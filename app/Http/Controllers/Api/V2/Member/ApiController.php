<?php
namespace App\Http\Controllers\Api\V2\Member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Country;

use Auth;
use App\Helpers\Helper;

class ApiController extends Controller
{
    public function signinWithMobile(Request $request){
        $apiStatus          = TRUE;
        $apiMessage         = '';
        $apiResponse        = [];
        $apiExtraField      = '';
        $apiExtraData       = '';
        $requestData        = $request->all();
        Helper::pr($requestData);
        
        // if($requestData['key'] == env('PROJECT_KEY')){
        //     $id         = $requestData['id'];
        //     $otp        = $requestData['otp1'].$requestData['otp2'].$requestData['otp3'].$requestData['otp4'];
        //     $getUser    = User::where('id', '=', $id)->first();
        //     if($getUser){
                
        //     } else {
        //         $apiStatus          = FALSE;
        //         http_response_code(400);
        //         $apiMessage         = 'User Not Found !!!';
        //         $apiExtraField      = 'response_code';
        //         $apiExtraData       = http_response_code();
        //     }
        // } else {
        //     http_response_code(400);
        //     $apiStatus          = FALSE;
        //     $apiMessage         = $this->getResponseCode(http_response_code());
        //     $apiExtraField      = 'response_code';
        //     $apiExtraData       = http_response_code();
        // }
        // $this->response_to_json($apiStatus, $apiMessage, $apiResponse, $apiExtraField, $apiExtraData);
    }
    
}
