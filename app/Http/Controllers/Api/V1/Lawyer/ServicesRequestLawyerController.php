<?php

namespace App\Http\Controllers\Api\V1\Lawyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\Request as RequestModel;
use App\Models\Lawyer;
use App\Services\NotificationService;

class ServicesRequestLawyerController  extends Controller
{
    protected $notificationService;
     
    //Price List
    public function getPriceListServicesRequestsWithoutServiceId(Request $request)
    {
        $lawyer = auth()->guard('lawyer')->user(); 
        if (!$lawyer) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Please log in as a lawyer.',
            ], 401);
        }
    
        $perPage = $request->get('per_page', 10);  
        $page = $request->get('page', 1); 
    
        $userRequests = RequestModel::whereJsonContains('lawyer_id', $lawyer->id)
            ->whereNull('service_id')
            ->select('id', 'user_id', 'first_name', 'last_name', 'email', 'message', 'summary', 'created_at', 'status')
            ->with('service:id,name') 
            ->paginate($perPage, ['*'], 'page', $page);
    
        if ($userRequests->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No Price List requests found for the given type.',
            ], 404);
        }
    
        return response()->json([
            'success' => true,
            'message' => "Price List requests retrieved successfully.",
            'data' => $userRequests,
        ]);
    }

    public function getPriceListServiceRequestById($id)
    {
        $lawyer = auth()->guard('lawyer')->user(); 
        if (!$lawyer) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Please log in as a lawyer.',
            ], 401);
        }

        $serviceRequest = RequestModel::whereJsonContains('lawyer_id', $lawyer->id)
            ->whereNull('service_id') 
            ->select('id', 'user_id', 'first_name', 'last_name', 'email', 'message', 'summary', 'created_at', 'status', 'files') 
            ->with('service:id,name')
            ->find($id);  

        if (!$serviceRequest) {
            return response()->json([
                'success' => false,
                'message' => 'Price List request not found.',
            ], 404);
        }

        $files = $serviceRequest->files ? array_map(function ($file) {
            return url($file);  
        }, explode(',', $serviceRequest->files)) : [];

        $serviceRequest->files = $files;

        return response()->json([
            'success' => true,
            'message' => 'Price List request retrieved successfully.',
            'data' => [
                'service_request' => $serviceRequest,
            ],
        ]);
    }

    public function acceptPriceListRequest($requestId)
    {
        $lawyer = auth()->guard('lawyer')->user(); 
        $userRequest = RequestModel::find($requestId);  
        
        if (!$userRequest) {
            return response()->json([
                'success' => false,
                'message' => 'No request found with the given ID.',
            ], 404);
        }

        if ($userRequest->service_id !== null) {
            return response()->json([
                'success' => false,
                'message' => 'Please choose a correct request.',
            ], 400);
        }

        $lawyerIds = json_decode($userRequest->lawyer_id, true);
        if (!is_array($lawyerIds)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid lawyer ID format.',
            ], 400);
        }

        if (!in_array($lawyer->id, $lawyerIds)) {
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

            // $this->notificationService->sendServiceRequestAcceptedNotificationToUser($userRequest);

            return response()->json([
                'success' => true,
                'message' => 'Request accepted successfully.',
            ]);
        }
    }
    public function completePriceListRequest($requestId)
    {
        $lawyer = auth()->guard('lawyer')->user(); 
        $userRequest = RequestModel::find($requestId);  
        
        if (!$userRequest) {
            return response()->json([
                'success' => false,
                'message' => 'No request found with the given ID.',
            ], 404);
        }

        if ($userRequest->service_id !== null) {
            return response()->json([
                'success' => false,
                'message' => 'Please choose a correct request.',
            ], 400);
        }

        $lawyerIds = json_decode($userRequest->lawyer_id, true);
        if (!is_array($lawyerIds)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid lawyer ID format.',
            ], 400);
        }

        if (!in_array($lawyer->id, $lawyerIds)) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to complete this request.',
            ], 403);
        }

        if ($userRequest->status === 'accepted') {
            $userRequest->update([
                'status' => 'completed',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Request completed successfully.',
            ]);
        }
    }

    //Hire Employee
    public function getHireEmployeeServicesRequestsWithoutServiceId(Request $request)
    {
        $lawyer = auth()->guard('lawyer')->user(); 
        if (!$lawyer) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Please log in as a lawyer.',
            ], 401);
        }

        $perPage = $request->get('per_page', 10);  
        $page = $request->get('page', 1); 

        $userRequests = RequestModel::whereJsonContains('lawyer_id', $lawyer->id)
            ->whereNotNull('service_id') 
            ->select('id', 'user_id', 'first_name', 'last_name', 'email', 'message', 'summary', 'created_at', 'status')
            ->paginate($perPage, ['*'], 'page', $page);

        if ($userRequests->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No Hire Employee requests found for the given type.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => "Hire Employee requests retrieved successfully.",
            'data' => $userRequests,
        ]);
    }
  
    public function getHireEmployeeServiceRequestById($id)
    {
        $lawyer = auth()->guard('lawyer')->user(); 
        if (!$lawyer) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Please log in as a lawyer.',
            ], 401);
        }
    
        $serviceRequest = RequestModel::whereJsonContains('lawyer_id', $lawyer->id)
            ->whereNotNull('service_id') 
            ->select('id', 'user_id', 'first_name', 'last_name', 'email', 'message', 'summary', 'created_at', 'status', 'files') 
            ->with('service:id,name')
            ->find($id);  
    
        if (!$serviceRequest) {
            return response()->json([
                'success' => false,
                'message' => 'Hire Employee request not found.',
            ], 404);
        }
    
        $files = $serviceRequest->files ? array_map(function ($file) {
            return url($file);  
        }, explode(',', $serviceRequest->files)) : [];
    
        $serviceRequest->files = $files;
    
        return response()->json([
            'success' => true,
            'message' => 'Hire Employee request retrieved successfully.',
            'data' => [
                'service_request' => $serviceRequest,
            ],
        ]);
    }

    public function acceptHireRequest($requestId)
    {
        $lawyer = auth()->guard('lawyer')->user(); 
        $userRequest = RequestModel::find($requestId);  
        
        if (!$userRequest) {
            return response()->json([
                'success' => false,
                'message' => 'No request found with the given ID.',
            ], 404);
        }

        if ($userRequest->service_id === null) {
            return response()->json([
                'success' => false,
                'message' => 'Please choose a correct request.',
            ], 400);
        }

        $lawyerIds = json_decode($userRequest->lawyer_id, true);
        if (!is_array($lawyerIds)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid lawyer ID format.',
            ], 400);
        }

        if (!in_array($lawyer->id, $lawyerIds)) {
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

            // $this->notificationService->sendServiceRequestAcceptedNotificationToUser($userRequest);

            return response()->json([
                'success' => true,
                'message' => 'Request accepted successfully.',
            ]);
        }
    }

    public function completeHireRequest($requestId)
    {
        $lawyer = auth()->guard('lawyer')->user(); 
        $userRequest = RequestModel::find($requestId);  
        
        if (!$userRequest) {
            return response()->json([
                'success' => false,
                'message' => 'No request found with the given ID.',
            ], 404);
        }

        if ($userRequest->service_id === null) {
            return response()->json([
                'success' => false,
                'message' => 'Please choose a correct request.',
            ], 400);
        }

        $lawyerIds = json_decode($userRequest->lawyer_id, true);
        if (!is_array($lawyerIds)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid lawyer ID format.',
            ], 400);
        }

        if (!in_array($lawyer->id, $lawyerIds)) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to complete this request.',
            ], 403);
        }

        if ($userRequest->status === 'accepted') {
            $userRequest->update([
                'status' => 'completed',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Request completed successfully.',
            ]);
        }
    }

     
}
