<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\Request as RequestModel;
use App\Models\Lawyer;
use App\Models\LawyerOffer;
use App\Models\UserRequestRating;
use App\Models\LawyerRating;
use App\Services\NotificationService;

class RequestServiceController  extends Controller
{
    public function saveRequest(Request $request, NotificationService $notificationService)
    {
        $user = auth()->user();
    
        try {
            $validated = $request->validate([
                'username' => 'nullable|string',
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'title' => 'nullable|string',
                'mobile' => 'required|string',
                'email' => 'required|email',
                'message' => 'required|string',
                'summary' => 'required|string',
                'service_id' => 'nullable|exists:platform_services,id',
                'files' => 'nullable|array',
                'files.*' => 'file|mimes:jpeg,png,jpg,pdf,docx,xlsx,txt|max:5000',
                'lawyer_id' => 'nullable|exists:lawyers,id',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        }
    
        $validated['user_id'] = $user->id;
    
        if ($request->lawyer_id) {
            $validated['lawyer_id'] = [(int)$request->lawyer_id];
        } else {
            $topLawyers = Lawyer::orderBy('rate', 'desc')->take(10)->pluck('id')->toArray();
            $validated['lawyer_id'] = json_encode($topLawyers); 
        }
    
        if ($request->hasFile('files')) {
            $uploadedFiles = uploadFiles($request->file('files'), 'requestService_files');
            $validated['files'] = $uploadedFiles;
        }
        $validated['status'] = 'pending';

        $requestService = RequestModel::create($validated);
    
        // $lawyerIds = json_decode($validated['lawyer_id'], true);
        // foreach ($lawyerIds as $lawyerId) {
        //     $notificationService->sendRequestServiceNotificationToLawyer($requestService, $lawyerId);
        // }
    
        return response()->json([
            'success' => true,
            'message' => 'Request saved successfully.',
            'data' => $requestService,
        ]);
    }


    public function acceptPriceListOffer(Request $request)
    {
        try {
            $validated = $request->validate([
                'offer_id' => 'required|exists:lawyer_offers,id',
            ]);
    
            $offer = LawyerOffer::find($validated['offer_id']);
    
            $requestRecord = RequestModel::find($offer->request_id);
            if ($requestRecord->user_id !== auth()->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'You are not authorized to accept this offer.',
                ], 403);
            }
    
            if ($offer->status === 'accepted') {
                return response()->json([
                    'success' => false,
                    'message' => 'This offer has already been accepted.',
                ], 400);
            }
    
            if ($requestRecord->status === 'accepted') {
                return response()->json([
                    'success' => false,
                    'message' => 'This request already has an accepted offer.',
                ], 400);
            }
    
            $requestRecord->update([
                'status' => 'accepted',
            ]);
    
            $offer->update([
                'status' => 'accepted',
                'accepted_by' => auth()->id(),
            ]);
    
            LawyerOffer::where('request_id', $offer->request_id)
                ->where('id', '!=', $offer->id)
                ->update(['status' => 'rejected']);
    
            $lawyer = $offer->lawyer;
            if ($lawyer) {
                $lawyer->calculateScorePoints();
            }
    
            return response()->json([
                'success' => true,
                'message' => 'Offer accepted successfully.',
                'data' => $offer,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while accepting the offer.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    

    public function rateServiceRequest(Request $request, $requestId)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'nullable|string',
        ]);
    
        $userRequest = RequestModel::find($requestId);
    
        if (!$userRequest) {
            return response()->json([
                'success' => false,
                'message' => 'The request ID does not exist.',
            ], 404);
        }
    
        if ($userRequest->user_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to rate this request.',
            ], 403);
        }
    
        if ($userRequest->status !== 'completed') {
            return response()->json([
                'success' => false,
                'message' => 'Request must be completed to rate it.',
            ], 400);
        }
    
        $lawyerId = $userRequest->accepted_by;
        if (!$lawyerId) {
            return response()->json([
                'success' => false,
                'message' => 'No lawyer is assigned to this request.',
            ], 400);
        }
    
        $existingRating = UserRequestRating::where('request_id', $requestId)
            ->where('user_id', auth()->id())
            ->first();
    
        if ($existingRating) {
            return response()->json([
                'success' => false,
                'message' => 'You have already rated this request.',
            ], 400);
        }
    
        UserRequestRating::create([
            'request_id' => $requestId,
            'user_id' => auth()->id(),
            'rating' => $validated['rating'],
            'message' => $validated['message'],
            'request_model' =>'App\Models\Request',
        ]);
    
        LawyerRating::create([
            'lawyer_id' => $lawyerId,
            'user_id' => auth()->id(),
            'rating' => $validated['rating'],
            'message' => $validated['message'],
        ]);
    
        $averageRating = LawyerRating::where('lawyer_id', $lawyerId)->avg('rating');
        Lawyer::where('id', $lawyerId)->update([
            'rate' => round($averageRating, 1),
        ]);
    
        return response()->json([
            'success' => true,
            'message' => 'Rating submitted successfully, and lawyer rating updated.',
        ]);
    }
    
}
