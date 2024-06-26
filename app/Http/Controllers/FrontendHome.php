<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReciprocalClub;

class FrontendHome extends Controller
{
    //
    public function index()
    {
        // $reciprocalClubs = ReciprocalClub::all();        
        // return view('frontend.index', compact('reciprocalClubs'));
    }
    public function deleteAccountLinks()
    {
        return view('frontend.delete-account');
    }
}


