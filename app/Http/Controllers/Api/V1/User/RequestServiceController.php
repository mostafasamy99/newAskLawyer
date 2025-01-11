<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request as Request2;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\Request;
use App\Models\Lawyer;
use App\Services\NotificationService;

class RequestServiceController  extends Controller
{

    
    public function saveRequest(Request2 $request, NotificationService $notificationService)
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
                'service_id' => 'required|exists:services,id',
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
            $validated['lawyer_id'] = json_encode([$request->lawyer_id]); 
        } else {
            $topLawyers = Lawyer::orderBy('rate', 'desc')->take(10)->pluck('id')->toArray();
            $validated['lawyer_id'] = json_encode($topLawyers); 
        }
    
        if ($request->hasFile('files')) {
            $uploadedFiles = uploadFiles($request->file('files'), 'requestService_files');
            $validated['files'] = $uploadedFiles;
        }
    
        $requestService = Request::create($validated);
    
        $lawyerIds = json_decode($validated['lawyer_id'], true);
        // foreach ($lawyerIds as $lawyerId) {
        //     $notificationService->sendRequestServiceNotificationToLawyer($requestService, $lawyerId);
        // }
    
        return response()->json([
            'success' => true,
            'message' => 'Request saved successfully.',
            'data' => $requestService,
        ]);
    }
    
    

}
