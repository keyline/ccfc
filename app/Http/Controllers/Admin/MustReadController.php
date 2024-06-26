<?php
namespace App\Http\Controllers\Admin;
use App\Models\GeneralSetting;
use App\Models\MustRead;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Helpers\Helper;

class MustReadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting    = GeneralSetting::find(1);
        $rows       = MustRead::where('status', '!=', 3)->orderBy('id', 'DESC')->get();
        return view('admin.must-read.list',compact('setting', 'rows'));
    }
    public function add(Request $request)
    {
        $setting    = GeneralSetting::find(1);
        $row        = [];
        if($request->isMethod('post')){
            $postData = $request->all();
            $rules = [
                'title'                                     => 'required',
                'description'                               => 'required',
                'is_popup'                                  => 'required',
            ];
            if($this->validate($request, $rules)){
                $fields = [
                    'title'                                 => $postData['title'],
                    'description'                           => $postData['description'],
                    'is_popup'                              => $postData['is_popup'],
                    'popup_validity_date'                   => date_format(date_create($postData['popup_validity_date']), "Y-m-d"),
                    'popup_validity_time'                   => date_format(date_create($postData['popup_validity_time']), "H:i:s"),
                ];
                // Helper::pr($fields);
                MustRead::insert($fields);
                return redirect("admin/create/mustreadlist")->with('success_message', 'Must Read Content Inserted Successfully !!!');
            } else {
                return redirect()->back()->with('error_message', 'All Fields Required !!!');
            }
        }
        return view('admin.must-read.add-edit',compact('setting', 'row'));
    }
    public function edit(Request $request, $id)
    {
        $setting    = GeneralSetting::find(1);
        $row        = MustRead::where('id', '=', $id)->first();
        if($request->isMethod('post')){
            $postData = $request->all();
            $rules = [
                'title'                                     => 'required',
                'description'                               => 'required',
                'is_popup'                                  => 'required',
            ];
            if($this->validate($request, $rules)){
                $fields = [
                    'title'                                 => $postData['title'],
                    'description'                           => $postData['description'],
                    'is_popup'                              => $postData['is_popup'],
                    'popup_validity_date'                   => date_format(date_create($postData['popup_validity_date']), "Y-m-d"),
                    'popup_validity_time'                   => date_format(date_create($postData['popup_validity_time']), "H:i:s"),
                ];
                MustRead::where('id', '=', $id)->update($fields);
                return redirect("admin/create/mustreadlist")->with('success_message', 'Must Read Content Updated Successfully !!!');
            } else {
                return redirect()->back()->with('error_message', 'All Fields Required !!!');
            }
        }
        return view('admin.must-read.add-edit',compact('setting', 'row'));
    }
    public function destroy($id)
    {
        $fields = [
            'status'               => 3
        ];
        MustRead::where('id', '=', $id)->update($fields);
        return redirect("admin/create/mustreadlist")->with('success_message', 'Must Read Content Deleted Successfully !!!');
    }
}