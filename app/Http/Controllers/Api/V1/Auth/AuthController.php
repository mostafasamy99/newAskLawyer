<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Models\User;
use App\Mail\OtpMail;
use App\Models\Lawyer;
use App\Models\Report;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use App\Mail\VerificationMail;
use Swift_TransportException; 
use App\Traits\Front\GeneralTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Notifications\SendOtpNotification;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Http\Requests\Auth\RegisterLawyerRequest;
use App\Http\ServicesLayer\Front\AuthServices\AuthService;
use App\Http\ServicesLayer\Front\UserServices\UserService;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;


class AuthController extends Controller
{
    use GeneralTrait;
    public $user;
    public $report;
    public $lawyer;
    public $authService;
    public $userService;

    public function __construct(Report $report, AuthService $authService, UserService $userService, Lawyer $lawyer, User $user)
    {
        $this->user = $user;
        $this->report = $report;
        $this->lawyer = $lawyer;
        $this->authService = $authService;
        $this->userService = $userService;
    }

    public function changeLanguage($locale)
    {
        $result = $this->userService->changeLanguage($locale);
        return response()->json(['success' => true, 'data' => $result], 200);
    }

    public function registerUser(RegisterUserRequest $request)
    {
        try {
            $validatedData = $request->validated(); 

            $otpCode = random_int(1000, 9999);
    
            $user = User::create([
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'code' => $otpCode,
                'is_activate'=>0    
            ]);
    
            try {
                Mail::raw('Your verification code is: ' . $user->code, function ($message) use ($user) {
                    $message->to($user->email)
                            ->subject('Verification Code'); 
                });
    
                return response()->json([
                    'success' => true,
                    'message' => 'User registered successfully. Please check your email for verification code.',
                    'data' => $user
                ], 201);
            } catch (\Exception $e) {
                \Log::error('Mail sending failed: ' . $e->getMessage());
                
                $user->delete();
                
                return response()->json([
                    'success' => false,
                    'message' => 'Registration failed due to email sending error',
                    'error' => $e->getMessage()
                ], 500);
            }
        } catch (\Exception $e) {
            \Log::error('Registration error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Registration failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    
    public function registerLawyer(RegisterLawyerRequest $request)
    {
        try {
            $data = $request->validated();
            if ($request->has('services')) {
                $data['services'] = json_decode($request->input('services'));
            }
    
            if ($request->has('languages')) {
                $data['languages'] = json_decode($request->input('languages'));
            }
    
            if ($request->has('legal_fields')) {
                $data['legal_fields'] = json_decode($request->input('legal_fields'));
            }
    
            if ($request->hasFile('img')) {
                $data['img'] = uploadImage($request->file('img'), 'lawyers/images');
            } 
    
            if ($request->hasFile('photo_union_card')) {
                $data['union_card'] = uploadImage($request->file('photo_union_card'), 'lawyers/union_cards');
            }
    
            if ($request->hasFile('photo_office_rent')) {
                $data['office_rent'] = uploadImage($request->file('photo_office_rent'), 'lawyers/office_rent');
            }
    
            if ($request->hasFile('photo_passport')) {
                $data['passport'] = uploadImage($request->file('photo_passport'), 'lawyers/passports');
            }
    
            if ($request->hasFile('file')) {
                $data['file'] = uploadFile($request->file('file'), 'lawyers/file');
            }

            if ($request->hasFile('card_id_img')) {
                $data['card_id_img'] = uploadImage($request->file('card_id_img'), 'lawyers/card_id');
            } 
    
            $data['password'] = bcrypt($data['password']);
            $data['is_activate'] = 0;
            $otpCode = random_int(1000, 9999);
            $data['code'] = $otpCode;
    
            try {
                Mail::raw('Your verification code is: ' . $otpCode, function ($message) use ($data) {
                    $message->to($data['email'])
                            ->subject('Verification Code');
                });
    
                DB::beginTransaction();
    
                $lawyer = Lawyer::create($data);
    
                if ($request->has('services')) {
                    $lawyer->services()->attach($data['services']);
                }
    
                if ($request->has('languages')) {
                    $lawyer->languages()->attach($data['languages']);
                }
    
                if ($request->has('legal_fields')) {
                    $lawyer->legal_fields()->attach($data['legal_fields']);
                }
    
                DB::commit();
    
                $responseData = $lawyer->toArray();
                $responseData['img_url'] = $lawyer->img ? url($lawyer->img) : null;
                $responseData['union_card_url'] = $lawyer->union_card ? url($lawyer->union_card) : null;
                $responseData['office_rent_url'] = $lawyer->office_rent ? url($lawyer->office_rent) : null;
                $responseData['passport_url'] = $lawyer->passport ? url($lawyer->passport) : null;
                $responseData['file_url'] = $lawyer->file ? url($lawyer->file) : null;
    
                return response()->json([
                    'success' => true,
                    'message' => 'Lawyer registered successfully. An OTP has been sent to your email.',
                    'data' => $responseData,
                ], 201);
            } catch (\Exception $e) {
                \Log::error('Mail sending failed: ' . $e->getMessage());
    
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to send email. Please check your email configuration.',
                    'error' => $e->getMessage()
                ], 500);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed!',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Registration error: ' . $e->getMessage());
    
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    
}
