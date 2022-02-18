<?php

use App\Http\Controllers\ContactController;

use App\Models\ReciprocalClub;

use App\Models\ContentPage;

use App\Models\Gallery;

use App\Models\Sportstype;

use App\Models\PastPresident;

// Route::get('/', 'FrontendHome@index')->name('index');

Route::get('/', function () {
    $reciprocalClubs = ReciprocalClub::all();
    $contentPages = ContentPage::all();
    // $galleries = Gallery::all();
    $sportstypes = Sportstype::all();
    $galleries = Gallery::with(['media'])->get();

    return view('index', compact('reciprocalClubs', 'contentPages', 'galleries', 'sportstypes'));
});


Route::get('/past-president', function () {
    $pastPresidents = PastPresident::with(['media'])->get();
    // $data='Data';
    return view('past-president', compact(['pastPresidents']));
    
});





// Route::redirect('/', '/login');

Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);


// Auth::routes(['login' => false]);

// Route::get('/ccfc_admin', 'Auth\LoginController@show_admin_login')->name('AdminLogin');

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
    Route::delete('newss/destroy', 'NewsController@massDestroy')->name('newss.massDestroy');
    Route::post('newss/media', 'NewsController@storeMedia')->name('newss.storeMedia');
    Route::post('newss/ckmedia', 'NewsController@storeCKEditorImages')->name('newss.storeCKEditorImages');
    Route::resource('newss', 'NewsController');

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
    Route::post('past-presidents/media', 'PastPresidentController@storeMedia')->name('past-presidents.storeMedia');
    Route::post('past-presidents/ckmedia', 'PastPresidentController@storeCKEditorImages')->name('past-presidents.storeCKEditorImages');
    Route::resource('past-presidents', 'PastPresidentController');

    // Trophies
    Route::delete('trophies/destroy', 'TrophiesController@massDestroy')->name('trophies.massDestroy');
    Route::post('trophies/media', 'TrophiesController@storeMedia')->name('trophies.storeMedia');
    Route::post('trophies/ckmedia', 'TrophiesController@storeCKEditorImages')->name('trophies.storeCKEditorImages');
    Route::resource('trophies', 'TrophiesController');

    // Amenities Services
    Route::delete('amenities-services/destroy', 'AmenitiesServicesController@massDestroy')->name('amenities-services.massDestroy');
    Route::post('amenities-services/media', 'AmenitiesServicesController@storeMedia')->name('amenities-services.storeMedia');
    Route::post('amenities-services/ckmedia', 'AmenitiesServicesController@storeCKEditorImages')->name('amenities-services.storeCKEditorImages');
    Route::resource('amenities-services', 'AmenitiesServicesController');

    // Gallery
    Route::delete('galleries/destroy', 'GalleryController@massDestroy')->name('galleries.massDestroy');
    Route::post('galleries/media', 'GalleryController@storeMedia')->name('galleries.storeMedia');
    Route::post('galleries/ckmedia', 'GalleryController@storeCKEditorImages')->name('galleries.storeCKEditorImages');
    Route::resource('galleries', 'GalleryController');

    // Sportstype
    Route::delete('sportstypes/destroy', 'SportstypeController@massDestroy')->name('sportstypes.massDestroy');
    Route::post('sportstypes/media', 'SportstypeController@storeMedia')->name('sportstypes.storeMedia');
    Route::post('sportstypes/ckmedia', 'SportstypeController@storeCKEditorImages')->name('sportstypes.storeCKEditorImages');
    Route::resource('sportstypes', 'SportstypeController');

    // Titles
    Route::delete('titles/destroy', 'TitlesController@massDestroy')->name('titles.massDestroy');
    Route::resource('titles', 'TitlesController');

    // Members
    Route::delete('members/destroy', 'MembersController@massDestroy')->name('members.massDestroy');
    Route::resource('members', 'MembersController');

    // Payments
    Route::delete('payments/destroy', 'PaymentsController@massDestroy')->name('payments.massDestroy');
    Route::resource('payments', 'PaymentsController');

    // User Details
    Route::delete('user-details/destroy', 'UserDetailsController@massDestroy')->name('user-details.massDestroy');
    Route::resource('user-details', 'UserDetailsController');
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

// Route::get('/past-president', function () {
//     return view('past-president');
// });
Route::get('/food_beverages', function () {
    return view('food_beverages');
});


// Route::get('/', 'PagesController@index')->name('pages');
// Route::resource('pages', 'PagesController');

// require __DIR__.'/auth.php';

Route::get('pages/{sport_name}', 'PagesController@show');

Route::get('demo', 'FrontendhtmlController@pastpresident');

Route::get('/footer', [ContactController::class,'contact']);

Route::post('/send-message', [ContactController::class,'sendEmail'])->name('contact.send');
Route::resource('reciprocal-clubs/create', ReciprocalClubsController::class);
Route::get('/history', function () {
    return view('history');
});
Route::get('/memeber-login', function () {
    return view('memeber-login');
});