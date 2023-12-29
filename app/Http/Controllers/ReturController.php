<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReturController extends Controller
{
    public function index(){

        return view('pages.admin.table.retur.index');
    }

    public function create(){
        $penerimaans = DB::select('SELECT p.*
        FROM penerimaan  p
        where p.status = 1
        AND p.id_penerimaan NOT IN (SELECT r.id_penerimaan FROM retur r ) ');
        return view('pages.admin.table.retur.create',['penerimaans' => $penerimaans]);
    }

    public function detilPenerimaan($id){
        $data = DB::table('detail_penerimaan as d')
                        ->select('d.*','b.nama_barang')
                        ->join('barang as b','b.id_barang','=','d.id_barang')
                        ->where('d.id_penerimaan','=',$id)
                        ->get();

        return response()->json($data);

    }
}
