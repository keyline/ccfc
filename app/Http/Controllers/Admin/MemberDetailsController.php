<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\MemberDetails;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class MemberDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/users/memberdetails');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MemberDetails  $memberDetails
     * @return \Illuminate\Http\Response
     */
    public function show(MemberDetails $memberDetails)
    {
        $user = User::where('id', '=', session('LoggedMember'))->first();

        $data= ['LoggedMemberInfo' => $user];

        //get member profile
        //$token= "YyHqs47HJOhJUM5Kf1pi5Jz_N8Ss573cxqE2clymSK5G4QLGWsfcxZY8HIKAVvM4vSRsXxCCde4lNfrPvvh93hlLbffZiTwqd_mAu1kAKN6YZWSKd6RDiya8lX50yRIUgaDfeITNUwGWWil3aUlOl3Is-6FFL1Dk8PcJT2iezWOPRYXNVg0TwG1H85v-QT17f1z2Vwr3nhBEfFsUbij0CLRKJwXEoMN4yovVY0QakIHxikwt2lvgibtMnJNZOawklBkpQtC87PcXuG-aGtCqATl0UgjwYr61_oIpRmbuiEk";
        $token= "N3bwPrgB4wzHytcBkrvd6duSAX46ksfh9zOGPGnzwL8YladUpD-XH0DD_ZVBfdktfuPvgMbHg4uvBNBzibf2qEvPWh-HlzMFwnWJCfI8uW7-RBbpBj5oPlL9KPj7jxL8kaHDB6Fvl1fc8KZfYpZlRKRRTXIqsOkWt4Wenzz8I-D42AQzY5u-4FF1lDN3pepkwSL6xxXEb6wHExSHYlqT_9mKOB-6P-h6uWeqLETbFnft0CBvzwo9rJ14Gvu1YesR_Yte88Xg9R1K4_2mlY93YxYJGI7I3LkPSsVBfPW1SkzmdWo3HRJci6nRl36U_Llc";

        $fields= [
            'MCODE' => $user->user_code
        ];

        $url= "https://ccfcmemberdata.in/Api/MemberProfile/?".http_build_query($fields);

        //dd(openssl_get_cert_locations());


        $profile = Http::withoutVerifying()
                    ->withHeaders(['Authorization' => 'Bearer ' . $token, 'Cache-Control' => 'no-cache', 'Accept' => '/',
                                    'Content-Type' => 'application/json',])
                    ->withOptions(["verify"=>false])
                    ->post($url)->json()['data'];




        return view('member.dashboard', [
            'userData'          => $data,
            'userProfile'       => $profile,
        ]);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MemberDetails  $memberDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(MemberDetails $memberDetails)
    {
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
