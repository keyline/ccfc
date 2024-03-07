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
use Log;
use Carbon\Carbon;

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
        //dd($request);
        //$user = User::create($request->all());
        try {
            
            $user = User::create($request->all());

            $user->roles()->sync($request->input('roles', []));

            //Dispatching the Job here
            \App\Jobs\MemberProfileUpdate::dispatch($user->user_code)->onQueue('memberprofile');

            return redirect()->route('admin.users.index');
        } catch (\Illuminate\Database\QueryException $ex) {
            //throw $th;
            
            //return redirect()->back()->with('error', $ex->getMessage());
            return redirect()->back()->withErrors(['user_code' => ['Duplicate user code provided']])->withInput($request->except('password'));
        }
        
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

        $user->roles()->detach();

        $user->userCodeUserDetails()->delete();

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
            //$token= "YyHqs47HJOhJUM5Kf1pi5Jz_N8Ss573cxqE2clymSK5G4QLGWsfcxZY8HIKAVvM4vSRsXxCCde4lNfrPvvh93hlLbffZiTwqd_mAu1kAKN6YZWSKd6RDiya8lX50yRIUgaDfeITNUwGWWil3aUlOl3Is-6FFL1Dk8PcJT2iezWOPRYXNVg0TwG1H85v-QT17f1z2Vwr3nhBEfFsUbij0CLRKJwXEoMN4yovVY0QakIHxikwt2lvgibtMnJNZOawklBkpQtC87PcXuG-aGtCqATl0UgjwYr61_oIpRmbuiEk";
            $token= "N3bwPrgB4wzHytcBkrvd6duSAX46ksfh9zOGPGnzwL8YladUpD-XH0DD_ZVBfdktfuPvgMbHg4uvBNBzibf2qEvPWh-HlzMFwnWJCfI8uW7-RBbpBj5oPlL9KPj7jxL8kaHDB6Fvl1fc8KZfYpZlRKRRTXIqsOkWt4Wenzz8I-D42AQzY5u-4FF1lDN3pepkwSL6xxXEb6wHExSHYlqT_9mKOB-6P-h6uWeqLETbFnft0CBvzwo9rJ14Gvu1YesR_Yte88Xg9R1K4_2mlY93YxYJGI7I3LkPSsVBfPW1SkzmdWo3HRJci6nRl36U_Llc";




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

            return view('admin.users.edit', compact('roles', 'user'), [

                'userProfile'       => $profile,
                // 'userTransactions'  => $transactions,
            ]);
        }
    }

    public function saveUserJson(Request $request)
    {
        //Dispatching the Job here
        \App\Jobs\MemberProfileUpdate::dispatch($request->code)->onQueue('memberprofile');

        //Log::info("Member profile update dispatch for". $request->code);

        return redirect()->back()->with('success', 'user data updated successfully');
        //dd("placed this job");
    }

    public function exportToCSV(Request $request)
    {
        $current = Carbon::now()->format('YmdHs');

        $fileName= 'user_list'. '_' .$current;

        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
        ,   'Content-type'        => 'text/csv'
        ,   'Content-Disposition' => 'attachment; filename='. $fileName . '.csv'
        ,   'Expires'             => '0'
        ,   'Pragma'              => 'public'
    ];

        $list = User::all()->toArray();


        # add headers for each column in the CSV download
        array_unshift($list, array_keys($list[0]));

        $callback = function () use ($list) {
            $FH = fopen('php://output', 'w');
            foreach ($list as $row) {
                fputcsv($FH, $row);
            }
            fclose($FH);
        };

        return response()->stream($callback, 200, $headers);
    }
}
