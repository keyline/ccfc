<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Helpers\SearchInvoicePdf;
use Illuminate\Support\Facades\Storage;
use File;
use Response;
use Auth;

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
        // if (! Hash::check($request->password, $userInfo->password)) {
        //     return back()->withErrors(['password' => ['Password is incorrect']]);
        // }

       if(Auth::attempt(['user_code'=>$request->email,'password'=>$request->password])){

        $request->session()->put('LoggedMember', ['id' => $userInfo->id, 'name'=> $userInfo->name ]);
        return redirect('member/dashboard');

       }
        
        return back()->withErrors(['password' => ['Password is incorrect']]);
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


    public function invoice()
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
        
                   
        return view('member.invoice', [
            'userData'          => $data,
            'userProfile'       => $profile,
            'userTransactions'  => $transactions,
        ]);
    }

    /**
     * Download specified pdf file from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $month
     * @param  string  $year
     * @param  string  $fileName
     * @return \Illuminate\Http\Response
     */

    public function download(Request $request, $month, $year, $fileName)
    {
        $month =strtoupper($month);
        
        //$pathToFile = storage_path("app\\" . SearchInvoicePdf::$basepath . implode("\\", ["{$month}_{$year}", $fileName]));

        //$base_path_mod = str_replace('\\', '/', $pathToFile);
        
        //return response()->download($pathToFile);
        // Download file with custom headers
        $testPath= SearchInvoicePdf::$basepath . implode("/", ["{$month}_{$year}", $fileName]);
        
        
        if (Storage::disk('local')->exists($testPath)) {
            $path= Storage::disk('local')->path($testPath);

            $content= file_get_contents($path);

            return response($content)->withHeaders([
                'Content-type'  => mime_content_type($path)
            ]);
        }

        return redirect('/404');
    }
}