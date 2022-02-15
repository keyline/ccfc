<?php

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
