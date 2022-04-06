<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class MemberAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('LoggedMember') && $request->path() != 'member/login') {
            return redirect('/')->with('fail', 'Members must be logged in!');
        }

        if (session()->has('LoggedMember') && $request->path() == 'member/login') {
            return back();
        }

        if(session()->has('firstMemberUpdate') && $request->path() == 'member/updateme'){
            return $next($request);
        }

        if (session()->has('firstMemberUpdate') && ! $request->is('member/*/update')) {
            return redirect()->route('member.profileupdate', session('firstMemberUpdate'));
        }

        if(Auth::user()->status == 'TERMINATED'){
            return redirect('/')->with("fail", "YOUR MEMBERSHIP NO. " . Auth::user()->user_code . " STANDS TERMINATED.");
        }

        return $next($request)->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
                                ->header('Pragma', 'no-cache')
                                ->header('Expires', 'Sat 01 Jan 1990 00:00:00 GMT');
    }
}