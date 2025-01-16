<?php

namespace App\Http\Controllers\Api\V1\Lawyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\UserRequest;
use App\Models\Lawyer;
use App\Services\NotificationService;
use Illuminate\Support\Facades\DB;

class RequestLawyerController  extends Controller
{
    protected $notificationService; 
    public function getUserRequestsByType(Request $request)
    {
        $lawyer = auth()->guard('lawyer')->user(); 
        if (!$lawyer) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Please log in as a lawyer.',
            ], 401);
        }
        $validated = $request->validate([
            'type' => 'required|string',  
            'per_page' => 'nullable|integer|min:1',  
            'page' => 'nullable|integer|min:1', 
        ]);
        $type = $validated['type'];
        $perPage = $request->get('per_page', 10);  
        $page = $request->get('page', 1); 

        $userRequests = UserRequest::where('type', $type)
            ->whereJsonContains('lawyer_id', $lawyer->id)
            ->select('id','user_id', 'name', 'email', 'mobile', 'message', 'created_at', 'status')
            ->paginate($perPage, ['*'], 'page', $page); 
        if ($userRequests->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No user requests found for the given type.',
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => "User requests of type '{$type}' retrieved successfully.",
            'data' => $userRequests,
        ]);
    }

    public function getOneUserRequestByType(Request $request, $type, $id)
    {
        $lawyer = auth()->guard('lawyer')->user(); 
        if (!$lawyer) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Please log in as a lawyer.',
            ], 401);
        }

        if (!in_array($type, ['call', 'chat', 'question'])) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid request type.',
            ], 400);
        }

        $userRequest = UserRequest::where('type', $type)
            ->whereJsonContains('lawyer_id', $lawyer->id)
            ->where('id', $id)
            ->select('user_id', 'name', 'email', 'mobile', 'message', 'created_at', 'status')
            ->first();

        if (!$userRequest) {
            return response()->json([
                'success' => false,
                'message' => 'No user request found for the given type and request ID.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => "User request of type '{$type}' retrieved successfully.",
            'data' => $userRequest,
        ]);
    }



    public function acceptRequest($requestId)
    {
        $lawyer = auth()->guard('lawyer')->user(); 
        $userRequest = UserRequest::find($requestId);  
    
        if (!$userRequest) {
            return response()->json([
                'success' => false,
                'message' => 'No request found with the given ID.',
            ], 404);
        }
    
        if (!in_array($lawyer->id, $userRequest->lawyer_id)) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to accept this request.',
            ], 403);
        }
    
        if ($userRequest->status === 'pending') {
            $userRequest->update([
                'status' => 'accepted',
                'accepted_by' => $lawyer->id,
            ]);

            // dd(get_class($lawyer));

            $lawyer->calculateScorePoints();
            
            // $this->notificationService->sendRequestAcceptedNotificationToUser($userRequest);

            return response()->json([
                'success' => true,
                'message' => 'Request accepted successfully.',
            ]);
        }
    
        return response()->json([
            'success' => false,
            'message' => 'Request cannot be accepted.',
        ], 400);
    }
    
    
    // public function cancelRequest($requestId)
    // {
    //     $lawyer = auth()->guard('lawyer')->user();
    //     $userRequest = UserRequest::findOrFail($requestId);

    //     if (!in_array($lawyer->id, $userRequest->lawyer_id)) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'You are not authorized to cancel this request.',
    //         ], 403); 
    //     }

    //     if ($userRequest->status === 'pending') {
    //         $userRequest->update(['status' => 'canceled']);

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Request canceled successfully.',
    //         ]);
    //     }

    //     return response()->json([
    //         'success' => false,
    //         'message' => 'Request cannot be canceled.',
    //     ], 400);
    // }

    public function completeRequest($requestId)
    {
        $lawyer = auth()->guard('lawyer')->user();
        $userRequest = UserRequest::findOrFail($requestId);

        if (!in_array($lawyer->id, $userRequest->lawyer_id)) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to complete this request.',
            ], 403); 
        }

        if ($userRequest->status === 'accepted' && $userRequest->accepted_by === $lawyer->id) {
            $userRequest->update(['status' => 'completed']);

            return response()->json([
                'success' => true,
                'message' => 'Request completed successfully.',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Request cannot be completed.',
        ], 400);
    }

        

}
