<?php
namespace App\Http\Controllers\Admin;
use App\Models\GeneralSetting;
use App\Models\CookingCategory;
use App\Models\CookingItem;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Helpers\Helper;
Use DB;

class CookingItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting    = GeneralSetting::find(1);
        $rows       = DB::table('cooking_items')
                        ->select('cooking_items.*', 'cooking_categories.name as category_name')
                        ->join('cooking_categories','cooking_categories.id','=','cooking_items.category_id')
                        ->where(['cooking_items.status' => 1])
                        ->get();
        return view('admin.cooking-item.list',compact('setting', 'rows'));
    }
    public function add(Request $request)
    {
        $setting    = GeneralSetting::find(1);
        $row        = [];
        $cats       = CookingCategory::select('id', 'name', 'for_cat')->where('status', '=', 1)->get();
        if($request->isMethod('post')){
            $postData = $request->all();
            $rules = [
                'category_id'               => 'required',
                'name'                      => 'required',
                'rate'                      => 'required',
            ];
            if($this->validate($request, $rules)){
                $getCategory        = CookingCategory::where('id', '=', $postData['category_id'])->first();
                $fields = [
                    'for_cat'               => (($getCategory)?$getCategory->for_cat:''),
                    'category_id'           => $postData['category_id'],
                    'name'                  => $postData['name'],
                    'rate'                  => $postData['rate'],
                ];
                CookingItem::insert($fields);
                $for_cat = $postData['for_cat'];
                return redirect("admin/create/cookingitemlist")->with('success_message', 'Cooking Item Inserted Successfully For ' . $for_cat . ' !!!');
            } else {
                return redirect()->back()->with('error_message', 'All Fields Required !!!');
            }
        }
        return view('admin.cooking-item.add-edit',compact('setting', 'row', 'cats'));
    }
    public function edit(Request $request, $id)
    {
        $setting    = GeneralSetting::find(1);
        $row        = CookingItem::where('id', '=', $id)->first();
        $cats       = CookingCategory::select('id', 'name', 'for_cat')->where('status', '=', 1)->get();
        if($request->isMethod('post')){
            $postData = $request->all();
            $rules = [
                'category_id'               => 'required',
                'name'                      => 'required',
                'rate'                      => 'required',
            ];
            if($this->validate($request, $rules)){
                $getCategory        = CookingCategory::where('id', '=', $postData['category_id'])->first();
                $fields = [
                    'for_cat'               => (($getCategory)?$getCategory->for_cat:''),
                    'category_id'           => $postData['category_id'],
                    'name'                  => $postData['name'],
                    'rate'                  => $postData['rate'],
                ];
                CookingItem::where('id', '=', $id)->update($fields);
                $for_cat = $postData['for_cat'];
                return redirect("admin/create/cookingitemlist")->with('success_message', 'Cooking Item Updated Successfully For ' . $for_cat . ' !!!');
            } else {
                return redirect()->back()->with('error_message', 'All Fields Required !!!');
            }
        }
        return view('admin.cooking-item.add-edit',compact('setting', 'row', 'cats'));
    }
    public function destroy($id)
    {
        $fields = [
            'status'               => 3
        ];
        CookingItem::where('id', '=', $id)->update($fields);
        return redirect("admin/create/cookingitemlist")->with('success_message', 'Cooking Item Deleted Successfully !!!');
    }
}