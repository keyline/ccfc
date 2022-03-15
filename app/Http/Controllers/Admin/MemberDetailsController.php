<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\MemberDetails;
use Illuminate\Http\Request;

class MemberDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MemberDetails  $memberDetails
     * @return \Illuminate\Http\Response
     */
    public function show(MemberDetails $memberDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MemberDetails  $memberDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(MemberDetails $memberDetails)
    {
        {
            abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
            $roles = Role::pluck('title', 'id');
            
          

           $user->load('roles');
   
       //    return view('admin.users.edit', compact('roles', 'user'));

           

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

               
              
               // dd($profile);
               
               return view('admin.users.edit',compact('roles', 'user'), [
                   
                   'userProfile'       => $profile,
                   // 'userTransactions'  => $transactions,
               ]);  

        }   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MemberDetails  $memberDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MemberDetails $memberDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MemberDetails  $memberDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(MemberDetails $memberDetails)
    {
        //
    }
}