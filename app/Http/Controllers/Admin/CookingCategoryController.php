<?php
namespace App\Http\Controllers\Admin;
use App\Models\GeneralSetting;
use App\Models\CookingCategory;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Helpers\Helper;

class CookingCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting    = GeneralSetting::find(1);
        $rows       = CookingCategory::where('status', '!=', 3)->orderBy('id', 'DESC')->get();
        return view('admin.cooking-category.list',compact('setting', 'rows'));
    }
    public function add()
    {
        $setting    = GeneralSetting::find(1);
        $row        = [];
        if($request->isMethod('post')){
            $postData = $request->all();
            $rules = [
                'for_cat'                   => 'required',
                'name'                      => 'required',
            ];
            if($this->validate($request, $rules)){
                $fields = [
                    'for_cat'               => $postData['for_cat'],
                    'name'                  => $postData['name'],
                ];
                CookingCategory::insert($fields);
                return redirect("admin/create/cookingcategorylist")->with('success_message', 'Cooking Category Inserted Successfully !!!');
            } else {
                return redirect()->back()->with('error_message', 'All Fields Required !!!');
            }
        }
        return view('admin.cooking-category.add-edit',compact('setting', 'row'));
    }
    public function edit($id)
    {
        $setting    = GeneralSetting::find(1);
        $row        = CookingCategory::where('id', '=', $id)->first();
        if($request->isMethod('post')){
            $postData = $request->all();
            $rules = [
                'for_cat'                   => 'required',
                'name'                      => 'required',
            ];
            if($this->validate($request, $rules)){
                $fields = [
                    'for_cat'               => $postData['for_cat'],
                    'name'                  => $postData['name'],
                ];
                CookingCategory::where('id', '=', $id)->update($fields);
                return redirect("admin/create/cookingcategorylist")->with('success_message', 'Cooking Category Updated Successfully !!!');
            } else {
                return redirect()->back()->with('error_message', 'All Fields Required !!!');
            }
        }
        return view('admin.cooking-category.add-edit',compact('setting', 'row'));
    }
    public function destroy($id)
    {
        $fields = [
            'status'               => 3
        ];
        CookingCategory::where('id', '=', $id)->update($fields);
        return redirect("admin/create/cookingcategorylist")->with('success_message', 'Cooking Category Deleted Successfully !!!');
    }
}