<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Models\User;
use App\Models\Lawyer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\VerifyOtpLawyer;
use App\Http\Requests\Auth\LoginCheckRequest;
use App\Http\Requests\Auth\VerifyOtpUser;

class LoginController extends Controller
{
    protected $user;
    protected $lawyer;

    public function __construct(User $user, Lawyer $lawyer)
    {
        $this->user = $user;
        $this->lawyer = $lawyer;
    }

    /**
     * Handle login for both users and lawyers
     */
    public function loginCheck(LoginCheckRequest $request)
    {

        if ($request->user_type == 1) {
            $result = $this->lawyerCheckLogin($request);
        } elseif ($request->user_type == 2) {
            $result = $this->userCheckLogin($request);
        }

        return $result;
    }

    /**
     * Lawyer login logic
     */
    private function lawyerCheckLogin($request)
    {
        $lawyer = $this->lawyer->where('email', strtolower(trim($request->email)))->first();

        if (!$lawyer || !Hash::check($request->password, $lawyer->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials',
            ], 401);
        }

        if ($lawyer->is_activate != 1) {
            return response()->json([
                'success' => false,
                'message' => 'Your account is not activated.',
            ], 403);
        }
        if (!empty($user->code)) {
            return response()->json([
                'success' => false,
                'message' => 'Please confirm your OTP before logging in.',
            ], 403);
        }
        if ($request->has('fcm_token')) {
            $lawyer->fcm_token = $request->fcm_token;  
            $lawyer->save();
        }
        $token = $lawyer->createToken('lawyerToken')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'data' => [
                'token' => $token,
                'user' => $lawyer,
            ],
        ]);
    }

    /**
     * User login logic
     */
    private function userCheckLogin($request)
    {
        $user = $this->user->where('email', strtolower(trim($request->email)))->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials',
            ], 401);
        }

        if ($user->is_activate != 1) {
            return response()->json([
                'success' => false,
                'message' => 'Please confirm your OTP before logging in.',
            ], 403);
        }

        if ($request->has('fcm_token')) {
            $user->fcm_token = $request->fcm_token;  
            $user->save();
        }
        $token = $user->createToken('userToken')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'data' => [
                'token' => $token,
                'user' => $user,
            ],
        ]);
    }

    public function verifyOtpLawyer(VerifyOtpLawyer $request)
    {
        try {
            $lawyer = Lawyer::where('email', $request->email)->first();

            if (!$lawyer) {
                return response()->json([
                    'success' => false,
                    'message' => 'lawyer not found.',
                ], 404);
            }

            // التحقق من الكود
            if ($lawyer->code != $request->otp) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid OTP.',
                ], 400);
            }

            $lawyer->is_activate = 0;
            $lawyer->code = null; 
            $lawyer->save();


            return response()->json([
                'success' => true,
                'message' => 'OTP verified successfully. wait for admin accept',
            ], 200);

        } catch (\Exception $e) {
            \Log::error('OTP verification error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'OTP verification failed.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function verifyOtpUser(VerifyOtpUser $request)
    {
        try {
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found.',
                ], 404);
            }

            // التحقق من الكود
            if ($user->code != $request->otp) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid OTP.',
                ], 400);
            }

            $user->is_activate = 1;
            $user->code = null; 
            $user->save();

            $token = $user->createToken('userToken')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'OTP verified successfully.',
                'token' => $token, 
            ], 200);

        } catch (\Exception $e) {
            \Log::error('OTP verification error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'OTP verification failed.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function logout(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], 401);
        }

        $user->tokens->each(function ($token) {
            $token->delete();
        });

        return response()->json([
            'success' => true,
            'message' => 'Successfully logged out.',
        ]);
    }
}
