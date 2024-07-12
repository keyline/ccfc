<?php
declare(strict_types=1);
namespace App\Http\Controllers\Api\V2\Member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Log;

use GuzzleHttp\Client;
use App\Helpers\SearchInvoicePdf;
use Illuminate\Support\Facades\Storage;
use pcrov\JsonReader\JsonReader;

use App\Models\BillReport;
use App\Models\circular;
use App\Models\Events;
use App\Models\Contact;
use App\Models\Contactlist;
use App\Models\CookingCategory;
use App\Models\CookingItem;
use App\Models\CookingDaySpecial;
use App\Models\CookingDaySpecialImage;
use App\Models\ContentBlock;
use App\Models\ContentCategory;
use App\Models\ContentPage;
use App\Models\ContentTag;
use App\Models\ClubmanItem;
use App\Models\DeleteAccountRequest;
use App\Models\GeneralSetting;
use App\Models\MustRead;
use App\Models\SpaBookingTracking;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\UserDevice;
use App\Models\Gallery;
use App\Models\OtherFoodItem;

use Tzsk\Payu\Concerns\Attributes;
use Tzsk\Payu\Concerns\Customer;
use Tzsk\Payu\Concerns\Transaction;
use Tzsk\Payu\Facades\Payu;

use Tzsk\Pay\Models\PayuTransaction;
use App\Notifications\PayUEmailNotification;
use Notification;

use App\Libraries\CreatorJwt;
use App\Libraries\JWT;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

use App\Helpers\Helper;

use File;
use Response;
use Auth;
use Hash;
use Mail;
Use DB;
Use DateTime;

class ApiController extends Controller
{

    /* signin */
        public function signinWithMobile(Request $request){
            $project_key        = 'facb6e0a6fcbe200dca2fb60dec75be7';
            $apiStatus          = TRUE;
            $apiMessage         = '';
            $apiResponse        = [];
            $apiExtraField      = '';
            $apiExtraData       = '';
            $this->isJSON(file_get_contents('php://input'));
            $requestData        = $this->extract_json(file_get_contents('php://input'));
            $requiredFields     = ['phone', 'device_token'];
            $headerData         = $request->header();
            if (!$this->validateArray($requiredFields, $requestData)){
                $apiStatus          = FALSE;
                $apiMessage         = 'All Data Are Not Present !!!';
            }
            // echo $headerData['key'][0];
            // echo '<br>';
            // echo $project_key;
            // echo '<br>';
            // Helper::pr($headerData);
            if($headerData['key'][0] == $project_key){
                $phone                      = $requestData['phone'];
                $device_token               = $requestData['device_token'];
                $checkUser                  = User::where('phone_number_1', '=', $phone)->first();
                if($checkUser){
                    if($checkUser->status == 'ACTIVE'){
                        $mobile_otp = rand(100000,999999);
                        $postData = [
                            'remember_token'        => $mobile_otp
                        ];
                        User::where('id', '=', $checkUser->id)->update($postData);
                        /* send sms */
                            $message = "Dear%20User%2C%0AOTP%20for%20logging%20in%20to%20the%20CC%26FC%20app%20is%20".$mobile_otp.".%20Valid%20for%202%20minutes.";
                            $mobileNo = (($checkUser)?$checkUser->phone_number_1:'');
                            // $mobileNo = 8981374267;
                            $this->sendSMS($mobileNo,$message);
                        /* send sms */
                        $mailData                   = [
                            'id'    => $checkUser->id,
                            'email' => $checkUser->email,
                            'phone' => $checkUser->phone_number_1,
                            'otp'   => $mobile_otp,
                        ];
                        /* send email */
                            $generalSettings    = GeneralSetting::find(1);
                            $subject            = $generalSettings->site_name.' :: OTP For Signin';
                            $message            = view('email-templates.otp',$mailData);
                            // echo $message;die;
                            $this->sendMail($generalSettings->system_email, $subject, $message);
                        /* send email */
                        
                        $apiResponse                        = $mailData;
                        $apiStatus                          = TRUE;
                        $apiMessage                         = 'Please Enter OTP !!!';                        
                    } else {
                        $apiStatus                              = FALSE;
                        $apiMessage                             = 'You Account Is Not Active Yet !!!';
                    }
                } else {
                    $apiStatus                              = FALSE;
                    $apiMessage                             = 'We Don\'t Recognize You !!!';
                }
            } else {
                $apiStatus          = FALSE;
                $apiMessage         = 'Unauthenticate Request !!!';
            }
            $this->response_to_json($apiStatus, $apiMessage, $apiResponse);
        }
        public function validateOtp(Request $request){
            $project_key        = 'facb6e0a6fcbe200dca2fb60dec75be7';
            $apiStatus          = TRUE;
            $apiMessage         = '';
            $apiResponse        = [];
            $apiExtraField      = '';
            $apiExtraData       = '';
            $this->isJSON(file_get_contents('php://input'));
            $requestData        = $this->extract_json(file_get_contents('php://input'));
            $requiredFields     = ['phone', 'otp', 'device_token'];
            $headerData         = $request->header();
            if (!$this->validateArray($requiredFields, $requestData)){
                $apiStatus          = FALSE;
                $apiMessage         = 'All Data Are Not Present !!!';
            }
            if($headerData['key'][0] == $project_key){
                $phone                      = $requestData['phone'];
                $otp                        = $requestData['otp'];
                $device_token               = $requestData['device_token'];
                $fcm_token                  = $requestData['fcm_token'];
                $device_type                = $headerData['source'][0];
                $checkUser                  = User::where('phone_number_1', '=', $phone)->first();
                if($checkUser){
                    if($checkUser->status == 'ACTIVE'){
                        if($otp == $checkUser->remember_token){
                            $objOfJwt           = new CreatorJwt();
                            $app_access_token   = $objOfJwt->GenerateToken($checkUser->id, $checkUser->email, $checkUser->phone_number_1);
                            $user_id            = $checkUser->id;
                            $fields             = [
                                'user_id'               => $user_id,
                                'device_type'           => $device_type,
                                'device_token'          => $device_token,
                                'fcm_token'             => $fcm_token,
                                'app_access_token'      => $app_access_token,
                            ];
                            $checkUserTokenExist                  = UserDevice::where('app_access_token', '=', $app_access_token)->first();
                            if(!$checkUserTokenExist){
                                UserDevice::insert($fields);
                            } else {
                                UserDevice::where('id', '=', $checkUserTokenExist->id)->update($fields);
                            }

                            $apiResponse = [
                                'user_id'               => $user_id,
                                'name'                  => $checkUser->name,
                                'email'                 => $checkUser->email,
                                'phone'                 => $checkUser->phone_number_1,
                                'device_type'           => $device_type,
                                'device_token'          => $device_token,
                                'fcm_token'             => $fcm_token,
                                'app_access_token'      => $app_access_token,
                            ];
                            User::where('id', '=', $checkUser->id)->update(['remember_token' => '']);
                            $apiStatus                          = TRUE;
                            $apiMessage                         = 'SignIn Successfully !!!';
                        } else {
                            $apiStatus                          = FALSE;
                            $apiMessage                         = 'OTP Mismatched !!!';
                        }
                    } else {
                        $apiStatus                              = FALSE;
                        $apiMessage                             = 'You Account Is Not Active Yet !!!';
                    }
                } else {
                    $apiStatus                              = FALSE;
                    $apiMessage                             = 'We Don\'t Recognize You !!!';
                }
            } else {
                $apiStatus          = FALSE;
                $apiMessage         = 'Unauthenticate Request !!!';
            }
            $this->response_to_json($apiStatus, $apiMessage, $apiResponse);
        }
        public function signInWithPassword(Request $request){
            $project_key        = 'facb6e0a6fcbe200dca2fb60dec75be7';
            $apiStatus          = TRUE;
            $apiMessage         = '';
            $apiResponse        = [];
            $apiExtraField      = '';
            $apiExtraData       = '';
            $this->isJSON(file_get_contents('php://input'));
            $requestData        = $this->extract_json(file_get_contents('php://input'));
            $requiredFields     = ['email', 'password', 'device_token'];
            $headerData         = $request->header();
            if (!$this->validateArray($requiredFields, $requestData)){
                $apiStatus          = FALSE;
                $apiMessage         = 'All Data Are Not Present !!!';
            }
            if($headerData['key'][0] == $project_key){
                $email                      = $requestData['email'];
                $password                   = $requestData['password'];
                $device_token               = $requestData['device_token'];
                $fcm_token                  = $requestData['fcm_token'];
                $device_type                = $headerData['source'][0];
                $checkUser                  = User::where('email', '=', $email)->orWhere('user_code', '=', $email)->first();
                if($checkUser){
                    if($checkUser->status == 'ACTIVE'){
                        if(Hash::check($password, $checkUser->password)){
                            $objOfJwt           = new CreatorJwt();
                            $app_access_token   = $objOfJwt->GenerateToken($checkUser->id, $checkUser->email, $checkUser->phone_number_1);
                            $user_id            = $checkUser->id;
                            $fields             = [
                                'user_id'               => $user_id,
                                'device_type'           => $device_type,
                                'device_token'          => $device_token,
                                'fcm_token'             => $fcm_token,
                                'app_access_token'      => $app_access_token,
                            ];
                            $checkUserTokenExist                  = UserDevice::where('app_access_token', '=', $app_access_token)->first();
                            if(!$checkUserTokenExist){
                                UserDevice::insert($fields);
                            } else {
                                UserDevice::where('id', '=', $checkUserTokenExist->id)->update($fields);
                            }
                            
                            $apiResponse = [
                                'user_id'               => $user_id,
                                'name'                  => $checkUser->name,
                                'email'                 => $checkUser->email,
                                'phone'                 => $checkUser->phone_number_1,
                                'device_type'           => $device_type,
                                'device_token'          => $device_token,
                                'fcm_token'             => $fcm_token,
                                'app_access_token'      => $app_access_token,
                            ];
                            $apiStatus                          = TRUE;
                            $apiMessage                         = 'SignIn Successfully !!!';
                        } else {
                            $apiStatus                          = FALSE;
                            $apiMessage                         = 'Invalid Password !!!';
                        }
                    } else {
                        $apiStatus                              = FALSE;
                        $apiMessage                             = 'You Account Is Not Active Yet !!!';
                    }
                } else {
                    $apiStatus                              = FALSE;
                    $apiMessage                             = 'We Don\'t Recognize You !!!';
                }
            } else {
                $apiStatus          = FALSE;
                $apiMessage         = 'Unauthenticate Request !!!';
            }
            $this->response_to_json($apiStatus, $apiMessage, $apiResponse);
        }
    /* signin */
    /* forgot password */
        public function forgotPassword(Request $request){
            $project_key        = 'facb6e0a6fcbe200dca2fb60dec75be7';
            $apiStatus          = TRUE;
            $apiMessage         = '';
            $apiResponse        = [];
            $apiExtraField      = '';
            $apiExtraData       = '';
            $this->isJSON(file_get_contents('php://input'));
            $requestData        = $this->extract_json(file_get_contents('php://input'));
            $requiredFields     = ['email', 'member_code'];
            $headerData         = $request->header();
            if (!$this->validateArray($requiredFields, $requestData)){
                $apiStatus          = FALSE;
                $apiMessage         = 'All Data Are Not Present !!!';
            }
            if($headerData['key'][0] == $project_key){
                $email                      = $requestData['email'];
                $member_code                = $requestData['member_code'];
                $checkUser                  = User::where('email', '=', $email)->where('user_code', '=', $member_code)->first();
                if($checkUser){
                    if($checkUser->status == 'ACTIVE'){
                        // $otp        = rand(100000,999999);
                        $otp        = 123456;
                        $postData   = [
                            'remember_token'        => $otp
                        ];
                        User::where('id', '=', $checkUser->id)->update($postData);
                        $mailData                   = [
                            'id'    => $checkUser->id,
                            'email' => $checkUser->email,
                            'phone' => $checkUser->phone_number_1,
                            'otp'   => $otp,
                        ];
                        /* send email */
                            $generalSettings    = GeneralSetting::find(1);
                            $subject            = $generalSettings->site_name.' :: OTP For Signin';
                            $message            = view('email-templates.otp',$mailData);
                            // echo $message;die;
                            $this->sendMail($generalSettings->system_email, $subject, $message);
                        /* send email */
                        /* send sms */
                            $message = "Dear%20User%2C%0AOTP%20for%20logging%20in%20to%20the%20CC%26FC%20app%20is%20".$otp.".%20Valid%20for%202%20minutes.";
                            $mobileNo = (($checkUser)?$checkUser->phone_number_1:'');
                            // $mobileNo = 6289339520;
                            $this->sendSMS($mobileNo,$message);
                        /* send sms */

                        $apiResponse                        = $mailData;
                        $apiStatus                          = TRUE;
                        http_response_code(200);
                        $apiMessage                         = 'OTP Sent To Email & Mobile For Validation !!!';
                        $apiExtraField                      = 'response_code';
                        $apiExtraData                       = http_response_code();
                    } else {
                        $apiStatus                              = FALSE;
                        $apiMessage                             = 'You Account Is Not Active Yet !!!';
                    }
                } else {
                    $apiStatus                              = FALSE;
                    $apiMessage                             = 'We Don\'t Recognize You !!!';
                }
            } else {
                $apiStatus          = FALSE;
                $apiMessage         = 'Unauthenticate Request !!!';
            }
            $this->response_to_json($apiStatus, $apiMessage, $apiResponse);
        }
        public function verifyOtp(Request $request){
            $project_key        = 'facb6e0a6fcbe200dca2fb60dec75be7';
            $apiStatus          = TRUE;
            $apiMessage         = '';
            $apiResponse        = [];
            $apiExtraField      = '';
            $apiExtraData       = '';
            $this->isJSON(file_get_contents('php://input'));
            $requestData        = $this->extract_json(file_get_contents('php://input'));
            $requiredFields     = ['id', 'otp'];
            $headerData         = $request->header();
            if (!$this->validateArray($requiredFields, $requestData)){
                $apiStatus          = FALSE;
                $apiMessage         = 'All Data Are Not Present !!!';
            }
            if($headerData['key'][0] == $project_key){
                $id                         = $requestData['id'];
                $otp                        = $requestData['otp'];
                $checkUser                  = User::where('id', '=', $id)->first();
                if($checkUser){
                    if($checkUser->status == 'ACTIVE'){
                        if($otp == $checkUser->remember_token){
                            $apiResponse = [
                                'id'                    => $id,
                                'name'                  => $checkUser->name,
                                'email'                 => $checkUser->email,
                                'phone'                 => $checkUser->phone_number_1
                            ];
                            User::where('id', '=', $id)->update(['remember_token' => '']);
                            $apiStatus                          = TRUE;
                            $apiMessage                         = 'OTP Verified Successfully !!!';
                        } else {
                            $apiStatus                          = FALSE;
                            $apiMessage                         = 'OTP Mismatched !!!';
                        }
                    } else {
                        $apiStatus                              = FALSE;
                        $apiMessage                             = 'You Account Is Not Active Yet !!!';
                    }
                } else {
                    $apiStatus                              = FALSE;
                    $apiMessage                             = 'We Don\'t Recognize You !!!';
                }
            } else {
                $apiStatus          = FALSE;
                $apiMessage         = 'Unauthenticate Request !!!';
            }
            $this->response_to_json($apiStatus, $apiMessage, $apiResponse);
        }
        public function resendOtp(Request $request){
            $project_key        = 'facb6e0a6fcbe200dca2fb60dec75be7';
            $apiStatus          = TRUE;
            $apiMessage         = '';
            $apiResponse        = [];
            $apiExtraField      = '';
            $apiExtraData       = '';
            $this->isJSON(file_get_contents('php://input'));
            $requestData        = $this->extract_json(file_get_contents('php://input'));
            $requiredFields     = ['id'];
            $headerData         = $request->header();
            if (!$this->validateArray($requiredFields, $requestData)){
                $apiStatus          = FALSE;
                $apiMessage         = 'All Data Are Not Present !!!';
            }
            if($headerData['key'][0] == $project_key){
                $id                         = $requestData['id'];
                $checkUser                  = User::where('id', '=', $id)->first();
                if($checkUser){
                    if($checkUser->status == 'ACTIVE'){
                        // $otp        = rand(100000,999999);
                        $otp        = 123456;
                        $postData   = [
                            'remember_token'        => $otp
                        ];
                        User::where('id', '=', $checkUser->id)->update($postData);
                        $mailData                   = [
                            'id'    => $checkUser->id,
                            'email' => $checkUser->email,
                            'phone' => $checkUser->phone_number_1,
                            'otp'   => $otp,
                        ];
                        /* send email */
                            $generalSettings    = GeneralSetting::find(1);
                            $subject            = $generalSettings->site_name.' :: OTP For Signin';
                            $message            = view('email-templates.otp',$mailData);
                            // echo $message;die;
                            $this->sendMail($generalSettings->system_email, $subject, $message);
                        /* send email */
                        /* send sms */
                            $message = "Dear%20User%2C%0AOTP%20for%20logging%20in%20to%20the%20CC%26FC%20app%20is%20".$otp.".%20Valid%20for%202%20minutes.";
                            $mobileNo = (($checkUser)?$checkUser->phone_number_1:'');
                            // $mobileNo = 6289339520;
                            $this->sendSMS($mobileNo,$message);
                        /* send sms */

                        $apiResponse                        = $mailData;
                        $apiStatus                          = TRUE;
                        http_response_code(200);
                        $apiMessage                         = 'OTP Resend Successfully For Validation !!!';
                        $apiExtraField                      = 'response_code';
                        $apiExtraData                       = http_response_code();
                    } else {
                        $apiStatus                              = FALSE;
                        $apiMessage                             = 'You Account Is Not Active Yet !!!';
                    }
                } else {
                    $apiStatus                              = FALSE;
                    $apiMessage                             = 'We Don\'t Recognize You !!!';
                }
            } else {
                $apiStatus          = FALSE;
                $apiMessage         = 'Unauthenticate Request !!!';
            }
            $this->response_to_json($apiStatus, $apiMessage, $apiResponse);
        }
        public function resetPassword(Request $request){
            $project_key        = 'facb6e0a6fcbe200dca2fb60dec75be7';
            $apiStatus          = TRUE;
            $apiMessage         = '';
            $apiResponse        = [];
            $apiExtraField      = '';
            $apiExtraData       = '';
            $this->isJSON(file_get_contents('php://input'));
            $requestData        = $this->extract_json(file_get_contents('php://input'));
            $requiredFields     = ['id', 'password', 'confirm_password'];
            $headerData         = $request->header();
            if (!$this->validateArray($requiredFields, $requestData)){
                $apiStatus          = FALSE;
                $apiMessage         = 'All Data Are Not Present !!!';
            }
            if($headerData['key'][0] == $project_key){
                $id                         = $requestData['id'];
                $password                   = $requestData['password'];
                $confirm_password           = $requestData['confirm_password'];
                $checkUser                  = User::where('id', '=', $id)->first();
                if($checkUser){
                    if($checkUser->status == 'ACTIVE'){
                        if($requestData['password'] == $requestData['confirm_password']){
                            if(Hash::check($password, $checkUser->password)){
                                $apiStatus          = FALSE;
                                http_response_code(404);
                                $apiMessage         = 'Password Can\'t Be Same With Existing Password !!!';
                                $apiExtraField      = 'response_code';
                            } else {
                                $fields = [
                                    'password'            => Hash::make($password)
                                ];
                                User::where('id', '=', $id)->update($fields);
                                
                                $mailData        = [
                                    'id'                => $checkUser->id,
                                    'name'              => $checkUser->name,
                                    'email'             => $checkUser->email
                                ];
                                
                                // $subject                    = 'CCFC :: Reset Password';
                                // $message                    = view('email-template/change-password',$mailData);
                                // // echo $message;die;
                                // $this->sendMail($getUser->email, $subject, $message);
                                
                                $apiStatus                          = TRUE;
                                http_response_code(200);
                                $apiMessage                         = 'Password Reset Successfully !!!';
                                $apiExtraField                      = 'response_code';
                                $apiExtraData                       = http_response_code();
                            }
                        } else {
                            $apiStatus          = FALSE;
                            http_response_code(404);
                            $apiMessage         = 'Password & Confirm Password Not Matched !!!';
                            $apiExtraField      = 'response_code';
                        }
                    } else {
                        $apiStatus                              = FALSE;
                        $apiMessage                             = 'You Account Is Not Active Yet !!!';
                    }
                } else {
                    $apiStatus                              = FALSE;
                    $apiMessage                             = 'We Don\'t Recognize You !!!';
                }
            } else {
                $apiStatus          = FALSE;
                $apiMessage         = 'Unauthenticate Request !!!';
            }
            $this->response_to_json($apiStatus, $apiMessage, $apiResponse);
        }
    /* forgot password */
    /* after login */
        /* logout */
            public function logOut(Request $request){
                $project_key        = 'facb6e0a6fcbe200dca2fb60dec75be7';
                $apiStatus          = TRUE;
                $apiMessage         = '';
                $apiResponse        = [];
                $apiExtraField      = '';
                $apiExtraData       = '';
                $headerData         = $request->header();
                if($headerData['key'][0] == $project_key){
                    $app_access_token           = $headerData['authorization'][0];
                    $getTokenValue              = $this->tokenAuth($app_access_token);
                    if($getTokenValue['status']){
                        $uId                        = $getTokenValue['data'][1];
                        $expiry                     = date('d/m/Y H:i:s', $getTokenValue['data'][4]);
                        $checkUser                  = User::where('id', '=', $uId)->first();
                        if($checkUser){
                            if($checkUser->status == 'ACTIVE'){
                                UserDevice::where('app_access_token', '=', $app_access_token)->delete();

                                $apiStatus          = TRUE;
                                http_response_code(200);
                                $apiMessage         = 'Signout Successfully !!!';
                                $apiExtraField      = 'response_code';
                                $apiExtraData       = http_response_code();
                            } else {
                                $apiStatus                              = FALSE;
                                $apiMessage                             = 'You Account Is Not Active Yet !!!';
                            }
                        } else {
                            $apiStatus                              = FALSE;
                            $apiMessage                             = 'We Don\'t Recognize You !!!';
                        }
                    } else {
                        http_response_code($getTokenValue['data'][2]);
                        $apiStatus                      = FALSE;
                        $apiMessage                     = $this->getResponseCode(http_response_code());
                        $apiExtraField                  = 'response_code';
                        $apiExtraData                   = http_response_code();
                    }
                } else {
                    $apiStatus          = FALSE;
                    $apiMessage         = 'Unauthenticate Request !!!';
                }
                $this->response_to_json($apiStatus, $apiMessage, $apiResponse);
            }
        /* logout */
        /* dashboard */
            public function dashboard(Request $request){
                $project_key        = 'facb6e0a6fcbe200dca2fb60dec75be7';
                $apiStatus          = TRUE;
                $apiMessage         = '';
                $apiResponse        = [];
                $apiExtraField      = '';
                $apiExtraData       = '';
                $headerData         = $request->header();
                if($headerData['key'][0] == $project_key){
                    $app_access_token           = $headerData['authorization'][0];
                    $getTokenValue              = $this->tokenAuth($app_access_token);
                    if($getTokenValue['status']){
                        $uId                        = $getTokenValue['data'][1];
                        $expiry                     = date('d/m/Y H:i:s', $getTokenValue['data'][4]);
                        $checkUser                  = User::where('id', '=', $uId)->first();
                        if($checkUser){
                            if($checkUser->status == 'ACTIVE'){
                                $getUserDetail                  = UserDetail::select('member_image')->where('user_code_id', '=', $uId)->first();
                                $profileImage       = '';
                                if($getUserDetail){
                                    if($getUserDetail->member_image != ''){
                                        $profileImage       = 'data:image/png;base64,'.$getUserDetail->member_image;
                                    }
                                }
                                $apiResponse        = [
                                    'user_code'                             => $checkUser->user_code,
                                    'name'                                  => $checkUser->name,
                                    'phone'                                 => $checkUser->phone_number_1,
                                    'email'                                 => $checkUser->email,
                                    'profile_image'                         => $profileImage
                                ];
                                $apiStatus          = TRUE;
                                http_response_code(200);
                                $apiMessage         = 'Data Available !!!';
                                $apiExtraField      = 'response_code';
                                $apiExtraData       = http_response_code();
                            } else {
                                $apiStatus                              = FALSE;
                                $apiMessage                             = 'You Account Is Not Active Yet !!!';
                            }
                        } else {
                            $apiStatus                              = FALSE;
                            $apiMessage                             = 'We Don\'t Recognize You !!!';
                        }
                    } else {
                        http_response_code($getTokenValue['data'][2]);
                        $apiStatus                      = FALSE;
                        $apiMessage                     = $this->getResponseCode(http_response_code());
                        $apiExtraField                  = 'response_code';
                        $apiExtraData                   = http_response_code();
                    }
                } else {
                    $apiStatus          = FALSE;
                    $apiMessage         = 'Unauthenticate Request !!!';
                }
                $this->response_to_json($apiStatus, $apiMessage, $apiResponse);
            }
        /* dashboard */
        /* get profile */
            public function getProfile(Request $request){
                $project_key        = 'facb6e0a6fcbe200dca2fb60dec75be7';
                $apiStatus          = TRUE;
                $apiMessage         = '';
                $apiResponse        = [];
                $apiExtraField      = '';
                $apiExtraData       = '';
                $headerData         = $request->header();
                if($headerData['key'][0] == $project_key){
                    $app_access_token           = $headerData['authorization'][0];
                    $getTokenValue              = $this->tokenAuth($app_access_token);
                    if($getTokenValue['status']){
                        $uId                        = $getTokenValue['data'][1];
                        $expiry                     = date('d/m/Y H:i:s', $getTokenValue['data'][4]);
                        $checkUser                  = User::where('id', '=', $uId)->first();
                        if($checkUser){
                            if($checkUser->status == 'ACTIVE'){
                                $getUserDetail                  = UserDetail::where('user_code_id', '=', $uId)->first();
                                $profileImage       = '';
                                if($getUserDetail){
                                    if($getUserDetail->member_image != ''){
                                        $profileImage       = 'data:image/png;base64,'.$getUserDetail->member_image;
                                    }
                                }
                                $apiResponse        = [
                                    'member'        => [
                                        'user_code'                             => $checkUser->user_code,
                                        'name'                                  => $checkUser->name,
                                        'phone'                                 => $checkUser->phone_number_1,
                                        'email'                                 => $checkUser->email,
                                        'profile_image'                         => $profileImage,
                                        'member_type'                           => (($getUserDetail)?$getUserDetail->member_type:''),
                                        'date_of_birth'                         => (($getUserDetail)?date_format(date_create($getUserDetail->date_of_birth), "d-m-Y"):''),
                                        'member_since'                          => (($getUserDetail)?date_format(date_create($getUserDetail->member_since), "d-m-Y"):''),
                                        'sex'                                   => (($getUserDetail)?$getUserDetail->sex:''),
                                        'phone_1'                               => (($getUserDetail)?$getUserDetail->phone_1:''),
                                        'phone_2'                               => (($getUserDetail)?$getUserDetail->phone_2:''),
                                        'phone_3'                               => (($getUserDetail)?$getUserDetail->mobile_no:''),
                                        'address'                               => (($getUserDetail)?$getUserDetail->address_1.' '.$getUserDetail->address_2.' '.$getUserDetail->address_3:''),
                                        'city'                                  => (($getUserDetail)?$getUserDetail->city:''),
                                        'state'                                 => (($getUserDetail)?$getUserDetail->state:''),
                                        'pin'                                   => (($getUserDetail)?$getUserDetail->pin:''),
                                        'status'                                => $checkUser->status,
                                    ],
                                    'spouse'        => [
                                        'name'                                  => (($getUserDetail)?$getUserDetail->spouse_name:''),
                                        'dob'                                   => (($getUserDetail)?(($getUserDetail->spouse_dob != '')?date_format(date_create($getUserDetail->spouse_dob), "d-m-Y"):''):''),
                                        'sex'                                   => (($getUserDetail)?$getUserDetail->spouse_sex:''),
                                        'phone_1'                               => (($getUserDetail)?$getUserDetail->spouse_phone_1:''),
                                        'phone_2'                               => (($getUserDetail)?$getUserDetail->spouse_phone_2:''),
                                        'phone_3'                               => (($getUserDetail)?$getUserDetail->spouse_mobile_no:''),
                                        'email'                                 => (($getUserDetail)?$getUserDetail->spouse_email:''),
                                        'profession'                            => (($getUserDetail)?$getUserDetail->spouse_business_profession:''),
                                        'category'                              => (($getUserDetail)?$getUserDetail->spouse_business_category:''),
                                    ],
                                    'children1'     => [
                                        'name'                                  => (($getUserDetail)?$getUserDetail->children1_name:''),
                                        'dob'                                   => (($getUserDetail)?(($getUserDetail->children1_dob != '')?date_format(date_create($getUserDetail->children1_dob), "d-m-Y"):''):''),
                                        'sex'                                   => (($getUserDetail)?$getUserDetail->children1_sex:''),
                                        'phone_1'                               => (($getUserDetail)?$getUserDetail->children1_phone1:''),
                                        'phone_2'                               => (($getUserDetail)?$getUserDetail->children1_phone2:''),
                                        'phone_3'                               => (($getUserDetail)?$getUserDetail->children1_mobileno:''),
                                    ],
                                    'children2'     => [
                                        'name'                                  => (($getUserDetail)?$getUserDetail->children2_name:''),
                                        'dob'                                   => (($getUserDetail)?(($getUserDetail->children2_dob != '')?date_format(date_create($getUserDetail->children2_dob), "d-m-Y"):''):''),
                                        'sex'                                   => (($getUserDetail)?$getUserDetail->children2_sex:''),
                                        'phone_1'                               => (($getUserDetail)?$getUserDetail->children2_phone1:''),
                                        'phone_2'                               => (($getUserDetail)?$getUserDetail->children2_phone2:''),
                                        'phone_3'                               => (($getUserDetail)?$getUserDetail->children2_mobileno:''),
                                    ],
                                    'children3'     => [
                                        'name'                                  => (($getUserDetail)?$getUserDetail->children3_name:''),
                                        'dob'                                   => (($getUserDetail)?(($getUserDetail->children3_dob != '')?date_format(date_create($getUserDetail->children3_dob), "d-m-Y"):''):''),
                                        'sex'                                   => (($getUserDetail)?$getUserDetail->children3_sex:''),
                                        'phone_1'                               => (($getUserDetail)?$getUserDetail->children3_phone1:''),
                                        'phone_2'                               => (($getUserDetail)?$getUserDetail->children3_phone2:''),
                                        'phone_3'                               => (($getUserDetail)?$getUserDetail->children3_mobileno:''),
                                    ]
                                ];
                                $apiStatus          = TRUE;
                                http_response_code(200);
                                $apiMessage         = 'Data Available !!!';
                                $apiExtraField      = 'response_code';
                                $apiExtraData       = http_response_code();
                            } else {
                                $apiStatus                              = FALSE;
                                $apiMessage                             = 'You Account Is Not Active Yet !!!';
                            }
                        } else {
                            $apiStatus                              = FALSE;
                            $apiMessage                             = 'We Don\'t Recognize You !!!';
                        }
                    } else {
                        http_response_code($getTokenValue['data'][2]);
                        $apiStatus                      = FALSE;
                        $apiMessage                     = $this->getResponseCode(http_response_code());
                        $apiExtraField                  = 'response_code';
                        $apiExtraData                   = http_response_code();
                    }
                } else {
                    $apiStatus          = FALSE;
                    $apiMessage         = 'Unauthenticate Request !!!';
                }
                $this->response_to_json($apiStatus, $apiMessage, $apiResponse);
            }
        /* get profile */
        /* my card */
            public function myCard(Request $request){
                $project_key        = 'facb6e0a6fcbe200dca2fb60dec75be7';
                $apiStatus          = TRUE;
                $apiMessage         = '';
                $apiResponse        = [];
                $apiExtraField      = '';
                $apiExtraData       = '';
                $headerData         = $request->header();
                if($headerData['key'][0] == $project_key){
                    $app_access_token           = $headerData['authorization'][0];
                    $getTokenValue              = $this->tokenAuth($app_access_token);
                    if($getTokenValue['status']){
                        $uId                        = $getTokenValue['data'][1];
                        $expiry                     = date('d/m/Y H:i:s', $getTokenValue['data'][4]);
                        $checkUser                  = User::where('id', '=', $uId)->first();
                        if($checkUser){
                            if($checkUser->status == 'ACTIVE'){
                                $getUserDetail                  = UserDetail::select('member_image')->where('user_code_id', '=', $uId)->first();
                                $profileImage       = '';
                                if($getUserDetail){
                                    if($getUserDetail->member_image != ''){
                                        $profileImage       = 'data:image/png;base64,'.$getUserDetail->member_image;
                                    }
                                }

                                $options = new QROptions(
                                  [
                                    'eccLevel' => QRCode::ECC_L,
                                    'outputType' => QRCode::OUTPUT_IMAGE_PNG,
                                    'version' => 5,
                                  ]
                                );

                                $token = "5tdpn6yeoycRKbWd0311m1B5S-ZKMfU2syAD50kiquOX20GbmXF89Z1-vvsN01WTAIRWHdRESd8nRWZJrC7xuHkClh63BPg1PCpZHKpDOjmtvgJL8ErYrup7PLG2LZHkbjDh6bFb54VyUsvZm4OzzIPI9QVKhTf2ui5Pmd8CzHJZUK-4Jd-aOmQFfhuertA5KuIRrNdHTzA7w1hEYHO9Hq9J_pkME7BhNpjWp44Z3R2YeLuQbskl_rMypzLj5icdoPWgCsxA1bU9iGo5x3heaP8lHliiSx3SeeYpBMe22DRaarXJYc5pxFJ1tuEKDoxn";
                                $qrcodeFields = [
                                    'mcode'     => $checkUser->user_code
                                ];
                                $qrcodeUrl    = 'https://ccfcmemberdata.in/Api/CardInfo/POST?' . http_build_query($qrcodeFields);
                                $qrcodes      = Http::withoutVerifying()
                                            ->withHeaders(['Authorization' => 'Bearer ' . $token, 'Cache-Control' => 'no-cache', 'Accept' => '/',
                                                            'Content-Type' => 'application/json',])
                                            ->withOptions(["verify" => false])
                                            ->post($qrcodeUrl)->json()['data'];
                                $SIXTEEN_DIGIT_CODE = '';
                                if($qrcodes){
                                    $SIXTEEN_DIGIT_CODE = $qrcodes[0]['16_DIGIT_CODE'];
                                    $qrcode             = (new QRCode($options))->render($SIXTEEN_DIGIT_CODE);
                                    $qrcode_image       = $qrcode;
                                    $apiResponse        = [
                                        'user_code'                             => $checkUser->user_code,
                                        'name'                                  => $checkUser->name,
                                        'phone'                                 => $checkUser->phone_number_1,
                                        'email'                                 => $checkUser->email,
                                        '16_DIGIT_CODE'                         => $SIXTEEN_DIGIT_CODE,
                                        'qrcode_image'                          => $qrcode_image,
                                        'profile_image'                         => $profileImage
                                    ];
                                }                                
                                $apiStatus          = TRUE;
                                http_response_code(200);
                                $apiMessage         = 'Data Available !!!';
                                $apiExtraField      = 'response_code';
                                $apiExtraData       = http_response_code();
                            } else {
                                $apiStatus                              = FALSE;
                                $apiMessage                             = 'You Account Is Not Active Yet !!!';
                            }
                        } else {
                            $apiStatus                              = FALSE;
                            $apiMessage                             = 'We Don\'t Recognize You !!!';
                        }
                    } else {
                        http_response_code($getTokenValue['data'][2]);
                        $apiStatus                      = FALSE;
                        $apiMessage                     = $this->getResponseCode(http_response_code());
                        $apiExtraField                  = 'response_code';
                        $apiExtraData                   = http_response_code();
                    }
                } else {
                    $apiStatus          = FALSE;
                    $apiMessage         = 'Unauthenticate Request !!!';
                }
                $this->response_to_json($apiStatus, $apiMessage, $apiResponse);
            }
        /* my card */
        /* get contact us */
            public function getContactUs(Request $request){
                $project_key        = 'facb6e0a6fcbe200dca2fb60dec75be7';
                $apiStatus          = TRUE;
                $apiMessage         = '';
                $apiResponse        = [];
                $apiExtraField      = '';
                $apiExtraData       = '';
                $headerData         = $request->header();
                if($headerData['key'][0] == $project_key){
                    $app_access_token           = $headerData['authorization'][0];
                    $getTokenValue              = $this->tokenAuth($app_access_token);
                    if($getTokenValue['status']){
                        $uId                        = $getTokenValue['data'][1];
                        $expiry                     = date('d/m/Y H:i:s', $getTokenValue['data'][4]);
                        $checkUser                  = User::where('id', '=', $uId)->first();
                        if($checkUser){
                            if($checkUser->status == 'ACTIVE'){
                                $generalSettings    = GeneralSetting::find(1);
                                $depatments         = [];
                                $contactlists       = Contactlist::all();
                                if($contactlists){
                                    foreach($contactlists as $contactlist){
                                        $depatments[]         = [
                                            'label' => $contactlist->department_name,
                                            'value' => $contactlist->department_email . '/' . $contactlist->department_name
                                        ];
                                    }
                                }
                                $apiResponse        = [
                                    'site_name'                             => $generalSettings->site_name,
                                    'site_phone'                            => $generalSettings->site_phone,
                                    'site_mail'                             => $generalSettings->site_mail,
                                    'site_address'                          => $generalSettings->site_address,
                                    'site_timings'                          => $generalSettings->site_timings,
                                    'depatments'                            => $depatments,
                                ];
                                $apiStatus          = TRUE;
                                http_response_code(200);
                                $apiMessage         = 'Data Available !!!';
                                $apiExtraField      = 'response_code';
                                $apiExtraData       = http_response_code();
                            } else {
                                $apiStatus                              = FALSE;
                                $apiMessage                             = 'You Account Is Not Active Yet !!!';
                            }
                        } else {
                            $apiStatus                              = FALSE;
                            $apiMessage                             = 'We Don\'t Recognize You !!!';
                        }
                    } else {
                        http_response_code($getTokenValue['data'][2]);
                        $apiStatus                      = FALSE;
                        $apiMessage                     = $this->getResponseCode(http_response_code());
                        $apiExtraField                  = 'response_code';
                        $apiExtraData                   = http_response_code();
                    }
                } else {
                    $apiStatus          = FALSE;
                    $apiMessage         = 'Unauthenticate Request !!!';
                }
                $this->response_to_json($apiStatus, $apiMessage, $apiResponse);
            }
        /* get contact us */
        /* post contact us */
            public function submitContactUs(Request $request){
                $project_key        = 'facb6e0a6fcbe200dca2fb60dec75be7';
                $apiStatus          = TRUE;
                $apiMessage         = '';
                $apiResponse        = [];
                $apiExtraField      = '';
                $apiExtraData       = '';
                $this->isJSON(file_get_contents('php://input'));
                $requestData        = $this->extract_json(file_get_contents('php://input'));
                $requiredFields     = ['department', 'name', 'email', 'phone', 'message'];
                $headerData         = $request->header();
                if (!$this->validateArray($requiredFields, $requestData)){
                    $apiStatus          = FALSE;
                    $apiMessage         = 'All Data Are Not Present !!!';
                }
                if($headerData['key'][0] == $project_key){
                    $app_access_token           = $headerData['authorization'][0];
                    $getTokenValue              = $this->tokenAuth($app_access_token);

                    $department                 = $requestData['department'];
                    $name                       = $requestData['name'];
                    $postemail                  = $requestData['email'];
                    $phone                      = $requestData['phone'];
                    $subject                    = "New enquiry from the website";
                    $message                    = $requestData['message'];
                    if($getTokenValue['status']){
                        $uId                        = $getTokenValue['data'][1];
                        $expiry                     = date('d/m/Y H:i:s', $getTokenValue['data'][4]);
                        $checkUser                  = User::where('id', '=', $uId)->first();
                        if($checkUser){
                            if($checkUser->status == 'ACTIVE'){
                                $postData           = [
                                    'name'          => $name,
                                    'email'         => $postemail,
                                    'phone'         => $phone,
                                    'message'       => $message,
                                    'created_at'    => date('Y-m-d H:i:s'),
                                    'updated_at'    => date('Y-m-d H:i:s'),
                                ];
                                Contact::insert($postData);

                                /* mail send */
                                    //  Send mail to admin
                                    // \Mail::send('contactMail', array(
                                    //     'name'          => $name,
                                    //     'email'         => $postemail,
                                    //     'phone'         => $phone,
                                    //     'subject'       => $subject,
                                    //     'description'   => $message,
                                    // ), function ($message) use ($request) {
                                    //     $message->from('ccfcsecretary@ccfc1792.com');
                                    //     $departments        = [];
                                    //     $departments        = explode("/", $department);
                                    //     $senderEmail        = $departments[0];
                                    //     $senderName         = $departments[1];
                                    //     $message->to('subhomoy@keylines.net', 'Admin')->subject($subject);
                                    //     // $message->to($senderEmail, $senderName)->subject($subject);
                                    // });
                                    $departments        = explode("/", $department);
                                    $senderEmail        = $departments[0];
                                    $senderName         = $departments[1];
                                    // $this->sendMail('subhomoy@keylines.net', $senderEmail, $senderName, $subject, $message);
                                /* mail send */
                                $mailData                   = [
                                    'name'          => $name,
                                    'email'         => $postemail,
                                    'phone'         => $phone,
                                    'message'       => $message,
                                    'department'    => $senderName,
                                ];
                                /* send email */
                                    $generalSettings    = GeneralSetting::find(1);
                                    $subject            = $generalSettings->site_name.' :: Contact Enquiry';
                                    $message            = view('email-templates.contact-us',$mailData);
                                    // echo $message;die;
                                    $this->sendMail($generalSettings->system_email, $subject, $message);
                                /* send email */

                                $apiStatus          = TRUE;
                                http_response_code(200);
                                $apiMessage         = 'Contact Form Submit Successfully !!!';
                                $apiExtraField      = 'response_code';
                                $apiExtraData       = http_response_code();
                            } else {
                                $apiStatus                              = FALSE;
                                $apiMessage                             = 'You Account Is Not Active Yet !!!';
                            }
                        } else {
                            $apiStatus                              = FALSE;
                            $apiMessage                             = 'We Don\'t Recognize You !!!';
                        }
                    } else {
                        http_response_code($getTokenValue['data'][2]);
                        $apiStatus                      = FALSE;
                        $apiMessage                     = $this->getResponseCode(http_response_code());
                        $apiExtraField                  = 'response_code';
                        $apiExtraData                   = http_response_code();
                    }
                } else {
                    $apiStatus          = FALSE;
                    $apiMessage         = 'Unauthenticate Request !!!';
                }
                $this->response_to_json($apiStatus, $apiMessage, $apiResponse);
            }
        /* post contact us */
        /* whats cooking */
            public function whatsCooking(Request $request){
                $project_key        = 'facb6e0a6fcbe200dca2fb60dec75be7';
                $apiStatus          = TRUE;
                $apiMessage         = '';
                $apiResponse        = [];
                $apiExtraField      = '';
                $apiExtraData       = '';
                $this->isJSON(file_get_contents('php://input'));
                $requestData        = $this->extract_json(file_get_contents('php://input'));
                $requiredFields     = ['for_cat'];
                $headerData         = $request->header();
                if (!$this->validateArray($requiredFields, $requestData)){
                    $apiStatus          = FALSE;
                    $apiMessage         = 'All Data Are Not Present !!!';
                }
                if($headerData['key'][0] == $project_key){
                    $app_access_token           = $headerData['authorization'][0];
                    $getTokenValue              = $this->tokenAuth($app_access_token);
                    $for_cat                    = $requestData['for_cat'];
                    if($getTokenValue['status']){
                        $uId                        = $getTokenValue['data'][1];
                        $expiry                     = date('d/m/Y H:i:s', $getTokenValue['data'][4]);
                        $checkUser                  = User::where('id', '=', $uId)->first();
                        if($checkUser){
                            if($checkUser->status == 'ACTIVE'){
                                $item_complete_list  = [];
                                if($for_cat == 'CLUB KITCHEN'){
                                    $itemGroups      = DB::table('clubman_items')->select('GROUPNAME')->where('CATEGORY', '=', 'FOOD')->where('GROUPNAME', '!=', 'DON GIOVANNIE')->where('SUBGROUP', '!=', 'RESTURANT')->distinct('GROUPNAME')->orderBy('GROUPNAME', 'ASC')->get();
                                    if($itemGroups){
                                        foreach($itemGroups as $itemGroup){
                                            $SUBGROUPS          = [];
                                            $itemSubGroups      = DB::table('clubman_items')->select('SUBGROUP')->where('CATEGORY', '=', 'FOOD')->where('GROUPNAME', '=', $itemGroup->GROUPNAME)->distinct('SUBGROUP')->orderBy('SUBGROUP', 'ASC')->get();
                                            if($itemSubGroups){
                                                foreach($itemSubGroups as $itemSubGroup){
                                                    $ITEMS = [];
                                                    $items = ClubmanItem::select('ITEMNAME', 'RATE', 'TAX', 'AMOUNT')->where('CATEGORY', '=', 'FOOD')->where('GROUPNAME', '=', $itemGroup->GROUPNAME)->where('SUBGROUP', '=', $itemSubGroup->SUBGROUP)->orderBy('ITEMNAME', 'ASC')->get();
                                                    if($items){
                                                        foreach($items as $item){
                                                            $ITEMS[] = [
                                                                'ITEMNAME'  => $item->ITEMNAME,
                                                                'RATE'      => number_format((float)$item->RATE,2),
                                                                'TAX'       => number_format((float)$item->TAX,2),
                                                                'AMOUNT'    => number_format((float)$item->AMOUNT,2)
                                                            ];
                                                        }
                                                    }
                                                    $SUBGROUPS[]          = [
                                                        'SUBGROUP'  => $itemSubGroup->SUBGROUP,
                                                        'ITEMS'     => $ITEMS
                                                    ];
                                                }
                                            }
                                            $item_complete_list[]        = [
                                                'GROUPNAME' => $itemGroup->GROUPNAME,
                                                'SUBGROUP'  => $SUBGROUPS
                                            ];
                                        }
                                    }
                                } elseif($for_cat == 'RESTAURANT'){
                                    $itemGroups      = DB::table('clubman_items')->select('GROUPNAME')->where('CATEGORY', '=', 'FOOD')->where('SUBGROUP', '=', 'RESTURANT')->distinct('GROUPNAME')->orderBy('GROUPNAME', 'ASC')->get();
                                    if($itemGroups){
                                        foreach($itemGroups as $itemGroup){
                                            $SUBGROUPS          = [];
                                            $itemSubGroups      = DB::table('clubman_items')->select('SUBGROUP')->where('CATEGORY', '=', 'FOOD')->where('GROUPNAME', '=', $itemGroup->GROUPNAME)->distinct('SUBGROUP')->orderBy('SUBGROUP', 'ASC')->get();
                                            if($itemSubGroups){
                                                foreach($itemSubGroups as $itemSubGroup){
                                                    $ITEMS = [];
                                                    $items = ClubmanItem::select('ITEMNAME', 'RATE', 'TAX', 'AMOUNT')->where('CATEGORY', '=', 'FOOD')->where('GROUPNAME', '=', $itemGroup->GROUPNAME)->where('SUBGROUP', '=', $itemSubGroup->SUBGROUP)->orderBy('ITEMNAME', 'ASC')->get();
                                                    if($items){
                                                        foreach($items as $item){
                                                            $ITEMS[] = [
                                                                'ITEMNAME'  => $item->ITEMNAME,
                                                                'RATE'      => number_format((float)$item->RATE,2),
                                                                'TAX'       => number_format((float)$item->TAX,2),
                                                                'AMOUNT'    => number_format((float)$item->AMOUNT,2)
                                                            ];
                                                        }
                                                    }
                                                    $SUBGROUPS[]          = [
                                                        'SUBGROUP'  => $itemSubGroup->SUBGROUP,
                                                        'ITEMS'     => $ITEMS
                                                    ];
                                                }
                                            }
                                            $item_complete_list[]        = [
                                                'GROUPNAME' => $itemGroup->GROUPNAME,
                                                'SUBGROUP'  => $SUBGROUPS
                                            ];
                                        }
                                    }
                                } elseif($for_cat == 'BEVERAGE'){
                                    $itemGroups      = DB::table('clubman_items')->select('GROUPNAME')->where('CATEGORY', '=', 'BEVERAGE')->distinct('GROUPNAME')->orderBy('GROUPNAME', 'ASC')->get();
                                    if($itemGroups){
                                        foreach($itemGroups as $itemGroup){
                                            $SUBGROUPS          = [];
                                            $itemSubGroups      = DB::table('clubman_items')->select('SUBGROUP')->where('CATEGORY', '=', 'BEVERAGE')->where('GROUPNAME', '=', $itemGroup->GROUPNAME)->distinct('SUBGROUP')->orderBy('SUBGROUP', 'ASC')->get();
                                            if($itemSubGroups){
                                                foreach($itemSubGroups as $itemSubGroup){
                                                    $ITEMS = [];
                                                    $items = ClubmanItem::select('ITEMNAME', 'RATE', 'TAX', 'AMOUNT')->where('CATEGORY', '=', 'BEVERAGE')->where('GROUPNAME', '=', $itemGroup->GROUPNAME)->where('SUBGROUP', '=', $itemSubGroup->SUBGROUP)->orderBy('ITEMNAME', 'ASC')->get();
                                                    if($items){
                                                        foreach($items as $item){
                                                            $ITEMS[] = [
                                                                'ITEMNAME'  => $item->ITEMNAME,
                                                                'RATE'      => number_format((float)$item->RATE,2),
                                                                'TAX'       => number_format((float)$item->TAX,2),
                                                                'AMOUNT'    => number_format((float)$item->AMOUNT,2)
                                                            ];
                                                        }
                                                    }
                                                    $SUBGROUPS[]          = [
                                                        'SUBGROUP'  => $itemSubGroup->SUBGROUP,
                                                        'ITEMS'     => $ITEMS
                                                    ];
                                                }
                                            }
                                            $item_complete_list[]        = [
                                                'GROUPNAME' => $itemGroup->GROUPNAME,
                                                'SUBGROUP'  => $SUBGROUPS
                                            ];
                                        }
                                    }
                                } elseif($for_cat == 'OTHER FOOD'){
                                    $currentDate        = date('Y-m-d');
                                    $otherFoodItems         = OtherFoodItem::select('name', 'food_image')->where('status', '=', 1)->where('validity', '>=', $currentDate)->orderBy('id', 'DESC')->get();
                                    if($otherFoodItems){
                                        foreach($otherFoodItems as $otherFoodItem){
                                            $item_complete_list[]        = [
                                                'name'          => $otherFoodItem->name,
                                                'food_image'    => env('UPLOADS_URL').$otherFoodItem->food_image
                                            ];
                                        }
                                    }
                                }
                                $apiResponse        = $item_complete_list;
                                $apiStatus          = TRUE;
                                http_response_code(200);
                                $apiMessage         = 'Data Available !!!';
                                $apiExtraField      = 'response_code';
                                $apiExtraData       = http_response_code();
                            } else {
                                $apiStatus                              = FALSE;
                                $apiMessage                             = 'You Account Is Not Active Yet !!!';
                            }
                        } else {
                            $apiStatus                              = FALSE;
                            $apiMessage                             = 'We Don\'t Recognize You !!!';
                        }
                    } else {
                        http_response_code($getTokenValue['data'][2]);
                        $apiStatus                      = FALSE;
                        $apiMessage                     = $this->getResponseCode(http_response_code());
                        $apiExtraField                  = 'response_code';
                        $apiExtraData                   = http_response_code();
                    }
                } else {
                    $apiStatus          = FALSE;
                    $apiMessage         = 'Unauthenticate Request !!!';
                }
                $this->response_to_json($apiStatus, $apiMessage, $apiResponse);
            }
        /* whats cooking */
        /* static pages */
            public function staticPages(Request $request){
                $project_key        = 'facb6e0a6fcbe200dca2fb60dec75be7';
                $apiStatus          = TRUE;
                $apiMessage         = '';
                $apiResponse        = [];
                $apiExtraField      = '';
                $apiExtraData       = '';
                $this->isJSON(file_get_contents('php://input'));
                $requestData        = $this->extract_json(file_get_contents('php://input'));
                $requiredFields     = ['page_slug'];
                $headerData         = $request->header();
                if (!$this->validateArray($requiredFields, $requestData)){
                    $apiStatus          = FALSE;
                    $apiMessage         = 'All Data Are Not Present !!!';
                }
                if($headerData['key'][0] == $project_key){
                    $app_access_token           = $headerData['authorization'][0];
                    $getTokenValue              = $this->tokenAuth($app_access_token);

                    $page_slug                    = $requestData['page_slug'];
                    if($getTokenValue['status']){
                        $uId                        = $getTokenValue['data'][1];
                        $expiry                     = date('d/m/Y H:i:s', $getTokenValue['data'][4]);
                        $checkUser                  = User::where('id', '=', $uId)->first();
                        if($checkUser){
                            if($checkUser->status == 'ACTIVE'){

                                $staticPage       = DB::table('content_category_content_page')
                                                ->select('content_categories.name as category_name', 'content_pages.title', 'content_pages.page_text')
                                                ->join('content_categories','content_categories.id','=','content_category_content_page.content_category_id')
                                                ->join('content_pages','content_pages.id','=','content_category_content_page.content_page_id')
                                                ->where(['content_categories.slug' => $page_slug])
                                                ->first();
                                if($staticPage){
                                    $apiResponse    = [
                                        'category_name' => $staticPage->category_name,
                                        'title'         => $staticPage->title,
                                        'page_text'     => $staticPage->page_text,
                                    ];
                                }
                                
                                $apiStatus          = TRUE;
                                http_response_code(200);
                                $apiMessage         = 'Data Available !!!';
                                $apiExtraField      = 'response_code';
                                $apiExtraData       = http_response_code();
                            } else {
                                $apiStatus                              = FALSE;
                                $apiMessage                             = 'You Account Is Not Active Yet !!!';
                            }
                        } else {
                            $apiStatus                              = FALSE;
                            $apiMessage                             = 'We Don\'t Recognize You !!!';
                        }
                    } else {
                        http_response_code($getTokenValue['data'][2]);
                        $apiStatus                      = FALSE;
                        $apiMessage                     = $this->getResponseCode(http_response_code());
                        $apiExtraField                  = 'response_code';
                        $apiExtraData                   = http_response_code();
                    }
                } else {
                    $apiStatus          = FALSE;
                    $apiMessage         = 'Unauthenticate Request !!!';
                }
                $this->response_to_json($apiStatus, $apiMessage, $apiResponse);
            }
        /* static pages */
        /* change password */
            public function changePassword(Request $request){
                $project_key        = 'facb6e0a6fcbe200dca2fb60dec75be7';
                $apiStatus          = TRUE;
                $apiMessage         = '';
                $apiResponse        = [];
                $apiExtraField      = '';
                $apiExtraData       = '';
                $this->isJSON(file_get_contents('php://input'));
                $requestData        = $this->extract_json(file_get_contents('php://input'));
                $requiredFields     = ['old_password', 'new_password', 'confirm_password'];
                $headerData         = $request->header();
                if (!$this->validateArray($requiredFields, $requestData)){
                    $apiStatus          = FALSE;
                    $apiMessage         = 'All Data Are Not Present !!!';
                }
                if($headerData['key'][0] == $project_key){
                    $app_access_token           = $headerData['authorization'][0];
                    $getTokenValue              = $this->tokenAuth($app_access_token);

                    $old_password                    = $requestData['old_password'];
                    $new_password                    = $requestData['new_password'];
                    $confirm_password                = $requestData['confirm_password'];
                    if($getTokenValue['status']){
                        $uId                        = $getTokenValue['data'][1];
                        $expiry                     = date('d/m/Y H:i:s', $getTokenValue['data'][4]);
                        $checkUser                  = User::where('id', '=', $uId)->first();
                        if($checkUser){
                            if($checkUser->status == 'ACTIVE'){
                                if($new_password == $confirm_password){
                                    if(Hash::check($old_password, $checkUser->password)){
                                        if($old_password != $new_password){
                                            $fields = [
                                                'password'            => Hash::make($new_password)
                                            ];
                                            User::where('id', '=', $uId)->update($fields);

                                            $apiStatus          = TRUE;
                                            http_response_code(200);
                                            $apiMessage         = 'Password Updated Successfully !!!';
                                            $apiExtraField      = 'response_code';
                                            $apiExtraData       = http_response_code();
                                        } else {
                                            $apiStatus                              = FALSE;
                                            $apiMessage                             = 'New Password Can\'t Be Same With Existing Password !!!';
                                        }
                                    } else {
                                        $apiStatus                              = FALSE;
                                        $apiMessage                             = 'Old Password Is Incorrect !!!';
                                    }
                                } else {
                                    $apiStatus                              = FALSE;
                                    $apiMessage                             = 'New & Confirm Password Does Not Matched !!!';
                                }
                            } else {
                                $apiStatus                              = FALSE;
                                $apiMessage                             = 'You Account Is Not Active Yet !!!';
                            }
                        } else {
                            $apiStatus                              = FALSE;
                            $apiMessage                             = 'We Don\'t Recognize You !!!';
                        }
                    } else {
                        http_response_code($getTokenValue['data'][2]);
                        $apiStatus                      = FALSE;
                        $apiMessage                     = $this->getResponseCode(http_response_code());
                        $apiExtraField                  = 'response_code';
                        $apiExtraData                   = http_response_code();
                    }
                } else {
                    $apiStatus          = FALSE;
                    $apiMessage         = 'Unauthenticate Request !!!';
                }
                $this->response_to_json($apiStatus, $apiMessage, $apiResponse);
            }
        /* change password */
        /* delete account */
            public function deleteAccount(Request $request){
                $project_key        = 'facb6e0a6fcbe200dca2fb60dec75be7';
                $apiStatus          = TRUE;
                $apiMessage         = '';
                $apiResponse        = [];
                $apiExtraField      = '';
                $apiExtraData       = '';
                $headerData         = $request->header();
                if($headerData['key'][0] == $project_key){
                    $app_access_token           = $headerData['authorization'][0];
                    $getTokenValue              = $this->tokenAuth($app_access_token);
                    if($getTokenValue['status']){
                        $uId                        = $getTokenValue['data'][1];
                        $expiry                     = date('d/m/Y H:i:s', $getTokenValue['data'][4]);
                        $checkUser                  = User::where('id', '=', $uId)->first();
                        if($checkUser){
                            if($checkUser->status == 'ACTIVE'){
                                $postData = [
                                    'user_type'             => 'user',
                                    'entity_name'           => $checkUser->name,
                                    'email'                 => $checkUser->email,
                                    'is_email_verify'       => 1,
                                    'phone'                 => $checkUser->phone_number_1,
                                    'is_phone_verify'       => 1,
                                    'comments'              => "",
                                ];
                                DeleteAccountRequest::insert($postData);

                                $apiStatus          = TRUE;
                                http_response_code(200);
                                $apiMessage         = 'Delete Account Request Submitted Successfully. Wait For Admin Approval !!!';
                                $apiExtraField      = 'response_code';
                                $apiExtraData       = http_response_code();
                            } else {
                                $apiStatus                              = FALSE;
                                $apiMessage                             = 'You Account Is Not Active Yet !!!';
                            }
                        } else {
                            $apiStatus                              = FALSE;
                            $apiMessage                             = 'We Don\'t Recognize You !!!';
                        }
                    } else {
                        http_response_code($getTokenValue['data'][2]);
                        $apiStatus                      = FALSE;
                        $apiMessage                     = $this->getResponseCode(http_response_code());
                        $apiExtraField                  = 'response_code';
                        $apiExtraData                   = http_response_code();
                    }
                } else {
                    $apiStatus          = FALSE;
                    $apiMessage         = 'Unauthenticate Request !!!';
                }
                $this->response_to_json($apiStatus, $apiMessage, $apiResponse);
            }
        /* delete account */
        /* facility */
            public function spaBooking(Request $request){
                $project_key        = 'facb6e0a6fcbe200dca2fb60dec75be7';
                $apiStatus          = TRUE;
                $apiMessage         = '';
                $apiResponse        = [];
                $apiExtraField      = '';
                $apiExtraData       = '';
                $headerData         = $request->header();
                if($headerData['key'][0] == $project_key){
                    $app_access_token           = $headerData['authorization'][0];
                    $getTokenValue              = $this->tokenAuth($app_access_token);
                    if($getTokenValue['status']){
                        $uId                        = $getTokenValue['data'][1];
                        $expiry                     = date('d/m/Y H:i:s', $getTokenValue['data'][4]);
                        $checkUser                  = User::where('id', '=', $uId)->first();
                        if($checkUser){
                            if($checkUser->status == 'ACTIVE'){
                                $generalSettings    = GeneralSetting::find(1);
                                $staticPage         = DB::table('content_category_content_page')
                                                ->select('content_categories.name as category_name', 'content_pages.title', 'content_pages.page_text')
                                                ->join('content_categories','content_categories.id','=','content_category_content_page.content_category_id')
                                                ->join('content_pages','content_pages.id','=','content_category_content_page.content_page_id')
                                                ->where(['content_categories.slug' => 'day spa'])
                                                ->first();
                                if($staticPage){
                                    $apiResponse    = [
                                        'category_name'     => $staticPage->category_name,
                                        'title'             => $staticPage->title,
                                        'page_text'         => $staticPage->page_text,
                                        'spa_booking'       => [
                                            'days'      => $generalSettings->spa_booking_days,
                                            'timings'   => $generalSettings->spa_booking_timings,
                                            'phone'     => $generalSettings->spa_booking_phone,
                                        ]
                                    ];
                                }

                                $apiStatus          = TRUE;
                                http_response_code(200);
                                $apiMessage         = 'Data Available !!!';
                                $apiExtraField      = 'response_code';
                                $apiExtraData       = http_response_code();
                            } else {
                                $apiStatus                              = FALSE;
                                $apiMessage                             = 'You Account Is Not Active Yet !!!';
                            }
                        } else {
                            $apiStatus                              = FALSE;
                            $apiMessage                             = 'We Don\'t Recognize You !!!';
                        }
                    } else {
                        http_response_code($getTokenValue['data'][2]);
                        $apiStatus                      = FALSE;
                        $apiMessage                     = $this->getResponseCode(http_response_code());
                        $apiExtraField                  = 'response_code';
                        $apiExtraData                   = http_response_code();
                    }
                } else {
                    $apiStatus          = FALSE;
                    $apiMessage         = 'Unauthenticate Request !!!';
                }
                $this->response_to_json($apiStatus, $apiMessage, $apiResponse);
            }
            public function facility(Request $request){
                $project_key        = 'facb6e0a6fcbe200dca2fb60dec75be7';
                $apiStatus          = TRUE;
                $apiMessage         = '';
                $apiResponse        = [];
                $apiExtraField      = '';
                $apiExtraData       = '';
                $this->isJSON(file_get_contents('php://input'));
                $requestData        = $this->extract_json(file_get_contents('php://input'));
                $requiredFields     = ['facility_type'];
                $headerData         = $request->header();
                if (!$this->validateArray($requiredFields, $requestData)){
                    $apiStatus          = FALSE;
                    $apiMessage         = 'All Data Are Not Present !!!';
                }
                if($headerData['key'][0] == $project_key){
                    $app_access_token               = $headerData['authorization'][0];
                    $getTokenValue                  = $this->tokenAuth($app_access_token);
                    $facility_type                  = $requestData['facility_type'];
                    // Helper::pr($requestData);
                    if($getTokenValue['status']){
                        $uId                        = $getTokenValue['data'][1];
                        $expiry                     = date('d/m/Y H:i:s', $getTokenValue['data'][4]);
                        $checkUser                  = User::where('id', '=', $uId)->first();
                        if($checkUser){
                            if($checkUser->status == 'ACTIVE'){
                                $generalSettings    = GeneralSetting::find(1);

                                if($facility_type == 'SPA'){
                                    $staticPage         = DB::table('content_category_content_page')
                                                    ->select('content_categories.name as category_name', 'content_pages.title', 'content_pages.page_text')
                                                    ->join('content_categories','content_categories.id','=','content_category_content_page.content_category_id')
                                                    ->join('content_pages','content_pages.id','=','content_category_content_page.content_page_id')
                                                    ->where(['content_categories.slug' => 'day spa'])
                                                    ->first();

                                    if($staticPage){
                                        $gallery        = Gallery::find(39);
                                        $sideImages     = [];
                                        if($gallery){
                                            $model_id = $gallery->id;
                                            $getImages = DB::table('media')->select('id', 'file_name')->where(['model_id' => $model_id, 'model_type' => 'App\Models\Gallery'])->get();
                                            if($getImages){
                                                foreach($getImages as $getImage){
                                                    $sideImages[]     = url('/storage/'.$getImage->id.'/'.$getImage->file_name);
                                                }
                                            }
                                        }
                                        $apiResponse    = [
                                            'category_name'     => $staticPage->category_name,
                                            'title'             => $staticPage->title,
                                            'page_text'         => $staticPage->page_text,
                                            'is_call_button'    => 1,
                                            'side_images'       => $sideImages,
                                            'booking'           => [
                                                'days'              => $generalSettings->spa_booking_days,
                                                'timings'           => $generalSettings->spa_booking_timings,
                                                'phone1'            => $generalSettings->spa_booking_phone,
                                                'phone2'            => '',
                                            ]
                                        ];
                                    }
                                } elseif($facility_type == 'GYM'){
                                    $staticPage         = DB::table('content_category_content_page')
                                                    ->select('content_categories.name as category_name', 'content_pages.title', 'content_pages.page_text')
                                                    ->join('content_categories','content_categories.id','=','content_category_content_page.content_category_id')
                                                    ->join('content_pages','content_pages.id','=','content_category_content_page.content_page_id')
                                                    ->where(['content_categories.slug' => 'gymming rejuvenated'])
                                                    ->first();
                                    $contentBlock    = ContentBlock::find(4);
                                    if($staticPage){
                                        $gallery        = Gallery::find(9);
                                        $sideImages     = [];
                                        if($gallery){
                                            $model_id = $gallery->id;
                                            $getImages = DB::table('media')->select('id', 'file_name')->where(['model_id' => $model_id, 'model_type' => 'App\Models\Gallery'])->get();
                                            if($getImages){
                                                foreach($getImages as $getImage){
                                                    $sideImages[]     = url('/storage/'.$getImage->id.'/'.$getImage->file_name);
                                                }
                                            }
                                        }
                                        $apiResponse    = [
                                            'category_name'     => $staticPage->category_name,
                                            'title'             => $staticPage->title,
                                            'page_text'         => $staticPage->page_text,
                                            'is_call_button'    => 1,
                                            'side_images'       => $sideImages,
                                            'booking'           => [
                                                'timings'           => (($contentBlock)?$contentBlock->body:''),
                                                'phone1'            => $generalSettings->gym_booking_phone1,
                                                'phone2'            => $generalSettings->gym_booking_phone2,
                                            ]
                                        ];
                                    }
                                } elseif($facility_type == 'SWIMMING'){
                                    $staticPage         = DB::table('content_category_content_page')
                                                    ->select('content_categories.name as category_name', 'content_pages.title', 'content_pages.page_text')
                                                    ->join('content_categories','content_categories.id','=','content_category_content_page.content_category_id')
                                                    ->join('content_pages','content_pages.id','=','content_category_content_page.content_page_id')
                                                    ->where(['content_categories.slug' => 'swimming pool'])
                                                    ->first();
                                    $contentBlock    = ContentBlock::find(7);
                                    if($staticPage){
                                        $gallery        = Gallery::find(12);
                                        $sideImages     = [];
                                        if($gallery){
                                            $model_id = $gallery->id;
                                            $getImages = DB::table('media')->select('id', 'file_name')->where(['model_id' => $model_id, 'model_type' => 'App\Models\Gallery'])->get();
                                            if($getImages){
                                                foreach($getImages as $getImage){
                                                    $sideImages[]     = url('/storage/'.$getImage->id.'/'.$getImage->file_name);
                                                }
                                            }
                                        }
                                        $apiResponse    = [
                                            'category_name'     => $staticPage->category_name,
                                            'title'             => $staticPage->title,
                                            'page_text'         => $staticPage->page_text,
                                            'is_call_button'    => 0,
                                            'side_images'       => $sideImages,
                                            'booking'           => [
                                                'timings'           => (($contentBlock)?$contentBlock->body:''),
                                                'phone1'            => '',
                                                'phone2'            => '',
                                            ]
                                        ];
                                    }
                                } elseif($facility_type == 'TENNIS'){
                                    $staticPage         = DB::table('content_category_content_page')
                                                    ->select('content_categories.name as category_name', 'content_pages.title', 'content_pages.page_text')
                                                    ->join('content_categories','content_categories.id','=','content_category_content_page.content_category_id')
                                                    ->join('content_pages','content_pages.id','=','content_category_content_page.content_page_id')
                                                    ->where(['content_categories.slug' => 'tennis'])
                                                    ->first();
                                    $contentBlock    = ContentBlock::find(8);
                                    if($staticPage){
                                        $gallery        = Gallery::find(12);
                                        $sideImages     = [];
                                        if($gallery){
                                            $model_id = $gallery->id;
                                            $getImages = DB::table('media')->select('id', 'file_name')->where(['model_id' => $model_id, 'model_type' => 'App\Models\Gallery'])->get();
                                            if($getImages){
                                                foreach($getImages as $getImage){
                                                    $sideImages[]     = url('/storage/'.$getImage->id.'/'.$getImage->file_name);
                                                }
                                            }
                                        }
                                        $apiResponse    = [
                                            'category_name'     => $staticPage->category_name,
                                            'title'             => $staticPage->title,
                                            'page_text'         => $staticPage->page_text,
                                            'is_call_button'    => 0,
                                            'side_images'       => $sideImages,
                                            'booking'           => [
                                                'timings'           => (($contentBlock)?$contentBlock->body:''),
                                                'phone1'            => '',
                                                'phone2'            => '',
                                            ]
                                        ];
                                    }
                                }

                                $apiStatus          = TRUE;
                                http_response_code(200);
                                $apiMessage         = 'Data Available !!!';
                                $apiExtraField      = 'response_code';
                                $apiExtraData       = http_response_code();
                            } else {
                                $apiStatus                              = FALSE;
                                $apiMessage                             = 'You Account Is Not Active Yet !!!';
                            }
                        } else {
                            $apiStatus                              = FALSE;
                            $apiMessage                             = 'We Don\'t Recognize You !!!';
                        }
                    } else {
                        http_response_code($getTokenValue['data'][2]);
                        $apiStatus                      = FALSE;
                        $apiMessage                     = $this->getResponseCode(http_response_code());
                        $apiExtraField                  = 'response_code';
                        $apiExtraData                   = http_response_code();
                    }
                } else {
                    $apiStatus          = FALSE;
                    $apiMessage         = 'Unauthenticate Request !!!';
                }
                $this->response_to_json($apiStatus, $apiMessage, $apiResponse);
            }
        /* facility */
        /* spa booking tracking */
            public function spaBookingTracking(Request $request){
                $project_key        = 'facb6e0a6fcbe200dca2fb60dec75be7';
                $apiStatus          = TRUE;
                $apiMessage         = '';
                $apiResponse        = [];
                $apiExtraField      = '';
                $apiExtraData       = '';
                $headerData         = $request->header();
                if($headerData['key'][0] == $project_key){
                    $app_access_token           = $headerData['authorization'][0];
                    $getTokenValue              = $this->tokenAuth($app_access_token);
                    if($getTokenValue['status']){
                        $uId                        = $getTokenValue['data'][1];
                        $expiry                     = date('d/m/Y H:i:s', $getTokenValue['data'][4]);
                        $checkUser                  = User::where('id', '=', $uId)->first();
                        if($checkUser){
                            if($checkUser->status == 'ACTIVE'){
                                $postData = [
                                    'user_id'       => $checkUser->id,
                                    'member_code'   => $checkUser->user_code,
                                    'name'          => $checkUser->name,
                                    'email'         => $checkUser->email,
                                    'phone'         => $checkUser->phone_number_1
                                ];
                                SpaBookingTracking::insert($postData);
                                
                                $apiStatus          = TRUE;
                                http_response_code(200);
                                $apiMessage         = 'Spa Booking Activity Submitted !!!';
                                $apiExtraField      = 'response_code';
                                $apiExtraData       = http_response_code();
                            } else {
                                $apiStatus                              = FALSE;
                                $apiMessage                             = 'You Account Is Not Active Yet !!!';
                            }
                        } else {
                            $apiStatus                              = FALSE;
                            $apiMessage                             = 'We Don\'t Recognize You !!!';
                        }
                    } else {
                        http_response_code($getTokenValue['data'][2]);
                        $apiStatus                      = FALSE;
                        $apiMessage                     = $this->getResponseCode(http_response_code());
                        $apiExtraField                  = 'response_code';
                        $apiExtraData                   = http_response_code();
                    }
                } else {
                    $apiStatus          = FALSE;
                    $apiMessage         = 'Unauthenticate Request !!!';
                }
                $this->response_to_json($apiStatus, $apiMessage, $apiResponse);
            }
        /* spa booking tracking */
        /* day special */
            public function daySpecial(Request $request){
                $project_key        = 'facb6e0a6fcbe200dca2fb60dec75be7';
                $apiStatus          = TRUE;
                $apiMessage         = '';
                $apiResponse        = [];
                $apiExtraField      = '';
                $apiExtraData       = '';
                $this->isJSON(file_get_contents('php://input'));
                $requestData        = $this->extract_json(file_get_contents('php://input'));
                $requiredFields     = ['menu_date'];
                $headerData         = $request->header();
                if (!$this->validateArray($requiredFields, $requestData)){
                    $apiStatus          = FALSE;
                    $apiMessage         = 'All Data Are Not Present !!!';
                }
                if($headerData['key'][0] == $project_key){
                    $app_access_token           = $headerData['authorization'][0];
                    $getTokenValue              = $this->tokenAuth($app_access_token);

                    $menu_date                    = $requestData['menu_date'];
                    if($getTokenValue['status']){
                        $uId                        = $getTokenValue['data'][1];
                        $expiry                     = date('d/m/Y H:i:s', $getTokenValue['data'][4]);
                        $checkUser                  = User::where('id', '=', $uId)->first();
                        if($checkUser){
                            if($checkUser->status == 'ACTIVE'){
                                $getCookingDaySpecialMenus = CookingDaySpecial::where('status', '=', 1)->where('menu_date', '=', $menu_date)->get();
                                if($getCookingDaySpecialMenus){
                                    foreach($getCookingDaySpecialMenus as $getCookingDaySpecialMenu){
                                        $apiResponse[] = env('UPLOADS_URL').$getCookingDaySpecialMenu->image_name;
                                    }
                                }
                                $apiStatus          = TRUE;
                                http_response_code(200);
                                $apiMessage         = 'Data Available !!!';
                                $apiExtraField      = 'response_code';
                                $apiExtraData       = http_response_code();
                            } else {
                                $apiStatus                              = FALSE;
                                $apiMessage                             = 'You Account Is Not Active Yet !!!';
                            }
                        } else {
                            $apiStatus                              = FALSE;
                            $apiMessage                             = 'We Don\'t Recognize You !!!';
                        }
                    } else {
                        http_response_code($getTokenValue['data'][2]);
                        $apiStatus                      = FALSE;
                        $apiMessage                     = $this->getResponseCode(http_response_code());
                        $apiExtraField                  = 'response_code';
                        $apiExtraData                   = http_response_code();
                    }
                } else {
                    $apiStatus          = FALSE;
                    $apiMessage         = 'Unauthenticate Request !!!';
                }
                $this->response_to_json($apiStatus, $apiMessage, $apiResponse);
            }
        /* day special */
        /* club updates */
            public function clubUpdates(Request $request){
                $project_key        = 'facb6e0a6fcbe200dca2fb60dec75be7';
                $apiStatus          = TRUE;
                $apiMessage         = '';
                $apiResponse        = [];
                $apiExtraField      = '';
                $apiExtraData       = '';
                // $this->isJSON(file_get_contents('php://input'));
                // $requestData        = $this->extract_json(file_get_contents('php://input'));
                // $requiredFields     = ['menu_date'];
                $headerData         = $request->header();
                // if (!$this->validateArray($requiredFields, $requestData)){
                //     $apiStatus          = FALSE;
                //     $apiMessage         = 'All Data Are Not Present !!!';
                // }
                if($headerData['key'][0] == $project_key){
                    $app_access_token           = $headerData['authorization'][0];
                    $getTokenValue              = $this->tokenAuth($app_access_token);
                    if($getTokenValue['status']){
                        $uId                        = $getTokenValue['data'][1];
                        $expiry                     = date('d/m/Y H:i:s', $getTokenValue['data'][4]);
                        $checkUser                  = User::where('id', '=', $uId)->first();
                        if($checkUser){
                            if($checkUser->status == 'ACTIVE'){
                                $currentDate        = date('Y-m-d');
                                $events             = Events::where('validity', '>=', $currentDate)->orderBy('id', 'DESC')->get();
                                if($events){
                                    foreach($events as $event){
                                        $apiResponse[] = [
                                            'title'                 => $event->event_name,
                                            'details_1'             => $event->details_1,
                                            'details_2'             => $event->details_2,
                                            'day'                   => $event->day,
                                            'month'                 => $event->month,
                                            'event_image'           => env('UPLOADS_URL').'enentimg/'.$event->event_image,
                                            'event_image_2'         => env('UPLOADS_URL').'enentimg/'.$event->event_image_2,
                                            'posted_by'             => 'CCFC',
                                        ];
                                    }
                                }
                                $apiStatus          = TRUE;
                                http_response_code(200);
                                $apiMessage         = 'Data Available !!!';
                                $apiExtraField      = 'response_code';
                                $apiExtraData       = http_response_code();
                            } else {
                                $apiStatus                              = FALSE;
                                $apiMessage                             = 'You Account Is Not Active Yet !!!';
                            }
                        } else {
                            $apiStatus                              = FALSE;
                            $apiMessage                             = 'We Don\'t Recognize You !!!';
                        }
                    } else {
                        http_response_code($getTokenValue['data'][2]);
                        $apiStatus                      = FALSE;
                        $apiMessage                     = $this->getResponseCode(http_response_code());
                        $apiExtraField                  = 'response_code';
                        $apiExtraData                   = http_response_code();
                    }
                } else {
                    $apiStatus          = FALSE;
                    $apiMessage         = 'Unauthenticate Request !!!';
                }
                $this->response_to_json($apiStatus, $apiMessage, $apiResponse);
            }
        /* club updates */
        /* must read */
            public function mustRead(Request $request){
                $project_key        = 'facb6e0a6fcbe200dca2fb60dec75be7';
                $apiStatus          = TRUE;
                $apiMessage         = '';
                $apiResponse        = [];
                $apiExtraField      = '';
                $apiExtraData       = '';
                // $this->isJSON(file_get_contents('php://input'));
                // $requestData        = $this->extract_json(file_get_contents('php://input'));
                // $requiredFields     = ['menu_date'];
                $headerData         = $request->header();
                // if (!$this->validateArray($requiredFields, $requestData)){
                //     $apiStatus          = FALSE;
                //     $apiMessage         = 'All Data Are Not Present !!!';
                // }
                if($headerData['key'][0] == $project_key){
                    $app_access_token           = $headerData['authorization'][0];
                    $getTokenValue              = $this->tokenAuth($app_access_token);
                    if($getTokenValue['status']){
                        $uId                        = $getTokenValue['data'][1];
                        $expiry                     = date('d/m/Y H:i:s', $getTokenValue['data'][4]);
                        $checkUser                  = User::where('id', '=', $uId)->first();
                        if($checkUser){
                            if($checkUser->status == 'ACTIVE'){
                                $circulars          = [];
                                $ruleRegulation     = [];
                                /* circulars */
                                    $currentDate        = date('Y-m-d');
                                    $notices            = circular::where('validity', '>=', $currentDate)->orderBy('id', 'DESC')->get();
                                    if($notices){
                                        foreach($notices as $notice){
                                            $circulars[] = [
                                                'title'                 => 'CIRCULAR',
                                                'details_1'             => $notice->details_1,
                                                'day'                   => $notice->day,
                                                'month'                 => $notice->month,
                                                'circular_image'        => env('UPLOADS_URL').'circularimg/'.$notice->circular_image,
                                                'posted_by'             => 'CCFC',
                                            ];
                                        }
                                    }
                                /* circulars */
                                /* rules & regulations */
                                    $page_slug          = 'Rules regulation';
                                    $staticPage         = DB::table('content_category_content_page')
                                                    ->select('content_categories.name as category_name', 'content_pages.title', 'content_pages.page_text')
                                                    ->join('content_categories','content_categories.id','=','content_category_content_page.content_category_id')
                                                    ->join('content_pages','content_pages.id','=','content_category_content_page.content_page_id')
                                                    ->where(['content_categories.slug' => $page_slug])
                                                    ->first();
                                    if($staticPage){
                                        $ruleRegulation    = [
                                            'category_name' => $staticPage->category_name,
                                            'title'         => $staticPage->title,
                                            'page_text'     => $staticPage->page_text,
                                        ];
                                    }
                                /* rules & regulations */

                                $apiResponse        = [
                                    'circulars'         => $circulars,
                                    'ruleRegulation'    => $ruleRegulation,
                                ];
                                $apiStatus          = TRUE;
                                http_response_code(200);
                                $apiMessage         = 'Data Available !!!';
                                $apiExtraField      = 'response_code';
                                $apiExtraData       = http_response_code();
                            } else {
                                $apiStatus                              = FALSE;
                                $apiMessage                             = 'You Account Is Not Active Yet !!!';
                            }
                        } else {
                            $apiStatus                              = FALSE;
                            $apiMessage                             = 'We Don\'t Recognize You !!!';
                        }
                    } else {
                        http_response_code($getTokenValue['data'][2]);
                        $apiStatus                      = FALSE;
                        $apiMessage                     = $this->getResponseCode(http_response_code());
                        $apiExtraField                  = 'response_code';
                        $apiExtraData                   = http_response_code();
                    }
                } else {
                    $apiStatus          = FALSE;
                    $apiMessage         = 'Unauthenticate Request !!!';
                }
                $this->response_to_json($apiStatus, $apiMessage, $apiResponse);
            }
        /* must read */
        /* billing */
            public function billing(Request $request){
                $project_key        = 'facb6e0a6fcbe200dca2fb60dec75be7';
                $apiStatus          = TRUE;
                $apiMessage         = '';
                $apiResponse        = [];
                $apiExtraField      = '';
                $apiExtraData       = '';
                $headerData         = $request->header();
                if($headerData['key'][0] == $project_key){
                    $app_access_token           = $headerData['authorization'][0];
                    $getTokenValue              = $this->tokenAuth($app_access_token);
                    if($getTokenValue['status']){
                        $uId                        = $getTokenValue['data'][1];
                        $expiry                     = date('d/m/Y H:i:s', $getTokenValue['data'][4]);
                        $checkUser                  = User::where('id', '=', $uId)->first();
                        if($checkUser){
                            if($checkUser->status == 'ACTIVE'){
                                // $token = "N3bwPrgB4wzHytcBkrvd6duSAX46ksfh9zOGPGnzwL8YladUpD-XH0DD_ZVBfdktfuPvgMbHg4uvBNBzibf2qEvPWh-HlzMFwnWJCfI8uW7-RBbpBj5oPlL9KPj7jxL8kaHDB6Fvl1fc8KZfYpZlRKRRTXIqsOkWt4Wenzz8I-D42AQzY5u-4FF1lDN3pepkwSL6xxXEb6wHExSHYlqT_9mKOB-6P-h6uWeqLETbFnft0CBvzwo9rJ14Gvu1YesR_Yte88Xg9R1K4_2mlY93YxYJGI7I3LkPSsVBfPW1SkzmdWo3HRJci6nRl36U_Llc";
                                $token = "5tdpn6yeoycRKbWd0311m1B5S-ZKMfU2syAD50kiquOX20GbmXF89Z1-vvsN01WTAIRWHdRESd8nRWZJrC7xuHkClh63BPg1PCpZHKpDOjmtvgJL8ErYrup7PLG2LZHkbjDh6bFb54VyUsvZm4OzzIPI9QVKhTf2ui5Pmd8CzHJZUK-4Jd-aOmQFfhuertA5KuIRrNdHTzA7w1hEYHO9Hq9J_pkME7BhNpjWp44Z3R2YeLuQbskl_rMypzLj5icdoPWgCsxA1bU9iGo5x3heaP8lHliiSx3SeeYpBMe22DRaarXJYc5pxFJ1tuEKDoxn";
                                // $fields = [
                                //     'MCODE' => $checkUser->user_code
                                // ];
                                // $url = "https://ccfcmemberdata.in/Api/MemberProfile/?".http_build_query($fields);
                                $transactionFields = [
                                    'MCODE'     => $checkUser->user_code,
                                    'FromDate'  => '01-apr-2020',
                                    'ToDate'    => '01-jun-2021',
                                ];

                                $tansactionUrl = 'https://ccfcmemberdata.in/api/MemberMonthlyBalance/?' . http_build_query($transactionFields);
                                $transactions = Http::withoutVerifying()
                                            ->withHeaders(['Authorization' => 'Bearer ' . $token, 'Cache-Control' => 'no-cache', 'Accept' => '/',
                                                            'Content-Type' => 'application/json',])
                                            ->withOptions(["verify" => false])
                                            ->post($tansactionUrl)->json()['data'];
                                // Helper::pr($transactions);

                                $monthly_billing                = [];
                                $daily_billing                  = [];
                                $user_outstanding_balance       = 0;
                                if($transactions){
                                    $user_outstanding_balance   = $transactions[0]['Balance'];
                                    foreach($transactions as $transaction){
                                        /* summarized bill */
                                            $summarized_bill_link = '';
                                            if(SearchInvoicePdf::isBillUploaded(implode("_", explode(" ", $transaction['Month']))) &&
                                            !empty(SearchInvoicePdf::getSummaryBillLinkApp($checkUser->user_code,
                                            $transaction['Month']))) {
                                                $summarized_bill_link = SearchInvoicePdf::getSummaryBillLinkApp($checkUser->user_code,  $transaction['Month']);
                                            }
                                        /* summarized bill */
                                        /* detailed bill */
                                            $detailed_bill_link = '';
                                            if(SearchInvoicePdf::isBillUploaded(implode("_", explode(" ",
                                            $transaction['Month']))) &&
                                            !empty(SearchInvoicePdf::getDetailBillLinkApp($checkUser->user_code,
                                            $transaction['Month']))){
                                                $detailed_bill_link = SearchInvoicePdf::getDetailBillLinkApp($checkUser->user_code,  $transaction['Month']);
                                            }
                                        /* detailed bill */
                                        /* bill list */
                                            $bill_list = [];
                                            // $Month      = str_replace(" ", "-", $transaction['Month']);
                                            // $billFields = [
                                            //     'mcode'     => $checkUser->user_code,
                                            //     'month'     => $Month
                                            // ];
                                            // $billUrl    = 'https://ccfcmemberdata.in/Api/MemberTransactionMonthly/POST?' . http_build_query($billFields);
                                            // $bills      = Http::withoutVerifying()
                                            //             ->withHeaders(['Authorization' => 'Bearer ' . $token, 'Cache-Control' => 'no-cache', 'Accept' => '/',
                                            //                             'Content-Type' => 'application/json',])
                                            //             ->withOptions(["verify" => false])
                                            //             ->post($billUrl)->json()['data'];
                                            // if($bills){
                                            //     foreach($bills as $bill){
                                            //         $bill_list[] = [
                                            //             'BILLDETAILS'   => $bill['BILLDETAILS'],
                                            //             'AMOUNT'        => number_format($bill['AMOUNT'],2),
                                            //             'BILLDATE'      => date_format(date_create($bill['BILLDATE']), "d-M-Y")
                                            //         ];
                                            //     }
                                            // }
                                        /* bill list */
                                        $monthly_billing[] = [
                                            'month'                 => $transaction['Month'],
                                            'opening_balance'       => $transaction['LastBalance'],
                                            'total_receipts'        => $transaction['paidamount'],
                                            'total_invoice'         => $transaction['debitamount'],
                                            'closing_balance'       => $transaction['Balance'],
                                            'summarized_bill'       => $summarized_bill_link,
                                            'detailed_bill'         => $detailed_bill_link,
                                            // 'bill_list'             => $bill_list,
                                        ];
                                    }
                                }
                                $user                           = [
                                    'name'                              => $checkUser->name,
                                    'email'                             => $checkUser->email,
                                    'phone'                             => $checkUser->phone_number_1,
                                    'user_code'                         => $checkUser->user_code,
                                    'user_outstanding_balance'          => $user_outstanding_balance,
                                ];

                                $apiResponse        = [
                                    'user'              => $user,
                                    'monthly_billing'   => $monthly_billing,
                                    'daily_billing'     => $daily_billing,
                                ];
                                // Helper::pr($transactions);

                                $apiStatus          = TRUE;
                                http_response_code(200);
                                $apiMessage         = 'Data Available !!!';
                                $apiExtraField      = 'response_code';
                                $apiExtraData       = http_response_code();
                            } else {
                                $apiStatus                              = FALSE;
                                $apiMessage                             = 'You Account Is Not Active Yet !!!';
                            }
                        } else {
                            $apiStatus                              = FALSE;
                            $apiMessage                             = 'We Don\'t Recognize You !!!';
                        }
                    } else {
                        http_response_code($getTokenValue['data'][2]);
                        $apiStatus                      = FALSE;
                        $apiMessage                     = $this->getResponseCode(http_response_code());
                        $apiExtraField                  = 'response_code';
                        $apiExtraData                   = http_response_code();
                    }
                } else {
                    $apiStatus          = FALSE;
                    $apiMessage         = 'Unauthenticate Request !!!';
                }
                $this->response_to_json($apiStatus, $apiMessage, $apiResponse);
            }
            public function billingList(Request $request){
                $project_key        = 'facb6e0a6fcbe200dca2fb60dec75be7';
                $apiStatus          = TRUE;
                $apiMessage         = '';
                $apiResponse        = [];
                $apiExtraField      = '';
                $apiExtraData       = '';
                $this->isJSON(file_get_contents('php://input'));
                $requestData        = $this->extract_json(file_get_contents('php://input'));
                $requiredFields     = ['billing_month_year'];
                $headerData         = $request->header();
                if (!$this->validateArray($requiredFields, $requestData)){
                    $apiStatus          = FALSE;
                    $apiMessage         = 'All Data Are Not Present !!!';
                }
                if($headerData['key'][0] == $project_key){
                    $app_access_token               = $headerData['authorization'][0];
                    $getTokenValue                  = $this->tokenAuth($app_access_token);
                    $billing_month_year             = $requestData['billing_month_year'];
                    if($getTokenValue['status']){
                        $uId                        = $getTokenValue['data'][1];
                        $expiry                     = date('d/m/Y H:i:s', $getTokenValue['data'][4]);
                        $checkUser                  = User::where('id', '=', $uId)->first();
                        if($checkUser){
                            if($checkUser->status == 'ACTIVE'){
                                // $token = "N3bwPrgB4wzHytcBkrvd6duSAX46ksfh9zOGPGnzwL8YladUpD-XH0DD_ZVBfdktfuPvgMbHg4uvBNBzibf2qEvPWh-HlzMFwnWJCfI8uW7-RBbpBj5oPlL9KPj7jxL8kaHDB6Fvl1fc8KZfYpZlRKRRTXIqsOkWt4Wenzz8I-D42AQzY5u-4FF1lDN3pepkwSL6xxXEb6wHExSHYlqT_9mKOB-6P-h6uWeqLETbFnft0CBvzwo9rJ14Gvu1YesR_Yte88Xg9R1K4_2mlY93YxYJGI7I3LkPSsVBfPW1SkzmdWo3HRJci6nRl36U_Llc";
                                $token = "5tdpn6yeoycRKbWd0311m1B5S-ZKMfU2syAD50kiquOX20GbmXF89Z1-vvsN01WTAIRWHdRESd8nRWZJrC7xuHkClh63BPg1PCpZHKpDOjmtvgJL8ErYrup7PLG2LZHkbjDh6bFb54VyUsvZm4OzzIPI9QVKhTf2ui5Pmd8CzHJZUK-4Jd-aOmQFfhuertA5KuIRrNdHTzA7w1hEYHO9Hq9J_pkME7BhNpjWp44Z3R2YeLuQbskl_rMypzLj5icdoPWgCsxA1bU9iGo5x3heaP8lHliiSx3SeeYpBMe22DRaarXJYc5pxFJ1tuEKDoxn";
                                /* bill list */
                                    $bill_list  = [];
                                    $Month      = str_replace(" ", "-", $billing_month_year);
                                    $billFields = [
                                        'mcode'     => $checkUser->user_code,
                                        'month'     => $Month
                                    ];
                                    $billUrl    = 'https://ccfcmemberdata.in/Api/MemberTransactionMonthly/POST?' . http_build_query($billFields);
                                    $bills      = Http::withoutVerifying()
                                                ->withHeaders(['Authorization' => 'Bearer ' . $token, 'Cache-Control' => 'no-cache', 'Accept' => '/',
                                                                'Content-Type' => 'application/json',])
                                                ->withOptions(["verify" => false])
                                                ->post($billUrl)->json()['data'];
                                    if($bills){
                                        foreach($bills as $bill){
                                            $bill_list[] = [
                                                'BILLDETAILS'   => $bill['BILLDETAILS'],
                                                'AMOUNT'        => number_format($bill['AMOUNT'],2),
                                                'BILLDATE'      => date_format(date_create($bill['BILLDATE']), "d-M-Y")
                                            ];
                                        }
                                    }
                                /* bill list */

                                $apiResponse        = $bill_list;
                                // Helper::pr($transactions);

                                $apiStatus          = TRUE;
                                http_response_code(200);
                                $apiMessage         = 'Data Available !!!';
                                $apiExtraField      = 'response_code';
                                $apiExtraData       = http_response_code();
                            } else {
                                $apiStatus                              = FALSE;
                                $apiMessage                             = 'You Account Is Not Active Yet !!!';
                            }
                        } else {
                            $apiStatus                              = FALSE;
                            $apiMessage                             = 'We Don\'t Recognize You !!!';
                        }
                    } else {
                        http_response_code($getTokenValue['data'][2]);
                        $apiStatus                      = FALSE;
                        $apiMessage                     = $this->getResponseCode(http_response_code());
                        $apiExtraField                  = 'response_code';
                        $apiExtraData                   = http_response_code();
                    }
                } else {
                    $apiStatus          = FALSE;
                    $apiMessage         = 'Unauthenticate Request !!!';
                }
                $this->response_to_json($apiStatus, $apiMessage, $apiResponse);
            }
            public function billingDetail(Request $request){
                $project_key        = 'facb6e0a6fcbe200dca2fb60dec75be7';
                $apiStatus          = TRUE;
                $apiMessage         = '';
                $apiResponse        = [];
                $apiExtraField      = '';
                $apiExtraData       = '';
                $this->isJSON(file_get_contents('php://input'));
                $requestData        = $this->extract_json(file_get_contents('php://input'));
                $requiredFields     = ['billdetails'];
                $headerData         = $request->header();
                if (!$this->validateArray($requiredFields, $requestData)){
                    $apiStatus          = FALSE;
                    $apiMessage         = 'All Data Are Not Present !!!';
                }
                if($headerData['key'][0] == $project_key){
                    $app_access_token               = $headerData['authorization'][0];
                    $getTokenValue                  = $this->tokenAuth($app_access_token);
                    $billdetails                    = $requestData['billdetails'];
                    if($getTokenValue['status']){
                        $uId                        = $getTokenValue['data'][1];
                        $expiry                     = date('d/m/Y H:i:s', $getTokenValue['data'][4]);
                        $checkUser                  = User::where('id', '=', $uId)->first();
                        if($checkUser){
                            if($checkUser->status == 'ACTIVE'){
                                $generalSettings    = GeneralSetting::find(1);
                                $item_reporting_time_in_hrs = $generalSettings->item_reporting_time_in_hrs;
                                $token = "5tdpn6yeoycRKbWd0311m1B5S-ZKMfU2syAD50kiquOX20GbmXF89Z1-vvsN01WTAIRWHdRESd8nRWZJrC7xuHkClh63BPg1PCpZHKpDOjmtvgJL8ErYrup7PLG2LZHkbjDh6bFb54VyUsvZm4OzzIPI9QVKhTf2ui5Pmd8CzHJZUK-4Jd-aOmQFfhuertA5KuIRrNdHTzA7w1hEYHO9Hq9J_pkME7BhNpjWp44Z3R2YeLuQbskl_rMypzLj5icdoPWgCsxA1bU9iGo5x3heaP8lHliiSx3SeeYpBMe22DRaarXJYc5pxFJ1tuEKDoxn";
                                /* bill details */
                                    $bill_details   = [];
                                    $billFields     = [
                                        'mcode'             => $checkUser->user_code,
                                        'billdetails'       => $billdetails
                                    ];
                                    $billUrl    = 'https://ccfcmemberdata.in/Api/MemberTransDet/POST?' . http_build_query($billFields);
                                    $bills      = Http::withoutVerifying()
                                                ->withHeaders(['Authorization' => 'Bearer ' . $token, 'Cache-Control' => 'no-cache', 'Accept' => '/',
                                                                'Content-Type' => 'application/json',])
                                                ->withOptions(["verify" => false])
                                                ->post($billUrl)->json()['data'];
                                    if($bills){
                                        foreach($bills as $bill){
                                            $BILLDATE           = $bill['BILLDATE'];
                                            $CURRENT_TIMESTAMP  = date('Y-m-d H:i:s');

                                            // Create DateTime objects from the date and time strings
                                            $date1 = new DateTime($BILLDATE);
                                            $date2 = new DateTime($CURRENT_TIMESTAMP);

                                            // Calculate the difference
                                            $interval = $date1->diff($date2);

                                            // Get the difference in hours
                                            $hours = ($interval->days * 24) + $interval->h + ($interval->i / 60) + ($interval->s / 3600);
                                            if($hours <= 72){
                                                $IS_REPORT = 1;
                                            } else {
                                                $IS_REPORT = 0;
                                            }


                                            $bill_details[]     = [
                                                'BILLDETAILS'       => $bill['BILLDETAILS'],
                                                'BILLDATE'          => date_format(date_create($bill['BILLDATE']), "d-M-Y h:i:s a"),
                                                'ITEMDESC'          => $bill['ITEMDESC'],
                                                'QTY'               => $bill['QTY'],
                                                'RATE'              => number_format($bill['RATE'],2),
                                                'AMOUNT'            => number_format($bill['AMOUNT'],2),
                                                'TAXAMOUNT'         => number_format($bill['TAXAMOUNT'],2),
                                                'BILLAMT'           => number_format($bill['BILLAMT'],2),
                                                'IS_REPORT'         => $IS_REPORT
                                            ];
                                        }
                                    }
                                /* bill details */

                                $apiResponse        = $bill_details;
                                $apiStatus          = TRUE;
                                http_response_code(200);
                                $apiMessage         = 'Data Available !!!';
                                $apiExtraField      = 'response_code';
                                $apiExtraData       = http_response_code();
                            } else {
                                $apiStatus                              = FALSE;
                                $apiMessage                             = 'You Account Is Not Active Yet !!!';
                            }
                        } else {
                            $apiStatus                              = FALSE;
                            $apiMessage                             = 'We Don\'t Recognize You !!!';
                        }
                    } else {
                        http_response_code($getTokenValue['data'][2]);
                        $apiStatus                      = FALSE;
                        $apiMessage                     = $this->getResponseCode(http_response_code());
                        $apiExtraField                  = 'response_code';
                        $apiExtraData                   = http_response_code();
                    }
                } else {
                    $apiStatus          = FALSE;
                    $apiMessage         = 'Unauthenticate Request !!!';
                }
                $this->response_to_json($apiStatus, $apiMessage, $apiResponse);
            }
            public function billingReport(Request $request){
                $project_key        = 'facb6e0a6fcbe200dca2fb60dec75be7';
                $apiStatus          = TRUE;
                $apiMessage         = '';
                $apiResponse        = [];
                $apiExtraField      = '';
                $apiExtraData       = '';
                $this->isJSON(file_get_contents('php://input'));
                $requestData        = $this->extract_json(file_get_contents('php://input'));
                $requiredFields     = ['billdetails', 'itemdesc', 'comments'];
                $headerData         = $request->header();
                if (!$this->validateArray($requiredFields, $requestData)){
                    $apiStatus          = FALSE;
                    $apiMessage         = 'All Data Are Not Present !!!';
                }
                if($headerData['key'][0] == $project_key){
                    $app_access_token               = $headerData['authorization'][0];
                    $getTokenValue                  = $this->tokenAuth($app_access_token);
                    $billdetails                    = $requestData['billdetails'];
                    $itemdesc                       = $requestData['itemdesc'];
                    $comments                       = $requestData['comments'];
                    if($getTokenValue['status']){
                        $uId                        = $getTokenValue['data'][1];
                        $expiry                     = date('d/m/Y H:i:s', $getTokenValue['data'][4]);
                        $checkUser                  = User::where('id', '=', $uId)->first();
                        if($checkUser){
                            if($checkUser->status == 'ACTIVE'){
                                $postdata = [
                                    'user_id'       => $uId,
                                    'user_code'     => $checkUser->user_code,
                                    'billdetails'   => $billdetails,
                                    'itemdesc'      => $itemdesc,
                                    'comments'      => $comments,
                                ];
                                BillReport::insert($postdata);

                                $apiStatus          = TRUE;
                                http_response_code(200);
                                $apiMessage         = 'Report Sucessfully Submitted Against ' . $billdetails . ' !!!';
                                $apiExtraField      = 'response_code';
                                $apiExtraData       = http_response_code();
                            } else {
                                $apiStatus                              = FALSE;
                                $apiMessage                             = 'You Account Is Not Active Yet !!!';
                            }
                        } else {
                            $apiStatus                              = FALSE;
                            $apiMessage                             = 'We Don\'t Recognize You !!!';
                        }
                    } else {
                        http_response_code($getTokenValue['data'][2]);
                        $apiStatus                      = FALSE;
                        $apiMessage                     = $this->getResponseCode(http_response_code());
                        $apiExtraField                  = 'response_code';
                        $apiExtraData                   = http_response_code();
                    }
                } else {
                    $apiStatus          = FALSE;
                    $apiMessage         = 'Unauthenticate Request !!!';
                }
                $this->response_to_json($apiStatus, $apiMessage, $apiResponse);
            }
        /* billing */
        /* payu reponse */
            public function payuResponse(Request $request){
                $project_key        = 'facb6e0a6fcbe200dca2fb60dec75be7';
                $apiStatus          = TRUE;
                $apiMessage         = '';
                $apiResponse        = [];
                $apiExtraField      = '';
                $apiExtraData       = '';
                $this->isJSON(file_get_contents('php://input'));
                $requestData        = $this->extract_json(file_get_contents('php://input'));
                $requiredFields     = ['amount', 'hash', 'id', 'status', 'payuResponse'];
                $headerData         = $request->header();
                if (!$this->validateArray($requiredFields, $requestData)){
                    $apiStatus          = FALSE;
                    $apiMessage         = 'All Data Are Not Present !!!';
                }
                
                if($headerData['key'][0] == $project_key){
                    $app_access_token           = $headerData['authorization'][0];
                    $getTokenValue              = $this->tokenAuth($app_access_token);

                    $amount                     = $requestData['amount'];
                    $hash                       = $requestData['hash'];
                    $txn_id                     = $requestData['id'];
                    $status                     = $requestData['status'];
                    $payuResponse               = $requestData['payuResponse'];

                    if($getTokenValue['status']){
                        $uId                        = $getTokenValue['data'][1];
                        $expiry                     = date('d/m/Y H:i:s', $getTokenValue['data'][4]);
                        $checkUser                  = User::where('id', '=', $uId)->first();
                        if($checkUser){
                            if($checkUser->status == 'ACTIVE'){
                                $checkPayuTransaction = DB::table('payu_transactions')->where('transaction_id','=','$txn_id')->count();
                                if($checkPayuTransaction <= 0){
                                    $postData = [
                                        'paid_for_id'           => $uId,
                                        'paid_for_type'         => 'App\Models\User',
                                        'transaction_id'        => $txn_id,
                                        'gateway'               => '',
                                        'body'                  => '',
                                        'destination'           => 'https://ccfc.keylines.in/member/payment/status',
                                        'hash'                  => $hash,
                                        'response'              => json_encode($payuResponse),
                                        'status'                => (($status == 'failure')?'failed':'successful'),
                                        'created_at'            => date('Y-m-d H:i:s'),
                                        'updated_at'            => date('Y-m-d H:i:s'),
                                    ];
                                    // Helper::pr($postData);
                                    // PayuTransaction::insert($postData);
                                    DB::table('payu_transactions')->insert(
                                        $postData
                                    );
                                    $user= User::find($uId);
                                    if (!empty($user) && $status != 'failure') {
                                        $emailInfo= array(
                                            'greeting' => "Dear, {$user->name}",
                                            'body'     => "Thank you for making payment of Rs.".$amount.". Please note that payment is subject to realization and will reflect in your account in the next 24 working hours."
                                        );
                                        // Notification::send($user, new PayUEmailNotification($emailInfo));
                                    }
                                }

                                $apiStatus          = TRUE;
                                http_response_code(200);
                                if($status == 'failure'){
                                    $apiMessage         = 'Payment Failed !!!';
                                } else {
                                    $apiMessage         = 'Payment Successfull !!!';
                                }
                                
                                $apiExtraField      = 'response_code';
                                $apiExtraData       = http_response_code();
                            } else {
                                $apiStatus                              = FALSE;
                                $apiMessage                             = 'You Account Is Not Active Yet !!!';
                            }
                        } else {
                            $apiStatus                              = FALSE;
                            $apiMessage                             = 'We Don\'t Recognize You !!!';
                        }
                    } else {
                        http_response_code($getTokenValue['data'][2]);
                        $apiStatus                      = FALSE;
                        $apiMessage                     = $this->getResponseCode(http_response_code());
                        $apiExtraField                  = 'response_code';
                        $apiExtraData                   = http_response_code();
                    }
                } else {
                    $apiStatus          = FALSE;
                    $apiMessage         = 'Unauthenticate Request !!!';
                }
                $this->response_to_json($apiStatus, $apiMessage, $apiResponse);
            }
        /* payu reponse */
        /* notification */
            public function notification(Request $request){
                $project_key        = 'facb6e0a6fcbe200dca2fb60dec75be7';
                $apiStatus          = TRUE;
                $apiMessage         = '';
                $apiResponse        = [];
                $apiExtraField      = '';
                $apiExtraData       = '';
                // $this->isJSON(file_get_contents('php://input'));
                // $requestData        = $this->extract_json(file_get_contents('php://input'));
                // $requiredFields     = ['menu_date'];
                $headerData         = $request->header();
                // if (!$this->validateArray($requiredFields, $requestData)){
                //     $apiStatus          = FALSE;
                //     $apiMessage         = 'All Data Are Not Present !!!';
                // }
                if($headerData['key'][0] == $project_key){
                    $app_access_token           = $headerData['authorization'][0];
                    $getTokenValue              = $this->tokenAuth($app_access_token);
                    if($getTokenValue['status']){
                        $uId                        = $getTokenValue['data'][1];
                        $expiry                     = date('d/m/Y H:i:s', $getTokenValue['data'][4]);
                        $checkUser                  = User::where('id', '=', $uId)->first();
                        if($checkUser){
                            if($checkUser->status == 'ACTIVE'){
                                $currentDate = date('Y-m-d');
                                $mustReads          = MustRead::select('title', 'description', 'is_popup', 'popup_validity_date', 'popup_validity_time', 'created_at')->where('status', '=', 1)->where('popup_validity_date', '>=', $currentDate)->orderBy('id', 'DESC')->get();
                                if($mustReads){
                                    foreach($mustReads as $mustRead){
                                        $apiResponse[] = [
                                            'title'                 => $mustRead->title,
                                            'description'           => $mustRead->description,
                                            'is_popup'              => $mustRead->is_popup,
                                            'popup_validity_date'   => $mustRead->popup_validity_date,
                                            'popup_validity_time'   => $mustRead->popup_validity_time,
                                            'popup_validity'        => $mustRead->popup_validity_date.' '.$mustRead->popup_validity_time,
                                            'created_at'            => Helper::time_ago($mustRead->created_at),
                                        ];
                                    }
                                }
                                $apiStatus          = TRUE;
                                http_response_code(200);
                                $apiMessage         = 'Data Available !!!';
                                $apiExtraField      = 'response_code';
                                $apiExtraData       = http_response_code();
                            } else {
                                $apiStatus                              = FALSE;
                                $apiMessage                             = 'You Account Is Not Active Yet !!!';
                            }
                        } else {
                            $apiStatus                              = FALSE;
                            $apiMessage                             = 'We Don\'t Recognize You !!!';
                        }
                    } else {
                        http_response_code($getTokenValue['data'][2]);
                        $apiStatus                      = FALSE;
                        $apiMessage                     = $this->getResponseCode(http_response_code());
                        $apiExtraField                  = 'response_code';
                        $apiExtraData                   = http_response_code();
                    }
                } else {
                    $apiStatus          = FALSE;
                    $apiMessage         = 'Unauthenticate Request !!!';
                }
                $this->response_to_json($apiStatus, $apiMessage, $apiResponse);
            }
        /* notification */
    /* after login */
    /*
    Get http response code
    Author : Subhomoy
    */
    private function getResponseCode($code = NULL){
        if ($code !== NULL) {
            switch ($code) {
                case 100: $text = 'Continue'; break;
                case 101: $text = 'Switching Protocols'; break;
                case 200: $text = 'OK'; break;
                case 201: $text = 'Created'; break;
                case 202: $text = 'Accepted'; break;
                case 203: $text = 'Non-Authoritative Information'; break;
                case 204: $text = 'No Content'; break;
                case 205: $text = 'Reset Content'; break;
                case 206: $text = 'Partial Content'; break;
                case 300: $text = 'Multiple Choices'; break;
                case 301: $text = 'Moved Permanently'; break;
                case 302: $text = 'Moved Temporarily'; break;
                case 303: $text = 'See Other'; break;
                case 304: $text = 'Not Modified'; break;
                case 305: $text = 'Use Proxy'; break;
                case 400: $text = 'Unauthenticated Request !!!'; break;
                case 401: $text = 'Token Not Found !!!'; break;
                case 402: $text = 'Payment Required'; break;
                case 403: $text = 'Token Has Expired !!!'; break;
                case 404: $text = 'User Not Found !!!'; break;
                case 405: $text = 'Method Not Allowed'; break;
                case 406: $text = 'All Data Are Not Present !!!'; break;
                case 407: $text = 'Proxy Authentication Required'; break;
                case 408: $text = 'Request Time-out'; break;
                case 409: $text = 'Conflict'; break;
                case 410: $text = 'Gone'; break;
                case 411: $text = 'Length Required'; break;
                case 412: $text = 'Precondition Failed'; break;
                case 413: $text = 'Request Entity Too Large'; break;
                case 414: $text = 'Request-URI Too Large'; break;
                case 415: $text = 'Unsupported Media Type'; break;
                case 500: $text = 'Internal Server Error'; break;
                case 501: $text = 'Not Implemented'; break;
                case 502: $text = 'Bad Gateway'; break;
                case 503: $text = 'Service Unavailable'; break;
                case 504: $text = 'Gateway Time-out'; break;
                case 505: $text = 'HTTP Version not supported'; break;
                default:
                    exit('Unknown http status code "' . htmlentities($code) . '"');
                break;
            }
            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . $code . ' ' . $text);
            $GLOBALS['http_response_code'] = $code;
        } else {
            $code = (isset($GLOBALS['http_response_code']) ? $GLOBALS['http_response_code'] : 200);
            $text = '';
        }
        return $text;
    }
    /*
    Generate JWT tokens for authentication
    Author : Subhomoy
    */
    private static function generateToken($userId, $email, $phone){
        $token      = array(
            'id'                => $userId,
            'email'             => $email,
            'phone'             => $phone,
            'exp'               => time() + (30 * 24 * 60 * 60) // 30 days
        );
        // pr($token);
        return JWT::encode($token, TOKEN_SECRET, 'HS256');
    }
    /*
    Check Authentication
    Author : Subhomoy
    */
    private function tokenAuth($appAccessToken){
        $headers = apache_request_headers();
        if (isset($appAccessToken) && !empty($appAccessToken)) :
            $userdata = $this->matchToken($appAccessToken);
            // pr($userdata);
            if ($userdata['status']) :
                $checkToken =  UserDevice::where('user_id', '=', $userdata['data']->id)->where('app_access_token', '=', $appAccessToken)->first();
                // echo $this->db->last_query();
                // pr($userdata);
                if (!empty($checkToken)) :
                    if ($userdata['data']->exp && $userdata['data']->exp > time()) :
                        $tokenStatus = array(TRUE, $userdata['data']->id, $userdata['data']->email, $userdata['data']->phone, $userdata['data']->exp);
                    else :
                        $tokenStatus = array(FALSE, 'Token Has Expired 1 !!!');
                    endif;
                else :
                    $tokenStatus = array(FALSE, 'Token Has Expired 2 !!!');
                endif;
            else :
                $tokenStatus = array(FALSE, 'Token Not Found !!!');
            endif;
        else :
            $tokenStatus = array(FALSE, 'Token Not Found In Request !!!');
        endif;
        if ($tokenStatus[0]) :
            $this->userId           = $tokenStatus[1];
            $this->userEmail        = $tokenStatus[2];
            $this->userMobile       = $tokenStatus[3];
            $this->userExpiry       = $tokenStatus[4];
            // pr($tokenStatus);
            return array('status' => TRUE, 'data' => $tokenStatus);
        else :
            return array('status' => FALSE, 'data' => $tokenStatus[1]);
            // $this->response_to_json(FALSE, $tokenStatus[1]);
        endif;
    }
    /*
    Match JWT token with user token saved in database
    Author : Subhomoy
    */
    private static function matchToken($token){
        // try{
        //     // $decoded    = JWT::decode($token, TOKEN_SECRET, 'HS256');
        //     $decoded    = JWT::decode($token, new Key(TOKEN_SECRET, 'HS256'));
        //     // pr($decoded);
        // } catch (\Exception $e) {
        //     //echo 'Caught exception: ',  $e->getMessage(), "\n";
        //     return array('status' => FALSE, 'data' => '');
        // }
        
        // return array('status' => TRUE, 'data' => $decoded);


        try{
            $key = "1234567890qwertyuiopmnbvcxzasdfghjkl";
            $decoded = JWT::decode($token, $key, array('HS256'));
            // $decodedData = (array) $decoded;
        } catch (\Exception $e) {
            //echo 'Caught exception: ',  $e->getMessage(), "\n";
            return array('status' => FALSE, 'data' => '');
        }
        return array('status' => TRUE, 'data' => $decoded);
    }
}
