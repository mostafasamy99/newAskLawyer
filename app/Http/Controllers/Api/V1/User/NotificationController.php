<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserRequest;
use App\Models\Lawyer;
use App\Models\RequestNotification;


class NotificationController  extends Controller
{
    public function getUserNotifications(Request $request)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access.',
            ], 401);
        }

        $perPage = $request->input('per_page', 5); 

        $notifications = RequestNotification::where('receiver_id', $user->id)
            ->orderBy('created_at', 'desc') 
            ->paginate($perPage);

        return response()->json([
            'success' => true,
            'message' => 'User notifications retrieved successfully.',
            'data' => $notifications,
        ]);
    }

}
