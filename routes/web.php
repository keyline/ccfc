<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\apiController;
use App\Http\Controllers\ContactController;
use App\Models\ReciprocalClub;
use App\Models\ContentPage;
use App\Models\Gallery;
use App\Models\Sportstype;
use App\Models\PastPresident;
use App\Models\ContentBlock;
use App\Models\Trophy;
use App\Models\Sportsman;
use App\Http\Controllers\Member\HomeController;
use App\Models\Member;
// use App\Models\Title;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\CommitteeMemberMapping;
use App\Models\SubCommitteeMember;
use App\Models\CommitteeName;
use App\Http\Controllers\Admin\UsersController;
use App\Models\circular;
use App\Models\Contactlist;
use App\Models\Events;
use App\Mail\MyTestEmail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Admin\TenderFileUploadController;
use App\Models\DocumentOrganizer;
use App\Http\Controllers\TenderDownloadController;

// Route::get('/', 'FrontendHome@index')->name('index');

Route::get('/', function () {
    if (session('fail')) {
        return view('member.protected');
    }
    $reciprocalClubs = ReciprocalClub::all();
    $contentPages = ContentPage::all();
    $sportstypes = Sportstype::all();
    $contactlists = Contactlist::all();
    $galleries = Gallery::with(['media'])->get();

    // $galleries = Gallery::all();


    return view('index', compact('reciprocalClubs', 'contentPages', 'galleries', 'sportstypes', 'contactlists'));
});


Route::get('/past-president', function () {
    $pastPresidents = PastPresident::with(['media'])->orderBy('short_order', 'ASC')->get();
    $galleries = Gallery::with(['media'])->get();
    // $data='Data';
    return view('past-president', compact(['pastPresidents','galleries']));
});



Route::get('/history', function () {
    $contentPages = ContentPage::all();
    $galleries = Gallery::with(['media'])->get();
    // $data='Data';
    return view('history', compact(['contentPages', 'galleries']));
});

Route::get('/food_beverages', function () {
    $contentPages = ContentPage::all();
    $galleries = Gallery::with(['media'])->get();
    $contentBlocks = ContentBlock::with(['source_page'])->get();
    // $data='Data';
    return view('food_beverages', compact(['contentPages', 'galleries', 'contentBlocks']));
});


Route::get('/trophies', function () {
    $contentPages = ContentPage::all();
    $trophies = Trophy::with(['media'])->get();
    $galleries = Gallery::with(['media'])->get();
    // $data='Data';
    return view('trophies', compact(['contentPages','trophies','galleries']));
});


Route::get('/famous_sportsmen', function () {
    $contentPages = ContentPage::all();
    $sportsmen = Sportsman::with(['media'])->get();
    $galleries = Gallery::with(['media'])->get();
    // $data='Data';
    return view('famous_sportsmen', compact(['contentPages','sportsmen','galleries']));
});



Route::get('/sports', function () {
    $contentPages = ContentPage::all();
    $members = Member::with(['select_member', 'select_title', 'select_sport'])->get();
    $userDetails = UserDetail::with(['user_code'])->get();
    $galleries = Gallery::with(['media'])->get();
    return view('sports', compact(['contentPages','members','userDetails','galleries']));
});



Route::get('/reciprocal_clubs', function () {
    $contentPages = ContentPage::all();
    $reciprocal = ReciprocalClub::with(['media'])->get();
    $galleries = Gallery::with(['media'])->get();
    return view('reciprocal_clubs', compact(['contentPages','reciprocal','galleries']));
});

Route::get('/general_committee', function () {
    $contentPages = ContentPage::all();
    // $members = Member::with(['select_member', 'select_title', 'select_sport'])->get();
    //$committeeMemberMappings = CommitteeMemberMapping::with(['committee', 'member'])->get();
    //dd($committeeMemberMappings->member());
    // $committeeNames = CommitteeName::all();
    $committeeMemberMappings = CommitteeMemberMapping::join('committee_names', 'committee_names.id', '=', 'committee_member_mappings.committee_id')
                            ->join('users', 'users.id', '=', 'committee_member_mappings.member_id')
                            ->where('committee_names.id', '=', '1')
                            ->orderBy('committee_member_mappings.member_order', 'ASC')
                            ->get();

    $userDetails = UserDetail::with(['user_code', 'media'])->get();

    $galleries = Gallery::with(['media'])->get();
    return view('general_committee', compact(['contentPages','committeeMemberMappings','userDetails','galleries']));
});



Route::get('/balloting_committee', function () {
    $contentPages = ContentPage::all();
    //$committeeMemberMappings = CommitteeMemberMapping::with(['committee', 'member'])->get();

    $committeeMemberMappings = CommitteeMemberMapping::join('committee_names', 'committee_names.id', '=', 'committee_member_mappings.committee_id')
                                ->join('users', 'users.id', '=', 'committee_member_mappings.member_id')
                                ->where('committee_names.id', '=', '2')
                                ->orderBy('committee_member_mappings.member_order', 'ASC')
                                ->get();

    $userDetails = UserDetail::with(['user_code', 'media'])->get();
    $galleries = Gallery::with(['media'])->get();
    return view('balloting_committee', compact(['contentPages','committeeMemberMappings','userDetails','galleries']));
});



Route::get('/sub_committees', function () {
    $contentPages = ContentPage::all();


    $subCommitteeMembers = SubCommitteeMember::with(['comittee_name', 'member'])->get();

    $userDetails = UserDetail::with(['user_code', 'media'])->get();


    $committeeNames = CommitteeName::all();


    $galleries = Gallery::with(['media'])->get();


    return view('sub_committees', compact(['contentPages','subCommitteeMembers','committeeNames','galleries','userDetails']));
});


Route::get('/gymming-rejuvenated', function () {
    $contentPages = ContentPage::all();
    $galleries = Gallery::with(['media'])->get();
    $contentBlocks = ContentBlock::with(['source_page'])->get();
    return view('gymming-rejuvenated', compact(['contentPages', 'galleries', 'contentBlocks']));
});


Route::get('/pool-pub', function () {
    $contentPages = ContentPage::all();
    $galleries = Gallery::with(['media'])->get();
    $contentBlocks = ContentBlock::with(['source_page'])->get();
    return view('pool-pub', compact(['contentPages', 'galleries', 'contentBlocks']));
});


Route::get('/club-bar', function () {
    $contentPages = ContentPage::all();
    $galleries = Gallery::with(['media'])->get();
    $contentBlocks = ContentBlock::with(['source_page'])->get();
    return view('club-bar', compact(['contentPages', 'galleries', 'contentBlocks']));
});

/* added day-spa page on 22/04/24 by <shuvadeep@keylines.net> */

Route::get('/day-spa', function () {
    $contentPages = ContentPage::all();
    $galleries = Gallery::with(['media'])->get();
    $contentBlocks = ContentBlock::with(['source_page'])->get();
    return view('day-spa', compact(['contentPages', 'galleries', 'contentBlocks']));
});


Route::get('/maintains-new', function () {
    $contentPages = ContentPage::all();
    $galleries = Gallery::with(['media'])->get();
    $contentBlocks = ContentBlock::with(['source_page'])->get();
    return view('maintains-new', compact(['contentPages', 'galleries', 'contentBlocks']));
});


Route::get('/swimming-pool', function () {
    $contentPages = ContentPage::all();
    $galleries = Gallery::with(['media'])->get();
    $contentBlocks = ContentBlock::with(['source_page'])->get();
    return view('swimming-pool', compact(['contentPages', 'galleries', 'contentBlocks']));
});


Route::get('/president_corner', function () {
    $contentPages = ContentPage::all();
    $galleries = Gallery::with(['media'])->get();
    $contentBlocks = ContentBlock::with(['source_page'])->get();
    return view('president_corner', compact(['contentPages', 'galleries', 'contentBlocks']));
});


Route::get('/amenities_services', function () {
    $galleries = Gallery::with(['media'])->get();

    return view('amenities_services', compact(['galleries']));
});


Route::get('/annual_report', function () {
    $contentPages = ContentPage::all();
    $galleries = Gallery::with(['media'])->get();

    return view('annual_report', compact(['galleries','contentPages']));
});


Route::get('/gallery', function () {
    $contentPages = ContentPage::all();
    $galleries = Gallery::with(['media'])->get();

    return view('gallery', compact(['contentPages','galleries']));
});



// Route::get('/contact-us', function () {

//     $galleries = Gallery::with(['media'])->get();

//     return view('contact-us', compact(['galleries']));
// });

// Route::post('password', 'ChangePasswordResetController@update')->name('passwordreset.update');



Route::get('/contact-us', [App\Http\Controllers\ContactController::class, 'contactForm'])->name('contact-us');
Route::post('/contact-us', [App\Http\Controllers\ContactController::class, 'storeContactForm'])->name('contact-us.store');



// Route::redirect('/', '/login');

// Route::get('/home', function () {
//     if (session('status')) {
//         return redirect()->route('admin.home')->with('status', session('status'));
//     }

//     return redirect()->route('admin.home');
// });


// Route::get('/home', function () {
//     if (session('status')) {
//         return redirect()->route('admin.home')->with('status', session('status'));
//     }

//     return redirect()->route('admin.home');
// });


Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', '2fa', 'admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    // Route::delete('users/updatedetails', 'UsersController@updatedetails')->name('users.updatedetails');
    Route::resource('users', 'UsersController');


    // Cron
    Route::resource('memberDataCron', 'memberDataCronController');
    //Cron


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

    // Contact List
    Route::get('create/contactlist', [App\Http\Controllers\Admin\ContactlistsController::class, 'index'])->name('contactlist');
    Route::get('create/add-contactlist', [App\Http\Controllers\Admin\ContactlistsController::class, 'create']);
    Route::post('create/add-contactlist', [App\Http\Controllers\Admin\ContactlistsController::class, 'store']);
    Route::get('create/edit-contactlist/{id}', [App\Http\Controllers\Admin\ContactlistsController::class, 'edit']);
    Route::put('create/update-contactlist/{id}', [App\Http\Controllers\Admin\ContactlistsController::class, 'update']);
    Route::get('create/delete-contactlist/{id}', [App\Http\Controllers\Admin\ContactlistsController::class, 'destroy']);

    // Members
    Route::delete('members/destroy', 'MembersController@massDestroy')->name('members.massDestroy');
    Route::resource('members', 'MembersController');

    // Payments
    Route::delete('payments/destroy', 'PaymentsController@massDestroy')->name('payments.massDestroy');
    Route::resource('payments', 'PaymentsController');

    // User Details
    Route::delete('user-details/destroy', 'UserDetailsController@massDestroy')->name('user-details.massDestroy');
    Route::post('user-details/media', 'UserDetailsController@storeMedia')->name('user-details.storeMedia');
    Route::post('user-details/ckmedia', 'UserDetailsController@storeCKEditorImages')->name('user-details.storeCKEditorImages');
    Route::resource('user-details', 'UserDetailsController');

    Route::get('create/edit-details/{id}', [App\Http\Controllers\Admin\UserDetailsController::class, 'edit']);
    Route::put('create/update-details/{id}', [App\Http\Controllers\Admin\UserDetailsController::class, 'update']);


    // Content Block
    Route::delete('content-blocks/destroy', 'ContentBlockController@massDestroy')->name('content-blocks.massDestroy');
    Route::post('content-blocks/media', 'ContentBlockController@storeMedia')->name('content-blocks.storeMedia');
    Route::post('content-blocks/ckmedia', 'ContentBlockController@storeCKEditorImages')->name('content-blocks.storeCKEditorImages');
    Route::resource('content-blocks', 'ContentBlockController');

    // Sub Committee Members
    Route::delete('sub-committee-members/destroy', 'SubCommitteeMembersController@massDestroy')->name('sub-committee-members.massDestroy');
    Route::resource('sub-committee-members', 'SubCommitteeMembersController');

    Route::get('campaigns/index', [App\Http\Controllers\Admin\SendInBlueController::class, 'index'])->name('list-campaign');

    Route::post('campaigns/new-campaign', [App\Http\Controllers\Admin\SendInBlueController::class, 'store'])->name('new-campaign');

    //circular
    Route::get('campaingns/{campaign}/show', [App\Http\Controllers\Admin\SendInBlueController::class, 'show'])->name('show-campaign');

    Route::get('campaingns/{campaign}/edit', [App\Http\Controllers\Admin\SendInBlueController::class, 'edit'])->name('edit-campaign');

    Route::post('campaingns/{campaign}/update', [App\Http\Controllers\Admin\SendInBlueController::class, 'update'])->name('update-campaign');

    Route::delete('campaigns/{campaign}/delete', [App\Http\Controllers\Admin\SendInBlueController::class, 'delete'])->name('delete-campaign');

    Route::post('campaigns/remove/attachment', [App\Http\Controllers\Admin\SendInBlueController::class, 'rmAttachment'])->name('remove-attachment');


    Route::get('create/circulars', [App\Http\Controllers\Admin\CircularController::class, 'index'])->name('circulars');

    Route::get('create/add-circular', [App\Http\Controllers\Admin\CircularController::class, 'create']);

    Route::post('create/add-circular', [App\Http\Controllers\Admin\CircularController::class, 'store']);

    Route::get('create/edit-circular/{id}', [App\Http\Controllers\Admin\CircularController::class, 'edit']);

    Route::put('create/update-circular/{id}', [App\Http\Controllers\Admin\CircularController::class, 'update']);

    Route::get('create/delete-circular/{id}', [App\Http\Controllers\Admin\CircularController::class, 'destroy']);


    // Route::delete("delete", [App\Http\Controllers\Admin\CircularController::class, "deleteImage"])->name("delete");

    //events

    Route::get('create/event', [App\Http\Controllers\Admin\EventsController::class, 'index'])->name('event');

    Route::get('create/add-event', [App\Http\Controllers\Admin\EventsController::class, 'create']);

    Route::post('create/add-event', [App\Http\Controllers\Admin\EventsController::class, 'store']);

    Route::get('create/edit-event/{id}', [App\Http\Controllers\Admin\EventsController::class, 'edit']);

    Route::put('create/update-event/{id}', [App\Http\Controllers\Admin\EventsController::class, 'update']);

    Route::get('create/delete-event/{id}', [App\Http\Controllers\Admin\EventsController::class, 'destroy']);




    Route::get('contactus', 'ContactController@index')->name('contactus');
    //Ajax Request
    Route::get('/saveUserJson/{code}', [UsersController::class, 'saveUserJson'])->name('saveUserJson');

    Route::get('/auto-memberprofileupdate', function () {
        $query = \App\Models\User::query();
        $query->where('email', '=', '');
        $query->where('id', '<>', 1);
        $users = $query->get();
        foreach ($users as $user) {
            \App\Jobs\MemberProfileUpdate::dispatch($user->user_code)->onQueue('memberprofile');
        }
        return view('home');
    });

    //Bulk email send
    Route::get('campaigns/{campaign}/start', [App\Http\Controllers\Admin\SendInBlueController::class, 'startCampaign'])->name('start-campaign');

    Route::get('/campaigns/showmeemailtpl', function () {
        return view('admin.campaigns.notification', ['body' => "This is test"]);
        //echo "pass";
    });

    Route::get('/exporttocsv', 'UsersController@exportToCSV')->name('users.exporttocsv');

    Route::delete('tenderuploads/destroy', 'TenderFileUploadController@massDestroy')->name('tenderuploads.massDestroy');
    Route::resource('tenderuploads', 'TenderFileUploadController');
    Route::post('tenderuploads/media', [TenderFileUploadController::class, 'storeMedia'])->name('tenderuploads.storeMedia');

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

// Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
//     // Change password
//     if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordResetController.php'))) {


//         Route::post('/change_password', 'ChangePasswordResetController@update')->name('change_password.update');

//     }


// });

// Route::get('/changePassword', [App\Http\Controllers\Auth\ChangePasswordResetController::class, 'showChangePasswordGet'])->name('changePasswordGet');

// Route::post('/changePassword', [App\Http\Controllers\Auth\ChangePasswordResetController::class, 'changePasswordPost'])->name('changePasswordPost');



Route::get('/member/change-password', 'ChangePasswordResetController@change_password')->name('change_password');

Route::post('/member/update-password', 'ChangePasswordResetController@update_password')->name('update_password');





// Route::get('/change_password', function () {
//     return view('change_password');
// })->name('change_password');


// Route::get('/change_password', [App\Http\Controllers\Auth\ChangePasswordResetController::class, 'showChangePasswordGet'])->name('changePasswordGet');
// Route::post('/change_password', [App\Http\Controllers\Auth\ChangePasswordResetController::class, 'changePasswordPost'])->name('changePasswordPost');

Route::group(['namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    // Two Factor Authentication
    if (file_exists(app_path('Http/Controllers/Auth/TwoFactorController.php'))) {
        Route::get('two-factor', 'TwoFactorController@show')->name('twoFactor.show');
        Route::post('two-factor', 'TwoFactorController@check')->name('twoFactor.check');
        Route::get('two-factor/resend', 'TwoFactorController@resend')->name('twoFactor.resend');
    }
});

Route::post('/member/check', [HomeController::class, 'checkMember'])->name('member.check');
Route::get('/member/logout', [HomeController::class, 'logout'])->name('member.logout');


Route::group([
    'prefix' => 'member',
    'as' => 'member.',
    'namespace' => 'Member',
    'middleware' => ['member'],
], function () {
    Route::get('/login', [HomeController::class, 'memberLogin'])->name('login');




    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    Route::get('/invoice', [HomeController::class, 'invoice'])->name('invoice');






    Route::get('/events_members_only', function () {
        $galleries = Gallery::with(['media'])->get();

        $contentPages = ContentPage::all();

        $event = Events::orderBy('id', 'DESC')->get();

        return view('events_members_only', compact(['galleries','contentPages','event']));
    })->name('events_members_only');






    Route::get('/1792-newsletter', function () {
        $galleries = Gallery::with(['media'])->get();
        $contentPages = ContentPage::all();

        $query = \App\Models\ContentBlock::query();
        $query->where('source_page_id', '=', 18);
        $contentBlocks = $query->get();

        //$contentBlocks = ContentBlock::all();
        return view('1792-newsletter', compact(['galleries','contentPages','contentBlocks']));
    })->name('1792-newsletter');

    Route::get('/notice-circulars', function () {
        $galleries = Gallery::with(['media'])->get();

        $contentPages = ContentPage::all();

        // $circular = circular::all();

        $circular = circular::orderBy('id', 'DESC')->get();

        return view('notice-circulars', compact(['galleries','contentPages','circular']));
    })->name('notice-circulars');


    Route::get('/rules_regulation', function () {
        $galleries = Gallery::with(['media'])->get();
        $contentPages = ContentPage::all();
        return view('rules_regulation', compact(['galleries','contentPages']));
    })->name('rules_regulation');


    # Call Route
    Route::post('payment', ['as' => 'payment', 'uses' => 'PaymentController@payment']);

    # Status Route
    Route::get('payment/status', ['as' => 'payment.status', 'uses' => 'PaymentController@status']);

    Route::get('/invoice/{month}/{year}/{filename}/download', [HomeController::class, 'download'])->name('download');

    Route::get('/{usercode}/update/', function ($usercode) {
        return view('member.updateprofile', ['usercode' => $usercode]);
    })->name('profileupdate');

    Route::POST('/updateme', [HomeController::class , 'updateMyProfile'])->name('updateme');

    //HDFC call route
    Route::post('paywithhdfc', ['as' => 'paywithhdfc', 'uses' => 'PaymentController@PayWithHdfc']);

    //HDFC Status route
    Route::post('payment/hdfcstatus', ['as' => 'paywithhdfc.status', 'uses' => 'PaymentController@statusForHdfc']);

    Route::get('payment/others/status', ['as' => 'paymentstatusotherpgs', 'uses' => 'PaymentController@showPaymentStatus']);


    #Axis-Razor Pay staus route
    Route::post('payment/axisstatus', ['as' => 'axisstatus', 'uses' => 'PaymentController@callback']);
    ##Axis-Razor Pay checkout route
    Route::post('payment/axischeckout', [ 'as' => 'axischeckout', 'uses' => 'PaymentController@checkout']);


});



// Route::get('/reciprocal_clubs', function () {
//     return view('reciprocal_clubs');
// });
// Route::get('/general_committee', function () {
//     return view('general_committee');
// });

// Route::get('/balloting_committee', function () {
//     return view('balloting_committee');
// });

// Route::get('/sub_committees', function () {
//     return view('sub_committees');
// });

// Route::get('/president_corner', function () {
//     return view('president_corner');
// });

// Route::get('/annual_report', function () {
//     return view('annual_report');
// });



Route::get('/new_member', function () {
    return view('new_member');
});


// Route::get('/gymming-rejuvenated', function () {
//     return view('gymming-rejuvenated');
// });
// Route::get('/swimming-pool', function () {
//     return view('swimming-pool');
// });
// Route::get('/club-bar', function () {
//     return view('club-bar');
// });
// Route::get('/pool-pub', function () {
//     return view('pool-pub');
// });
// Route::get('/contact-us', function () {
//     return view('contact-us');
// });

// Route::get('/amenities_services', function () {
//     return view('amenities_services');
// });

// Route::get('/amenities_services', function () {
//     return view('amenities_services');
// });


// Route::get('/', 'PagesController@index')->name('pages');
// Route::resource('pages', 'PagesController');

// require _DIR_.'/auth.php';

Route::get('sports/{sport_name}', 'PagesController@show');
// Route::get('sports/{sport_name}', 'PagesController@show');

Route::get('demo', 'FrontendhtmlController@pastpresident');

Route::get('/footer', [ContactController::class,'contact']);

Route::post('/send-message', [ContactController::class,'sendEmail'])->name('contact.send');
Route::resource('reciprocal-clubs/create', ReciprocalClubsController::class);


// Route::get('/trophies', function () {
//     return view('trophies');
// });

// Route::get('/famous_sportsmen', function () {
//     return view('famous_sportsmen');
// });

// Route::get('/reciprocal_clubs', function () {
//     return view('reciprocal_clubs');
// });
// Route::get('/general_committee', function () {
//     return view('general_committee');
// });

// Route::get('/balloting_committee', function () {
//     return view('balloting_committee');
// });

// Route::get('/sub_committees', function () {
//     return view('sub_committees');
// });

// Route::get('/president_corner', function () {
//     return view('president_corner');
// });

// Route::get('/annual_report', function () {
//     return view('annual_report');
// });

// Route::get('/events_members_only', function () {
//     return view('events_members_only');
// });

Route::get('/new_member', function () {
    return view('new_member');
});

// Route::get('/rules_regulation', function () {
//     return view('rules_regulation');
// });


Route::get('/member-login', function () {
    return view('member-login');
});
// Route::get('/sports', function () {
//     return view('sports');
// });

// Route::get('/gallery', function () {
//     return view('gallery');
// });
Route::get('/dashboard-landing', function () {
    return view('dashboard-landing');
});
// Route::get('member/invoice', function () {
//     return view('member/invoice');
// });





// Route::post('user-details/media', 'UserDetailsController@storeMedia')->name('user-details.storeMedia');

// Route::get('users/index', [MemberDetailsController::class, 'index'])->name('index');

// Route::get('insert','MemberDetailsController@index');

// Route::post('store','MemberDetailsController@store');


// Route::get('memberdetails', 'MemberDetailsController@index')->name('memberdetails.index');

// Route::post('memberdetails','MemberDetailsController@index');

// Route::get('users/memberdetails', 'MemberDetailsController@index')->name('memberdetails');




// Route::get('users/userDetails', [MemberDetailsController::class, 'userDetails'])->name('userDetails');

// Route::get('ajaxRequest', [MemberUpdateController::class, 'ajaxRequest']);
// Route::post('ajaxRequest', [MemberUpdateController::class, 'ajaxRequestPost'])->name('ajaxRequest.post');


//contact

// Route::get('admin/contactus', function () {
//     return view('admin.contact.index');
// });

// Route::get('password/reset/{token}/{email}/{user_code}', 'Auth\ResetPasswordController@showResetForm')
// ->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')
->name('password.update');
Route::get('maintenace');
Route::get('/testemail', function () {
    //$name = "Funny Coder";

    $data = ['name' => 'Sudip Kulavi', 'link' => 'https://ccfc1792.com', 'subject' => 'This is test email'];

    // The email sending is done using the to method on the Mail facade
    Mail::to('system@keylines.net')->send(new MyTestEmail($data));
});
Route::get('tenders', function () {
    $uploadedTenders = DocumentOrganizer::find(1)->documents()->where('ctd_archive_status', '1')->get();
    return view('document-viewer', compact(['uploadedTenders']));
})->name('showme.tenders');
Route::get('archives', function () {
    //$archivedTenders= DocumentOrganizer::find(1)->documents()->where('ctd_archive_status', '0')->get();
    //$folder = DocumentOrganizer::where('cdo_id', $archivedTenders[0]->ctd_cdo_id)->first();
    /*$folders = DocumentOrganizer::all();
        $folders->load(['documents' => function ($query) {
                    $query->where('ctd_archive_status', '0');
        }]);*/
    $folders = DocumentOrganizer::whereHas('documents', function ($query) {
        $query->where('ctd_archive_status', '0');
    })->with(['documents' => function ($query) {
        $query->where('ctd_archive_status', '0')->with('files');
    }])->get();
    //dd($folders);
    return view('document-archive', compact(['folders']));
})->name('showme.archives');

Route::get('/download/tender/{file}', [TenderDownloadController::class, 'download'])->name('download.tender');

/* api */
    Route::prefix('/apiv2')->namespace('App\Http\Controllers\Api')->group(function () {
        // Route::match(['post', 'get'], 'signinWithMobile', 'ApiController@signinWithMobile');
        Route::post('signinWithMobile', 'ApiController@signinWithMobile')->name('signinWithMobile');
    });
/* api */