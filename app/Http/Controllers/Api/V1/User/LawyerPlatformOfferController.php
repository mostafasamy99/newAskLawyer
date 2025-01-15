<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Models\LawyerAcceptedService;

class LawyerPlatformOfferController  extends Controller
{
    public function getLawyerOffers($platformServiceId)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access.',
            ], 401);
        }
        try {
            $offers = LawyerAcceptedService::with('lawyer')
                ->where('platform_service_id', $platformServiceId)
                ->get()
                ->map(function ($offer) {
                    return [
                        'offer_id' => $offer->id,
                        'price' => $offer->price,
                        'is_active' => $offer->is_active,
                        'offer_created_at' => $offer->created_at,
                        'lawyer_id' => $offer->lawyer->id,
                        'lawyer_name' => $offer->lawyer->name,
                        'email' => $offer->lawyer->email,
                        'mobile' => $offer->lawyer->mobile,
                        'rate' => $offer->lawyer->rate,
                        'img' => $offer->lawyer->img ? url($offer->lawyer->img) : null,

                    ];
                });

            if ($offers->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No offers found for the given service.',
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Platform services offers retrieved successfully',
                'data' => $offers,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while fetching offers.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
