<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClubmanItem;
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
                // Helper::pr($fields);
                DeleteAccountRequest::insert($fields);
                return redirect("deleteaccountlinks")->with('success_message', 'Delete Account Request Submitted Successfully !!!');
            } else {
                return redirect()->back()->with('error_message', 'All Fields Required !!!');
            }
        }
        return view('delete-account');
    }
    public function clubmanitemsinsertcron(Request $request)
    {
        ClubmanItem::truncate();
        $token          = "5tdpn6yeoycRKbWd0311m1B5S-ZKMfU2syAD50kiquOX20GbmXF89Z1-vvsN01WTAIRWHdRESd8nRWZJrC7xuHkClh63BPg1PCpZHKpDOjmtvgJL8ErYrup7PLG2LZHkbjDh6bFb54VyUsvZm4OzzIPI9QVKhTf2ui5Pmd8CzHJZUK-4Jd-aOmQFfhuertA5KuIRrNdHTzA7w1hEYHO9Hq9J_pkME7BhNpjWp44Z3R2YeLuQbskl_rMypzLj5icdoPWgCsxA1bU9iGo5x3heaP8lHliiSx3SeeYpBMe22DRaarXJYc5pxFJ1tuEKDoxn";
        $item_details   = [];
        $billUrl        = 'https://ccfcmemberdata.in/Api/POSItemDet/POST';
        $items          = Http::withoutVerifying()
                    ->withHeaders(['Authorization' => 'Bearer ' . $token, 'Cache-Control' => 'no-cache', 'Accept' => '/',
                                    'Content-Type' => 'application/json',])
                    ->withOptions(["verify" => false])
                    ->post($billUrl)->json()['data'];
        if($items){
            foreach($items as $item){
                $postData = [
                    'CATEGORY'      => $item->CATEGORY,
                    'GROUPNAME'     => $item->GROUPNAME,
                    'SUBGROUP'      => $item->SUBGROUP,
                    'ITEMNAME'      => $item->ITEMNAME,
                    'RATE'          => $item->RATE,
                    'TAX'           => $item->TAX,
                    'AMOUNT'        => $item->AMOUNT
                ];
                ClubmanItem::insert($postData);
            }
        }
        echo "All items inserted successfully";
    }
}


