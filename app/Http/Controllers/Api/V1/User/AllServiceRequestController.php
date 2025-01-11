<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\Request as RequestModel;
use App\Models\Lawyer;
use App\Services\NotificationService;
use Illuminate\Support\Facades\DB;

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
    
}
