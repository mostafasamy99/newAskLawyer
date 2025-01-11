<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| Auth API Routes
|--------------------------------------------------------------------------
|
| These routes are prefixed with 'api/v1'.
| These routes use the root namespace 'App\Http\Controllers\Api\V1'.
|
 */

/*
 * These routes use the root namespace 'App\Http\Controllers\Api\V1\Auth'.
 */
Route::prefix('api/v1')->group(function () {
    Route::namespace('Auth')->group(function () {
        Route::controller(AuthController::class)->group(function () {
            Route::post('/login', 'loginCheck');
            Route::post('/register-user', 'registerSroteUser');
            Route::post('/register-lawyer', 'registerStoreLawyer');
            Route::post('/logout', 'logout');
            Route::post('/forgot-password-user', 'forgot_password_user_check');
            Route::post('/otp-check-user/{email}', 'otp_check_user');
            Route::post('/reset-password-user/{email}', 'reset_password_user_check');
            Route::post('/forgot-password-lawyer', 'forgot_password_lawyer_check');
            Route::post('/otp-check-lawyer/{email}', 'otp_check_lawyer');
            Route::post('/reset-password-lawyer/{email}', 'reset_password_lawyer_check');
            Route::get('/change-language/{locale}', 'changeLanguage');
        });
    });
});
