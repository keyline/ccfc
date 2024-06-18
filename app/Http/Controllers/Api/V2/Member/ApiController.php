<?php
namespace App\Http\Controllers\Api\V2\Member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;

use Auth;
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
            Helper::pr($requestData,0);
            Helper::pr($headerData,0);
            die;
            if (!$this->validateArray($requiredFields, $requestData)){
                $apiStatus          = FALSE;
                $apiMessage         = 'All Data Are Not Present !!!';
            }
            if($headerData['Key'] == 'Key: '.getenv('app.PROJECTKEY')){
                $email                      = $requestData['email'];
                $password                   = $requestData['password'];
                $device_token               = $requestData['device_token'];
                $fcm_token                  = $requestData['fcm_token'];
                $device_type                = trim($headerData['Source'], "Source: ");
                $checkUser                  = $this->common_model->find_data('ecoex_admin_user', 'row', ['email' => $email, 'user_type!=' => 'MA']);
                if($checkUser){
                    if($checkUser->status != 3){
                        if($checkUser->status >= 1){
                            if(md5($password) == $checkUser->password){
                                $getCompany         = [];

                                $objOfJwt           = new CreatorJwt();
                                $app_access_token   = $objOfJwt->GenerateToken($checkUser->id, $checkUser->email, $checkUser->mobileNo);
                                $user_id            = $checkUser->id;
                                $fields             = [
                                    'user_id'               => $user_id,
                                    'device_type'           => $device_type,
                                    'device_token'          => $device_token,
                                    'fcm_token'             => $fcm_token,
                                    'app_access_token'      => $app_access_token,
                                ];
                                $checkUserTokenExist                  = $this->common_model->find_data('ecomm_user_devices', 'row', ['app_access_token' => $app_access_token]);
                                if(!$checkUserTokenExist){
                                    $this->common_model->save_data('ecomm_user_devices', $fields, '', 'id');
                                } else {
                                    $this->common_model->save_data('ecomm_user_devices', $fields, $checkUserTokenExist->id, 'id');
                                }
                                /* login log capture */
                                    $source = explode("Source: ", $headerData['Source']);
                                    $fields1 = [
                                        'user_id'       => $checkUser->id,
                                        'name'          => $checkUser->name,
                                        'email'         => $checkUser->email,
                                        'type'          => 'SIGN IN',
                                        'ip_address'    => $this->request->getIPAddress(),
                                        'browser_used'  => $source[1],
                                        'platform'      => 'App',
                                    ];
                                    $this->common_model->save_data('ecoex_login_logs', $fields1, '', 'id');
                                /* login log capture */

                                $userActivityData = [
                                    'user_email'        => $checkUser->email,
                                    'user_name'         => $checkUser->name,
                                    'activity_type'     => 1,
                                    'user_type'         => $checkUser->user_type,
                                    'ip_address'        => $this->request->getIPAddress(),
                                    'activity_details'  => $checkUser->user_type.' Sign In Success',
                                ];
                                $this->common_model->save_data('user_activities', $userActivityData, '','activity_id');
                                $apiResponse = [
                                    'user_id'               => $user_id,
                                    'company_name'          => $checkUser->name,
                                    'email'                 => $checkUser->email,
                                    'phone'                 => $checkUser->mobileNo,
                                    'type'                  => $checkUser->user_type,
                                    'device_type'           => $device_type,
                                    'device_token'          => $device_token,
                                    'fcm_token'             => $fcm_token,
                                    'app_access_token'      => $app_access_token,
                                ];
                                $apiStatus                          = TRUE;
                                $apiMessage                         = 'SignIn Successfully !!!';
                            } else {
                                $userActivityData = [
                                    'user_email'        => $email,
                                    'user_name'         => $checkUser->name,
                                    'user_type'         => $checkUser->user_type,
                                    'ip_address'        => $this->request->getIPAddress(),
                                    'activity_type'     => 0,
                                    'activity_details'  => 'Invalid Password',
                                ];
                                $this->common_model->save_data('user_activities', $userActivityData, '','activity_id');
                                $apiStatus                          = FALSE;
                                $apiMessage                         = 'Invalid Password !!!';
                            }
                        } else {
                            $userActivityData = [
                                'user_email'        => $checkUser->email,
                                'user_name'         => $checkUser->name,
                                'user_type'         => $checkUser->user_type,
                                'ip_address'        => $this->request->getIPAddress(),
                                'activity_type'     => 0,
                                'activity_details'  => 'Admin Not Verified Yet',
                            ];
                            $this->common_model->save_data('user_activities', $userActivityData, '','activity_id');
                            $apiStatus                              = FALSE;
                            $apiMessage                             = 'You Account Is Not Verified Yet !!!';
                        }
                    } else {
                        $userActivityData = [
                            'user_email'        => $email,
                            'user_name'         => $checkUser->name,
                            'user_type'         => $checkUser->user_type,
                            'ip_address'        => $this->request->getIPAddress(),
                            'activity_type'     => 0,
                            'activity_details'  => 'Sorry ! Account Is Deleted',
                        ];
                        $this->common_model->save_data('user_activities', $userActivityData, '','activity_id');
                        $apiStatus                          = FALSE;
                        $apiMessage                         = 'Sorry ! Account Is Deleted !!!';
                    }
                } else {
                    $userActivityData = [
                        'user_email'        => $email,
                        'user_name'         => '',
                        'user_type'         => '',
                        'ip_address'        => $this->request->getIPAddress(),
                        'activity_type'     => 0,
                        'activity_details'  => 'We Don\'t Recognize Your Email Address',
                    ];
                    $this->common_model->save_data('user_activities', $userActivityData, '','activity_id');
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
            $requestData        = $request->all();
            Helper::pr($requestData);
            
        }
        public function signInWithPassword(Request $request){
            $apiStatus          = TRUE;
            $apiMessage         = '';
            $apiResponse        = [];
            $apiExtraField      = '';
            $apiExtraData       = '';
            $requestData        = $request->all();
            Helper::pr($requestData);
            
        }
    /* signin */
    /* forgot password */
        public function forgotPassword(Request $request){
            $apiStatus          = TRUE;
            $apiMessage         = '';
            $apiResponse        = [];
            $apiExtraField      = '';
            $apiExtraData       = '';
            $requestData        = $request->all();
            Helper::pr($requestData);
            
        }
        public function verifyOtp(Request $request){
            $apiStatus          = TRUE;
            $apiMessage         = '';
            $apiResponse        = [];
            $apiExtraField      = '';
            $apiExtraData       = '';
            $requestData        = $request->all();
            Helper::pr($requestData);
            
        }
        public function resetPassword(Request $request){
            $apiStatus          = TRUE;
            $apiMessage         = '';
            $apiResponse        = [];
            $apiExtraField      = '';
            $apiExtraData       = '';
            $requestData        = $request->all();
            Helper::pr($requestData);
            
        }
    /* forgot password */
}
