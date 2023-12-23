<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenerimaanController extends Controller
{
    public function index(){
        $pengadaans = DB::table('pengadaan as p')->select('p.*','v.nama_vendor','u.username')
                        ->join('vendor as v','v.id_vendor','=','p.id_vendor')
                        ->join('user as u','u.id_user','=','p.id_user')
                        ->get();
        return view('pages.admin.table.penerimaan.index',['pengadaans'=>$pengadaans]);
    }

    public function create(){
        $pengadaans = DB::table('pengadaan as p')->select('*')->get();
        return view('pages.admin.table.penerimaan.create',['pengadaans'=>$pengadaans]);
    }

    public function detailPengadaan($id){
        $detailPengadaans = DB::table('detail_pengadaan as d')
        ->select('d.*','b.nama_barang')
        ->join('barang as b','b.id_barang','=','d.id_barang')
        ->where('d.id_pengadaan','=',$id)
        ->get();
        return response()->json($detailPengadaans);
    }
}
