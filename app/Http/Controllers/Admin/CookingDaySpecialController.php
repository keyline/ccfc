<?php
namespace App\Http\Controllers\Admin;
use App\Models\GeneralSetting;
use App\Models\CookingDaySpecial;
use App\Models\CookingDaySpecialImage;
use App\Models\UserDevice;
use App\Models\Notification;
use App\Models\UserNotification;
use App\Models\User;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Helpers\Helper;
date_default_timezone_set("Asia/Kolkata");
class CookingDaySpecialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting    = GeneralSetting::find(1);
        $rows       = CookingDaySpecial::where('status', '!=', 3)->orderBy('id', 'DESC')->get();
        return view('admin.cooking-day-special.list',compact('setting', 'rows'));
    }
    public function add(Request $request)
    {
        $setting    = GeneralSetting::find(1);
        $row        = [];
        if($request->isMethod('post')){
            $postData = $request->all();
            $rules = [
                'menu_date'                         => 'required',
                'title'                             => 'required',
            ];
            if($this->validate($request, $rules)){
                /* image */
                    $imageFile      = $request->file('image_name');
                    if($imageFile != ''){
                        $imageName      = $imageFile->getClientOriginalName();
                        $uploadedFile   = $this->upload_single_file('image_name', $imageName, '', 'image');
                        if($uploadedFile['status']){
                            $image_name = $uploadedFile['newFilename'];
                        } else {
                            return redirect()->back()->with(['error_message' => $uploadedFile['message']]);
                        }
                    } else {
                        return redirect()->back()->with(['error_message' => 'Please upload image']);
                    }
                /* image */
                $fields = [
                    'menu_date'                     => $postData['menu_date'],
                    'title'                         => $postData['title'],
                    'description'                   => $postData['description'],
                    'image_name'                    => $image_name,
                ];
                // Helper::pr($fields);
                $ref_id = CookingDaySpecial::insertGetId($fields);
                $menu_date = $postData['menu_date'];
                /* insert notification */
                    $fields = [
                        'type'          => 'dayspecial',
                        'title'         => $postData['title'],
                        'description'   => $postData['description'],
                        'ref_id'        => $ref_id,
                    ];
                    $notification_id = Notification::insertGetId($fields);
                    $users = User::select('id')->orderBy('id', 'ASC')->get();
                    if($users){
                        foreach($users as $user){
                            $fields2 = [
                                'user_id'                   => $user->id,
                                'notification_id'           => $notification_id,
                                'ref_id'                    => $ref_id,
                            ];
                            UserNotification::insert($fields2);
                        }
                    }
                /* insert notification */
                /* push notification */
                    $title              = $postData['title'];
                    $body               = '';
                    $image              = env('UPLOADS_URL').$image_name;
                    $type               = 'dayspecial';
                    $getUserFCMTokens   = UserDevice::select('fcm_token')->where('fcm_token', '!=', '')->groupBy('fcm_token')->get();
                    $tokens             = [];
                    if($getUserFCMTokens){
                        foreach($getUserFCMTokens as $getUserFCMToken){
                            $response           = $this->sendCommonPushNotification($getUserFCMToken->fcm_token, $title, $body, $type, $image);
                        }
                    }
                /* push notification */
                return redirect("admin/create/dayspeciallist")->with('success_message', 'Cooking Day Special Inserted Successfully For ' . $menu_date . ' !!!');
            } else {
                return redirect()->back()->with('error_message', 'All Fields Required !!!');
            }
        }
        return view('admin.cooking-day-special.add-edit',compact('setting', 'row'));
    }
    public function edit(Request $request, $id)
    {
        $setting    = GeneralSetting::find(1);
        $row        = CookingDaySpecial::where('id', '=', $id)->first();
        if($request->isMethod('post')){
            $postData = $request->all();
            $rules = [
                'menu_date'                         => 'required',
                'title'                             => 'required',
            ];
            if($this->validate($request, $rules)){
                /* image */
                    $imageFile      = $request->file('image_name');
                    if($imageFile != ''){
                        $imageName      = $imageFile->getClientOriginalName();
                        $uploadedFile   = $this->upload_single_file('image_name', $imageName, '', 'image');
                        if($uploadedFile['status']){
                            $image_name = $uploadedFile['newFilename'];
                        } else {
                            return redirect()->back()->with(['error_message' => $uploadedFile['message']]);
                        }
                    } else {
                        $image_name = $row->image_name;
                    }
                /* image */
                $fields = [
                    'menu_date'                     => $postData['menu_date'],
                    'title'                         => $postData['title'],
                    'description'                   => $postData['description'],
                    'image_name'                    => $image_name,
                ];
                CookingDaySpecial::where('id', '=', $id)->update($fields);
                $menu_date = $postData['menu_date'];
                return redirect("admin/create/dayspeciallist")->with('success_message', 'Cooking Day Special Updated Successfully For ' . $menu_date . ' !!!');
            } else {
                return redirect()->back()->with('error_message', 'All Fields Required !!!');
            }
        }
        return view('admin.cooking-day-special.add-edit',compact('setting', 'row'));
    }
    public function destroy($id)
    {
        $fields = [
            'status'               => 3
        ];
        CookingDaySpecial::where('id', '=', $id)->update($fields);
        return redirect("admin/create/dayspeciallist")->with('success_message', 'Cooking Day Special Deleted Successfully !!!');
    }
    public function deactive($id)
    {
        $fields = [
            'status'               => 0
        ];
        CookingDaySpecial::where('id', '=', $id)->update($fields);
        /* notification delete */
            $getNotification = Notification::where('ref_id', '=', $id)->where('type', '=', 'dayspecial')->first();
            if($getNotification){
                $noti_id = $getNotification->id;
                UserNotification::where('ref_id', '=', $id)->where('notification_id', '=', $noti_id)->delete();
                Notification::where('ref_id', '=', $id)->where('type', '=', 'dayspecial')->delete();
            }
        /* notification delete */
        return redirect("admin/create/dayspeciallist")->with('success_message', 'Cooking Day Special Deactivated Successfully !!!');
    }
}