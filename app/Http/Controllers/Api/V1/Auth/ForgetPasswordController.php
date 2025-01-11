<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lawyer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ForgetPasswordController extends Controller
{

    //lawyer
    
    public function sendResetOtpLawyer(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:lawyers,email',
        ]);

        $lawyer = Lawyer::where('email', strtolower(trim($request->email)))->first();

        $otp = rand(1000, 9999);

        $lawyer->update([
            'code' => $otp,
            'otp_expires_at' => now()->addMinutes(10), 
        ]);

        Mail::raw('Your OTP to reset the password is: ' . $otp, function ($message) use ($lawyer) {
            $message->to($lawyer->email)
                    ->subject('Reset Password OTP'); 
        });

        return response()->json([
            'success' => true,
            'message' => 'OTP sent to your email.',
        ]);
    }
    public function ResendResetOtpLawyer(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:lawyers,email',
        ]);

        $lawyer = Lawyer::where('email', strtolower(trim($request->email)))->first();

        $otp = rand(1000, 9999);

        $lawyer->update([
            'code' => $otp,
            'otp_expires_at' => now()->addMinutes(10), 
        ]);

        Mail::raw('Your new OTP to reset the password is: ' . $otp, function ($message) use ($lawyer) {
            $message->to($lawyer->email)
                    ->subject('Reset Password OTP'); 
        });

        return response()->json([
            'success' => true,
            'message' => ' New OTP sent to your email.',
        ]);
    }

    public function otp_check_lawyer(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:lawyers,email',
            'otp' => 'required|numeric',
        ]);

        $lawyer = Lawyer::where('email', strtolower(trim($request->email)))->first();

        if ($lawyer->code !== $request->otp || now()->greaterThan($lawyer->otp_expires_at)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired OTP.',
            ], 400);
        }

        $lawyer->update([
            'code' => null,
            'otp_expires_at' => null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'OTP verified.',
        ]);
    }


    public function resetPasswordLawyer(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email|exists:lawyers,email',
            'password' => 'required|confirmed|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(), // Return validation errors
            ], 422);
        }

        // Find the lawyer
        $lawyer = Lawyer::where('email', strtolower(trim($request->email)))->first();


        // Reset the password
        $lawyer->update([
            'password' => Hash::make($request->password),
            'code' => null, 
            'otp_expires_at' => null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Password has been reset successfully.',
        ]);
    }


    //user

    public function sendResetOtpUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', strtolower(trim($request->email)))->first();

        $otp = rand(1000, 9999);

        $user->update([
            'code' => $otp,
            'otp_expires_at' => now()->addMinutes(10), 
        ]);

        Mail::raw('Your OTP to reset the password is: ' . $otp, function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Reset Password OTP'); 
        });

        return response()->json([
            'success' => true,
            'message' => 'OTP sent to your email.',
        ]);
    }
    public function ResendResetOtpUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', strtolower(trim($request->email)))->first();

        $otp = rand(1000, 9999);

        $user->update([
            'code' => $otp,
            'otp_expires_at' => now()->addMinutes(10), 
        ]);

        Mail::raw('Your new OTP to reset the password is: ' . $otp, function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Reset Password OTP'); 
        });

        return response()->json([
            'success' => true,
            'message' => ' New OTP sent to your email.',
        ]);
    }

    public function otp_check_user(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|numeric',
        ]);

        $user = User::where('email', strtolower(trim($request->email)))->first();

        if ($user->code !== $request->otp || now()->greaterThan($user->otp_expires_at)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired OTP.',
            ], 400);
        }

        $user->update([
            'code' => null,
            'otp_expires_at' => null,
            'is_activate'=>1
        ]);

        return response()->json([
            'success' => true,
            'message' => 'OTP verified.',
        ]);
    }

    public function resetPasswordUser(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(), 
            ], 422);
        }

        // Find the user
        $user = User::where('email', strtolower(trim($request->email)))->first();


        // Reset the password
        $user->update([
            'password' => Hash::make($request->password),
            'code' => null, 
            'otp_expires_at' => null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Password has been reset successfully.',
        ]);
    }



 
}
