<?php

namespace App\Http\ServicesLayer\Front\AuthServices;

use App\Models\User;
use App\Models\Lawyer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ForgatPasswordNotification;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash as FacadesHash;

class AuthService
{
    protected $user;
    protected $lawyer;

    public function __construct(User $user, Lawyer $lawyer)
    {
        $this->user = $user;
        $this->lawyer = $lawyer;
    }

    public function lawyer_check_login($request)
    {
        try {
            $lawyer = $this->lawyer->where('email', strtolower(trim($request->email)))->first();
            if ($lawyer) {
                return $this->auth($lawyer, 'lawyer', $request);
            } else {
                flash()->error("There IS Something Wrong");
                return back();
            }
        } catch (\Exception $ex) {
            flash()->error("There IS Something Wrong , Please Contact Technical Support");
            return back();
        }
    }

    public function user_check_login($request)
    {
        try {
            $user = $this->user->where('email', strtolower(trim($request->email)))->first();
            if ($user) {
                return $this->auth($user, 'web', $request);
            } else {
                flash()->error("There IS Something Wrong");
                return back();
            }
        } catch (\Exception $ex) {
            flash()->error("There IS Something Wrong , Please Contact Technical Support");
            return back();
        }
    }

    private function auth($auth, $guard, $request)
    {
        if (FacadesHash::check($request->password, $auth->password)) {

            if ($auth->is_activate == 1) {

                if (FacadesAuth::guard($guard)->attempt($request->only('email', 'password'))) {
                    return redirect(route('dashboard/home'));
                } else {
                    flash()->error("There IS Something Worng");
                    return back();
                }
            } else {
                flash()->error("You Are Not Activate");
                return back();
            }
        } else {
            flash()->error("There IS Something Worng");
            return back();
        }
    }

    // ================== Register ================
    public function lawyer_store_register($request)
    {
        try {
            $request = $this->handle_request($request, $this->lawyer->fildes(), 'lawyers');
            $this->lawyer->create($request);
            flash()->success("success");
            return back();
        } catch (\Exception $ex) {
            flash()->error("There IS Something Wrong , Please Contact Technical Support");
            return back();
        }
    }

    public function user_store_register($request)
    {
        try {
            $request = $this->handle_request($request, $this->user->fildes(), 'users');
            $request['name'] = explode('@', $request['email'])[0];
            $this->user->create($request);
            flash()->success("success");
            return back();
        } catch (\Exception $ex) {
            flash()->error("There IS Something Wrong , Please Contact Technical Support");
            return back();
        }
    }

    public function handle_request($request, $authFildes, $crudName)
    {
        $request->password ? $request->merge(['password' => bcrypt($request->password)]) : "";
        if (!$request->hasFile('photo') == null) {
            $file = uploadIamge($request->file('photo'), $crudName); // function on helper file to upload file
            $request->merge(['img' => $file]);
        }
        if (!$request->hasFile('photo_union_card') == null) {
            $file = uploadIamge($request->file('photo_union_card'), $crudName); // function on helper file to upload file
            $request->merge(['union_card' => $file]);
        }
        if (!$request->hasFile('photo_office_rent') == null) {
            $file = uploadIamge($request->file('photo_office_rent'), $crudName); // function on helper file to upload file
            $request->merge(['office_rent' => $file]);
        }
        if (!$request->hasFile('photo_passport') == null) {
            $file = uploadIamge($request->file('photo_passport'), $crudName); // function on helper file to upload file
            $request->merge(['passport' => $file]);
        }
        $request = array_filter(array_intersect_key($request->all(), $authFildes));
        return $request;
    }

    public function get_user()
    {
        if (auth()->guard('lawyer')->check()) {
            $auth = auth()->guard('lawyer')->user();
            $auth->user_type = 'lawyers';
            $auth->user_fildes = $this->lawyer->fildes();
        } else {
            $auth = auth()->guard('web')->user();
            $auth->user_type = 'users';
            $auth->user_fildes = $this->user->fildes();
        }
        return $auth ?? null;
    }

    public function update($request)
    {
        $auth = $this->get_user();
        if (is_null($auth)) {
            flash()->error('user not found');
            return back();
        }
        if (isset($request->old_password) && !Hash::check($request->old_password, $auth->password)) {
            flash()->error("Incorrect password");
            return back();
        }
        $request = $this->handle_request($request, $auth->user_fildes, $auth->user_type);
        unset($auth->user_type, $auth->user_fildes);
        $auth->update($request);
        isset($request['services']) && count($request['services']) > 0 ? $auth->services()->sync($request['services']) : '';
        isset($request['languages']) && count($request['languages']) > 0 ? $auth->languages()->sync($request['languages']) : '';
        isset($request['legal_fields']) && count($request['legal_fields']) > 0 ? $auth->legal_fields()->sync($request['legal_fields']) : '';
        flash()->success("success");
        return back();
    }

    public function logout()
    {
        auth()->guard('lawyer')->check() ? auth('lawyer')->logout() : auth('web')->logout();
        return redirect(route('front/index'));
    }

    // User Frogoat Password Cycle
    public function forgot_password_user_check($request)
    {
        $user = $this->user->where('email', strtolower(trim($request->email)))->first();
        $otp = rand(1000, 9999);
        if ($user) {
            $user->update(['code' => $otp]);
            Notification::send($user, new ForgatPasswordNotification($otp));
            return redirect(route('otp_user', ['email' => encrypt($user->email)]));
        } else {
            flash()->error("There IS Something Wrong");
            return back();
        }
    }
    public function otp_check_user($request, $email)
    {
        $user = $this->user->where('email', strtolower(trim(decrypt($email))))
                    ->where('code', implode('', $request->only(['n1', 'n2', 'n3', 'n4'])))->first();
        if ($user) {
            return redirect(route('reset_password_user', $email));
        } else {
            flash()->error("There IS Something Wrong");
            return back();
        }
    }

    public function reset_password_user_check($request, $email)
    {
        $this->user->where('email', decrypt($email))->update([
            'pawssword' => bcrypt($request->password)
        ]);
        flash()->success('Done');
        return redirect()->route('dashboard/login');
    }

    // Lawyer Frogoat Password Cycle
    public function forgot_password_lawyer_check($request)
    {
        $lawyer = $this->lawyer->where('email', strtolower(trim($request->email)))->first();
        $otp = rand(1000, 9999);
        if ($lawyer) {
            $lawyer->update(['code' => $otp]);
            Notification::send($lawyer, new ForgatPasswordNotification($otp));
            return redirect(route('otp_lawyer', ['email' => encrypt($lawyer->email)]));
        } else {
            flash()->error("There IS Something Wrong");
            return back();
        }
    }

    public function otp_check_lawyer($request, $email)
    {
        $lawyer = $this->lawyer->where('email', strtolower(trim(decrypt($email))))
                    ->where('code', implode('', $request->only(['n1', 'n2', 'n3', 'n4'])))->first();
        if ($lawyer) {
            return redirect(route('reset_password_lawyer', $email));
        } else {
            flash()->error("There IS Something Wrong");
            return back();
        }
    }

    public function reset_password_lawyer_check($request, $email)
    {
        $this->lawyer->where('email', decrypt($email))->update([
            'password' => bcrypt($request->password)
        ]);
        flash()->success('Done');
        return redirect()->route('dashboard/login');
    }
}
