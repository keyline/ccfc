<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class apiController extends Controller
{
    public function dashboard()
    {
        // $user = User::where('id', '=', session('LoggedMember'))->first();
        // $data= ['LoggedMemberInfo' => $user];
        //get member profile
        //$token= "YyHqs47HJOhJUM5Kf1pi5Jz_N8Ss573cxqE2clymSK5G4QLGWsfcxZY8HIKAVvM4vSRsXxCCde4lNfrPvvh93hlLbffZiTwqd_mAu1kAKN6YZWSKd6RDiya8lX50yRIUgaDfeITNUwGWWil3aUlOl3Is-6FFL1Dk8PcJT2iezWOPRYXNVg0TwG1H85v-QT17f1z2Vwr3nhBEfFsUbij0CLRKJwXEoMN4yovVY0QakIHxikwt2lvgibtMnJNZOawklBkpQtC87PcXuG-aGtCqATl0UgjwYr61_oIpRmbuiEk";
        // $token = "N3bwPrgB4wzHytcBkrvd6duSAX46ksfh9zOGPGnzwL8YladUpD-XH0DD_ZVBfdktfuPvgMbHg4uvBNBzibf2qEvPWh-HlzMFwnWJCfI8uW7-RBbpBj5oPlL9KPj7jxL8kaHDB6Fvl1fc8KZfYpZlRKRRTXIqsOkWt4Wenzz8I-D42AQzY5u-4FF1lDN3pepkwSL6xxXEb6wHExSHYlqT_9mKOB-6P-h6uWeqLETbFnft0CBvzwo9rJ14Gvu1YesR_Yte88Xg9R1K4_2mlY93YxYJGI7I3LkPSsVBfPW1SkzmdWo3HRJci6nRl36U_Llc";
        $token = "5tdpn6yeoycRKbWd0311m1B5S-ZKMfU2syAD50kiquOX20GbmXF89Z1-vvsN01WTAIRWHdRESd8nRWZJrC7xuHkClh63BPg1PCpZHKpDOjmtvgJL8ErYrup7PLG2LZHkbjDh6bFb54VyUsvZm4OzzIPI9QVKhTf2ui5Pmd8CzHJZUK-4Jd-aOmQFfhuertA5KuIRrNdHTzA7w1hEYHO9Hq9J_pkME7BhNpjWp44Z3R2YeLuQbskl_rMypzLj5icdoPWgCsxA1bU9iGo5x3heaP8lHliiSx3SeeYpBMe22DRaarXJYc5pxFJ1tuEKDoxn";
        $fields= [
            'MCODE' => 'g168'
        ];
        $url= "https://ccfcmemberdata.in/Api/MemberProfile/?".http_build_query($fields);

        // dd($url);


        $headers= ['Authorization' => 'Bearer ' . $token, 'Cache-Control' => 'no-cache', 'Accept' => '/',

      'Content-Type' => 'application/json',];


        $profile = Http::withoutVerifying()
        ->withHeaders(['Authorization' => 'Bearer ' . $token, 'Cache-Control' => 'no-cache', 'Accept' => '/',
    'Content-Type' => 'application/json',])
        ->withOptions(["verify"=>false])
        ->post($url)->json();

        //   dd($profile);


        return response()->json(['html'=>$profile]);

        // dd($response);





        // $promise = $client->sendAsync($request)->then(function ($response) {
        //     $sd=$response->getBody()->getContents();
        //     $datas=json_decode($sd);
        //     //return response()->json($datas);
        //     return view('memberprofile', compact('datas'));
        // });

        // return $promise->wait();



        //return view('member.dashboard', $data);
    }
}
