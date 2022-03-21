<?php
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

// Route::get('/', 'FrontendHome@index')->name('index');

Route::get('/', function () {
    if (session('fail')) {
        return view('member.protected');
    }
    $reciprocalClubs = ReciprocalClub::all();
    $contentPages = ContentPage::all();
    $sportstypes = Sportstype::all();

    $galleries = Gallery::with(['media'])->get();
    
    // $galleries = Gallery::all();
    

    return view('index', compact('reciprocalClubs', 'contentPages', 'galleries', 'sportstypes'));
});


Route::get('/past-president', function () {
    $pastPresidents = PastPresident::with(['media'])->get();
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
    $userDetails = UserDetail::with(['user_code', 'media'])->get();
    $galleries = Gallery::with(['media'])->get();
    // $users = User::with(['roles'])->get();
    return view('sports', compact(['contentPages','members','userDetails','galleries']));
    // return view('sports', compact(['members','users']));
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
    $committeeMemberMappings = CommitteeMemberMapping::with(['committee', 'member'])->get();
    // $committeeNames = CommitteeName::all();
    $userDetails = UserDetail::with(['user_code', 'media'])->get();
    $galleries = Gallery::with(['media'])->get();
    return view('general_committee', compact(['contentPages','committeeMemberMappings','userDetails','galleries']));
});



Route::get('/balloting_committee', function () {
    $contentPages = ContentPage::all();
    $committeeMemberMappings = CommitteeMemberMapping::with(['committee', 'member'])->get();
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
    return view('sub_committees', compact(['contentPages','subCommitteeMembers','userDetails','committeeNames','galleries']));
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
    
    $galleries = Gallery::with(['media'])->get();
  
    return view('annual_report', compact(['galleries']));
});


Route::get('/gallery', function () {
    
    $galleries = Gallery::with(['media'])->get();
  
    return view('gallery', compact(['galleries']));
});



Route::get('/contact-us', function () {
    
    $galleries = Gallery::with(['media'])->get();
  
    return view('contact-us', compact(['galleries']));
});




// Route::redirect('/', '/login');

Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

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


    // Users
    // Route::delete('users/destroy', 'MemberDetailsController@massDestroy')->name('users.massDestroy');
    // Route::delete('users/updatedetails', 'UsersController@updatedetails')->name('users.updatedetails');
    // Route::resource('users', 'MemberDetailsController');

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
    Route::post('user-details/media', 'UserDetailsController@storeMedia')->name('user-details.storeMedia');
    Route::post('user-details/ckmedia', 'UserDetailsController@storeCKEditorImages')->name('user-details.storeCKEditorImages');
    Route::resource('user-details', 'UserDetailsController');

    // Content Block
    Route::delete('content-blocks/destroy', 'ContentBlockController@massDestroy')->name('content-blocks.massDestroy');
    Route::post('content-blocks/media', 'ContentBlockController@storeMedia')->name('content-blocks.storeMedia');
    Route::post('content-blocks/ckmedia', 'ContentBlockController@storeCKEditorImages')->name('content-blocks.storeCKEditorImages');
    Route::resource('content-blocks', 'ContentBlockController');

    // Sub Committee Members
    Route::delete('sub-committee-members/destroy', 'SubCommitteeMembersController@massDestroy')->name('sub-committee-members.massDestroy');
    Route::resource('sub-committee-members', 'SubCommitteeMembersController');
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

Route::post('/member/check', [HomeController::class, 'checkMember'])->name('member.check');
Route::get('/member/logout', [HomeController::class, 'logout'])->name('member.logout');



Route::group([
    'prefix' => 'member',
    'as' => 'member.',
    'namespace' => 'Member',
    'middleware' => ['member']
], function () {
    Route::get('/login', [HomeController::class, 'memberLogin'])->name('login');

    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    Route::get('/invoice', [HomeController::class, 'invoice'])->name('invoice');

    Route::get('/events_members_only', function () {
        return view('events_members_only');
    })->name('events_members_only');

    Route::get('/1792-newsletter', function () {
        return view('1792-newsletter');
    })->name('1792-newsletter');

    Route::get('/notice-circulars', function () {
        return view('notice-circulars');
    })->name('notice-circulars');

    
    Route::get('/rules_regulation', function () {
        return view('rules_regulation');
    })->name('rules_regulation');
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
    
    Route::get('/rules_regulation', function () {
        return view('rules_regulation');
    });
     
    
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

    Route::get('/edit', [MemberDetailsController::class, 'edit'])->name('edit');

    
    // Route::get('/invoice', [HomeController::class, 'invoice'])->name('invoice');

    // Route::get('ajaxRequest', [MemberUpdateController::class, 'ajaxRequest']);
    // Route::post('ajaxRequest', [MemberUpdateController::class, 'ajaxRequestPost'])->name('ajaxRequest.post');