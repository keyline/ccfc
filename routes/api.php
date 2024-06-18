<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Member\AuthController;
use App\Http\Middleware\ApiVersionMiddleware;
use App\Http\Controllers\Api\V2\Member\ApiController;

// Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
//     // Users
//     Route::apiResource('users', 'UsersApiController');

//     // Event Details
//     Route::post('event-details/media', 'EventDetailsApiController@storeMedia')->name('event-details.storeMedia');
//     Route::apiResource('event-details', 'EventDetailsApiController');

//     // Reciprocal Clubs
//     Route::post('reciprocal-clubs/media', 'ReciprocalClubsApiController@storeMedia')->name('reciprocal-clubs.storeMedia');
//     Route::apiResource('reciprocal-clubs', 'ReciprocalClubsApiController');

//     // Sportsmen
//     Route::post('sportsmen/media', 'SportsmenApiController@storeMedia')->name('sportsmen.storeMedia');
//     Route::apiResource('sportsmen', 'SportsmenApiController');

//     // Past President
//     Route::post('past-presidents/media', 'PastPresidentApiController@storeMedia')->name('past-presidents.storeMedia');
//     Route::apiResource('past-presidents', 'PastPresidentApiController');
// });

// Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Member',], function () {
//     Route::post('member/auth', 'AuthController@login')->name('member.auth');
// });


// Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Member', 'middleware' => ['auth:api']], function () {
//     Route::get('list', 'AuthController@index');
// });

// Route::fallback(function () {
//     return response()->json([
//         'message' => 'Page Not Found. If error persists, contact shuvadeep@keylines.net'], 404);
// });

//we can send multiple parameter to middleware like `api.versions:1,2`
Route::prefix('v1')->group(function () {
    //Version 1 routes
    //https://ccfccms.test/api/v1/member/list
    Route::get('member/list', [AuthController::class, 'index'])->name('api.v1.member.list.show');
});

Route::prefix('v2')->group(function () {
    // Other Version 2 routes
    //https://ccfccms.test/api/v2/member/auth
    Route::post('member/auth', [ApiController::class,'signinWithMobile'])->name('api.v2.member.auth.signinwithmobile');
    Route::post('member/auth2', [ApiController::class,'validateOtp'])->name('api.v2.member.auth2.validateOtp');
});