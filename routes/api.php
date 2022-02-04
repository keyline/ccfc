<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Reciprocal Clubs
    Route::post('reciprocal-clubs/media', 'ReciprocalClubsApiController@storeMedia')->name('reciprocal-clubs.storeMedia');
    Route::apiResource('reciprocal-clubs', 'ReciprocalClubsApiController');
});
