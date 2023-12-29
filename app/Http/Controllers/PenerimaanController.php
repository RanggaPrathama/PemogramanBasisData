<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenerimaanController extends Controller
{
    public function index()
    {
        $penerimaans = DB::table('penerimaan as p')->select('p.*', 'u.username')
            ->join('user as u', 'u.id_user', '=', 'p.id_user')
            ->get();
        return view('pages.admin.table.penerimaan.index', ['penerimaans' => $penerimaans]);
    }

    public function detailPenerimaan($id)
    {
        $detailPenerimaan = DB::table('detail_penerimaan as d')
            ->select('d.*', 'b.nama_barang')
            ->join('barang as b', 'b.id_barang', '=', 'd.id_barang')
            ->where('d.id_penerimaan', '=', $id)
            ->get();



        return response()->json($detailPenerimaan);
    }


    public function create()
    {

        $pengadaans = DB::select('SELECT * FROM pengadaan AS p
                                    WHERE p.status = 1
                                        AND p.id_pengadaan NOT IN (
                                                 SELECT id_pengadaan
                                                    FROM penerimaan)');
                                                    
        return view('pages.admin.table.penerimaan.create', ['pengadaans' => $pengadaans]);
    }

    public function detailPengadaan($id)
    {
        $detailPengadaans = DB::table('detail_pengadaan as d')
            ->select('d.*', 'b.nama_barang')
            ->join('barang as b', 'b.id_barang', '=', 'd.id_barang')
            ->where('d.id_pengadaan', '=', $id)
            ->get();
        return response()->json($detailPengadaans);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $dataPenerimaan = $request->dataPenerimaan;
        $id_pengadaan = $request->id_pengadaan;
        $id_user = auth()->user()->id_user;

        DB::select('CALL penerimaan_detailPenerimaan(?,?,?)', [$dataPenerimaan, $id_pengadaan, $id_user]);
        return response()->json(['message' => 'success']);
    }
}
