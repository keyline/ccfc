<?php
namespace App\Http\Controllers\Admin;
use App\Models\GeneralSetting;
use App\Models\CookingDaySpecial;
use App\Models\CookingDaySpecialImage;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Helpers\Helper;

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
                $fields = [
                    'menu_date'                     => $postData['menu_date'],
                    'title'                         => $postData['title'],
                    'description'                   => $postData['description'],
                ];
                CookingDaySpecial::insert($fields);
                $menu_date = $postData['menu_date'];
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
                $fields = [
                    'menu_date'                     => $postData['menu_date'],
                    'title'                         => $postData['title'],
                    'description'                   => $postData['description'],
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
}