<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class MemberUpdateController extends Controller
{
    public function index()
    {
        
    }


    public function ajaxRequest()
    {
        return view('ajaxRequest');
    }

    // public function ajaxRequestPost(Request $request)
    // {
    //     $input = $request->all();
          
        
    // }
}