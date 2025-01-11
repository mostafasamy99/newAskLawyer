<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lawyer;
use App\Models\LawyerOffer;

use App\Services\NotificationService;
use Illuminate\Support\Facades\DB;

class ShowOfferController  extends Controller
{
 
    public function acceptOffer(Request $request, $offerId)
    {
        $offer = LawyerOffer::findOrFail($offerId);

        $userId = auth()->id();
        if ($offer->request->user_id !== $userId) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to accept this offer.',
            ], 403);
        }

        LawyerOffer::where('request_id', $offer->request_id)
            ->update(['accepted_by' => null]);

        $offer->update([
            'accepted_by' => $userId,
            'is_rejected' => false,  
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Offer accepted successfully.',
            'data' => $offer,
        ]);
    }

    public function rejectOffer(Request $request, $offerId)
    {
        $offer = LawyerOffer::findOrFail($offerId);

        $userId = auth()->id();
        if ($offer->request->user_id !== $userId) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to reject this offer.',
            ], 403);
        }

        $offer->update([
            'is_rejected' => true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Offer rejected successfully.',
        ]);
    }


}
