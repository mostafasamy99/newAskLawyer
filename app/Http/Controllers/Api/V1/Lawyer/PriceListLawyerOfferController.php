<?php

namespace App\Http\Controllers\Api\V1\Lawyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\Request as RequestModel;
use App\Models\Lawyer;
use App\Models\LawyerOffer;
use Illuminate\Support\Facades\Validator;

use App\Services\NotificationService;

class PriceListLawyerOfferController   extends Controller
{
    protected $notificationService;

    public function submitOffer(Request $request)
    {
        try {
            $validated = $request->validate([
                'request_id' => 'required|exists:requests,id',
                'price' => 'required|numeric|min:1',
                'message' => 'nullable|string',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        }
    
        $lawyer = auth()->guard('lawyer')->user();
    
        $requestRecord = RequestModel::find($validated['request_id']);
    
        if ($requestRecord->service_id !== null) {
            return response()->json([
                'success' => false,
                'message' => 'Offers can only be submitted for requests with service_id set to null.',
            ], 403);
        }
    
        $assignedLawyers = json_decode($requestRecord->lawyer_id, true); 
        if (!in_array($lawyer->id, $assignedLawyers)) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to submit an offer for this request.',
            ], 403);
        }
    
        $existingOffer = LawyerOffer::where('lawyer_id', $lawyer->id)
            ->where('request_id', $validated['request_id'])
            ->first();
    
        if ($existingOffer) {
            return response()->json([
                'success' => false,
                'message' => 'You have already submitted an offer for this request.',
            ], 403);
        }
    
        $offer = LawyerOffer::create([
            'lawyer_id' => $lawyer->id,
            'request_id' => $validated['request_id'],
            'price' => $validated['price'],
            'message' => $validated['message'],
            'status' => 'pending',
        ]);
    
        return response()->json([
            'success' => true,
            'message' => 'Offer submitted successfully.',
            'data' => $offer,
        ]);
    }
    public function startRequest(Request $request, $requestId)
    {
        try {
            $validated = Validator::make(['request_id' => $requestId], [
                'request_id' => 'required|exists:requests,id',
            ]);

            if ($validated->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed.',
                    'errors' => $validated->errors(),
                ], 422);
            }

            $requestRecord = RequestModel::find($requestId);

            if ($requestRecord->status !== 'accepted') {
                return response()->json([
                    'success' => false,
                    'message' => 'This request has already been started.',
                ], 403);
            }

            $lawyerOffer = LawyerOffer::where('request_id', $requestId)
                ->where('lawyer_id',auth()->guard('lawyer')->user()->id)
                ->where('status', 'accepted')
                ->first();

            if (!$lawyerOffer) {
                return response()->json([
                    'success' => false,
                    'message' => 'You are not authorized to start this request, or your offer is not accepted.',
                ], 403);
            }

            $requestRecord->update([
                'status' => 'in_progress',
                'accepted_by'=>auth()->guard('lawyer')->user()->id,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Request started successfully.',
                'data' => $requestRecord,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while starting the request.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function completeRequest(Request $request, $requestId)
    {
        try {
            $validated = Validator::make(['request_id' => $requestId], [
                'request_id' => 'required|exists:requests,id',
            ]);
    
            if ($validated->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed.',
                    'errors' => $validated->errors(),
                ], 422);
            }
    
            $requestRecord = RequestModel::find($requestId);
    
            if ($requestRecord->status !== 'in_progress') {
                return response()->json([
                    'success' => false,
                    'message' => 'Request cannot be completed as it is not in progress.',
                ], 403);
            }
    
            $lawyerOffer = LawyerOffer::where('request_id', $requestId)
                ->where('lawyer_id', auth()->guard('lawyer')->id())
                ->where('status', 'accepted')
                ->first();
    
            if (!$lawyerOffer) {
                return response()->json([
                    'success' => false,
                    'message' => 'You are not authorized to complete this request.',
                ], 403);
            }
    
            $requestRecord->update([
                'status' => 'completed',
                'accepted_by'=>auth()->guard('lawyer')->id(),
            ]);
    
            // Return only selected fields
            $responseData = [
                'id' => $requestRecord->id,
                'status' => $requestRecord->status,
                'summary' => $requestRecord->summary,
            ];
    
            return response()->json([
                'success' => true,
                'message' => 'Request completed successfully.',
                'data' => $responseData,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while completing the request.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    
    
     
}
