<?php

/*
|--------------------------------------------------------------------------
| User API Routes
|--------------------------------------------------------------------------
|
| These routes are prefixed with 'api/v1'.
| These routes use the root namespace 'App\Http\Controllers\Api\V1'.
|
 */
use App\Base\Constants\Auth\Role;
use App\Http\Controllers\Api\V1\Rider\RiderTripPreferenceController;
use App\Http\Controllers\Api\V1\Rider\RideRateController;
use App\Http\Controllers\Api\V1\Trip\RequestTripController;
use App\Http\Controllers\Api\V1\Rider\FavoriteController;
use App\Http\Controllers\Api\V1\Trip\AllTripsController;
use App\Http\Controllers\Api\V1\CancelRide\CancelRideController;
use App\Http\Controllers\Api\V1\User\DisputeController;


use App\Http\Controllers\Api\V1\Payment\PaymentCardController;





/*
 * These routes are prefixed with 'api/v1/user'.
 * These routes use the root namespace 'App\Http\Controllers\Api\V1\User'.
 * These routes use the middleware group 'auth'.
 */
Route::prefix('user')->namespace('User')->middleware('auth')->group(function () {
    // Get the logged in user.
    Route::get('/', 'AccountController@me');
    /**
     * These routes use the middleware group 'role'.
     * These routes are accessible only by a user with the 'user' role.
     */
    Route::middleware('auth')->group(function () {


        Route::prefix('rides')->group(function () {
            Route::post('/{rideId}/cancel', [CancelRideController::class, 'cancelRide']);
        });


        // Update user password.
        Route::post('password', 'ProfileController@updatePassword');
        // Update user profile.
        Route::post('profile', 'ProfileController@updateProfile');
        Route::post('driver-profile', 'ProfileController@updateDriverProfile');
        Route::post('update-my-lang', 'ProfileController@updateMyLanguage');
        Route::post('update-bank-info','ProfileController@updateBankinfo');
        Route::get('get-bank-info','ProfileController@getBankInfo');
        // Add Favourite location
        Route::get('list-favourite-location','ProfileController@FavouriteLocationList');
        Route::post('add-favourite-location','ProfileController@addFavouriteLocation');
        Route::get('delete-favourite-location/{favourite_location}','ProfileController@deleteFavouriteLocation');
        // Delete user Account.
        Route::post('delete-user-account','ProfileController@userDeleteAccount');

        Route::post('rider-trip-preferences', [RiderTripPreferenceController::class, 'store']);
        Route::get('rider-trip-preferences', [RiderTripPreferenceController::class, 'getPreferences']);

        Route::put('rider-trip-preferences/{id}', [RiderTripPreferenceController::class, 'update']);


        Route::prefix('payment-cards')->group(function () {
            Route::post('/', [PaymentCardController::class, 'store']);
            Route::get('/', [PaymentCardController::class, 'showAll']);
            Route::get('/{card}', [PaymentCardController::class, 'show']);
            Route::delete('/{card}', [PaymentCardController::class, 'destroy']);
        });

        Route::prefix('favorites')->group(function () {
            Route::post('/', [FavoriteController::class, 'store']);
            Route::delete('/{driverId}', [FavoriteController::class, 'destroy']);
            Route::get('/', [FavoriteController::class, 'index']);
        });

        Route::get('/main-ride-types', [RequestTripController::class, 'mainTypeRide']);
        Route::get('/main-ride-types/{mainRideTypeId}/ride-types', [RequestTripController::class, 'tripRide']);




        Route::prefix('request-ride')->group(function () {
            Route::post('/', [RequestTripController::class, 'store']);
            Route::put('/{ride}', [RequestTripController::class, 'update']);
            Route::get('/{ride}', [RequestTripController::class, 'show']);
            Route::delete('/{ride}', [RequestTripController::class, 'destroy']);
        });


        Route::post('/rides/{rideId}/rate', [RideRateController::class, 'rateRide']);
        Route::post('/rides/{rideId}/add-tip', [RideRateController::class, 'addTip']);


        Route::prefix('trips')->group(function () {
            Route::get('/canceled', [AllTripsController::class, 'getCanceledTrips']);
            Route::get('/completed-trips', [AllTripsController::class, 'getCompletedTrips']);
            Route::get('/accepted-trips', [AllTripsController::class, 'getAcceptedTrips']);
            Route::get('/completed-trip/{tripId}', [AllTripsController::class, 'getCompletedTrip']);
        });

        Route::prefix('disputes')->group(function () {
            Route::post('/{rideId}', [DisputeController::class, 'createDispute']);
            Route::post('/{disputeId}/reply', [DisputeController::class, 'replyToDispute']); 
            Route::post('/{disputeId}/vote', [DisputeController::class, 'voteOnDispute']);
            Route::post('/{disputeId}/resolve', [DisputeController::class, 'resolveDispute']);
            Route::get('/{disputeId}', [DisputeController::class, 'viewSingleDispute']);
            Route::get('/ride/getAll', [DisputeController::class, 'viewAllDisputes']);
            
            Route::get('ride/open', [DisputeController::class, 'getOpenDisputes']);
            Route::get('ride/closed', [DisputeController::class, 'getClosedDisputes']);
        });
    });
});


Route::namespace('VehicleType')->middleware('auth')->prefix('types')->group(function () {
    // get types depends on the location
    Route::get('/{lat}/{lng}', 'VehicleTypeController@getTypesByLocationOld');
    Route::get('/by-location/{lat}/{lng}', 'VehicleTypeController@getTypesByLocationAlongPrice');

    // Route::post('/{vehicle_type}','VehicleTypeController@update');
});


