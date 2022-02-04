<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', '2fa']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Content Category
    Route::delete('content-categories/destroy', 'ContentCategoryController@massDestroy')->name('content-categories.massDestroy');
    Route::resource('content-categories', 'ContentCategoryController');

    // Content Tag
    Route::delete('content-tags/destroy', 'ContentTagController@massDestroy')->name('content-tags.massDestroy');
    Route::resource('content-tags', 'ContentTagController');

    // Content Page
    Route::delete('content-pages/destroy', 'ContentPageController@massDestroy')->name('content-pages.massDestroy');
    Route::post('content-pages/media', 'ContentPageController@storeMedia')->name('content-pages.storeMedia');
    Route::post('content-pages/ckmedia', 'ContentPageController@storeCKEditorImages')->name('content-pages.storeCKEditorImages');
    Route::resource('content-pages', 'ContentPageController');

    // Committee Name
    Route::delete('committee-names/destroy', 'CommitteeNameController@massDestroy')->name('committee-names.massDestroy');
    Route::resource('committee-names', 'CommitteeNameController');

    // Committee Member Mapping
    Route::delete('committee-member-mappings/destroy', 'CommitteeMemberMappingController@massDestroy')->name('committee-member-mappings.massDestroy');
    Route::resource('committee-member-mappings', 'CommitteeMemberMappingController');

    // Event Details
    Route::delete('event-details/destroy', 'EventDetailsController@massDestroy')->name('event-details.massDestroy');
    Route::post('event-details/media', 'EventDetailsController@storeMedia')->name('event-details.storeMedia');
    Route::post('event-details/ckmedia', 'EventDetailsController@storeCKEditorImages')->name('event-details.storeCKEditorImages');
    Route::resource('event-details', 'EventDetailsController');

    // News
    Route::delete('news/destroy', 'NewsController@massDestroy')->name('news.massDestroy');
    Route::post('news/media', 'NewsController@storeMedia')->name('news.storeMedia');
    Route::post('news/ckmedia', 'NewsController@storeCKEditorImages')->name('news.storeCKEditorImages');
    Route::resource('news', 'NewsController');

    // Reciprocal Clubs
    Route::delete('reciprocal-clubs/destroy', 'ReciprocalClubsController@massDestroy')->name('reciprocal-clubs.massDestroy');
    Route::post('reciprocal-clubs/media', 'ReciprocalClubsController@storeMedia')->name('reciprocal-clubs.storeMedia');
    Route::post('reciprocal-clubs/ckmedia', 'ReciprocalClubsController@storeCKEditorImages')->name('reciprocal-clubs.storeCKEditorImages');
    Route::resource('reciprocal-clubs', 'ReciprocalClubsController');

    // Sportsmen
    Route::delete('sportsmen/destroy', 'SportsmenController@massDestroy')->name('sportsmen.massDestroy');
    Route::post('sportsmen/media', 'SportsmenController@storeMedia')->name('sportsmen.storeMedia');
    Route::post('sportsmen/ckmedia', 'SportsmenController@storeCKEditorImages')->name('sportsmen.storeCKEditorImages');
    Route::resource('sportsmen', 'SportsmenController');

    // Past President
    Route::delete('past-presidents/destroy', 'PastPresidentController@massDestroy')->name('past-presidents.massDestroy');
    Route::resource('past-presidents', 'PastPresidentController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
        Route::post('profile/two-factor', 'ChangePasswordController@toggleTwoFactor')->name('password.toggleTwoFactor');
    }
});
Route::group(['namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    // Two Factor Authentication
    if (file_exists(app_path('Http/Controllers/Auth/TwoFactorController.php'))) {
        Route::get('two-factor', 'TwoFactorController@show')->name('twoFactor.show');
        Route::post('two-factor', 'TwoFactorController@check')->name('twoFactor.check');
        Route::get('two-factor/resend', 'TwoFactorController@resend')->name('twoFactor.resend');
    }
});
