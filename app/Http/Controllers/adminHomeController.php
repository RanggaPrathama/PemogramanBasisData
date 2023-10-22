<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminHomeController extends Controller
{
    public function index(){
            $users = auth()->user();
            return view('pages.admin.home',['users'=>$users]);




    }

    public function profile(){

        return view('partials.admin.navbar');
    }
}
