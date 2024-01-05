<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KasirController extends Controller
{
    public function index(){
       $barangs = DB::select('
       SELECT k.stock, k.id_barang, b.nama_barang, k.created_at, k.jenis_transaksi,b.harga,b.gambar
       FROM kartu_stok k
       JOIN barang b ON b.id_barang = k.id_barang
       WHERE (k.id_barang, k.created_at) IN (
           SELECT id_barang, MAX(created_at) AS max_created_at
           FROM kartu_stok
           GROUP BY id_barang
       ) and k.stock != 0
       ORDER BY k.created_at,k.id_barang DESC;
        ');

        $margins = DB::select('
        select *
        from margin_penjualan
        order by created_at desc limit 1;
        ');
        return view('pages.Kasir.home',['barangs'=>$barangs,'margins'=>$margins]);
    }

    public function store(Request $request){
        DB::beginTransaction();
        try {
            $idmargin_Penjualan = $request->id_marginPenjualan;
            $id_user = auth()->user()->id_user;
            $subTotal = $request->subtotal;
            $dataPENJUALAN = $request->dataPenjualan;

            // penjualan_detailPenjualan(dataPenjualan JSON, idUser int, idMarginPenjualan int, subtotal int)
            DB::select('CALL penjualan_detailPenjualan(?,?,?,?)',[$dataPENJUALAN,$id_user,$idmargin_Penjualan,$subTotal]);

            DB::commit();

            return response()->json(['message'=>'success']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'error', 'error' => $e->getMessage()]);
        }

        // $tes = $request->all();

    }

    public function indexstruk(){
        return view('pages.Kasir.Struk.struk');
    }
    public function struk(){
        $penjualans = DB::select('
        select p.*, max(p.id_penjualan)
        from penjualan p
        group by p.id_penjualan,p.created_at,p.subtotal_nilai,p.ppn,.p.total_nilai,p.id_user,p.idmargin_penjualan
        having max(p.id_penjualan);
        ');

        $id_Penjualan = $penjualans[0]->id_penjualan;

        $detailPenjualans =  DB::select('
        select dp.*,b.nama_barang
        from detail_penjualan dp
        join barang b on b.id_barang = dp.id_barang
        where id_penjualan = ?;
        ',[$id_Penjualan]);

        return view('pages.Kasir.Struk.struk',['penjualans'=>$penjualans,'detailPenjualans'=>$detailPenjualans]);
    }
}
