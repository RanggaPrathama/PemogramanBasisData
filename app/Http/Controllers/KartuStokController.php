<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KartuStokController extends Controller
{
    public function index()
    {

        $kartuStoks =  DB::select('

                SELECT k.stock, k.id_barang, b.nama_barang, k.created_at as tanggal_terakhir, k.jenis_transaksi,s.nama_satuan
                FROM kartu_stok k
                JOIN barang b ON b.id_barang = k.id_barang
                JOIN satuan s on b.id_satuan = s.id_satuan
                WHERE (k.id_barang, k.created_at) IN (
                              SELECT id_barang, MAX(created_at) AS max_created_at
                                FROM kartu_stok
                                GROUP BY id_barang
                                                    )
                ORDER BY k.created_at,k.id_barang DESC;');
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
                ORDER BY jenis_transaksi, created_at DESC;
                ',
            [$id, $id]
        );

        return response()->json($kartuStoks);
    }
}
