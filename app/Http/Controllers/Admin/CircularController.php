<?php


namespace App\Http\Controllers\Admin;

use App\Models\circular;

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
        $event->validity        = $request->input('validity');

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
        $event->validity        = $request->input('validity');

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



    
}