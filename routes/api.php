<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\ForgetPasswordController;
use App\Http\Controllers\Api\V1\User\ProfileController;
use App\Http\Controllers\Api\V1\User\RequestController;
use App\Http\Controllers\Api\V1\User\SearchLawyerController;
use App\Http\Controllers\Api\V1\User\RequestServiceController;
use App\Http\Controllers\Api\V1\User\AllRequestController;
use App\Http\Controllers\Api\V1\User\AllServiceRequestController;
use App\Http\Controllers\Api\V1\User\NotificationController;
use App\Http\Controllers\Api\V1\User\LawyerPlatformOfferController;
use App\Http\Controllers\Api\V1\CountryController;
use App\Http\Controllers\Api\V1\Lawyer\RequestLawyerController;
use App\Http\Controllers\Api\V1\Lawyer\LawyerProfileController;
use App\Http\Controllers\Api\V1\Lawyer\NotificationLawyerController;
use App\Http\Controllers\Api\V1\Lawyer\LawyerPlatformServiceController;
use App\Http\Controllers\Api\V1\Lawyer\ServicesRequestLawyerController;
use App\Http\Controllers\Api\V1\Lawyer\PriceListLawyerOfferController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Here is where you can register API routes for your application.
| These routes are loaded by the RouteServiceProvider and assigned to
| the "api" middleware group.
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Authentication Routes
 */
Route::prefix('auth')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('/register-user', 'registerUser');
        Route::post('/register-lawyer', 'registerLawyer');
        Route::post('/forgot-password-user', 'forgot_password_user_check');
        Route::post('/otp-check-user', 'verifyOtpUser');
        Route::post('/reset-password-user/{email}', 'reset_password_user_check');
        Route::post('/forgot-password-lawyer', 'forgot_password_lawyer_check');
        Route::post('/otp-check-lawyer/{email}', 'otp_check_lawyer');
        Route::get('/change-language/{locale}', 'changeLanguage');
    });

    Route::controller(LoginController::class)->group(function () {
        Route::post('/login', 'loginCheck');
        Route::post('/otp-check-user', 'verifyOtpUser');
        Route::post('/otp-check-lawyer', 'verifyOtpLawyer');
        Route::middleware('auth:sanctum')->post('logout', 'logout');
    });

    Route::controller(ForgetPasswordController::class)->group(function () {
        Route::post('/reset-password-lawyer', 'sendResetOtpLawyer');
        Route::post('/resend-reset-password-lawyer', 'ResendResetOtpLawyer');
        Route::post('/otp-check-lawyer', 'otp_check_lawyer');
        Route::post('/new-password-lawyer', 'resetPasswordLawyer');

        Route::post('/reset-password-user', 'sendResetOtpUser');
        Route::post('/resend-reset-password-user', 'ResendResetOtpUser');
        Route::post('/otp-check-user', 'otp_check_user');
        Route::post('/new-password-user', 'resetPasswordUser');
    });
});

/**
 * User Routes
 */
Route::middleware('auth:sanctum')->prefix('user')->group(function () {
    Route::controller(ProfileController::class)->group(function () {
        Route::post('/update-profile', 'updateUserProfile');
        Route::get('/show-profile', 'getUserProfile');
        Route::post('/change-password', 'changeUserPassword');
    });

    Route::controller(RequestController::class)->group(function () {
        Route::post('/store-request', 'storeRequest');
        Route::post('/rate-request/{requestId}', 'rateRequest');
        Route::get('/request/{id}', 'getUserRequestById');
    });

    Route::controller(NotificationController::class)->group(function () {
        Route::get('/notifications', 'getUserNotifications');
    });

    Route::controller(RequestServiceController::class)->group(function () {
        Route::post('/request-service', 'saveRequest');
        Route::post('/accept-price-list-offer', 'acceptPriceListOffer');

    });

    Route::controller(AllRequestController::class)->group(function () {
        Route::get('/get-all', 'getUserRequestsByType');
    });

    Route::controller(AllServiceRequestController::class)->group(function () {
        Route::get('/get-all-hire-service-requests', 'getSingleLawyerRequestsService');
        Route::get('/get-all-hire-service-requests/{id}', 'getDataOfSingleLawyerRequestsService');
        Route::get('/get-all-price-list-service-requests', 'getMultipleLawyerRequestsService');
        Route::get('/get-all-price-list-service-requests/{id}', 'getDataOfMultipleLawyerRequestsService');
        Route::get('/platform-services', 'getAllPlatfromServices');
        Route::get('/platform-services/{id}/lawyers', 'getLawyersWithOffers');
        Route::get('/get-all/{request_id}/price-list-offers', 'getOffersByRequest');

    });

    Route::controller(LawyerPlatformOfferController::class)->group(function () {
        Route::get('/lawyer-offers/{platformServiceId}','getLawyerOffers');
    });
});

/**
 * Lawyer Routes
 */
Route::prefix('lawyer')->group(function () {
    Route::controller(RequestLawyerController::class)->group(function () {
        Route::get('/lawyer-requests', 'getUserRequestsByType');
        Route::get('/lawyer-request/{type}/{id}', 'getOneUserRequestByType');
        Route::post('/accept-request/{id}', 'acceptRequest');
        Route::post('/complete-request/{id}', 'completeRequest');
    });

    Route::controller(ServicesRequestLawyerController::class)->group(function () {
        Route::get('/price-list-requests', 'getPriceListServicesRequestsWithoutServiceId');
        Route::get('/price-list-request/{id}', 'getPriceListServiceRequestById');
        Route::post('/accept-price-list-request/{id}', 'acceptPriceListRequest');
        Route::post('/complete-price-list-request/{id}', 'completePriceListRequest');
        Route::get('/hire-employee-requests', 'getHireEmployeeServicesRequestsWithoutServiceId');
        Route::get('/hire-employee-request/{id}', 'getHireEmployeeServiceRequestById');
        Route::post('/accept-hire-request/{id}', 'acceptHireRequest');
        Route::post('/complete-hire-request/{id}', 'completeHireRequest');
    });

    Route::controller(LawyerProfileController::class)->group(function () {
        Route::get('/profile', 'showProfile')->middleware('auth:lawyer');
        Route::post('/profile', 'updateProfile')->middleware('auth:lawyer');
        Route::post('/change-password', 'changePassword')->middleware('auth:lawyer');
    });

    Route::controller(NotificationLawyerController::class)->group(function () {
        Route::get('/notifications', 'getLawyerNotifications');
    });

    Route::controller(LawyerPlatformServiceController::class)->group(function () {
        Route::get('/platform-services', 'getPlatformServices');
        Route::post('/add-platform-service', 'addService');
        Route::get('/accepted-platform-service', 'getAcceptedServices');
    });

    Route::controller(PriceListLawyerOfferController::class)->group(function () {
        Route::post('/submit-offer-price-list', 'submitOffer');
        Route::post('/price-list-request/{requestId}/start', 'startRequest');
        Route::post('/price-list-request/{requestId}/complete', 'completeRequest');

    });
});

/**
 * Shared Routes
 */
Route::controller(RequestController::class)->group(function () {
    Route::get('/getLawyers', 'getActiveLawyerNames');
    Route::get('/getAdvisor', 'getActiveAdvisorNames');
});

Route::controller(CountryController::class)->group(function () {
    Route::get('/countries', 'getCountries');
    Route::get('/ceties', 'getCeties');
    Route::get('/countries/{id}/cities', 'getCitiesByCountry');
    Route::get('/languages', 'getLanguages');
    Route::get('/legalFileds', 'getLegalField');
});

Route::controller(SearchLawyerController::class)->group(function () {
    Route::get('/active-lawyers', 'getActiveLawyers');
    Route::get('/active-companies', 'getActiveCompanies');
});
