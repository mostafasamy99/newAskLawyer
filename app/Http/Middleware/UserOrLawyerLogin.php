<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserOrLawyerLogin
{
    
    public function handle(Request $request, Closure $next)
    {
        if(auth()->guard('lawyer')?->check() || auth()->guard('web')?->check()){
            if(auth()->guard('lawyer')->user()?->is_activate == 1 || auth()->guard('web')->user()?->is_activate == 1){
                return $next($request);
            }else{
                abort(403, "This Account Not Activate , Please Contact Technical Support");
            }
        }else{
            return redirect()->route('dashboard/login');
        }
    }
}
