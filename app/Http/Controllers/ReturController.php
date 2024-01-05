<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReturController extends Controller
{
    public function index(){
        $pengembalians = DB::table('pengembalian as p')
                        ->select('p.*','u..username')
                        ->join('user as u','u.id_user','=','p.id_user')
                        ->get();
        return view('pages.admin.table.retur.index',['pengembalians'=>$pengembalians]);
    }

    public function detail($id){
        $data = DB::table('detail_pengembalian as dp')
        ->where('id_pengembalian','=',$id)
        ->get();

        return response()->json($data);
    }
    public function create(){
        $penerimaans = DB::select('SELECT p.*
        FROM penerimaan  p
        where p.status = 1
        ');
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

    public function store(Request $request){
        DB::beginTransaction();
        try {
            $tes = $request->all();
            $idUser = auth()->user()->id_user;
            $idPenerimaan = $request->id_penerimaan;
            $dataRetur = $request->dataRetur;

            DB::select('CALL pengembalian_detailPengembalian(?,?,?)',[$dataRetur,$idPenerimaan,$idUser]);
            DB::commit();
            return response()->json(['message'=>'success']);

        }catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'error', 'error' => $e->getMessage()]);
        }
}
}
