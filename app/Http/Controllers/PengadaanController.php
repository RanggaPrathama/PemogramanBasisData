<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PengadaanController extends Controller
{


        public function index(){
            $pengadaans = DB::table('pengadaan as p')->select('p.*','v.nama_vendor','u.username')
                        ->join('vendor as v','v.id_vendor','=','p.id_vendor')
                        ->join('user as u','u.id_user','=','p.id_user')
                        ->get();
            return view('pages.admin.table.pengadaan.index',['pengadaans'=>$pengadaans]);
        }

        public function detail($id){
            $detailPengadaans = DB::table('detail_pengadaan as d')
                                ->select('d.*','b.nama_barang')
                                ->join('barang as b','b.id_barang','=','d.id_barang')
                                ->where('d.id_pengadaan','=',$id)
                                ->get();



            return response()->json($detailPengadaans);
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

        public function store(Request $request){
            $data = $request->all();
            $id_vendor = $request->id_vendor;
            $subTotal = $request->subtotal;
            $id_user = auth()->user()->id_user;
            // $ppn = $subtotal * 0.11;
            // $total_nilai = $subtotal + $ppn;
            $dataPengadaan = $request->barangPilih;



            DB::select('CALL pengadaan_detilPengadaan(?,?,?,?)',[$dataPengadaan,$id_user,$id_vendor,$subTotal]);

            return response()->json(['message'=>'success']);
        }


}
