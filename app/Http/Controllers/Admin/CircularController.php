<?php


namespace App\Http\Controllers\Admin;

use App\Models\circular;
use App\Models\UserDevice;
use App\Models\Notification;
use App\Models\UserNotification;
use App\Models\User;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\File;

class CircularController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $circular = circular::all();

        $circular = circular::orderBy('id', 'DESC')->get();

        return view('admin.circulars.index',compact('circular'));


        // return view('admin.circulars.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.circulars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $circular               = new circular;
        $circular->day          = $request->input('day');
        $circular->month        = $request->input('month');
        $circular->details_1    = $request->input('circular_details1');
        $circular->details_2    = $request->input('circular_details2');
        $circular->validity     = $request->input('validity');

        if($request->hasfile('circularimage')){

            $file1 = $request->file('circularimage');


            // $extention = $file1->getClientOriginalExtension();

            // $filename = time().'.'.$extention;
            

            $filename= date('YmdHi').$file1->getClientOriginalName();

            $file1->move('uploads/circularimg/',$filename);

            $circular->circular_image = $filename;
        }

        if($request->hasfile('circular_image2')){

            $file = $request->file('circular_image2');

            $extention = $file->getClientOriginalExtension();

            $filename = time().'.'.$extention;

            $file->move('uploads/circularimg/',$filename);

            $circular->circular_image2 = $filename;
        }

        $circular->save();
        $ref_id = $circular->id;
        /* insert notification */
            $fields = [
                'type'          => 'circular',
                'title'         => $request->input('circular_details1'),
                'description'   => $request->input('circular_details2'),
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
            $title              = $request->input('circular_details1');
            $body               = strip_tags($request->input('circular_details2'));

            $type               = 'circular';
            $getUserFCMTokens   = UserDevice::select('fcm_token')->where('fcm_token', '!=', '')->get();
            $tokens             = [];
            if($getUserFCMTokens){
                foreach($getUserFCMTokens as $getUserFCMToken){
                    $response           = $this->sendCommonPushNotification($getUserFCMToken->fcm_token, $title, $body, $type);
                }
            }
            // echo $body;die;
        /* push notification */
        return redirect()->back()->with('status','Save successfully');
        // $circular->circular_image = $request->input('circularimage');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\circular  $circular
     * @return \Illuminate\Http\Response
     */
    public function show(circular $circular)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\circular  $circular
     * @return \Illuminate\Http\Response
     */
    public function edit(circular $circular,$id)
    {

        $circular = circular::find($id);
        return view('admin.circulars.edit',compact('circular'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\circular  $circular
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, circular $circular)

    public function update(Request $request, $id)

    {
        $circular = circular::find($id);
        
        $circular->day          = $request->input('day');
        $circular->month        = $request->input('month');
        $circular->details_1    = $request->input('circular_details1');
        $circular->details_2    = $request->input('circular_details2');
        $circular->validity     = $request->input('validity');

        if($request->hasfile('circularimage')){

            $destination = 'uploads/circularimg/'.$circular->circular_image;

            if(File::exists($destination)){

                File::delete($destination);
            }

            $file1 = $request->file('circularimage');

            // $extention = $file1->getClientOriginalExtension();

            // $filename = time().'.'.$extention;

            $filename= date('YmdHi').$file1->getClientOriginalName();

            $file1->move('uploads/circularimg/',$filename);

            $circular->circular_image = $filename;
        }


        if($request->hasfile('circular_image2')){

            $destination = 'uploads/circularimg/'.$circular->circular_image2;

            if(File::exists($destination)){

                File::delete($destination);
            }

            $file = $request->file('circular_image2');

            $extention = $file->getClientOriginalExtension();

            $filename = time().'.'.$extention;

            $file->move('uploads/circularimg/',$filename);

            $circular->circular_image2 = $filename;
        }

        $circular->update();

        return redirect()->back()->with('status','Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\circular  $circular
     * @return \Illuminate\Http\Response
     */
    public function destroy(circular $circular,$id)
    {
        $circular = circular::find($id);
        $destination = 'uploads/circularimg/'.$circular->circular_image;

        if(File::exists($destination)){

            File::delete($destination);
        }

        $circular->delete();

        return redirect()->back()->with('status','Delete successfully');
    }
    public function deactive($id)
    {
        $fields = [
            'status'               => 0
        ];
        circular::where('id', '=', $id)->update($fields);
        /* notification delete */
            $getNotification = Notification::where('ref_id', '=', $id)->where('type', '=', 'circular')->first();
            if($getNotification){
                $noti_id = $getNotification->id;
                UserNotification::where('ref_id', '=', $id)->where('notification_id', '=', $noti_id)->delete();
                Notification::where('ref_id', '=', $id)->where('type', '=', 'circular')->delete();
            }
        /* notification delete */
        return redirect("admin/create/circulars")->with('success_message', 'Circular Deactivated Successfully !!!');
    }
}