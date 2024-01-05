<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KartuStokController extends Controller
{
    public function index()
    {

        $kartuStoks =  DB::select('

                SELECT stock, id_barang, nama_barang, tanggal_terakhir, jenis_transaksi,nama_satuan
                FROM view_kartu_stok
                ORDER BY tanggal_terakhir,id_barang DESC;');
        return view('pages.admin.table.kartuStok.index', ['kartuStoks' => $kartuStoks]);
    }

    public function detail($id)
    {


        $kartuStoks = DB::select(
            '
            (
                SELECT barang.nama_barang,"PENERIMAAN" AS Tabel,jenis_transaksi,coalesce(kartu_stok.masuk,0) as masuk, coalesce(kartu_stok.keluar,0) as keluar, kartu_stok.stock, kartu_stok.created_at
                FROM kartu_stok
                join barang on barang.id_barang = kartu_stok.id_barang
                WHERE kartu_stok.jenis_transaksi = "M" AND kartu_stok.id_barang = ?
                ORDER BY created_at DESC
            )
            UNION
            (
                SELECT barang.nama_barang, "RETUR" AS TABEL, jenis_transaksi, coalesce(kartu_stok.masuk,0) as masuk, coalesce(kartu_stok.keluar,0) as keluar, kartu_stok.stock, kartu_stok.created_at
                FROM kartu_stok
                join barang on barang.id_barang = kartu_stok.id_barang
                WHERE kartu_stok.jenis_transaksi = "R" AND kartu_stok.id_barang = ?
                ORDER BY created_at DESC
            )
            UNION
            (
                    SELECT barang.nama_barang,"PENJUALAN" AS TABEL, jenis_transaksi, coalesce(kartu_stok.masuk,0) as masuk, coalesce(kartu_stok.keluar,0) as keluar, kartu_stok.stock, kartu_stok.created_at
                    from kartu_stok
                    join barang on barang.id_barang = kartu_stok.id_barang
                    where kartu_stok.jenis_transaksi = "K" and kartu_stok.id_barang = ?
                    order by created_at DESC
            )

            ORDER BY jenis_transaksi, created_at DESC;

                ',
            [$id, $id,$id]
        );

        return response()->json($kartuStoks);
    }
}
