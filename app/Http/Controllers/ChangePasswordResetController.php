<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use Gate;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
// use Auth;
use Symfony\Component\HttpFoundation\Response;


class ChangePasswordResetController extends Controller
{
     
    public function change_password() {
        
        return view('member.change_password');
    }

    public function update_password(Request $request) {

        // dd($user = auth()->user());

        $request->validate([

            'old_password'=>'required|min:4|max:100',
            'new_password'=>'required|min:4|max:100',
            'confirm_password'=>'required|same:new_password'

        ]);

        $current_user=auth()->user();

        // dd($current_user);

        if(Hash::check($request->old_password,$current_user->password)){

            $current_user->update([
                'password'=>bcrypt($request->new_password)
            ]);

            return redirect()->back()->with('success','Password successfully updated. ');


        }else{
            return redirect()->back()->with('error','old password does not matched. ');
        }
    }
}