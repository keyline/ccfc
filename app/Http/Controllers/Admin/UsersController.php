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

        //Saving data into user table
        $user->email= ($profile['EMAIL'] != "") ? $profile['EMAIL'] : "";

        $user->is_active= ($profile['CURENTSTATUS'] != 'ACTIVE') ? '0' : '1';

        $user->phone_number_1 = (preg_match('/^[0-9]{10}+$/', $profile['MOBILENO'])) ? $profile['MOBILENO'] : "";

        if($user->save()){
            $userInformation = UserDetail::where('user_code_id',$user->id)->first();
            
            

        $userInformation->member_type_code= $profile['MEMBERTYPECODE'];
        $userInformation->member_type= $profile['MEMBERTYPE'];
        $userInformation->date_of_birth= date("d-m-Y", strtotime($profile["DOB"]));

        $userInformation->save();

        }
        return redirect()->back()->with('success', 'user data updated successfully');

        

    }
}