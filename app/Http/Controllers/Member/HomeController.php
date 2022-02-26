<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
            return back()->with('fail', 'Please contact to admin');
        }
        if (! Hash::check($request->password, $userInfo->password)) {
            return back()->with('fail', 'password is incorrect');
        }
        $request->session()->put('LoggedMember', $userInfo->id);
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
        $data= ['LoggedMemberInfo' => User::where('id', '=', session('LoggedMember'))->first()];
        return view('member.dashboard', $data);
    }
}
