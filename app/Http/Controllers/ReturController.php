<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReturController extends Controller
{
    public function index(){
        return view('pages.admin.table.retur.index');
    }
}