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
        $settings = GeneralSetting::find(1);
        return view('admin.settings.list',compact('settings'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.settings.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contactlist = new Contactlist;
        $contactlist->department_name = $request->input('department_name');        
        $contactlist->department_email = $request->input('department_email');
        $contactlist->save();        
        return redirect()->to('admin/settings/list')->with('status','Saved successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Events  $events
     * @return \Illuminate\Http\Response
     */
    public function show(Contactlist $events)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Events  $events
     * @return \Illuminate\Http\Response
     */
    public function edit(Contactlist $contactlists,$id)
    {
        $contactlist = GeneralSetting::find($id);
        return view('admin.settings.edit',compact('contactlist'));
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
        $contactlist = GeneralSetting::find($id);
        
        $contactlist->department_name = $request->input('department_name');
        $contactlist->department_email = $request->input('department_email');
        $contactlist->update();
        return redirect()->to('admin/settings/list')->with('status','Updated successfully');        
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Events  $events
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contactlist $events,$id)
    {
        $contactlist = GeneralSetting::find($id);        
        $contactlist->delete();
        return redirect()->back()->with('status','Deleted successfully');
    }
}