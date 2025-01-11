<?php

namespace App\Http\Controllers\Api\V1\Lawyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserRequest;
use App\Models\Lawyer;
use App\Models\RequestNotification;

class NotificationLawyerController  extends Controller
{
    public function getLawyerNotifications(Request $request)
    {
        $lawyer = auth()->guard('lawyer')->user();

        if (!$lawyer) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access.',
            ], 401);
        }

        $perPage = $request->input('per_page', 5); 

        $notifications = RequestNotification::where('receiver_id', $lawyer->id)
            ->orderBy('created_at', 'desc') 
            ->paginate($perPage);

        return response()->json([
            'success' => true,
            'message' => 'lawyer notifications retrieved successfully.',
            'data' => $notifications,
        ]);
    }

}
