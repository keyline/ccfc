<?php
namespace App\Http\Controllers\Admin;
use App\Models\Contactlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
class ContactlistsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contactlists = Contactlist::orderBy('id', 'DESC')->get();
        return view('admin.contactlists.index',compact('contactlists'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.contactlists.create');
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
        return redirect()->to('admin/create/contactlist')->with('status','Saved successfully');
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
        $contactlist = Contactlist::find($id);
        return view('admin.contactlists.edit',compact('contactlist'));
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
        $contactlist = Contactlist::find($id);
        
        $contactlist->department_name = $request->input('department_name');
        $contactlist->department_email = $request->input('department_email');
        $contactlist->update();
        return redirect()->to('admin/create/contactlist')->with('status','Updated successfully');        
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Events  $events
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contactlist $events,$id)
    {
        $contactlist = Contactlist::find($id);        
        $contactlist->delete();
        return redirect()->back()->with('status','Deleted successfully');
    }
}