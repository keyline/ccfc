<?php
namespace App\Http\Controllers\Admin;
use App\Models\GeneralSetting;
use App\Models\DeleteAccountRequest;
use App\Models\SpaBookingTracking;
use App\Models\User;
use App\Models\UserDevice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Helpers\Helper;

// require 'vendor/autoload.php';

use Google\Client;
use Google\Service\FirebaseCloudMessaging;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = GeneralSetting::find(1);
        return view('admin.settings.list',compact('setting'));
    }
    public function generalSetting(Request $request)
    {
        $setting = GeneralSetting::find(1);
        /* site logo */
            // $imageFile      = $request->file('site_logo');
            // if($imageFile != ''){
            //     $imageName      = $imageFile->getClientOriginalName();
            //     $uploadedFile   = $this->upload_single_file('site_logo', $imageName, '', 'image');
            //     if($uploadedFile['status']){
            //         $site_logo = $uploadedFile['newFilename'];
            //     } else {
            //         return redirect()->back()->with(['error_message' => $uploadedFile['message']]);
            //     }
            // } else {
            //     $site_logo = $setting->site_logo;
            // }
        /* site logo */
        /* site footer logo */
            // $imageFile      = $request->file('site_footer_logo');
            // if($imageFile != ''){
            //     $imageName      = $imageFile->getClientOriginalName();
            //     $uploadedFile   = $this->upload_single_file('site_footer_logo', $imageName, '', 'image');
            //     if($uploadedFile['status']){
            //         $site_footer_logo = $uploadedFile['newFilename'];
            //     } else {
            //         return redirect()->back()->with(['error_message' => $uploadedFile['message']]);
            //     }
            // } else {
            //     $site_footer_logo = $setting->site_footer_logo;
            // }
        /* site footer logo */
        /* site favicon */
            // $imageFile      = $request->file('site_favicon');
            // if($imageFile != ''){
            //     $imageName      = $imageFile->getClientOriginalName();
            //     $uploadedFile   = $this->upload_single_file('site_favicon', $imageName, '', 'image');
            //     if($uploadedFile['status']){
            //         $site_favicon = $uploadedFile['newFilename'];
            //     } else {
            //         return redirect()->back()->with(['error_message' => $uploadedFile['message']]);
            //     }
            // } else {
            //     $site_favicon = $setting->site_favicon;
            // }
        /* site favicon */
        $postData = [
            'site_name'                     => $request->site_name,
            'site_phone'                    => $request->site_phone,
            'site_mail'                     => $request->site_mail,
            'system_email'                  => $request->system_email,
            'account_email'                 => $request->account_email,
            'site_url'                      => $request->site_url,
            'site_address'                  => $request->site_address,
            'clubman_api_token'             => $request->clubman_api_token,
            'item_reporting_time_in_hrs'    => $request->item_reporting_time_in_hrs,
            'site_timings'                  => $request->site_timings,
            'spa_booking_days'              => $request->spa_booking_days,
            'spa_booking_timings'           => $request->spa_booking_timings,
            'spa_booking_phone'             => $request->spa_booking_phone,
            'gym_booking_phone1'            => $request->gym_booking_phone1,
            'gym_booking_phone2'            => $request->gym_booking_phone2,
            'theme_color'                   => $request->theme_color,
            'font_color'                    => $request->font_color,
            'twitter_profile'               => $request->twitter_profile,
            'facebook_profile'              => $request->facebook_profile,
            'instagram_profile'             => $request->instagram_profile,
            'linkedin_profile'              => $request->linkedin_profile,
            'youtube_profile'               => $request->youtube_profile,
            // 'site_logo'                     => $site_logo,
            // 'site_footer_logo'              => $site_footer_logo,
            // 'site_favicon'                  => $site_favicon
        ];
        // Helper::pr($postData);
        GeneralSetting::where('id', '=', 1)->update($postData);
        return redirect()->to('admin/create/settinglist')->with('status','General Settings Updated Successfully');
    }
    public function smsSetting(Request $request)
    {
        $postData = [
            'sms_authentication_key'        => $request->sms_authentication_key,
            'sms_authentication_password'   => $request->sms_authentication_password,
            'sms_sender_id'                 => $request->sms_sender_id,
            'sms_base_url'                  => $request->sms_base_url
        ];
        GeneralSetting::where('id', '=', 1)->update($postData);
        return redirect()->to('admin/create/settinglist')->with('status','SMS Settings Updated Successfully');
    }
    public function emailSetting(Request $request)
    {
        $postData = [
            'from_email'        => $request->from_email,
            'from_name'         => $request->from_name,
            'smtp_host'         => $request->smtp_host,
            'smtp_username'     => $request->smtp_username,
            'smtp_password'     => $request->smtp_password,
            'smtp_port'         => $request->smtp_port
        ];
        GeneralSetting::where('id', '=', 1)->update($postData);
        return redirect()->to('admin/create/settinglist')->with('status','Email Settings Updated Successfully');
    }
    public function seoSetting(Request $request)
    {
        $postData = [
            'meta_title'        => $request->meta_title,
            'meta_description'  => $request->meta_description
        ];
        GeneralSetting::where('id', '=', 1)->update($postData);
        return redirect()->to('admin/create/settinglist')->with('status','SEO Settings Updated Successfully');
    }
    public function spaBookingTrackingList()
    {
        $spaBookings = SpaBookingTracking::orderBy('id', 'DESC')->get();
        return view('admin.settings.spa-booking-tracking-list',compact('spaBookings'));
    }
    public function deleteAccountRequests()
    {
        $deleteAccountRequests = DeleteAccountRequest::orderBy('id', 'DESC')->get();
        return view('admin.settings.delete-account-request-list',compact('deleteAccountRequests'));
    }
    public function deleteAccountRequestsAction($id, $status)
    {
        $fields = [
            'status'               => $status,
            'approve_date'         => date('Y-m-d H:i:s'),
        ];
        if($status == 1){
            $getDeleteRequest = DeleteAccountRequest::where('id', '=', $id)->first();
            User::where('email', '=', $getDeleteRequest->email)->update(['status' => 'DELETED']);
            $msg = 'Approved';
        } else {
            $msg = 'Rejected';
        }
        DeleteAccountRequest::where('id', '=', $id)->update($fields);
        return redirect("admin/create/deleteaccountrequests")->with('success_message', 'Delete Account Request ' . $msg . ' Successfully !!!');
    }
    public function sendTestEmail(){
        /* send email */
            $generalSettings    = GeneralSetting::find(1);
            $subject            = $generalSettings->site_name.' :: test Email '.date('Y-m-d H:i:s');
            $message            = "This is for testing email using smtp.";
            // echo $message;die;
            if($this->sendMail($generalSettings->system_email, $subject, $message)){
                return redirect()->to('admin/create/settinglist')->with('status','Test Email Send Successfully');
            } else {
                return redirect()->to('admin/create/settinglist')->with('error_message','Test Email Not Send Successfully');
            }
        /* send email */
    }
    /* send push notification */
        public function sendTestPushNotification(){
            $title              = 'Hi push notification';
            $body               = 'World subhomoy joydeep ccfc ' . date('Y-m-d H:i:s');
            
            $getUserFCMTokens   = UserDevice::select('fcm_token')->where('fcm_token', '!=', '')->get();
            $tokens             = [];
            if($getUserFCMTokens){
                foreach($getUserFCMTokens as $getUserFCMToken){
                    $response           = $this->sendCommonPushNotification($getUserFCMToken->fcm_token, $title, $body);
                }
            }
            return redirect()->to('admin/create/settinglist')->with('status', "Response: " . $response);
        }
    /* send push notification */
}