<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\Request as RequestModel;
use App\Models\PlatformService;
use App\Services\NotificationService;

class AllServiceRequestController  extends Controller
{
    
    public function getSingleLawyerRequestsService(Request $request)
    {
        $user = auth()->user();
        try {
            $validated = $request->validate([
                'order' => 'nullable|string|in:asc,desc',
                'per_page' => 'nullable|integer',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        }
        $order = $validated['order'] ?? 'desc';
        $perPage = $validated['per_page'] ?? 5; 
        $requests = RequestModel::where('user_id', $user->id)
        ->whereRaw('JSON_LENGTH(lawyer_id) = 1') 
        ->select('id', 'created_at', 'service_id', 'message', 'summary') 
        ->with('service:id,name') 
        ->orderBy('created_at', $order)
        ->paginate($perPage);
        
        return response()->json([
            'success' => true,
            'message' => 'Requests with a single lawyer ID retrieved successfully.',
            'data' => $requests,
        ]);
    }

    public function getDataOfSingleLawyerRequestsService(Request $request, $id)
    {
        $user = auth()->user();
        try {
            $requestData = RequestModel::where('user_id', $user->id)
                ->where('id', $id)
                ->whereRaw('JSON_LENGTH(lawyer_id) = 1')
                ->select('id', 'created_at', 'service_id', 'message', 'summary','status')
                ->with('service:id,name') 
                ->firstOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Request not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Request retrieved successfully.',
            'data' => $requestData,
        ]);
    }

    public function getMultipleLawyerRequestsService(Request $request)
    {
        $user = auth()->user();
        try {
            $validated = $request->validate([
                'order' => 'nullable|string|in:asc,desc',
                'per_page' => 'nullable|integer',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        }
        $order = $validated['order'] ?? 'desc';
        $perPage = $validated['per_page'] ?? 5;
        $requests = RequestModel::where('user_id', $user->id)
            ->whereRaw('JSON_LENGTH(lawyer_id) > 1') 
            ->select('id', 'created_at', 'service_id', 'message', 'summary') 
            ->with('service:id,name') 
            ->orderBy('created_at', $order)
            ->paginate($perPage);

        return response()->json([
            'success' => true,
            'message' => 'Requests with multiple lawyer IDs retrieved successfully.',
            'data' => $requests,
        ]);
    }

    public function getDataOfMultipleLawyerRequestsService(Request $request, $id)
    {
        $user = auth()->user();
        try {
            $requestData = RequestModel::where('user_id', $user->id)
                ->where('id', $id)
                ->whereRaw('JSON_LENGTH(lawyer_id) > 1') 
                ->select('id', 'created_at', 'service_id', 'message', 'summary','status')
                ->with('service:id,name') 
                ->firstOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Request not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Request retrieved successfully.',
            'data' => $requestData,
        ]);
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

}
