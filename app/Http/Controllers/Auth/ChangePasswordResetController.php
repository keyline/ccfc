<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use Gate;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;
use Symfony\Component\HttpFoundation\Response;


class ChangePasswordResetController extends Controller
{
    // public function edit()
    // {
    //     abort_if(Gate::denies('profile_password_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     return view('auth.passwords.edit');
    // }

    // public function update(UpdatePasswordRequest $request)
    // {
    //     auth()->user()->update($request->validated());

    //     // return view('member.change_password')->with('message', __('global.change_password_success'));
    //     // return redirect()->route('member.change_password')->with('message', __('global.change_password_success'));

    //     return redirect()->route('change_password')->with(['success' => 'password change successfully']);


    // }

    // public function updateProfile(UpdateProfileRequest $request)
    // {
    //     $user = auth()->user();

    //     $user->update($request->validated());

    //     return redirect()->route('profile.password.edit')->with('message', __('global.update_profile_success'));
    // }

    // public function destroy()
    // {
    //     $user = auth()->user();

    //     $user->update([
    //         'email' => time() . '_' . $user->email,
    //     ]);

    //     $user->delete();

    //     // return redirect()->route('login')->with('message', __('global.delete_account_success'));
    //     return redirect()->route('member/dashboard')->with('message', __('global.delete_account_success'));

    // }

    // public function toggleTwoFactor(Request $request)
    // {
    //     $user = auth()->user();

    //     if ($user->two_factor) {
    //         $message = __('global.two_factor.disabled');
    //     } else {
    //         $message = __('global.two_factor.enabled');
    //     }

    //     $user->two_factor = !$user->two_factor;

    //     $user->save();

    //     return redirect()->route('profile.password.edit')->with('message', $message);
    // }

    

    public function showChangePasswordGet() {
        // return view('auth.passwords.change-password');

        return view('change_password');
    }

    public function changePasswordPost(Request $request) {

        // $user = Auth::user();  
        // dd($request);
    
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            // Current password and new password same
            return redirect()->back()->with("error","New Password cannot be same as your current password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:4|confirmed',
        ]);

        //Change Password
        $user = Auth::user();       
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("success","Password successfully changed!");

    }






    
    // public function changePasswordPost(Request $request)

    // {       
    //     $user = Auth::user();
    
    //     $userPassword = $user->password;
        
    //     $request->validate([
    //         'current_password' => 'required',
    //         'password' => 'required|same:confirm_password|min:6',
    //         'confirm_password' => 'required',
    //     ]);

    //     if (!Hash::check($request->current_password, $userPassword)) {
    //         return back()->withErrors(['current_password'=>'password not match']);
    //     }

    //     $user->password = Hash::make($request->password);

    //     $user->save();

    //     return redirect()->back()->with('success','password successfully updated');
    // }

}