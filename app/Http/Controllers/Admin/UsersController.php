<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\UserDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;



class UsersController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::with(['roles'])->get();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        return view('admin.users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.users.index');
    }

    // public function edit(User $user)
    // {
    //     abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     $roles = Role::pluck('title', 'id');

    //     $user->load('roles');

    //     return view('admin.users.edit', compact('roles', 'user'));
    // }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));



        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles', 'userCodeUserDetails');

        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }


    public function updatedetails(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        $user->load('roles');

        return view('admin.users.edit', compact('roles', 'user'));
    }



    public function edit(User $user)
    {
        {
            abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        $user->load('roles');

           
   
        //   return view('admin.users.edit', compact('roles', 'user'));

           

          $user = User::where('id', '=', session('LoggedMember'))->first();

       
   
       //get member profile
           $token= "YyHqs47HJOhJUM5Kf1pi5Jz_N8Ss573cxqE2clymSK5G4QLGWsfcxZY8HIKAVvM4vSRsXxCCde4lNfrPvvh93hlLbffZiTwqd_mAu1kAKN6YZWSKd6RDiya8lX50yRIUgaDfeITNUwGWWil3aUlOl3Is-6FFL1Dk8PcJT2iezWOPRYXNVg0TwG1H85v-QT17f1z2Vwr3nhBEfFsUbij0CLRKJwXEoMN4yovVY0QakIHxikwt2lvgibtMnJNZOawklBkpQtC87PcXuG-aGtCqATl0UgjwYr61_oIpRmbuiEk";

       $fields= [
             'MCODE' => $user->user_code
           ];
   
           $url= "https://ccfcmemberdata.in/Api/MemberProfile/?".http_build_query($fields);

       
          

       $profile = Http::withoutVerifying()
               ->withHeaders(['Authorization' => 'Bearer ' . $token, 'Cache-Control' => 'no-cache', 'Accept' => '/',
                               'Content-Type' => 'application/json',])
               ->withOptions(["verify"=>false])
               ->post($url)->json()['data'];

               
             
            
            //    dd($profile);
               
               return view('admin.users.edit',compact('roles', 'user'), [
                   
                   'userProfile'       => $profile,
                   // 'userTransactions'  => $transactions,
               ]);  
               

        }   
    }

    public function saveUserJson(Request $request){

        $user = User::where('user_code', '=', $request->code)->first();

        $token= "YyHqs47HJOhJUM5Kf1pi5Jz_N8Ss573cxqE2clymSK5G4QLGWsfcxZY8HIKAVvM4vSRsXxCCde4lNfrPvvh93hlLbffZiTwqd_mAu1kAKN6YZWSKd6RDiya8lX50yRIUgaDfeITNUwGWWil3aUlOl3Is-6FFL1Dk8PcJT2iezWOPRYXNVg0TwG1H85v-QT17f1z2Vwr3nhBEfFsUbij0CLRKJwXEoMN4yovVY0QakIHxikwt2lvgibtMnJNZOawklBkpQtC87PcXuG-aGtCqATl0UgjwYr61_oIpRmbuiEk";

       $fields= [
             'MCODE' => $request->code
           ];
   
           $url= "https://ccfcmemberdata.in/Api/MemberProfile/?".http_build_query($fields);

       
          

       $profile = Http::withoutVerifying()
               ->withHeaders(['Authorization' => 'Bearer ' . $token, 'Cache-Control' => 'no-cache', 'Accept' => '/',
                               'Content-Type' => 'application/json',])
               ->withOptions(["verify"=>false])
               ->post($url)->json()['data'];


            //    dd($profile);
        //Saving data into user table
        $user->email= ($profile['EMAIL'] != "") ? $profile['EMAIL'] : "";

        $user->is_active= ($profile['CURENTSTATUS'] != 'ACTIVE') ? '0' : '1';

        $user->phone_number_1 = (preg_match('/^[0-9]{10}+$/', $profile['MOBILENO'])) ? $profile['MOBILENO'] : "";

        if($user->save()){
            $userInformation = UserDetail::where('user_code_id',$user->id)->first();
            
            // $memberbase64 = "data:image/png". ";base64," . base64_encode($profile['MemberImage']);

            $memberbase64 =$profile['MemberImage'];


            // dd($memberbase64);

            // $spousebase64 = "data:image/png". ";base64," . base64_encode($profile['SpouseImage']);

            $spousebase64 = $profile['SpouseImage'];

            // dd($profile['children']);

            if(!empty($profile['children'])){


 
                for($i=0; $i< count($profile['children']); ++$i){
                //save the first child
                if(!empty($profile['children'][$i]) && $i == 0)
                {

                    $child1_name = $profile['children'][$i]['CHILDREN1_NAME'];
                    $child1_dob = $profile['children'][$i]['DOB'];
                    $child1_sex = $profile['children'][$i]['SEX'];
                    $child1_phone1 = $profile['children'][$i]['PHONE1'];
                    $child1_phone2 = $profile['children'][$i]['PHONE2'];
                    $child1_mobile = $profile['children'][$i]['MOBILENO'];
                    $child1_image = $profile['children'][$i]['Image'];
                    

                    
                
                }else{
                    // break;
                }
                
                //Save the second child
                if(!empty($profile['children'][$i]) && $i == 1)
                {
                
                    $child2_name = $profile['children'][$i]['CHILDREN1_NAME'];
                    $child2_dob = $profile['children'][$i]['DOB'];
                    $child2_sex = $profile['children'][$i]['SEX'];
                    $child2_phone1 = $profile['children'][$i]['PHONE1'];
                    $child2_phone2 = $profile['children'][$i]['PHONE2'];
                    $child2_mobile = $profile['children'][$i]['MOBILENO'];
                    $child2_image = $profile['children'][$i]['Image'];

                }else{
                    // break;
                }
                
                //Save the Third child
                if(!empty($profile['children'][$i]) && $i == 2)
                {
                
                    $child3_name = $profile['children'][$i]['CHILDREN1_NAME'];
                    $child3_dob = $profile['children'][$i]['DOB'];
                    $child3_sex = $profile['children'][$i]['SEX'];
                    $child3_phone1 = $profile['children'][$i]['PHONE1'];
                    $child3_phone2 = $profile['children'][$i]['PHONE2'];
                    $child3_mobile = $profile['children'][$i]['MOBILENO'];
                    $child3_image = $profile['children'][$i]['Image'];

                }else{
                    // break;
                }
                
                
                
                }
             }

            if(!$userInformation){
                $user->userCodeUserDetails()->create([
                    'member_type_code'=>$profile['MEMBERTYPECODE'],
                    'member_type'=>$profile['MEMBERTYPE'],
                    'date_of_birth'=>date("d-m-Y", strtotime($profile["DOB"])),
                    'member_since'=>date("d-m-Y", strtotime($profile['MEMBER_SINCE'])),
                    'sex'=>$profile['SEX'],
                    'address_1'=>$profile['ADDRESS1'],
                    'address_2'=>$profile['ADDRESS2'],
                    'address_3'=>$profile['ADDRESS3'],
                    'state'=>$profile['STATE'],
                    'pin'=>$profile['PIN'],
                    'phone_1'=>$profile['PHONE1'],
                    'phone_2'=>$profile['PHONE2'],
                    'mobile_no'=>$profile['MOBILENO'],
                    'email'=>$profile['EMAIL'],
                    'current_status'=>$profile['CURENTSTATUS'],
                    'represented_club_in'=>$profile['REPRESENTED_CLUB_IN'],
                    'hobbies_interest'=>$profile['HOBBIES/ INTERESTS'],
                    'business_profession'=>$profile['BUSINESS/ PROFESSION'],
                    'category'=>$profile['CATEGORY'],
                    'business_address_1'=>$profile['ADDRESS1'],
                    'business_address_2'=>$profile['ADDRESS2'],
                    'business_address_3'=>$profile['ADDRESS3'],
                    'business_city'=>$profile['CITY'],
                    'business_state'=>$profile['STATE'],
                    'business_pin'=>$profile['PIN'],
                    'business_phone_1'=>$profile['PHONE1'],
                    'business_phone_2'=>$profile['PHONE2'],
                    'business_email'=>$profile['BUSINESS_EMAIL'],
                    'spouse_name'=>$profile['SPOUSE_NAME'],
                    'spouse_dob'=>date("d-m-Y", strtotime($profile['SPOUSE_DOB'])),
                    'spouse_sex'=>$profile['SEX'],
                    'spouse_phone_1'=>$profile['PHONE1'],
                    'spouse_phone_2'=>$profile['PHONE2'],
                    'spouse_mobile_no'=>$profile['SPOUSEMOBILENO'],
                    'spouse_email'=>$profile['EMAIL'],
                    'spouse_business_profession'=>$profile['SPOUSE_BUSINESS/ PROFESSION'],
                    'spouse_business_category'=>$profile['CATEGORY'],
                    'spouse_business_address_1'=>$profile['ADDRESS1'],
                    'spouse_business_address_2'=>$profile['ADDRESS2'],
                    'spouse_business_address_3'=>$profile['ADDRESS3'],
                    'spouse_business_city'=>$profile['CITY'],
                    'spouse_business_state'=>$profile['STATE'],
                    'spouse_business_pin'=>$profile['PIN'],
                    'spouse_business_phone_1'=>$profile['PHONE1'],
                    'spouse_business_phone_2'=>$profile['PHONE2'],
                    'spouse_business_email'=>$profile['EMAIL'],

                    'member_image'=>$memberbase64,

                    'spouse_image'=>$spousebase64,

                    'children1_name'=>isset($child1_name) ? $child1_name : '',
                    'children1_dob'=>isset($child1_dob) ? $child1_dob : '',
                    'children1_sex'=>isset($child1_sex) ? $child1_sex : '',
                    'children1_phone1'=>isset($child1_phone1) ? $child1_phone1 : '',
                    'children1_phone2'=>isset($child1_phone2) ? $child1_phone2 : '',
                    'children1_mobileno'=>isset($child1_mobile) ? $child1_mobile : '',

                    'children2_name'=>isset($child2_name) ? $child2_name : '',
                    'children2_dob'=>isset($child2_dob) ? $child2_dob : '',
                    'children2_sex'=>isset($child2_sex) ? $child2_sex : '',
                    'children2_phone1'=>isset($child2_phone1) ? $child2_phone1 : '',
                    'children2_phone2'=>isset($child2_phone2) ? $child2_phone2 : '',
                    'children2_mobileno'=>isset($child2_mobile) ? $child2_mobile : '',


                    'children3_name'=>isset($child3_name) ? $child3_name : '',
                    'children3_dob'=>isset($child3_dob) ? $child3_dob : '',
                    'children3_sex'=>isset($child3_sex) ? $child3_sex : '',
                    'children3_phone1'=>isset($child3_phone1) ? $child3_phone1 : '',
                    'children3_phone2'=>isset($child3_phone2) ? $child3_phone2 : '',
                    'children3_mobileno'=>isset($child3_mobile) ? $child3_mobile : '',

                    ])->id;
            }
            else{

                $userInformation->member_type_code= $profile['MEMBERTYPECODE'];
                $userInformation->member_type= $profile['MEMBERTYPE'];
                $userInformation->date_of_birth= date("d-m-Y", strtotime($profile["DOB"]));
                $userInformation->member_since= date("d-m-Y", strtotime($profile['MEMBER_SINCE']));
                $userInformation->sex= $profile['SEX'];

                $userInformation->address_1= $profile['ADDRESS1'];

                $userInformation->address_2= $profile['ADDRESS2'];

                $userInformation->address_3= $profile['ADDRESS3'];
                $userInformation->state= $profile['STATE'];
                $userInformation->pin= $profile['PIN'];
                $userInformation->phone_1= $profile['PHONE1'];
                $userInformation->phone_2= $profile['PHONE2'];
                $userInformation->mobile_no= $profile['MOBILENO'];
                $userInformation->email= $profile['EMAIL'];
                $userInformation->current_status= $profile['CURENTSTATUS'];
                $userInformation->represented_club_in= $profile['REPRESENTED_CLUB_IN'];
                $userInformation->hobbies_interest= $profile['HOBBIES/ INTERESTS'];
                $userInformation->business_profession= $profile['BUSINESS/ PROFESSION'];
                $userInformation->category= $profile['CATEGORY'];

                $userInformation->business_address_1= $profile['ADDRESS1'];
                $userInformation->business_address_2= $profile['ADDRESS2'];
                $userInformation->business_address_3= $profile['ADDRESS3'];
                $userInformation->business_city= $profile['CITY'];
                $userInformation->business_state= $profile['STATE'];
                $userInformation->business_pin= $profile['PIN'];
                $userInformation->business_phone_1= $profile['PHONE1'];
                $userInformation->business_phone_2= $profile['PHONE2'];
                $userInformation->business_email= $profile['BUSINESS_EMAIL'];
                $userInformation->spouse_name= $profile['SPOUSE_NAME'];
                
                $userInformation->spouse_dob=date("d-m-Y", strtotime($profile['SPOUSE_DOB']));

                $userInformation->spouse_sex= $profile['SEX'];

                $userInformation->spouse_phone_1= $profile['PHONE1'];
                $userInformation->spouse_phone_2= $profile['PHONE2'];
                $userInformation->spouse_mobile_no= $profile['SPOUSEMOBILENO'];
                $userInformation->spouse_email= $profile['EMAIL'];
                $userInformation->spouse_business_profession= $profile['SPOUSE_BUSINESS/ PROFESSION'];
                $userInformation->spouse_business_category= $profile['CATEGORY'];
                $userInformation->spouse_business_address_1= $profile['ADDRESS1'];
                $userInformation->spouse_business_address_2= $profile['ADDRESS2'];
                $userInformation->spouse_business_address_3= $profile['ADDRESS3'];
                $userInformation->spouse_business_city= $profile['CITY'];
                $userInformation->spouse_business_state= $profile['STATE'];
                $userInformation->spouse_business_pin= $profile['PIN'];
                $userInformation->spouse_business_phone_1= $profile['PHONE1'];
                $userInformation->spouse_business_phone_2= $profile['PHONE2'];
                $userInformation->spouse_business_email= $profile['EMAIL'];


                $userInformation->spouse_business_email= $profile['EMAIL'];

                $userInformation->member_image= $memberbase64;

                $userInformation->spouse_image= $spousebase64;



                $userInformation->children1_name = isset($child1_name) ? $child1_name : '';
                $userInformation->children1_dob = isset($child1_dob) ? $child1_dob : '';
                $userInformation->children1_sex = isset($child1_sex) ? $child1_sex : '';
                $userInformation->children1_phone1 = isset($child1_phone1) ? $child1_phone1 : '';
                $userInformation->children1_phone2 = isset($child1_phone2) ? $child1_phone2 : '';
                $userInformation->children1_mobileno = isset($child1_mobile) ? $child1_mobile : '';

                $userInformation->children2_name = isset($child2_name) ? $child2_name : '';
                $userInformation->children2_dob = isset($child2_dob) ? $child2_dob : '';
                $userInformation->children2_sex = isset($child2_sex) ? $child2_sex : '';
                $userInformation->children2_phone1 = isset($child2_phone1) ? $child2_phone1 : '';
                $userInformation->children2_phone2 = isset($child2_phone2) ? $child2_phone2 : '';
                $userInformation->children2_mobileno = isset($child2_mobile) ? $child2_mobile : '';


                $userInformation->children3_name = isset($child3_name) ? $child3_name : '';
                $userInformation->children3_dob = isset($child3_dob) ? $child3_dob : '';
                $userInformation->children3_sex = isset($child3_sex) ? $child3_sex : '';
                $userInformation->children3_phone1 = isset($child3_phone1) ? $child3_phone1 : '';
                $userInformation->children3_phone2 = isset($child3_phone2) ? $child3_phone2 : '';
                $userInformation->children3_mobileno = isset($child3_mobile) ? $child3_mobile : '';

                $userInformation->save();

            }

        

       
        

        }
        return redirect()->back()->with('success', 'user data updated successfully');

        

    }
}