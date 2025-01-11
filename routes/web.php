<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

use Illuminate\Support\Facades\Mail;
use App\Mail\OTPMail;




Route::get('/test-send-email', function () {
    $otp = rand(1000, 9999); 
    $email = 'mostafamenshawy1999@gmail.com'; 

    try {
        Mail::send([], [], function ($message) use ($email, $otp) {
            $message->to($email)
                    ->subject('Test Email')
                    ->setBody("Your OTP is: $otp", 'text/html'); 
        });

        return response()->json(['success' => true, 'message' => 'Email sent successfully']);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()]);
    }
});

Route::get('/test-email', function () {
    Mail::raw('Test email', function ($message) {
        $message->to('mostafamenshawy1999@gmail.com')->subject('Test');
    });

    return response()->json(['success' => true, 'message' => 'Test email sent successfully']);
});


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function(){
    Route::group(['namespace' => 'App\Http\Controllers\Front', 'middleware' => 'limitReq'], function() {

        Route::get('/', 'FrontController@home');
        Route::get('/', 'FrontController@home')->name('front/index');
        Route::get('/change-language/{locale}', 'AuthController@changeLanguage')->name('change-language');

        Route::get('/lawyers/josn', 'FrontController@lawyersJosn')->name('get/lawyers/josn');

        Route::get('/about', 'FrontController@abouts')->name('front/about');
        Route::get('/how-it-works', 'FrontController@howWorks')->name('front/how-it-works');
        Route::get('/users/process', 'FrontController@userProcess')->name('front/users/process');
        Route::get('/lawyers/process', 'FrontController@lawyersProcess')->name('front/lawyers/process');
        Route::get('/hire-a-lawyer', 'FrontController@hireALawyer')->name('front/hire-a-lawyer');
        Route::get('/privacy-policy', 'FrontController@privacyPolicy')->name('front/privacy-policy');
        Route::get('/legal-info', 'FrontController@legalInfo')->name('front/legal-info');
        Route::get('/subjects/{id}', 'FrontController@subjects')->name('front/subjects');
        Route::get('/services/{id}/{lawyer_id?}/{blog_id?}', 'FrontController@services')->name('front/services');
        Route::get('/ask-price/{id}', 'FrontController@askPrice')->name('front/ask-price');

        Route::get('/blogs/{type}', 'FrontController@blogs')->name('front/blogs');
        Route::get('/blog/{id}', 'FrontController@blog')->name('front/blog');

        Route::get('/companies/{page?}', 'FrontController@companies')->name('front/companies');
        Route::get('/company/{id}', 'FrontController@company')->name('front/company');
        Route::get('/fixed-service/{id}/{lawyer_id?}', 'FrontController@fixedService')->name('front/fixed-service');
        Route::get('/all-service/{id}', 'FrontController@allService')->name('front/all-service');

        Route::get('/lawyers/{page?}', 'FrontController@lawyers')->name('front/lawyers');
        Route::get('/lawyer/{id}', 'FrontController@lawyer')->name('front/lawyer');
        Route::get('/lawyer/api/{id?}', 'FrontController@lawyerApi')->name('front/api/lawyer');

        Route::get('/contact', 'FrontController@contact')->name('front/contact');
        Route::post('/contact', 'ContactController@store')->name('contact/store');

        Route::post('/request', 'RequestController@store')->name('request/store');
        Route::get('/request/answers/{id?}', 'RequestController@answers')->name('request/answers');
        Route::post('request/paid-services/{service_id}', 'RequestController@paidServices')->name('request/paid-services');

        Route::group(['prefix' => 'dashboard'], function() {

            Route::get('/login', 'AuthController@login')->name('dashboard/login');
            Route::post('/check', 'AuthController@loginCheck')->name('dashboard/loginCheck');
            Route::get('/register', 'AuthController@register')->name('dashboard/register');
            Route::post('/register/user', 'AuthController@registerSroteUser')->name('dashboard/registerStoreUser');
            Route::post('/register/lawyer', 'AuthController@registerStoreLawyer')->name('dashboard/registerStoreLawyer');

            // User Frogoat Password Cycle
            Route::get('/forgot-password-user', 'AuthController@forgot_password_user')->name('forgot_password_user');
            Route::post('/forgot-password-user-check', 'AuthController@forgot_password_user_check')->name('forgot_password_user_check');

            Route::get('/otp-check-user/{email}', 'AuthController@otp_user')->name('otp_user');
            Route::post('/otp-check-user/{email}', 'AuthController@otp_check_user')->name('otp_check_user');

            Route::get('/reset-password-user/{email}', 'AuthController@reset_password_user')->name('reset_password_user');
            Route::post('/reset-password-user/{email}', 'AuthController@reset_password_user_check')->name('reset_password_user_check');

            // Lawyer Frogoat Password Cycle
            Route::get('/forgot-password-lawyer', 'AuthController@forgot_password_lawyer')->name('forgot_password_lawyer');
            Route::post('/forgot-password-lawyer-check', 'AuthController@forgot_password_lawyer_check')->name('forgot_password_lawyer_check');

            Route::get('/otp-check-lawyer/{email}', 'AuthController@otp_lawyer')->name('otp_lawyer');
            Route::post('/otp-check-lawyer/{email}', 'AuthController@otp_check_lawyer')->name('otp_check_lawyer');

            Route::get('/reset-password-lawyer/{email}', 'AuthController@reset_password_lawyer')->name('reset_password_lawyer');
            Route::post('/reset-password-lawyer/{email}', 'AuthController@reset_password_lawyer_check')->name('reset_password_lawyer_check');

            Route::group(['middleware' => 'userOrLawyerLogin'], function() {

                Route::get('/', 'DashboradController@home')->name('dashboard/home');
                Route::get('service/{id}', 'DashboradController@service')->name('dashboard/service');
                Route::post('room', 'RequestController@room')->name('dashboard/room/get');

                Route::get('settings', 'DashboradController@settings')->name('dashboard/settings/get');
                Route::get('settings/profile', 'DashboradController@profile')->name('dashboard/settings/profile/get');

                Route::post('update/profile', 'AuthController@updateProfile')->name('dashboard/update/profile');
                
                Route::get('notifications', 'DashboradController@notifications')->name('dashboard/notifications');

                Route::get('logout', 'AuthController@logout')->name('dashboard/logout');
            });

            Route::group(['middleware' => 'lawyerLogin'], function() {

                Route::get('blogs', 'DashboradController@blogs')->name('dashboard/blogs');
                Route::get('blogs/add', 'BlogController@addBlog')->name('dashboard/blogs/add');
                Route::post('blogs/store', 'BlogController@store')->name('dashboard/blogs/store');
                Route::get('blogs/edit/{id?}', 'BlogController@editBlog')->name('dashboard/blogs/edit');
                Route::post('blogs/update/{id?}', 'BlogController@update')->name('dashboard/blogs/update');
                Route::get('cost/{id?}', 'BlogController@cost')->name('dashboard/blogs/cost');
                Route::get('cost/update/{id?}', 'BlogController@costUpdate')->name('dashboard/blogs/cost/update');

                Route::post('request/read', 'RequestController@read')->name('request/read');
                Route::post('request/confirm', 'RequestController@confirm')->name('request/confirm');
            });

            // Route::group(['middleware' => 'userLogin'], function() {

            // });
        });
    });
});
