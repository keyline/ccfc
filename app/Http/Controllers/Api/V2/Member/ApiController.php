<?php
namespace App\Http\Controllers\Api\V2\Member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\User;
use App\Models\UserDevice;

use App\Libraries\CreatorJwt;
use App\Libraries\JWT;

use Auth;
use Hash;
use App\Helpers\Helper;

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
                Helper::pr($headerData);
                if($headerData['key'][0] == env('PROJECT_KEY')){
                    $id                         = $requestData['id'];
                    $checkUser                  = User::where('id', '=', $id)->first();
                    if($checkUser){
                        if($checkUser->status == 'ACTIVE'){
                            
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
        /* dashboard */
        /* get profile */
            public function getProfile(Request $request){
                $apiStatus          = TRUE;
                $apiMessage         = '';
                $apiResponse        = [];
                $apiExtraField      = '';
                $apiExtraData       = '';
                $headerData         = $request->header();
                Helper::pr($headerData);
                if($headerData['key'][0] == env('PROJECT_KEY')){
                    $id                         = $requestData['id'];
                    $checkUser                  = User::where('id', '=', $id)->first();
                    if($checkUser){
                        if($checkUser->status == 'ACTIVE'){
                            
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
        /* get profile */
        /* my card */
            public function myCard(Request $request){
                $apiStatus          = TRUE;
                $apiMessage         = '';
                $apiResponse        = [];
                $apiExtraField      = '';
                $apiExtraData       = '';
                $headerData         = $request->header();
                Helper::pr($headerData);
                if($headerData['key'][0] == env('PROJECT_KEY')){
                    $id                         = $requestData['id'];
                    $checkUser                  = User::where('id', '=', $id)->first();
                    if($checkUser){
                        if($checkUser->status == 'ACTIVE'){
                            
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
        /* my card */
        /* get contact us */
            public function getContactUs(Request $request){
                $apiStatus          = TRUE;
                $apiMessage         = '';
                $apiResponse        = [];
                $apiExtraField      = '';
                $apiExtraData       = '';
                $headerData         = $request->header();
                Helper::pr($headerData);
                if($headerData['key'][0] == env('PROJECT_KEY')){
                    $id                         = $requestData['id'];
                    $checkUser                  = User::where('id', '=', $id)->first();
                    if($checkUser){
                        if($checkUser->status == 'ACTIVE'){
                            
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
        /* get contact us */
        /* post contact us */
            public function submitContactUs(Request $request){
                $apiStatus          = TRUE;
                $apiMessage         = '';
                $apiResponse        = [];
                $apiExtraField      = '';
                $apiExtraData       = '';
                $headerData         = $request->header();
                Helper::pr($headerData);
                if($headerData['key'][0] == env('PROJECT_KEY')){
                    $id                         = $requestData['id'];
                    $checkUser                  = User::where('id', '=', $id)->first();
                    if($checkUser){
                        if($checkUser->status == 'ACTIVE'){
                            
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
        /* post contact us */
    /* after login */
}
