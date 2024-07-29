<?php

namespace App\Http\Controllers\Admin;

use App\Models\Events;
use App\Models\UserDevice;
use App\Models\Notification;
use App\Models\UserNotification;
use App\Models\User;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\File;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $event = Events::all();

        $event = Events::orderBy('id', 'DESC')->get();

        return view('admin.event.index',compact('event'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.event.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event              = new Events;
        $event->day         = $request->input('day');        
        $event->month       = $request->input('month');
        $event->event_name  = $request->input('event_name');
        $event->details_1   = $request->input('event_details1');
        $event->details_2   = $request->input('event_details2');
        $event->validity    = $request->input('validity');

        if($request->hasfile('enentimage')){

            $file1 = $request->file('enentimage');

            // $extention = $file1->getClientOriginalExtension();

            // $filename = time().'.'.$extention;


            $filename= date('YmdHi').$file1->getClientOriginalName();

            $file1->move('uploads/enentimg/',$filename);

            $event->event_image = $filename;
        }

        if($request->hasfile('event_image_2')){

            $file2 = $request->file('event_image_2');

            $extention1 = $file2->getClientOriginalExtension();

            $filename1 = time().'.'.$extention1;

            $file2->move('uploads/enentimg/',$filename1);

            $event->event_image_2 = $filename1;
        }

        $event->save();
        /* insert notification */
            $fields = [
                'type'          => 'event',
                'title'         => $request->input('event_name'),
                'description'   => $request->input('event_details1'),
            ];
            $notification_id = Notification::insertGetId($fields);
            $users = User::select('id')->orderBy('id', 'ASC')->get();
            if($users){
                foreach($users as $user){
                    $fields2 = [
                        'user_id'                   => $user->id,
                        'notification_id'           => $notification_id
                    ];
                    UserNotification::insert($fields2);
                }
            }
        /* insert notification */
        /* push notification */
            $title              = $request->input('event_name');
            $body               = strip_tags($request->input('event_details1'));
            $type               = 'event';
            $getUserFCMTokens   = UserDevice::select('fcm_token')->where('fcm_token', '!=', '')->get();
            $tokens             = [];
            if($getUserFCMTokens){
                foreach($getUserFCMTokens as $getUserFCMToken){
                    $response           = $this->sendCommonPushNotification($getUserFCMToken->fcm_token, $title, $body, $type);
                }
            }
        /* push notification */
        return redirect()->back()->with('status','Save successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Events  $events
     * @return \Illuminate\Http\Response
     */
    public function show(Events $events)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Events  $events
     * @return \Illuminate\Http\Response
     */
    public function edit(Events $events,$id)
    {
        $event = Events::find($id);
        return view('admin.event.edit',compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Events  $events
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $event              = Events::find($id);
        
        $event->day         = $request->input('day');
        $event->month       = $request->input('month');
        $event->event_name  = $request->input('event_name');
        $event->details_1   = $request->input('event_details1');
        $event->details_2   = $request->input('event_details2');
        $event->validity    = $request->input('validity');

        if($request->hasfile('eventimage')){

            $destination = 'uploads/enentimg/'.$event->event_image;

            if(File::exists($destination)){

                File::delete($destination);
            }

            $file1 = $request->file('eventimage');


            // $extention = $file1->getClientOriginalExtension();

            // $filename = time().'.'.$extention;
            

            $filename= date('YmdHi').$file1->getClientOriginalName();

            $file1->move('uploads/enentimg/',$filename);

            $event->event_image = $filename;
        }



        if($request->hasfile('event_image_2')){

            $destination = 'uploads/enentimg/'.$event->event_image_2;

            if(File::exists($destination)){

                File::delete($destination);
            }

            $file2 = $request->file('event_image_2');

            $extention = $file2->getClientOriginalExtension();

            $filename = time().'.'.$extention;

            $file2->move('uploads/enentimg/',$filename);

            $event->event_image_2 = $filename;
        }

        $event->update();

        return redirect()->back()->with('status','Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Events  $events
     * @return \Illuminate\Http\Response
     */
    public function destroy(Events $events,$id)
    {
        $event = Events::find($id);
        $destination = 'uploads/enentimg/'.$event->event_image;

        if(File::exists($destination)){

            File::delete($destination);
        }

        $event->delete();

        return redirect()->back()->with('status','Delete successfully');
    }
}