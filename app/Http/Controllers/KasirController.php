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
}
