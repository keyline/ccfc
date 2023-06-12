<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
<<<<<<< HEAD
        //this is my code 
||||||| de44403
=======
        //this is to generate conflict
>>>>>>> 87a9723fa07b607c9b5c5c2fd2c6292709d11629
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
}
