<?php

namespace App\Services;

use App\Models\UserRequest;
use App\Models\Request as RequestModel;
use App\Models\Lawyer;
use App\Models\User;
use App\Models\RequestNotification;

class NotificationService
{
    public function sendNotificationToLawyer(UserRequest $userRequest, $lawyerId)
    {
        $lawyer = Lawyer::findOrFail($lawyerId);

        $title = 'New Request Received';
        $body = "You have received a new request from {$userRequest->name}.";

        RequestNotification::create([
            'user_request_id' => $userRequest->id,
            'user_request_type' => get_class($userRequest),
            'sender_id' => $userRequest->user_id,
            'sender_type' => 'App\Models\User',
            'receiver_id' => $lawyerId,
            'receiver_type' => 'App\Models\Lawyer',
            'title' => $title,
            'body' => $body,
        ]);

        if ($lawyer->fcm_token) {
            app('App\Services\FirebaseService')->sendNotification(
                $lawyer->fcm_token,
                $title,
                $body
            );
        }
    }


    public function sendRequestServiceNotificationToLawyer(RequestModel $Request, $lawyerId)
    {
        $lawyer = Lawyer::findOrFail($lawyerId);
    
        $title = 'New Request Received';
        $body = "You have received a new request service from {$Request->first_name} {$Request->last_name}.";
    
        RequestNotification::create([
            'user_request_id' => $Request->id,  
            'user_request_type' => get_class($Request),
            'sender_id' => $Request->user_id,
            'sender_type' => 'App\Models\User',
            'receiver_id' => $lawyerId,
            'receiver_type' => 'App\Models\Lawyer',
            'title' => $title,
            'body' => $body,
        ]);
        if ($lawyer->fcm_token) {
            app('App\Services\FirebaseService')->sendNotification(
                $lawyer->fcm_token,
                $title,
                $body
            );
        }
    }


    public function sendRequestAcceptedNotificationToUser(UserRequest $userRequest)
    {
        $user = User::findOrFail($userRequest->user_id);
        
        $title = 'Request Accepted';
        $body = "Your request has been accepted by a lawyer. You can now proceed with the next steps.";

        RequestNotification::create([
            'user_request_id' => $userRequest->id,
            'user_request_type' => get_class($userRequest),
            'sender_id' => $userRequest->accepted_by, 
            'sender_type' => 'App\Models\Lawyer',
            'receiver_id' => $user->id,
            'receiver_type' => 'App\Models\User',
            'title' => $title,
            'body' => $body,
        ]);

        if ($user->fcm_token) {
            app('App\Services\FirebaseService')->sendNotification(
                $user->fcm_token,
                $title,
                $body
            );
        }
    }

    public function sendServiceRequestAcceptedNotificationToUser(RequestModel $userRequest)
    {
        $user = User::findOrFail($userRequest->user_id);
        
        $title = 'Request Accepted';
        $body = "Your request has been accepted by a lawyer. You can now proceed with the next steps.";

        RequestNotification::create([
            'user_request_id' => $userRequest->id,
            'user_request_type' => get_class($userRequest),
            'sender_id' => $userRequest->accepted_by,  
            'sender_type' => 'App\Models\Lawyer',
            'receiver_id' => $user->id,
            'receiver_type' => 'App\Models\User',
            'title' => $title,
            'body' => $body,
        ]);

        if ($user->fcm_token) {
            app('App\Services\FirebaseService')->sendNotification(
                $user->fcm_token,
                $title,
                $body
            );
        }
    }

    

}
