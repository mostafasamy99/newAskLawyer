<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfileController  extends Controller
{
 
    public function updateUserProfile(Request $request)
    {
        $user = auth()->user();

        try {
            $request->validate([
                'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'name' => 'required|string|max:255',
                'title' => 'required|string|max:255',
                'mobile' => 'required|unique:users,mobile,' . $user->id,
                'country_id' => 'nullable|exists:countries,id',
                'city_id' => 'nullable|exists:cities,id',
                'address' => 'nullable|string|max:500',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        }

        $data = $request->only(['name', 'title', 'mobile', 'country_id', 'city_id', 'address']);

        if ($request->hasFile('img')) {
            $data['img'] = uploadImage($request->file('img'), 'users/images');
        }

        $user->update($data);

        $responseData = $user->toArray();
        $responseData['img'] = $user->img ? url($user->img) : null; 
        unset($responseData['img_url']); 

        return response()->json([
            'success' => true,
            'message' => 'Profile upd
            ated successfully.',
            'data' => $responseData,
        ]);
    }
    
    public function getUserProfile()
    {
        $user = auth()->user();
    
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated.',
            ], 401);
        }
    
        $responseData = $user->toArray();
        $responseData['img'] = $user->img ? url($user->img) : null;
        // Cast country_id and city_id to strings
        $responseData['country_id'] = (string)$user->country_id;
        $responseData['city_id'] = (string)$user->city_id;
        return response()->json([
            'success' => true,
            'message' => 'User profile retrieved successfully.',
            'data' => $responseData,
        ]);
    }
    
    public function changeUserPassword(Request $request)
    {
        $user = auth()->user();

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

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'The current password is incorrect.',
            ], 401);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Password changed successfully.',
        ], 200);
    }

    
}
