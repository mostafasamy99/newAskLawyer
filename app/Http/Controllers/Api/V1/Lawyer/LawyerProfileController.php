<?php

namespace App\Http\Controllers\Api\V1\Lawyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LawyerProfileController  extends Controller
{
 
    public function showProfile()
    {
        try {
            $lawyer = auth()->guard('lawyer')->user();
    
            if (!$lawyer) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized access. Please log in.',
                ], 401);
            }
    
            // Load relationships
            $lawyer->load(['services', 'languages', 'legal_fields']);
    
            // Hide sensitive fields
            $lawyer->makeHidden(['password', 'remember_token']);
    
            $responseData = $lawyer->toArray();
            $responseData['img_url'] = $lawyer->img ? url($lawyer->img) : null;
            $responseData['union_card_url'] = $lawyer->union_card ? url($lawyer->union_card) : null;
            $responseData['office_rent_url'] = $lawyer->office_rent ? url($lawyer->office_rent) : null;
            $responseData['passport_url'] = $lawyer->passport ? url($lawyer->passport) : null;
            $responseData['file_url'] = $lawyer->file ? url($lawyer->file) : null;
            $responseData['country_id'] = (string)$lawyer->country_id;
            $responseData['city_id'] = (string)$lawyer->city_id;
            return response()->json([
                'success' => true,
                'data' => $responseData,
            ], 200);
        } catch (\Exception $e) {
            \Log::error('Show profile error: ' . $e->getMessage());
    
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    
    public function updateProfile(Request $request)
    {
        try {
            $lawyer = auth()->guard('lawyer')->user();
    
            if (!$lawyer) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized access. Please log in.',
                ], 401);
            }
    
            $request->validate([
                'name' => 'string|max:255',
                'email' => 'email|unique:lawyers,email,' . $lawyer->id,
                'mobile' => 'string|max:20',
                'title' => 'string|max:255',
                'address' => 'string|max:255',
                'education' => 'string|max:255',
                'medals' => 'string|max:255',
                'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'union_card' => 'nullable|file|max:2048',
                'office_rent' => 'nullable|file|max:2048',
                'passport' => 'nullable|file|max:2048',
                'file' => 'nullable|file|max:2048',
                'services.*' => 'nullable|exists:services,id',
                'languages.*' => 'nullable|exists:languages,id',
                'legal_fields.*' => 'nullable|exists:legal_fields,id',
                'country_id' => 'nullable|exists:countries,id',
                'city_id' => 'nullable|exists:cities,id',
            ]);
    
            $lawyer->name = $request->input('name', $lawyer->name);
            // $lawyer->email = $request->input('email', $lawyer->email);
            $lawyer->mobile = $request->input('mobile', $lawyer->mobile);
            $lawyer->title = $request->input('title', $lawyer->title);
            $lawyer->address = $request->input('address', $lawyer->address);
            $lawyer->education = $request->input('education', $lawyer->education);
            $lawyer->medals = $request->input('medals', $lawyer->medals);
            $lawyer->country_id = $request->input('country_id', $lawyer->country_id);
            $lawyer->city_id = $request->input('city_id', $lawyer->city_id);
    
            if ($request->hasFile('img')) {
                $lawyer->img = uploadImage($request->file('img'), 'lawyers/images');
            }
            if ($request->hasFile('union_card')) {
                $lawyer->union_card = uploadImage($request->file('union_card'), 'lawyers/union_cards');
            }
           
            if ($request->hasFile('passport')) {
                $lawyer->passport = uploadImage($request->file('passport'), 'lawyers/passports');
            }
           
            if ($request->has('languages')) {
                $languages = json_decode($request->input('languages'), true);
                if (is_array($languages)) {
                    $lawyer->languages()->sync($languages);
                }
            }
            
            if ($request->has('legal_fields')) {
                $legalFields = json_decode($request->input('legal_fields'), true);
                if (is_array($legalFields)) {
                    $lawyer->legal_fields()->sync($legalFields);
                }
            }
            
            $lawyer->save();
    
            $lawyer->makeHidden(['password', 'remember_token']);
            $responseData = $lawyer->toArray();
            $responseData['img_url'] = $lawyer->img ? url($lawyer->img) : null;
            $responseData['union_card_url'] = $lawyer->union_card ? url($lawyer->union_card) : null;
            $responseData['passport_url'] = $lawyer->passport ? url($lawyer->passport) : null;
    
            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully.',
                'data' => $responseData,
            ], 200);
        } catch (\Exception $e) {
            \Log::error('Update profile error: ' . $e->getMessage());
    
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    
    
    public function changePassword(Request $request)
    {
        $lawyer = auth()->guard('lawyer')->user();
    
        if (!$lawyer) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access. Please log in.',
            ], 401);
        }
    
        try {
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:8|confirmed', 
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        }
    
        if (!Hash::check($request->current_password, $lawyer->password)) {
            return response()->json([
                'success' => false,
                'message' => 'The current password is incorrect.',
            ], 401);
        }
    
        $lawyer->password = Hash::make($request->new_password);
        $lawyer->save();
    
        return response()->json([
            'success' => true,
            'message' => 'Password changed successfully.',
        ], 200);
    }
    
}
