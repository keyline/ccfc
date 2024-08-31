<?php
namespace App\Http\Controllers\Admin;
use App\Models\GeneralSetting;
use App\Models\OtherFoodItem;
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
class OtherFoodItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting    = GeneralSetting::find(1);
        $rows       = OtherFoodItem::where('status', '!=', 3)->orderBy('id', 'DESC')->get();
        return view('admin.other-food-item.list',compact('setting', 'rows'));
    }
    public function add(Request $request)
    {
        $setting    = GeneralSetting::find(1);
        $row        = [];
        if($request->isMethod('post')){
            $postData = $request->all();
            $rules = [
                'name'                         => 'required',
                'description'                  => 'required',
                'validity'                     => 'required',
            ];
            if($this->validate($request, $rules)){
                /* image */
                    $imageFile      = $request->file('food_image');
                    if($imageFile != ''){
                        $imageName      = $imageFile->getClientOriginalName();
                        $uploadedFile   = $this->upload_single_file('food_image', $imageName, '', 'image');
                        if($uploadedFile['status']){
                            $food_image = $uploadedFile['newFilename'];
                        } else {
                            return redirect()->back()->with(['error_message' => $uploadedFile['message']]);
                        }
                    } else {
                        return redirect()->back()->with(['error_message' => 'Please upload image']);
                    }
                /* image */
                $fields = [
                    'name'                          => $postData['name'],
                    'description'                   => $postData['description'],
                    'validity'                      => date_format(date_create($postData['validity']), "Y-m-d"),
                    'food_image'                    => $food_image,
                    'created_at'                    => date('Y-m-d H:i:s'),
                    'updated_at'                    => date('Y-m-d H:i:s'),
                ];
                // Helper::pr($fields);
                $ref_id = OtherFoodItem::insertGetId($fields);
                /* insert notification */
                    $fields = [
                        'type'          => 'outsideitem',
                        'title'         => $postData['name'],
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
                    $title              = $postData['name'];
                    $body               = '';
                    $image              = env('UPLOADS_URL').$food_image;
                    $type               = 'outsideitem';
                    $getUserFCMTokens   = UserDevice::select('fcm_token')->where('fcm_token', '!=', '')->groupBy('fcm_token')->get();
                    $tokens             = [];
                    if($getUserFCMTokens){
                        foreach($getUserFCMTokens as $getUserFCMToken){
                            $response           = $this->sendCommonPushNotification($getUserFCMToken->fcm_token, $title, $body, $type, $image);
                        }
                    }
                /* push notification */
                return redirect("admin/create/otherfooditemlist")->with('success_message', 'Other Food Item Inserted Successfully !!!');
            } else {
                return redirect()->back()->with('error_message', 'All Fields Required !!!');
            }
        }
        return view('admin.other-food-item.add-edit',compact('setting', 'row'));
    }
    public function edit(Request $request, $id)
    {
        $setting    = GeneralSetting::find(1);
        $row        = OtherFoodItem::where('id', '=', $id)->first();
        if($request->isMethod('post')){
            $postData = $request->all();
            $rules = [
                'name'                         => 'required',
                'description'                  => 'required',
                'validity'                     => 'required',
            ];
            if($this->validate($request, $rules)){
                /* image */
                    $imageFile      = $request->file('food_image');
                    if($imageFile != ''){
                        $imageName      = $imageFile->getClientOriginalName();
                        $uploadedFile   = $this->upload_single_file('food_image', $imageName, '', 'image');
                        if($uploadedFile['status']){
                            $food_image = $uploadedFile['newFilename'];
                        } else {
                            return redirect()->back()->with(['error_message' => $uploadedFile['message']]);
                        }
                    } else {
                        $food_image = $row->food_image;
                    }
                /* image */
                $fields = [
                    'name'                          => $postData['name'],
                    'description'                   => $postData['description'],
                    'validity'                      => date_format(date_create($postData['validity']), "Y-m-d"),
                    'food_image'                    => $food_image,
                    'created_at'                    => date('Y-m-d H:i:s'),
                    'updated_at'                    => date('Y-m-d H:i:s'),
                ];
                OtherFoodItem::where('id', '=', $id)->update($fields);
                return redirect("admin/create/otherfooditemlist")->with('success_message', 'Other Food Item Updated Successfully !!!');
            } else {
                return redirect()->back()->with('error_message', 'All Fields Required !!!');
            }
        }
        return view('admin.other-food-item.add-edit',compact('setting', 'row'));
    }
    public function destroy($id)
    {
        $fields = [
            'status'               => 3
        ];
        OtherFoodItem::where('id', '=', $id)->update($fields);
        return redirect("admin/create/otherfooditemlist")->with('success_message', 'Other Food Item Deleted Successfully !!!');
    }
    public function deactive($id)
    {
        $fields = [
            'status'               => 0
        ];
        OtherFoodItem::where('id', '=', $id)->update($fields);
        /* notification delete */
            $getNotification = Notification::where('ref_id', '=', $id)->where('type', '=', 'outsideitem')->first();
            if($getNotification){
                $noti_id = $getNotification->id;
                UserNotification::where('ref_id', '=', $id)->where('notification_id', '=', $noti_id)->delete();
                Notification::where('ref_id', '=', $id)->where('type', '=', 'outsideitem')->delete();
            }
        /* notification delete */
        return redirect("admin/create/otherfooditemlist")->with('success_message', 'Other Food Item Deactivated Successfully !!!');
    }
}