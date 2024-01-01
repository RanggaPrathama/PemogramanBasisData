<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KasirController extends Controller
{
    public function index(){
       $barangs = DB::select('
            select b.id_barang, b.nama_barang, b.harga,b.gambar,ks.stock
            from kartu_stok ks
            join barang b on b.id_barang = ks.id_barang
            where (ks.id_barang, ks.created_at) in ( select id_barang,max(created_at) from kartu_stok group by id_barang );
        ');
        return view('pages.Kasir.home',['barangs'=>$barangs]);
    }
}
