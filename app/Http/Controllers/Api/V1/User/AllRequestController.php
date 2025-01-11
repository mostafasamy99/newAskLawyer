<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\UserRequest;
use App\Models\Lawyer;
use App\Services\NotificationService;
use Illuminate\Support\Facades\DB;

class AllRequestController  extends Controller
{
    
    public function getUserRequestsByType(Request $request)
    {
        $user = auth()->user();
        try {
            $validated = $request->validate([
                'type' => 'required|string|in:call,chat,question',
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
        $requests = UserRequest::where('user_id', $user->id)
            ->where('type', $validated['type'])
            ->orderBy('created_at', $order)
            ->paginate($perPage);
        return response()->json([
            'success' => true,
            'message' => "User requests of type '{$validated['type']}' retrieved successfully in {$order} order.",
            'data' => $requests,
        ]);
    }
    public function getUserRequestById(Request $request, $id)
    {
        $user = auth()->user();
        
        try {
            $validated = $request->validate([
                'id' => 'required|integer',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        }
    
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
    
    
}
