<?php
namespace App\Http\Controllers\Admin;
use App\Models\GeneralSetting;
use App\Models\DeleteAccountRequest;
use App\Models\SpaBookingTracking;
use App\Models\User;

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
        public function getAccessToken($credentialsPath) {
            $client = new Client();
            $client->setAuthConfig($credentialsPath);
            $client->addScope('https://www.googleapis.com/auth/cloud-platform');
            $client->setAccessType('offline');

            $client->fetchAccessTokenWithAssertion();

            return $client->getAccessToken();
        }

        public function sendFCMMessage($accessToken, $projectId, $message) {
            $url = "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send";

            $headers = [
                'Authorization: Bearer ' . $accessToken['access_token'],
                'Content-Type: application/json',
            ];

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));

            $response = curl_exec($ch);

            if ($response === false) {
                throw new Exception(curl_error($ch));
            }

            curl_close($ch);

            return $response;
        }
        public function sendTestPushNotification(){
            try {
                $credentialsPath = public_path('uploads/ccfc-83373-firebase-adminsdk-qauj0-66a7cd8a2f.json'); // Replace with the path to your service account JSON file
                // echo $credentialsPath;die;
                $projectId = 'ccfc-83373'; // Replace with your Firebase project ID

                // Get access token
                $accessToken = $this->getAccessToken($credentialsPath);

                // Define your message payload
                $message = [
                    'message' => [
                        'token' => 'fMHT0VEyTBWvB3zBONkLFE:APA91bH1RbrQ4aMrHSbqZBXBeYVMuay5MUW1t32UDQ3hxAtprWd_YFpBxOlHwITJOPpnkgTlqZgMu4XY_JrEMX0Y4Y9mg20eMBdAmGV7V1xBuoPuBtjRtrjvRalAvisiIlkPtd60n6RW', // Replace with the recipient device token
                        'notification' => [
                            'title' => 'Hello',
                            'body' => 'World subhomoy joydeep ccfc ' . date('Y-m-d H:i:s')
                        ]
                    ]
                ];

                // Send FCM message
                $response = $this->sendFCMMessage($accessToken, $projectId, $message);

                // echo "Response: " . $response;
                return redirect()->to('admin/create/settinglist')->with('status', "Response: " . $response);
            } catch (Exception $e) {
                // echo "Error: " . $e->getMessage();
                return redirect()->to('admin/create/settinglist')->with('error_message', "Error: " . $e->getMessage());
            }
        }
    /* send push notification */
}