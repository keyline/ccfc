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
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function seoSetting(Request $request)
    {
        $postData = [
            'meta_title'        => $request->meta_title,
            'meta_description'  => $request->meta_description,
        ];
        GeneralSetting::where('id', '=', 1)->update($postData);
        return redirect()->to('admin/settings/list')->with('status','SEO Settings Updated Successfully');
    }
    
}