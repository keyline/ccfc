<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    //in minutes
    protected $throttle = 60;

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email', 'user_code'=> 'required']);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $user = User::where('email', $request->email)
                            ->where('user_code', $request->user_code)
                            ->first();

        if (is_null($user)) {
            return $this->sendResetLinkFailedResponse($request, PasswordBroker::INVALID_USER);
        }

        $reset = DB::table('password_resets')
                        ->where('email', $user->email)
                        ->where('user_code', $user->user_code)
                        ->first();

        if ($reset && $this->tokenRecentlyCreated($reset)) {
            return $this->sendResetLinkFailedResponse($request, PasswordBroker::RESET_THROTTLED);
        }

        $token = $this->createToken($request, $user, $reset);
        
        //keep in mind that saved token is hashed version of this
        $user->sendPasswordResetNotification($token, $user->user_code);

        return $this->sendResetLinkResponse($request, Password::RESET_LINK_SENT);
    }

    /**
     * Create a ne password reset token
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Model $user
     * @param Model $reset
     */
    public function createToken($request, $user, $reset)
    {
        $email = $user->email;

        if ($reset) {
            DB::table('password_resets')->where('user_code', '=', $reset->user_code)->delete();
        }

        // We will create a new, random token for the user so that we can e-mail them
        // a safe link to the password reset form. Then we will insert a record in
        // the database so that we can verify the token within the actual reset.
        $token = $this->createNewToken();

        DB::table('password_resets')->insert([
            'email' => $email,
            'user_code' => $user->user_code,
            'token' => bcrypt($token),
            'created_at' => now(),
        ]);

        return $token;
    }

    /**
     * Create a new token for the user.
     *
     * @return string
     */
    public function createNewToken()
    {
        return hash_hmac('sha256', \Str::random(30), $this->getHashKey());
    }

    /**
     * Replicate hash key used by DatabaseTokenRepository
     */
    public function getHashKey()
    {
        $key = config('app.key');
        if (Str::startsWith($key, 'base64:')) {
            $key = base64_decode(substr($key, 7));
        }
        return $key;
    }

    /**
     * Determine if the token was recently created.
     *
     * @param  Model  $token
     * @return bool
     */
    protected function tokenRecentlyCreated($token)
    {
        if ($this->throttle <= 0) {
            return false;
        }

        return Carbon::parse($token->created_at)->addSeconds(
            $this->throttle
        )->isFuture();
    }
}
