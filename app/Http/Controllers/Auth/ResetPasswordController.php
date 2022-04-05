<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

use Hash;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:4',
        ];
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email, 'user_code' => $request->user_code]
        );
    }

    public function reset(Request $request)
    {
        $request->validate([
              'email' => 'required|email|exists:users',
              'password' => 'required|string|min:4|confirmed',
              'password_confirmation' => 'required',
              'user_code'             => 'required'
          ]);
        
        $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $request->email,
                                'user_code'=> $request->user_code,
                              ])
                              ->first();
        
        if (is_null($updatePassword)) {
            return redirect()->back()
                    ->withInput($request->only('email'))
                    ->withErrors(['email' => 'Invalid token!!']);
        }

        //Validating token
        if (Hash::check($request->token, $updatePassword->token)) {
            $user = tap(User::where('user_code', $request->user_code)->select('id', 'email_verified_at', 'email', 'user_code'))
                      ->update(
                          ['password' => Hash::make($request->password)]
                      )->first();
            //first time track through email_verified_at
            if (is_null($user->email_verified_at)) {
                //return back()->with('status', 'Your account is not activated. Please activate it first.');

                $user->email_verified_at= date('Y-m-d H:i:s');
                $user->save();
            }
              
            //login the user immediately they change password successfully
            //Auth::login($user);

            //Delete the token
            DB::table('password_resets')->where('email', $user->email)
                                    ->where('user_code', $user->user_code)
                                    ->delete();
                                    
            return redirect()->route('member.login');
        } else {
        }
    }
}
