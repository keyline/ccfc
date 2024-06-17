<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\Member\AuthController;
use App\Http\Controllers\Api\ApiController;

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Users
    Route::apiResource('users', 'UsersApiController');

    // Event Details
    Route::post('event-details/media', 'EventDetailsApiController@storeMedia')->name('event-details.storeMedia');
    Route::apiResource('event-details', 'EventDetailsApiController');

    // Reciprocal Clubs
    Route::post('reciprocal-clubs/media', 'ReciprocalClubsApiController@storeMedia')->name('reciprocal-clubs.storeMedia');
    Route::apiResource('reciprocal-clubs', 'ReciprocalClubsApiController');

    // Sportsmen
    Route::post('sportsmen/media', 'SportsmenApiController@storeMedia')->name('sportsmen.storeMedia');
    Route::apiResource('sportsmen', 'SportsmenApiController');

    // Past President
    Route::post('past-presidents/media', 'PastPresidentApiController@storeMedia')->name('past-presidents.storeMedia');
    Route::apiResource('past-presidents', 'PastPresidentApiController');
});




Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Member',], function () {
    Route::post('member/auth', 'AuthController@login')->name('member.auth');
});


Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Member', 'middleware' => ['auth:api']], function () {
    Route::get('list', 'AuthController@index');
});

Route::fallback(function () {
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact shuvadeep@keylines.net'], 404);
});

/* api */
    Route::prefix('/apiv2')->namespace('App\Http\Controllers\Api')->group(function () {
        // Route::match(['post', 'get'], 'signinWithMobile', 'ApiController@signinWithMobile');
        Route::post('signinWithMobile', 'ApiController@signinWithMobile')->name('signinWithMobile');
    });
/* api */
