<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengadaanController extends Controller
{


        public function index(){
            return view('pages.admin.table.pengadaan.index');
        }

        public function create(){
            $vendors = DB::table('vendor')->select('*')->get();
            return view('pages.admin.table.pengadaan.create',['vendors'=>$vendors]);
        }
        public function caribarang(Request $request)
        {
            //print_r($request->all());
            $brg = $request->barang;

            $barang = DB::table('barang as b')
                ->select('b.*','s.nama_satuan')
                ->join('satuan as s','b.id_satuan','=','s.id_satuan')
                ->whereRaw("upper(nama_barang) LIKE upper('%$brg%')")
                ->get();
            return response()->json($barang);
        }


}
