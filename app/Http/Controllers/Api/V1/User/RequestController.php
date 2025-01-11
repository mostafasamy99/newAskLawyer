<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserRequest;
use App\Models\UserRequestRating;
use App\Models\LawyerRating;
use App\Models\Lawyer;
use App\Services\NotificationService;

class RequestController  extends Controller
{
    public function storeRequest(Request $request, NotificationService $notificationService)
    {
        $user = auth()->user();
    
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'mobile' => 'required|unique:users,mobile,' . $user->id,
                'country_id' => 'nullable|exists:countries,id',
                'lang_id' => 'required|exists:languages,id',
                'message' => 'required|string',
                'type' => 'required|string',
                'lawyer_type' => 'required',
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
        $validated['status'] = 'pending';
    
        if ($request->lawyer_id) {
            $validated['lawyer_id'] = [$request->lawyer_id];
            $userRequest = UserRequest::create($validated);
            $notificationService->sendNotificationToLawyer($userRequest, $request->lawyer_id);
        } else {
            // Get top 10 lawyer IDs
            $topLawyers = Lawyer::orderBy('rate', 'desc')->take(10)->pluck('id')->toArray();
    
            // Save the IDs as a JSON array in the `lawyer_id` column
            $validated['lawyer_id'] = json_encode($topLawyers);
    
            $userRequest = UserRequest::create($validated);
    
            // Notify each lawyer
            foreach ($topLawyers as $lawyerId) {
                $notificationService->sendNotificationToLawyer($userRequest, $lawyerId);
            }
        }
    
        return response()->json([
            'success' => true,
            'message' => 'Request created and notifications sent successfully.',
            'data' => $userRequest,
        ], 201);
    }
    
    public function rateRequest(Request $request, $requestId)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'nullable|string',
        ]);
    
        $userRequest = UserRequest::find($requestId);
    
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
    
        $existingRating = UserRequestRating::where('user_request_id', $requestId)
            ->where('user_id', auth()->id())
            ->first();
    
        if ($existingRating) {
            return response()->json([
                'success' => false,
                'message' => 'You have already rated this request.',
            ], 400);
        }
    
        UserRequestRating::create([
            'user_request_id' => $requestId,
            'user_id' => auth()->id(),
            'rating' => $validated['rating'],
            'message' => $validated['message'],
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
    
    public function getUserRequestById(Request $request, $id)
    {
        $user = auth()->user();
    
        $userRequest = UserRequest::where('id', $id)->where('user_id', $user->id)->first();
    
        if (!$userRequest) {
            return response()->json([
                'success' => false,
                'message' => 'Request not found or does not belong to the user.',
            ], 404);
        }
    
        return response()->json([
            'success' => true,
            'message' => 'User request retrieved successfully.',
            'data' => $userRequest,
        ]);
    }
    
    public function getActiveLawyerNames()
    {
        $lawyers = Lawyer::getActiveLawyerNames();

        return response()->json([
            'success' => true,
            'message' => 'Active lawyer names retrieved successfully.',
            'data' => $lawyers,
        ]);
    } 

    public function getActiveAdvisorNames()
    {
        $advisors = Lawyer::getActiveAdvisorNames();

        return response()->json([
            'success' => true,
            'message' => 'Active advisor names retrieved successfully.',
            'data' => $advisors,
        ]);
    }

}
