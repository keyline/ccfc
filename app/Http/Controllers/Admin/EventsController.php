<?php

namespace App\Http\Controllers\Admin;

use App\Models\Events;

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
        $event = Events::all();

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
        $event = new Events;
        $event->day = $request->input('day');        
        $event->month = $request->input('month');
        $event->details_1 = $request->input('event_details1');
        $event->details_2 = $request->input('event_details2');

        if($request->hasfile('enentimage')){

            $file = $request->file('enentimage');

            $extention = $file->getClientOriginalExtension();

            $filename = time().'.'.$extention;

            $file->move('uploads/enentimg/',$filename);

            $event->event_image = $filename;
        }

        $event->save();

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
        $event = Events::find($id);
        
        $event->day = $request->input('day');
        $event->month = $request->input('month');
        $event->details_1 = $request->input('event_details1');
        $event->details_2 = $request->input('event_details2');

        if($request->hasfile('eventimage')){

            $destination = 'uploads/enentimg/'.$event->event_image;

            if(File::exists($destination)){

                File::delete($destination);
            }

            $file = $request->file('eventimage');

            $extention = $file->getClientOriginalExtension();

            $filename = time().'.'.$extention;

            $file->move('uploads/enentimg/',$filename);

            $event->event_image = $filename;
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