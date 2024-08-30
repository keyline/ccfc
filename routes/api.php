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
    /* before login */
        Route::post('member/signinwithmobile', [ApiController::class,'signinWithMobile'])->name('api.v2.member.signinwithmobile.signinwithmobile');
        Route::post('member/validateotp', [ApiController::class,'validateOtp'])->name('api.v2.member.validateotp.validateOtp');
        Route::post('member/signinwithpassword', [ApiController::class,'signInWithPassword'])->name('api.v2.member.signinwithpassword.signInWithPassword');
        Route::post('member/forgotpassword', [ApiController::class,'forgotPassword'])->name('api.v2.member.forgotpassword.forgotPassword');
        Route::post('member/verifyotp', [ApiController::class,'verifyOtp'])->name('api.v2.member.verifyotp.verifyOtp');
        Route::post('member/resendotp', [ApiController::class,'resendOtp'])->name('api.v2.member.resendotp.resendOtp');
        Route::post('member/resetpassword', [ApiController::class,'resetPassword'])->name('api.v2.member.resetpassword.resetPassword');
    /* before login */
    /* after login */
        Route::get('member/logout', [ApiController::class,'logOut'])->name('api.v2.member.logout.logOut');
        Route::get('member/dashboard', [ApiController::class,'dashboard'])->name('api.v2.member.dashboard.dashboard');
        Route::get('member/getprofile', [ApiController::class,'getProfile'])->name('api.v2.member.getprofile.getProfile');
        Route::get('member/mycard', [ApiController::class,'myCard'])->name('api.v2.member.mycard.myCard');
        Route::get('member/getcontactus', [ApiController::class,'getContactUs'])->name('api.v2.member.getcontactus.getContactUs');
        Route::post('member/submitcontactus', [ApiController::class,'submitContactUs'])->name('api.v2.member.submitcontactus.submitContactUs');

        Route::post('member/whatscooking', [ApiController::class,'whatsCooking'])->name('api.v2.member.whatscooking.whatsCooking');
        Route::post('member/dayspecial', [ApiController::class,'daySpecial'])->name('api.v2.member.dayspecial.daySpecial');
        Route::post('member/staticpages', [ApiController::class,'staticPages'])->name('api.v2.member.staticpages.staticPages');
        Route::post('member/changepassword', [ApiController::class,'changePassword'])->name('api.v2.member.changepassword.changePassword');
        Route::get('member/deleteaccount', [ApiController::class,'deleteAccount'])->name('api.v2.member.deleteaccount.deleteAccount');
        Route::get('member/spabooking', [ApiController::class,'spaBooking'])->name('api.v2.member.spabooking.spaBooking');
        Route::post('member/facility', [ApiController::class,'facility'])->name('api.v2.member.facility.facility');
        Route::get('member/spabooking-tracking', [ApiController::class,'spaBookingTracking'])->name('api.v2.member.spabooking-tracking.spaBookingTracking');
        Route::get('member/clubupdates', [ApiController::class,'clubUpdates'])->name('api.v2.member.clubupdates.clubUpdates');
        Route::get('member/mustread', [ApiController::class,'mustRead'])->name('api.v2.member.mustread.mustRead');
        Route::get('member/billing', [ApiController::class,'billing'])->name('api.v2.member.billing.billing');
        Route::post('member/billinglist', [ApiController::class,'billingList'])->name('api.v2.member.billinglist.billingList');
        Route::post('member/billingdetail', [ApiController::class,'billingDetail'])->name('api.v2.member.billingdetail.billingDetail');
        Route::post('member/billingreport', [ApiController::class,'billingReport'])->name('api.v2.member.billingreport.billingReport');
        Route::post('member/payuresponse', [ApiController::class,'payuResponse'])->name('api.v2.member.payuresponse.payuResponse');
        Route::get('member/notification', [ApiController::class,'notification'])->name('api.v2.member.notification.notification');
        Route::post('member/testpush', [ApiController::class,'testPush'])->name('api.v2.member.testpush.testPush');
        Route::post('member/profileupdaterequest', [ApiController::class,'profileUpdateRequest'])->name('api.v2.member.profileupdaterequest.profileUpdateRequest');
        Route::get('member/testclubmanapi', [ApiController::class,'testClubmanApi'])->name('api.v2.member.testclubmanapi.testClubmanApi');
        Route::post('member/makepayment', [ApiController::class,'makePayment'])->name('api.v2.member.makepayment.makePayment');
        Route::get('member/getunreadnotificationcount', [ApiController::class,'getUnreadNotificationCount'])->name('api.v2.member.getunreadnotificationcount.getUnreadNotificationCount');
    /* after login */
});