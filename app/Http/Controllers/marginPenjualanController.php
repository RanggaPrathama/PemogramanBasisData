<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class marginPenjualanController extends Controller
{
    public function index(){
        $marginPenjualans = DB::table('margin_penjualan as mp')
                            ->select('mp.*','u.username')
                            ->join('user as u','u.id_user','=','mp.id_user')
                            ->get();
        return view('pages.admin.table.marginPenjualan.index',['marginPenjualans'=>$marginPenjualans]);
    }

    public function create(){
        return view('pages.admin.table.marginPenjualan.create');
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'persen'=>'required'
        ]);

        $query = 'update  margin_penjualan
                set updated_at = now(), status = 0
                where created_at = (Select created_at from margin_penjualan order by created_at desc limit 1); ';
        DB::update($query);

        $validatedData['id_user']=auth()->user()->id_user;
        $validatedData['created_at']=Carbon::now();
         $tes = DB::table('margin_penjualan')->insert($validatedData);
         if($tes){
            return redirect()->route('marginPenjualan.index')->with(['success'=>'Berhasil !']);
         }
    }
}

