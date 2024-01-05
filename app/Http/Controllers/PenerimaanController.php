<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenerimaanController extends Controller
{
    public function index()
    {
        // $penerimaans = DB::table('penerimaan as p')->select('p.*', 'u.username')
        //     ->join('user as u', 'u.id_user', '=', 'p.id_user')
        //     ->groupBy('p.id_pengadaan','p.id_penerimaan','p.created_at','p.status','p.id_user','u.username')
        //     ->get();

        $penerimaans =DB::select('
        SELECT
        min(p.id_penerimaan) as id_penerimaan,
        p.id_pengadaan,
        MIN(p.created_at) as created_at,
        MIN(p.status) as status,
        MIN(p.id_user) as id_user,
        u.username
    FROM dbpbd.penerimaan p
    JOIN user u ON u.id_user = p.id_user
    GROUP BY p.id_pengadaan, u.username;

        ');
        return view('pages.admin.table.penerimaan.index', ['penerimaans' => $penerimaans]);
    }

    public function detailPenerimaan($id)
    {
        // $detailPenerimaan = DB::table('detail_penerimaan as d')
        //     ->select('d.*', 'b.nama_barang')
        //     ->join('barang as b', 'b.id_barang', '=', 'd.id_barang')
        //     ->where('d.id_penerimaan', '=', $id)
        //     ->get();

        $detailPenerimaan = DB::select('

 SELECT

 dpe.id_penerimaan,
 dpe.sub_total_terima,
 dp.iddetail_pengadaan,
 pe.id_pengadaan,
 dp.id_barang,
 b.nama_barang,
 dpe.harga_satuan_terima,
 dpe.iddetail_penerimaan,

 SUM(dp.jumlah) as jumlah_pengadaan,
 COALESCE(SUM(dpe.jumlah_terima), 0) as jumlah_Terima,
 COALESCE(SUM(dp.jumlah) - COALESCE(SUM(dpe.jumlah_terima), 0), 0) as YangBelumDiterima
FROM detail_pengadaan dp
JOIN pengadaan p ON dp.id_pengadaan = p.id_pengadaan
LEFT JOIN penerimaan pe ON p.id_pengadaan = pe.id_pengadaan
LEFT JOIN detail_penerimaan dpe ON pe.id_penerimaan = dpe.id_penerimaan AND dp.id_barang = dpe.id_barang
JOIN barang b ON dp.id_barang = b.id_barang
WHERE pe.id_pengadaan = ?
GROUP BY dp.iddetail_pengadaan,pe.id_pengadaan, b.nama_barang, dpe.harga_satuan_terima,dp.jumlah,dp.sub_total,dp.id_barang,dpe.iddetail_penerimaan,dpe.sub_total_terima,dpe.id_penerimaan;
        ',[$id]);


        return response()->json($detailPenerimaan);
    }


    public function create()
    {
        // $pengadaans = DB::select('SELECT * FROM pengadaan AS p
        //                             WHERE p.status = 1
        //                                 AND p.id_pengadaan NOT IN (
        //                                          SELECT id_pengadaan
        //                                             FROM penerimaan)');
        $pengadaans = DB::select('
        SELECT dp.id_pengadaan
        FROM detail_pengadaan dp
        LEFT JOIN (
            SELECT COALESCE(SUM(dpe.jumlah_terima), 0) as total_terima, pe.id_pengadaan
            FROM detail_penerimaan dpe
            JOIN penerimaan pe ON pe.id_penerimaan = dpe.id_penerimaan
            GROUP BY id_pengadaan
        ) penerimaan_totals ON dp.id_pengadaan = penerimaan_totals.id_pengadaan
        WHERE dp.jumlah > COALESCE(penerimaan_totals.total_terima, 0)
           or dp.id_pengadaan =  (
               SELECT id_pengadaan
               FROM pengadaan p
               WHERE id_pengadaan NOT IN (SELECT id_pengadaan FROM penerimaan)
           )
        GROUP BY dp.id_pengadaan;
        ');



        // $pengadaans = DB::select(
        //     'select p.id_pengadaan
        //         from pengadaan p
        //         join detail_pengadaan dp on p.id_pengadaan = dp.id_pengadaan
        //         join penerimaan pe on pe.id_pengadaan = p.id_pengadaan
        //         join detail_penerimaan dpe on dpe.id_penerimaan = pe.id_penerimaan
        //         group by id_pengadaan
        //         having coalesce(sum(jumlah_terima),0) < coalesce(sum(jumlah),0);'
        // );

        return view('pages.admin.table.penerimaan.create', ['pengadaans' => $pengadaans]);
    }

    public function detailPengadaan($id)
    {
        //  $detailPengadaans = DB::table('detail_pengadaan as d')
        //     ->select('d.*', 'b.nama_barang')
        //      ->join('barang as b', 'b.id_barang', '=', 'd.id_barang')
        //      ->where('d.id_pengadaan', '=', $id)
        //      ->get();
        // $detailPengadaans = DB::table('detail_pengadaan as dpg')
        // ->join('pengadaan as p', 'p.id_pengadaan', '=', 'dpg.id_pengadaan')
        // ->leftJoin('penerimaan as pe', 'p.id_pengadaan', '=', 'pe.id_pengadaan')
        // ->leftJoin('detail_penerimaan as dp', 'dp.id_penerimaan', '=', 'pe.id_penerimaan')
        // ->join('barang as b', 'b.id_barang', '=', 'dpg.id_barang')
        // ->select(
        //     'dpg.*',
        //     'b.nama_barang',
        //     'dpg.jumlah as jumlahpengadaan',
        //     'dpg.harga_satuan',
        //     DB::raw('COALESCE(SUM(dp.jumlah_terima), 0) as jumlah_terima'),
        //     DB::raw('COALESCE(dpg.jumlah - COALESCE(SUM(dp.jumlah_terima), 0), 0) as YangBelumDiterima')
        // )
        // ->where('p.id_pengadaan', '=', $id)
        // ->groupBy('dpg.iddetail_pengadaan','dp.jumlah_terima','dp.id_penerimaan','dp.iddetail_penerimaan', 'dpg.harga_satuan', 'dpg.jumlah', 'dpg.sub_total', 'dpg.id_barang', 'dpg.id_pengadaan', 'b.nama_barang')
        // ->get();

        $detailPengadaans = DB::select('
        SELECT
        dp.jumlah,
        dp.sub_total,
        dp.iddetail_pengadaan,
        dp.id_barang,
        b.nama_barang,
        dp.harga_satuan,
        SUM(dp.jumlah) as jumlah_pengadaan,
        COALESCE(SUM(dpe.jumlah_terima), 0) as jumlah_terima,
        COALESCE(SUM(dp.jumlah) - COALESCE(SUM(dpe.jumlah_terima), 0), 0) as YangBelumDiterima
    FROM detail_pengadaan dp
    JOIN pengadaan p ON dp.id_pengadaan = p.id_pengadaan
    LEFT JOIN penerimaan pe ON p.id_pengadaan = pe.id_pengadaan
    LEFT JOIN detail_penerimaan dpe ON pe.id_penerimaan = dpe.id_penerimaan AND dp.id_barang = dpe.id_barang
    JOIN barang b ON dp.id_barang = b.id_barang
    WHERE p.id_pengadaan = ?
    GROUP BY dp.iddetail_pengadaan, b.nama_barang, dp.harga_satuan,dp.jumlah,dp.sub_total,dp.id_barang;
        ',[$id]);



        return response()->json($detailPengadaans);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $dataPenerimaan = $request->dataPenerimaan;
            $id_pengadaan = $request->id_pengadaan;
            $id_user = auth()->user()->id_user;

            DB::select('CALL penerimaan_detailPenerimaan(?,?,?)', [$dataPenerimaan, $id_pengadaan, $id_user]);
            DB::commit();
            return response()->json(['message' => 'success']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'error', 'error' => $e->getMessage()]);
        }

        // $data = $request->all();

    }
}
