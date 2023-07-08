<?php

namespace App\Http\Controllers\Api\V1\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
     * Login API
     *
     * @return \Illuminate\Http\Response
     */

    public function login(Request $request)
    {
        try {
            //code...
            //dd($request);
            if (Auth::attempt(['user_code' => $request->member_code, 'password' => $request->password])) {
                $user = Auth::user();
                $token= auth()->user()->createApiToken();

                return response()->json([
                  'status' => 'Authorized',
                  'token' => $token
                ], 200);
            } else {
                return response()->json([
                  'status' => 'Unauthorized Access',
                ], 401);
            }
        } catch (\Exception $ex) {
            //throw $th;
            abort(500, $ex->getMessage());
        }
    }

    public function test()
    {
        return response()->json([
          'status'  => 200,
          'data'  => []
        ]);
    }

    public function index()
    {
        $users= User::latest()->paginate(10);

        if ($users->count()) {
            return response()->json(['status'=> 'true', 'data'=> $users,], 200);
        } else {
            return response()->json(['status' => 'false', ], 401);
        }
    }
}
