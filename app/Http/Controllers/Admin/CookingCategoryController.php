<?php
namespace App\Http\Controllers\Admin;
use App\Models\GeneralSetting;
use App\Models\CookingCategory;
use Illuminate\Http\Request;
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
    
    public function seoSetting(Request $request)
    {
        $postData = [
            'meta_title'        => $request->meta_title,
            'meta_description'  => $request->meta_description
        ];
        GeneralSetting::where('id', '=', 1)->update($postData);
        return redirect()->to('admin/create/settinglist')->with('status','SEO Settings Updated Successfully');
    }
    
}