<?php

namespace App\Http\Controllers\Front;

use App\Models\User;
use App\Models\Lawyer;
use App\Models\Report;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Traits\Front\GeneralTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Front\UserUpdateRequests;
use App\Http\Requests\Front\UserRegisterRequest;
use App\Http\Requests\Front\auth\user\CheckOtplRequest;
use App\Http\Requests\Front\auth\user\CheckEmailRequest;
use App\Http\Requests\LawyerRequests\LawyerStoreRequest;
use App\Http\ServicesLayer\Front\AuthServices\AuthService;
use App\Http\ServicesLayer\Front\UserServices\UserService;
use App\Http\Requests\Front\auth\user\CheckPasswordRequest;
use App\Http\Requests\Front\auth\lawyer\CheckOtpLawyerRequest;
use App\Http\Requests\Front\auth\lawyer\CheckEmailLawyerRequest;
use App\Http\Requests\Front\auth\lawyer\CheckPasswordLawyerRequest;

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

    public function changeLanguage($local)
    {
        return $this->userService->changeLanguage($local);
    }

    public function updateProfile(UserUpdateRequests $request)
    {
        return $this->authService->update($request);
    }

    public function login()
    {
        $data = $this->reportPage(['settings']);
        return view('front.auth.login', compact('data'));
    }

    public function loginCheck(Request $request)
    {
        if ($request->user_type == 1) {
            return $this->authService->lawyer_check_login($request);
        } else if ($request->user_type == 2) {
            return $this->authService->user_check_login($request);
        }
    }

    public function register()
    {
        $data = $this->reportPage(['settings']);
        return view('front.auth.register', compact('data'));
    }

    public function registerStoreLawyer(LawyerStoreRequest $request)
    {
        return $this->authService->lawyer_store_register($request);
    }

    public function registerSroteUser(UserRegisterRequest $request)
    {
        return $this->authService->user_store_register($request);
    }

    public function logout()
    {
        return $this->authService->logout();
    }

    // User Frogoat Password Cycle
    public function forgot_password_user()
    {
        $data = $this->reportPage(['settings']);
        return view('front.auth.frogot-user', compact('data'));
    }

    public function forgot_password_user_check(CheckEmailRequest $request)
    {
        try {
            return $this->authService->forgot_password_user_check($request);
        } catch (\Exception $th) {
            flash()->error("There IS Something Wrong");
            return back();
        }
    }

    public function otp_user($email)
    {
        $data = $this->reportPage(['settings']);
        return view('front.auth.otp-user', compact(['data', 'email']));
    }

    public function otp_check_user(CheckOtplRequest $request, $email)
    {
        return $this->authService->otp_check_user($request, $email);
    }

    public function reset_password_user($email)
    {
        $data = $this->reportPage(['settings']);
        return view('front.auth.changPass-user', compact(['data', 'email']));
    }

    public function reset_password_user_check(CheckPasswordRequest $request,$email)
    {
        return $this->authService->reset_password_user_check($request, $email);
    }

    // Lawyer Frogoat Password Cycle
    public function forgot_password_lawyer()
    {
        $data = $this->reportPage(['settings']);
        return view('front.auth.frogot-lawyer', compact('data'));
    }

    public function forgot_password_lawyer_check(CheckEmailLawyerRequest $request)
    {
        try {
            return $this->authService->forgot_password_lawyer_check($request);
        } catch (\Exception $th) {
            flash()->error("There IS Something Wrong");
            return back();
        }
    }

    public function otp_lawyer($email)
    {
        $data = $this->reportPage(['settings']);
        return view('front.auth.otp-lawyer', compact(['data', 'email']));
    }

    public function otp_check_lawyer(CheckOtpLawyerRequest $request, $email)
    {
        return $this->authService->otp_check_lawyer($request, $email);
    }

    public function reset_password_lawyer($email)
    {
        $data = $this->reportPage(['settings']);
        return view('front.auth.changPass-lawyer', compact(['data', 'email']));
    }

    public function reset_password_lawyer_check(CheckPasswordLawyerRequest $request,$email)
    {
        return $this->authService->reset_password_lawyer_check($request, $email);
    }
}
