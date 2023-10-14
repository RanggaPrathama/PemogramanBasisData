<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adminHomeController extends Controller
{
    public function index(){
        return view('pages.admin.home');
    }
}
