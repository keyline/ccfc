<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeleteAccountRequest;
use App\Models\ReciprocalClub;
use App\Helpers\Helper;

class FrontendHome extends Controller
{
    //
    public function index()
    {
        // $reciprocalClubs = ReciprocalClub::all();        
        // return view('frontend.index', compact('reciprocalClubs'));
    }
    public function deleteAccountLinks(Request $request)
    {
        if($request->isMethod('post')){
            $postData = $request->all();
            $rules = [
                'entity_name'                   => 'required',
                'email'                         => 'required',
                'phone'                         => 'required',
                'comments'                      => 'required',
            ];
            if($this->validate($request, $rules)){
                $fields = [
                    'user_type'                 => $postData['user_type'],
                    'entity_name'               => $postData['entity_name'],
                    'email'                     => $postData['email'],
                    'is_email_verify'           => $postData['is_email_verify'],
                    'phone'                     => $postData['phone'],
                    'is_phone_verify'           => $postData['is_phone_verify'],
                    'comments'                  => $postData['comments'],
                ];
                Helper::pr($fields);
                DeleteAccountRequest::insert($fields);
                return redirect("deleteaccountlinks")->with('success_message', 'Cooking Category Inserted Successfully For ' . $for_cat . ' !!!');
            } else {
                return redirect()->back()->with('error_message', 'All Fields Required !!!');
            }
        }
        return view('delete-account');
    }
}


