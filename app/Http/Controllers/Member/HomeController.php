<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class HomeController extends Controller
{
    //
    public function index()
    {
        return view('member.home');
    }

    public function memberLogin()
    {
        return redirect('/');
    }

    public function checkMember(Request $request)
    {
        //validate request
        $request->validate([
            'email'     => 'required',
            'password'  => 'required',
        ]);
        $userInfo= User::where('user_code', '=', $request->email)->first();

        if (!$userInfo) {
            return back()->withErrors(['email' => ['Member code not found! please contact admin']]);
        }
        if (! Hash::check($request->password, $userInfo->password)) {
            return back()->withErrors(['password' => ['Password is incorrect']]);
        }
        $request->session()->put('LoggedMember', ['id' => $userInfo->id, 'name'=> $userInfo->name ]);
        return redirect('member/dashboard');
    }

    public function logout()
    {
        if (session()->has('LoggedMember')) {
            session()->pull('LoggedMember');
            return redirect('');
        }
    }

    public function dashboard()
    {
        $user = User::where('id', '=', session('LoggedMember'))->first();

        $data= ['LoggedMemberInfo' => $user];
        
        //get member profile
        $token= "YyHqs47HJOhJUM5Kf1pi5Jz_N8Ss573cxqE2clymSK5G4QLGWsfcxZY8HIKAVvM4vSRsXxCCde4lNfrPvvh93hlLbffZiTwqd_mAu1kAKN6YZWSKd6RDiya8lX50yRIUgaDfeITNUwGWWil3aUlOl3Is-6FFL1Dk8PcJT2iezWOPRYXNVg0TwG1H85v-QT17f1z2Vwr3nhBEfFsUbij0CLRKJwXEoMN4yovVY0QakIHxikwt2lvgibtMnJNZOawklBkpQtC87PcXuG-aGtCqATl0UgjwYr61_oIpRmbuiEk";

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


        // $transactionFields= [
        //     'MCODE'     => $user->user_code,
        //     'FromDate'  => '01-apr-2020',
        //     'ToDate'    => '01-jun-2021', 
        // ];

        // $tansactionUrl= 'https://ccfcmemberdata.in/Api/MEMBERTRANSACTIONS/?' . http_build_query($transactionFields);

        // $transactions = Http::withoutVerifying()
        //             ->withHeaders(['Authorization' => 'Bearer ' . $token, 'Cache-Control' => 'no-cache', 'Accept' => '/',
        //                             'Content-Type' => 'application/json',])
        //             ->withOptions(["verify"=>false])
        //             ->post($tansactionUrl)->json()['data'];
        
        //dd($transactions);
           
        return view('member.dashboard', [
            'userData'          => $data,
            'userProfile'       => $profile,
            // 'userTransactions'  => $transactions,
        ]);
    }


    public function invoice(){


        $user = User::where('id', '=', session('LoggedMember'))->first();

        $data= ['LoggedMemberInfo' => $user];
        
        //get member profile
        $token= "YyHqs47HJOhJUM5Kf1pi5Jz_N8Ss573cxqE2clymSK5G4QLGWsfcxZY8HIKAVvM4vSRsXxCCde4lNfrPvvh93hlLbffZiTwqd_mAu1kAKN6YZWSKd6RDiya8lX50yRIUgaDfeITNUwGWWil3aUlOl3Is-6FFL1Dk8PcJT2iezWOPRYXNVg0TwG1H85v-QT17f1z2Vwr3nhBEfFsUbij0CLRKJwXEoMN4yovVY0QakIHxikwt2lvgibtMnJNZOawklBkpQtC87PcXuG-aGtCqATl0UgjwYr61_oIpRmbuiEk";

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


        $transactionFields= [
            'MCODE'     => $user->user_code,
            'FromDate'  => '01-apr-2020',
            'ToDate'    => '01-jun-2021', 
        ];

        $tansactionUrl= 'https://ccfcmemberdata.in/api/MemberMonthlyBalance/?' . http_build_query($transactionFields);

        $transactions = Http::withoutVerifying()
                    ->withHeaders(['Authorization' => 'Bearer ' . $token, 'Cache-Control' => 'no-cache', 'Accept' => '/',
                                    'Content-Type' => 'application/json',])
                    ->withOptions(["verify"=>false])
                    ->post($tansactionUrl)->json()['data'];
        
        // dd($transactions);
           
        return view('member.invoice', [
            'userData'          => $data,
            'userProfile'       => $profile,
            'userTransactions'  => $transactions,
        ]);


        
        
    }
}