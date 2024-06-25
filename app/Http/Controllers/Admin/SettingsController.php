<?php
namespace App\Http\Controllers\Admin;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Helpers\Helper;

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
            'site_url'                      => $request->site_url,
            'site_address'                  => $request->site_address,
            'site_timings'                  => $request->site_timings,
            'spa_timings'                   => $request->spa_timings,
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
    
}