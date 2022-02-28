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
        $token= "YyHqs47HJOhJUM5Kf1pi5Jz_N8Ss573cxqE2clymSK5G4QLGWsfcxZY8HIKAVvM4vSRsXxCCde4lNfrPvvh93hlLbffZiTwqd_mAu1kAKN6YZWSKd6RDiya8lX50yRIUgaDfeITNUwGWWil3aUlOl3Is-6FFL1Dk8PcJT2iezWOPRYXNVg0TwG1H85v-QT17f1z2Vwr3nhBEfFsUbij0CLRKJwXEoMN4yovVY0QakIHxikwt2lvgibtMnJNZOawklBkpQtC87PcXuG-aGtCqATl0UgjwYr61_oIpRmbuiEk";
        $fields= [
            'MCODE' => 'G168'
        ];
        $url= "https://ccfcmemberdata.in/Api/MemberProfile/?".http_build_query($fields);

        // dd($url);
        
        
        $headers= ['Authorization' => 'Bearer ' . $token, 'Cache-Control' => 'no-cache', 'Accept' => '/',
        
      'Content-Type' => 'application/json',];
      

        $client  = new \GuzzleHttp\Client(['verify' =>false]); //ssl verifyication

        $request = new \GuzzleHttp\Psr7\Request('POST', $url, [
            'headers' => ['Authorization' => 'Bearer ' . $token,
                         'Cache-Control' => 'no-cache',
                         
                         'Content-Type' => 'application/json',
        ],
       
        ]);
        // dd($request);

        $promise = $client->sendAsync($request)->then(function ($response) {
            $sd=$response->getBody()->getContents();
            $datas=json_decode($sd);
            //return response()->json($datas);
            return view('memberprofile', compact('datas'));
        });

        return $promise->wait();

        
        
        //return view('member.dashboard', $data);
    }
}