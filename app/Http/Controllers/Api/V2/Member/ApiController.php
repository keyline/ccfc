<?php
namespace App\Http\Controllers\Api\V2\Member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\Contact;
use App\Models\Contactlist;
use App\Models\GeneralSetting;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\UserDevice;

use App\Libraries\CreatorJwt;
use App\Libraries\JWT;

use App\Helpers\Helper;

use Auth;
use Hash;
use Mail;

class ApiController extends Controller
{
    /* signin */
        public function signinWithMobile(Request $request){
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
            if($headerData['key'][0] == env('PROJECT_KEY')){
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
                            // $message = "Dear ".(($checkUser)?$checkUser->name:'ECOEX').", ".$mobile_otp." is your verification OTP for registration at ECOEX PORTAL. Do not share this OTP with anyone for security reasons.";
                            // $mobileNo = (($checkUser)?$checkUser->mobileNo:'');
                            // $this->sendSMS($mobileNo,$message);
                        /* send sms */
                        $mailData                   = [
                            'id'    => $checkUser->id,
                            'email' => $checkUser->email,
                            'phone' => $checkUser->phone_number_1,
                            'otp'   => $mobile_otp,
                        ];
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
            if($headerData['key'][0] == env('PROJECT_KEY')){
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
            if($headerData['key'][0] == env('PROJECT_KEY')){
                $email                      = $requestData['email'];
                $password                   = $requestData['password'];
                $device_token               = $requestData['device_token'];
                $fcm_token                  = $requestData['fcm_token'];
                $device_type                = $headerData['source'][0];
                $checkUser                  = User::where('email', '=', $email)->first();
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
            $apiStatus          = TRUE;
            $apiMessage         = '';
            $apiResponse        = [];
            $apiExtraField      = '';
            $apiExtraData       = '';
            $this->isJSON(file_get_contents('php://input'));
            $requestData        = $this->extract_json(file_get_contents('php://input'));
            $requiredFields     = ['email'];
            $headerData         = $request->header();
            if (!$this->validateArray($requiredFields, $requestData)){
                $apiStatus          = FALSE;
                $apiMessage         = 'All Data Are Not Present !!!';
            }
            if($headerData['key'][0] == env('PROJECT_KEY')){
                $email                      = $requestData['email'];
                $checkUser                  = User::where('email', '=', $email)->first();
                if($checkUser){
                    if($checkUser->status == 'ACTIVE'){
                        $otp        = rand(100000,999999);
                        $postData   = [
                            'remember_token'        => $otp
                        ];
                        User::where('id', '=', $checkUser->id)->update($postData);
                        $mailData                   = [
                            'id'    => $checkUser->id,
                            'email' => $checkUser->email,
                            'otp'   => $otp
                        ];
                        // $subject                    = 'CCFC :: Forgot Password OTP';
                        // $message                    = view('email-template/otp',$mailData);
                        // echo $message;die;
                        // $this->sendMail($requestData['email'], $subject, $message);

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
            if($headerData['key'][0] == env('PROJECT_KEY')){
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
            if($headerData['key'][0] == env('PROJECT_KEY')){
                $id                         = $requestData['id'];
                $checkUser                  = User::where('id', '=', $id)->first();
                if($checkUser){
                    if($checkUser->status == 'ACTIVE'){
                        $otp        = rand(100000,999999);
                        $postData   = [
                            'remember_token'        => $otp
                        ];
                        User::where('id', '=', $checkUser->id)->update($postData);
                        $mailData                   = [
                            'id'    => $checkUser->id,
                            'email' => $checkUser->email,
                            'otp'   => $otp
                        ];
                        // $subject                    = 'CCFC :: Forgot Password OTP';
                        // $message                    = view('email-template/otp',$mailData);
                        // echo $message;die;
                        // $this->sendMail($requestData['email'], $subject, $message);

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
            if($headerData['key'][0] == env('PROJECT_KEY')){
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
        /* dashboard */
            public function dashboard(Request $request){
                $apiStatus          = TRUE;
                $apiMessage         = '';
                $apiResponse        = [];
                $apiExtraField      = '';
                $apiExtraData       = '';
                $headerData         = $request->header();
                if($headerData['key'][0] == env('PROJECT_KEY')){
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
                $apiStatus          = TRUE;
                $apiMessage         = '';
                $apiResponse        = [];
                $apiExtraField      = '';
                $apiExtraData       = '';
                $headerData         = $request->header();
                if($headerData['key'][0] == env('PROJECT_KEY')){
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
                                        'dob'                                   => (($getUserDetail)?date_format(date_create($getUserDetail->spouse_dob), "d-m-Y"):''),
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
                                        'dob'                                   => (($getUserDetail)?date_format(date_create($getUserDetail->children1_dob), "d-m-Y"):''),
                                        'sex'                                   => (($getUserDetail)?$getUserDetail->children1_sex:''),
                                        'phone_1'                               => (($getUserDetail)?$getUserDetail->children1_phone1:''),
                                        'phone_2'                               => (($getUserDetail)?$getUserDetail->children1_phone2:''),
                                        'phone_3'                               => (($getUserDetail)?$getUserDetail->children1_mobileno:''),
                                    ],
                                    'children2'     => [
                                        'name'                                  => (($getUserDetail)?$getUserDetail->children2_name:''),
                                        'dob'                                   => (($getUserDetail)?date_format(date_create($getUserDetail->children2_dob), "d-m-Y"):''),
                                        'sex'                                   => (($getUserDetail)?$getUserDetail->children2_sex:''),
                                        'phone_1'                               => (($getUserDetail)?$getUserDetail->children2_phone1:''),
                                        'phone_2'                               => (($getUserDetail)?$getUserDetail->children2_phone2:''),
                                        'phone_3'                               => (($getUserDetail)?$getUserDetail->children2_mobileno:''),
                                    ],
                                    'children3'     => [
                                        'name'                                  => (($getUserDetail)?$getUserDetail->children3_name:''),
                                        'dob'                                   => (($getUserDetail)?date_format(date_create($getUserDetail->children3_dob), "d-m-Y"):''),
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
                $apiStatus          = TRUE;
                $apiMessage         = '';
                $apiResponse        = [];
                $apiExtraField      = '';
                $apiExtraData       = '';
                $headerData         = $request->header();
                if($headerData['key'][0] == env('PROJECT_KEY')){
                    $app_access_token           = $headerData['authorization'][0];
                    $getTokenValue              = $this->tokenAuth($app_access_token);
                    if($getTokenValue['status']){
                        $uId                        = $getTokenValue['data'][1];
                        $expiry                     = date('d/m/Y H:i:s', $getTokenValue['data'][4]);
                        $checkUser                  = User::where('id', '=', $uId)->first();
                        if($checkUser){
                            if($checkUser->status == 'ACTIVE'){
                                
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
                $apiStatus          = TRUE;
                $apiMessage         = '';
                $apiResponse        = [];
                $apiExtraField      = '';
                $apiExtraData       = '';
                $headerData         = $request->header();
                if($headerData['key'][0] == env('PROJECT_KEY')){
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
                if($headerData['key'][0] == env('PROJECT_KEY')){
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
                                    \Mail::send('contactMail', array(
                                        'name'          => $name,
                                        'email'         => $postemail,
                                        'phone'         => $phone,
                                        'subject'       => $subject,
                                        'description'   => $message,
                                    ), function ($message) use ($request) {
                                        $message->from($postemail);
                                        $department     = [];
                                        $department     = explode("/", $department);
                                        $senderEmail    = $department[0];
                                        $senderName     = $department[1];
                                        $message->to('subhomoy@keylines.net', 'Admin')->subject($subject);
                                        // $message->to($senderEmail, $senderName)->subject($subject);
                                    });
                                /* mail send */

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
