<?php

namespace App\Http\Controllers\Member;

use Illuminate\Support\Facades\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Helpers\SearchInvoicePdf;
use Illuminate\Support\Facades\Storage;
use File;
use Response;
use Auth;

use pcrov\JsonReader\JsonReader;

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

        $userDetailsInfo= $userInfo->userCodeUserDetails()->first();


        if (is_null($userInfo->email_verified_at)) {
            return redirect('password/reset')->with([ 'user_code' => $userInfo->user_code ]);
        }

        if (Auth::attempt(['user_code'=>$request->email,'password'=>$request->password])) {
            $request->session()->put('LoggedMember', ['id' => $userInfo->id, 'name'=> $userInfo->name]);

            //Check if fetching member data has been done or not
            if (!$userDetailsInfo || is_null($userDetailsInfo->current_status)) {
                $request->session()->put('firstMemberUpdate', ['usercode' => $userInfo->user_code]);
                return redirect()->route('member.profileupdate', $userInfo->user_code);
            }

            //return redirect('member/dashboard');
            return redirect()->route('member.profileupdate', $userInfo->user_code);
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
        // $user = User::where('id', '=', session('LoggedMember'))->first();

        $user = User::with('userCodeUserDetails')->find(session('LoggedMember'));

        // dd($user);

        // $userdetails = $user->userCodeUserDetails()->get();

        // dd($userdetails);

        // $data= ['LoggedMemberInfo' => $userdetails];

        //get member profile
        // $token= "YyHqs47HJOhJUM5Kf1pi5Jz_N8Ss573cxqE2clymSK5G4QLGWsfcxZY8HIKAVvM4vSRsXxCCde4lNfrPvvh93hlLbffZiTwqd_mAu1kAKN6YZWSKd6RDiya8lX50yRIUgaDfeITNUwGWWil3aUlOl3Is-6FFL1Dk8PcJT2iezWOPRYXNVg0TwG1H85v-QT17f1z2Vwr3nhBEfFsUbij0CLRKJwXEoMN4yovVY0QakIHxikwt2lvgibtMnJNZOawklBkpQtC87PcXuG-aGtCqATl0UgjwYr61_oIpRmbuiEk";

        // $fields= [
        //     'MCODE' => $user->user_code
        // ];

        // $url= "https://ccfcmemberdata.in/Api/MemberProfile/?".http_build_query($fields);

        //dd(openssl_get_cert_locations());


        // $profile = Http::withoutVerifying()
        //             ->withHeaders(['Authorization' => 'Bearer ' . $token, 'Cache-Control' => 'no-cache', 'Accept' => '/',
        //                             'Content-Type' => 'application/json',])
        //             ->withOptions(["verify"=>false])
        //             ->post($url)->json()['data'];


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




        return view('member.dashboard_local', [
            // 'userData'          => $data,
            'userProfile'       => $user,
            // 'userTransactions'  => $transactions,
        ]);
    }


    public function invoice()
    {
        $user = User::with('userCodeUserDetails')->find(session('LoggedMember'))->first();

        // dd($userProfile);

        // $user = User::where('id', '=', session('LoggedMember'))->first();

        // $data= ['LoggedMemberInfo' => $user];

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
            'userData'          => $user,
            // 'userProfile'       => $profile,
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

    public function updateMyProfile(Request $request)
    {
        $user = User::where('user_code', '=', $request->user_code)->first();

        //$token= "YyHqs47HJOhJUM5Kf1pi5Jz_N8Ss573cxqE2clymSK5G4QLGWsfcxZY8HIKAVvM4vSRsXxCCde4lNfrPvvh93hlLbffZiTwqd_mAu1kAKN6YZWSKd6RDiya8lX50yRIUgaDfeITNUwGWWil3aUlOl3Is-6FFL1Dk8PcJT2iezWOPRYXNVg0TwG1H85v-QT17f1z2Vwr3nhBEfFsUbij0CLRKJwXEoMN4yovVY0QakIHxikwt2lvgibtMnJNZOawklBkpQtC87PcXuG-aGtCqATl0UgjwYr61_oIpRmbuiEk";
        $token="N3bwPrgB4wzHytcBkrvd6duSAX46ksfh9zOGPGnzwL8YladUpD-XH0DD_ZVBfdktfuPvgMbHg4uvBNBzibf2qEvPWh-HlzMFwnWJCfI8uW7-RBbpBj5oPlL9KPj7jxL8kaHDB6Fvl1fc8KZfYpZlRKRRTXIqsOkWt4Wenzz8I-D42AQzY5u-4FF1lDN3pepkwSL6xxXEb6wHExSHYlqT_9mKOB-6P-h6uWeqLETbFnft0CBvzwo9rJ14Gvu1YesR_Yte88Xg9R1K4_2mlY93YxYJGI7I3LkPSsVBfPW1SkzmdWo3HRJci6nRl36U_Llc";


        $client = new Client(['verify' => false]);
        $res = $client->request('POST', 'https://ccfcmemberdata.in/Api/MemberProfile', [
        'headers'=> ['Authorization' =>'Bearer '. $token,'Accept'     => 'application/json'],
            'query' => [
                'MCODE' => $user->user_code,

            ]
        ]);
        // echo $res->getStatusCode();
        // 200
        // echo $res->getHeader('content-type');
        // 'application/json; charset=utf8'
        $respones=$res->getBody()->getContents();
        // dd($respones);
        $teststr = <<< JSON

{$respones}

JSON;

        $reader = new JsonReader();

        $reader->json($teststr);


        // while ($reader->read("EMAIL")) {
//     var_dump($reader->value());
        // }
        // $reader->close();


        $reader->read('EMAIL');

        $memberemail=$reader->value();



        // var_dump($reader->value());


        $reader->close();

        $profileArr=json_decode($respones, true);

        $profile=$profileArr['data'];
        //Saving data into user table
        $user->email= $memberemail;

        $user->phone_number_1 = (preg_match('/^[0-9]{10}+$/', $profile['MOBILENO'])) ? $profile['MOBILENO'] : "";

        $user->status= $profile['CURENTSTATUS']; //saving member status


        if ($user->save()) {
            $userInformation = UserDetail::where('user_code_id', $user->id)->first();

            // $memberbase64 = "data:image/png". ";base64," . base64_encode($profile['MemberImage']);

            $memberbase64 =$profile['MemberImage'];


            // dd($memberbase64);

            // $spousebase64 = "data:image/png". ";base64," . base64_encode($profile['SpouseImage']);

            $spousebase64 = $profile['SpouseImage'];

            // dd($profile['children']);

            if (!empty($profile['children'])) {
                for ($i=0; $i< count($profile['children']); ++$i) {
                    //save the first child
                    if (!empty($profile['children'][$i]) && $i == 0) {
                        $child1_name = $profile['children'][$i]['CHILDREN1_NAME'];
                        $child1_dob = $profile['children'][$i]['DOB'];
                        $child1_sex = $profile['children'][$i]['SEX'];
                        $child1_phone1 = $profile['children'][$i]['PHONE1'];
                        $child1_phone2 = $profile['children'][$i]['PHONE2'];
                        $child1_mobile = $profile['children'][$i]['MOBILENO'];
                        $child1_image = $profile['children'][$i]['Image'];
                    } else {
                        // break;
                    }

                    //Save the second child
                    if (!empty($profile['children'][$i]) && $i == 1) {
                        $child2_name = $profile['children'][$i]['CHILDREN1_NAME'];
                        $child2_dob = $profile['children'][$i]['DOB'];
                        $child2_sex = $profile['children'][$i]['SEX'];
                        $child2_phone1 = $profile['children'][$i]['PHONE1'];
                        $child2_phone2 = $profile['children'][$i]['PHONE2'];
                        $child2_mobile = $profile['children'][$i]['MOBILENO'];
                        $child2_image = $profile['children'][$i]['Image'];
                    } else {
                        // break;
                    }

                    //Save the Third child
                    if (!empty($profile['children'][$i]) && $i == 2) {
                        $child3_name = $profile['children'][$i]['CHILDREN1_NAME'];
                        $child3_dob = $profile['children'][$i]['DOB'];
                        $child3_sex = $profile['children'][$i]['SEX'];
                        $child3_phone1 = $profile['children'][$i]['PHONE1'];
                        $child3_phone2 = $profile['children'][$i]['PHONE2'];
                        $child3_mobile = $profile['children'][$i]['MOBILENO'];
                        $child3_image = $profile['children'][$i]['Image'];
                    } else {
                        // break;
                    }
                }
            }

            if (!$userInformation) {
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
            } else {
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
        if (session()->has('firstMemberUpdate')) {
            session()->pull('firstMemberUpdate');
        }
        return redirect()->route('member.dashboard');
    }
}
