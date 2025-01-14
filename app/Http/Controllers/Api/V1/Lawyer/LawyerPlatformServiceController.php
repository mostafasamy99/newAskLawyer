<?php

namespace App\Http\Controllers\Api\V1\Lawyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PlatformService;
use App\Models\LawyerAcceptedService;
use App\Models\Lawyer;


class LawyerPlatformServiceController  extends Controller
{
    public function getPlatformServices(Request $request)
    {
        $lawyer = auth()->guard('lawyer')->user();
        if (!$lawyer) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
            ], 401);
        }
    
        $lawyer->load('legal_fields');
        $legalFieldIds = $lawyer->legal_fields->pluck('id');
    
        $perPage = $request->input('per_page', 10); 
        $page = $request->input('page', 1); 
    
        $platformServices = PlatformService::whereIn('legal_field_id', $legalFieldIds)
            ->paginate($perPage, ['*'], 'page', $page);
    
        return response()->json([
            'status' => true,
            'message' => 'Services retrieved successfully',
            'data' => $platformServices,
        ], 200);
    }
    

    public function addService(Request $request)
    {
        $lawyer = auth()->guard('lawyer')->user();
        try {
            $validated = $request->validate([
                'platform_service_id' => 'required|exists:platform_services,id',
            ]);
            $platformService = PlatformService::find($validated['platform_service_id']);
            $request->validate([
                'price' => [
                    'nullable',
                    'numeric',
                    'min:0',
                    function ($attribute, $value, $fail) use ($platformService) {
                        if ($value > $platformService->max_price) {
                            $fail("The $attribute must not exceed the maximum allowed price of {$platformService->max_price}.");
                        }
                    },
                ],
            ]);
            $existingService = LawyerAcceptedService::where('lawyer_id', $lawyer->id)
                ->where('platform_service_id', $platformService->id)
                ->first();
            if ($existingService) {
                return response()->json([
                    'status' => false,
                    'message' => 'You have already added this service.',
                    'data' => null,
                ], 409); 
            }
            $service = LawyerAcceptedService::create([
                'lawyer_id' => $lawyer->id,
                'platform_service_id' => $platformService->id,
                'price' => $request->price,
                'is_active' => true,
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Service added successfully',
                'data' => $service,
            ], 201); 
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Failed',
                'data' => $e->errors(),
            ], 422); 
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An unexpected error occurred',
                'data' => $e->getMessage(),
            ], 500); 
        }
    }
    

    public function getAcceptedServices(Request $request)
    {
        $lawyer = auth()->guard('lawyer')->user();

        try {
            $perPage = $request->input('per_page', 10); 
            $page = $request->input('page', 1); 

            $services = LawyerAcceptedService::where('lawyer_id', $lawyer->id)
                ->with(['platformService.translations'])
                ->paginate($perPage, ['*'], 'page', $page)
                ->map(function ($service) {
                    return [
                        'platform_service_id' => $service->platform_service_id,
                        'price' => $service->price,
                        'is_active' => $service->is_active,
                        'created_at' => $service->created_at,
                        'platform_service' => [
                            'id' => $service->platformService->id,
                            'icon' => $service->platformService->icon,
                            'name' => $service->platformService->name,
                            'description' => $service->platformService->description,
                            'translations' => $service->platformService->translations->map(function ($translation) {
                                return [
                                    'locale' => $translation->locale,
                                    'name' => $translation->name,
                                    'description' => $translation->description,
                                ];
                            }),
                        ],
                    ];
                });

            return response()->json([
                'status' => 'success',
                'message' => 'Accepted services retrieved successfully.',
                'data' => $services,
                'pagination' => [
                    'total' => $services->total(),
                    'per_page' => $services->perPage(),
                    'current_page' => $services->currentPage(),
                    'last_page' => $services->lastPage(),
                    'next_page_url' => $services->nextPageUrl(),
                    'prev_page_url' => $services->previousPageUrl(),
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected error occurred.',
                'data' => $e->getMessage(),
            ], 500);
        }
    }


        


}
