<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\Request as RequestModel;
use App\Models\PlatformService;
use App\Models\LawyerOffer;
use Illuminate\Support\Facades\Validator;

use App\Services\NotificationService;

class AllServiceRequestController  extends Controller
{
    //price list

    public function getAllPriceListRequests()
    {
        try {
            $perPage = request()->input('per_page', 10);
            $order = request()->input('order', 'desc');
    
            $requests = RequestModel::select(
                    'id',
                    'created_at',
                    'first_name',
                    'last_name',
                    'message',
                    'user_id',
                    'lawyer_id',
                    'status',
                    'summary',
                    'accepted_by'
                )
                ->whereNull('service_id')
                ->orderBy('created_at', $order)
                ->paginate($perPage);
    
            if ($requests->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No requests found.',
                    'data' => [],
                ], 404);
            }
    
            return response()->json([
                'success' => true,
                'message' => 'Requests retrieved successfully.',
                'data' => $requests,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    
    public function getPriceListRequestById($id)
    {
        try {
            $request = RequestModel::select(
                    'id',
                    'created_at',
                    'first_name',
                    'last_name',
                    'message',
                    'user_id',
                    'lawyer_id',
                    'status',
                    'summary',
                    'accepted_by',
                    'files'
                )
                ->where('id', $id)
                ->whereNull('service_id')
                ->first();
    
            if (!$request) {
                return response()->json([
                    'success' => false,
                    'message' => 'Request not found.',
                    'data' => [],
                ], 404);
            }
            if ($request->files) {
                $filePaths = explode(',', $request->files); 
                $request->files = array_map(function ($filePath) {
                    return url($filePath); 
                }, $filePaths);
            }
            return response()->json([
                'success' => true,
                'message' => 'Request retrieved successfully.',
                'data' => $request,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getLawyersWithOffers($id)
    {
        $platformService = PlatformService::with('translations')->find($id);
    
        if (!$platformService) {
            return response()->json(['message' => 'Platform service not found.'], 404);
        }
    
        $perPage = request()->query('per_page', 10);
    
        $lawyers = $platformService->lawyerAcceptedServices()
            ->with('lawyer')
            ->where('is_active', 1)
            ->paginate($perPage)
            ->through(function ($service) use ($platformService) {
                return [
                    'lawyer_id' => $service->lawyer_id,
                    'lawyer_name' => $service->lawyer->name,
                    'lawyer_email' => $service->lawyer->email,
                    'lawyer_rate' => $service->lawyer->rate,
                    'lawyer_img' => $service->lawyer->img ? url($service->lawyer->img) : null,
                    'offer_price' => $service->price,
                    'offer_status' => $service->is_active ? 'Active' : 'Inactive',
                ];
            });
    
        $translations = $platformService->translations->mapWithKeys(function ($translation) {
            return [
                $translation->locale => [
                    'name' => $translation->name,
                    'description' => $translation->description,
                ],
            ];
        });
    
        return response()->json([
            'success' => true,
            'message' => 'Lawyers offers retrieved successfully.',
            'data' => [
                'platform_service' => [
                    'translations' => $translations,
                    'price' => $platformService->price,  
                    'icon' => $platformService->icon? url($platformService->icon) : null,  
                ],
                'lawyers' => $lawyers,  
            ],
        ]);
    }
    
    public function getAllPlatfromServices(Request $request)
    {
        $perPage = $request->input('per_page', 5); 

        $platformServices = PlatformService::orderBy('created_at', 'desc') 
            ->paginate($perPage);

        return response()->json([
            'success' => true,
            'message' => 'Platform services retrieved successfully.',
            'data' => $platformServices
        ]);
    }



    public function getOffersByRequest($request_id)
    {
        try {
            $validated = Validator::make(['request_id' => $request_id], [
                'request_id' => 'required|exists:requests,id',
            ]);
    
            if ($validated->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed.',
                    'errors' => $validated->errors(),
                ], 422);
            }
    
            $requestRecord = RequestModel::find($request_id);
    
            if ($requestRecord->service_id !== null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Offers can only be retrieved for requests with service_id set to null.',
                ], 403);
            }
    
            if ($requestRecord->user_id !== auth()->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'You are not authorized to view offers for this request.',
                ], 403);
            }
    
            $perPage = request()->input('per_page', 5); 
            $order = request()->input('order', 'desc'); 
    
            $offers = LawyerOffer::where('request_id', $request_id)
                ->with('lawyer:id,name,email,mobile,rate,img')
                ->orderBy('created_at', $order)
                ->paginate($perPage);
    
            $offers->getCollection()->transform(function ($offer) {
                if ($offer->lawyer && $offer->lawyer->img) {
                    $offer->lawyer->img = url($offer->lawyer->img);
                }
                return $offer;
            });
    
            if ($offers->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No offers found for this request.',
                    'data' => [],
                ], 404);
            }
    
            return response()->json([
                'success' => true,
                'message' => 'Offers retrieved successfully.',
                'data' => $offers,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
        
    public function getOfferById($offerId)
    {
        try {
            // Validate the offer ID
            $validated = Validator::make(['offer_id' => $offerId], [
                'offer_id' => 'required|exists:lawyer_offers,id',
            ]);

            if ($validated->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed.',
                    'errors' => $validated->errors(),
                ], 422);
            }

            // Retrieve the offer with the associated lawyer details
            $offer = LawyerOffer::where('id', $offerId)
                ->with('lawyer:id,name,email,mobile,rate,img')
                ->first();

            if (!$offer) {
                return response()->json([
                    'success' => false,
                    'message' => 'Offer not found.',
                ], 404);
            }

            // Modify the lawyer's image URL if it exists
            if ($offer->lawyer && $offer->lawyer->img) {
                $offer->lawyer->img = url($offer->lawyer->img);
            }

            return response()->json([
                'success' => true,
                'message' => 'Offer retrieved successfully.',
                'data' => $offer,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    //hire employee 
    public function getAllHireRequests()
    {
        try {
            $perPage = request()->input('per_page', 10);
            $order = request()->input('order', 'desc');
    
            $requests = RequestModel::select(
                    'id',
                    'created_at',
                    'first_name',
                    'last_name',
                    'message',
                    'service_id',
                    'user_id',
                    'lawyer_id',
                    'status',
                    'summary',
                    'accepted_by'
                )
                ->with(['service' => function ($query) {
                    $query->select('platform_services.id') 
                          ->withTranslation(); 
                }])
                ->whereNotNull('service_id')
                ->orderBy('created_at', $order)
                ->paginate($perPage);
    
            if ($requests->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No requests found.',
                    'data' => [],
                ], 404);
            }
    
            return response()->json([
                'success' => true,
                'message' => 'Requests retrieved successfully.',
                'data' => $requests,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    
    
    public function getHireRequestById($id)
    {
        try {
            $request = RequestModel::select(
                    'id',
                    'created_at',
                    'first_name',
                    'last_name',
                    'message',
                    'service_id',
                    'user_id',
                    'lawyer_id',
                    'status',
                    'summary',
                    'accepted_by',
                    'files'
                )
                ->with(['service' => function ($query) {
                    $query->select('platform_services.id')
                          ->withTranslation(); 
                }])
                ->where('id', $id)
                ->whereNotNull('service_id')
                ->first();
    
            if (!$request) {
                return response()->json([
                    'success' => false,
                    'message' => 'Request not found.',
                    'data' => [],
                ], 404);
            }
            if ($request->files) {
                $filePaths = explode(',', $request->files); 
                $request->files = array_map(function ($filePath) {
                    return url($filePath); 
                }, $filePaths);
            }
            return response()->json([
                'success' => true,
                'message' => 'Request retrieved successfully.',
                'data' => $request,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    

}
