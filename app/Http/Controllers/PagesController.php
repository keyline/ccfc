<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Sportstype;
use App\Models\Title;
use App\Models\User;
use App\Models\UserDetail;

use Illuminate\Http\Request;



class PagesController extends Controller
{
    // public function index()
    // {
    //    return view('pages');
    // }


    public function show($sport_name) 
    {
        // $members = Member::with(['select_member', 'select_title', 'select_sport'])->where('sport_name', 'LIKE', trim($sport_name) . '%')->get(); 
        
        // $members = Member::with("title,sport")->get(); 

        $members = Member::with(['select_member', 'select_title', 'select_sport'])->get();
        $userDetails = UserDetail::with(['user_code', 'media'])->get();
        // $a = $members->where('sport_name',$sport_name);

        // $query = Member::where('sport_name', '=', $sport_name);

        // $query = $query->whereHas('select_sport', function ($q) {
        //     $q->where('select_member', 'select_title');
        //     $q->where('value', '=', 0);
        // })-with('sport_name');

        // var_dump($query);

        

        // return view('pages')->with('id',$id);
        return view('pages',compact('members','sport_name','userDetails'));
    }


    // public function home($members) 
    // {
        
        

    //     return view('pages', compact('sport_name'));
    // }

}