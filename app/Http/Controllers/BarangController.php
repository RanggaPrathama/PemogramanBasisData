<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //QUERY BUILDER
        // $barangs = DB::table('barang')
        //         ->select('barangs.id_barang','barangs.jenis','barangs.nama_barang','barangs.status','barangs.harga','satuans.id_satuan','satuans.nama_satuan','barangs.status')
        //         ->join('satuans','barangs.id_satuan','=','satuans.id_satuan')
        //         ->where('barangs.status',1)
        //         ->get();

        // QUERY SQL NATIVE
        $query = 'SELECT b.id_barang, b.nama_barang , b.jenis, b.status,b.harga, satuan.id_satuan, satuan.nama_satuan
                  FROM barang b
                  JOIN satuan ON satuan.id_satuan = b.id_satuan
                  WHERE b.status = ?';
        $kondisi = [1];
        $barangs = DB::select($query, $kondisi);


        return view('pages.admin.table.barang.index', ['barangs' => $barangs]);
    }

    public function trash()
    {

        //QUERY BUILDER
        // $barangs = DB::table('barang')
        // ->select('barangs.id_barang','barangs.jenis','barangs.nama_barang','barangs.status','barangs.harga','satuans.id_satuan','satuans.nama_satuan','barangs.status')
        // ->join('satuans','barangs.id_satuan','=','satuans.id_satuan')
        //     ->where('barangs.status',0)
        //     ->get();

        //QUERY SQL NATIVE
        $query = 'SELECT b.id_barang, b.nama_barang, b.jenis, b.status, b.harga, s.id_satuan, s.nama_satuan
                  FROM barang b
                  JOIN satuan s ON b.id_satuan = s.id_satuan
                  WHERE b.status = ?';
        $kondisi = [0];
        $barangs = DB::select($query, $kondisi);

        return view('pages.admin.table.barang.trash', ['barangs' => $barangs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //QUERY BUILDER
        // $satuans = DB::table('satuan')
        //             ->select('id_satuan','nama_satuan')
        //             ->get();

        //QUERY SQL NATIVE
        $query = 'SELECT * FROM satuan where status= ?';
        $kondisi = [1];
        $satuans = DB::select($query, $kondisi);
        return view('pages.admin.table.barang.create', ['satuans' => $satuans]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateddata = $request->validate(
            [
                'nama_barang' => 'required|unique:barang,nama_barang',
                'id_satuan' => 'required',
                'jenis' => 'required',
                'harga' => 'required|numeric'
            ],
            [
                'nama_barang.required' => 'Nama Barang wajib diisi',
                'id_satuan.required' => 'Satuan wajib diisi',
                'jenis.required' => 'Jenis Wajib diisi',
                'harga.required' => 'Harga Wajib diisi',
                'harga.numeric' => 'Harga Bersifat Numeric'
            ]
        );
        //QUERY BUILDER
        // $data = DB::table('barang')->insert($validateddata);

        //QUERY NATIVE
        $query = 'INSERT INTO barang (nama_barang,id_satuan,jenis,harga) VALUES (?,?,?,?)';
        $values = [$validateddata['nama_barang'], $validateddata['id_satuan'], $validateddata['jenis'], $validateddata['harga']];
        $sql = DB::insert($query, $values);
        if ($sql) {
            return redirect()->route('barang.index')->with('success', 'Berhasil !');
        } else {
            return redirect()->back()->with('errors', 'Gagal!')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //QUERY BUILDER
        // $barangs = DB::table('barang')
        // ->select('barangs.id_barang','barangs.jenis','barangs.nama_barang','barangs.status','barangs.harga','barangs.id_satuan')
        // ->where('id_barang',$id)
        // ->first();
        // $satuans = DB::table('satuan')
        //         ->select('id_satuan','nama_satuan')
        //         ->get();

        //QUERY NATIVE
        $query = 'SELECT * FROM barang WHERE id_barang= ? ';
        $kondisi = [$id];
        $barangs = DB::select($query, $kondisi);

        $query = 'SELECT * FROM satuan where status = ?';
        $kondisi = [1];
        $satuans = DB::select($query, $kondisi);
        return view('pages.admin.table.barang.update', ['barangs' => $barangs, 'satuans' => $satuans]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validateddata = $request->validate(
            [
                'nama_barang' => 'required',
                'id_satuan' => 'required',
                'jenis' => 'required',
                'harga' => 'required|numeric'
            ],
            [
                'nama_barang.required' => 'Nama Barang wajib diisi',
                'id_satuan.required' => 'Satuan wajib diisi',
                'jenis.required' => 'Jenis Wajib diisi',
                'harga.required' => 'Harga Wajib diisi',
                'harga.numeric' => 'Harga Bersifat Numeric'
            ]
        );

        //QUERY BUILDER
        // $barangs = DB::table('barang')->where('id_barang',$id);
        // $valid =$barangs->update($validateddata);

        //QUERY NATIVE
        $query = 'UPDATE barang SET nama_barang = ?, id_satuan = ?, jenis= ? , harga = ? WHERE id_barang = ?';
        $values = [$validateddata['nama_barang'], $validateddata['id_satuan'], $validateddata['jenis'], $validateddata['harga'], $id];
        $sql = DB::update($query, $values);
        if ($sql) {
            return redirect()->route('barang.index')->with('success', 'Berhasil!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // QUERY BUILDER
        // $barangs = DB::table('barang')->where('id_barang',$id);
        // $valid=$barangs->update(['status'=>0]);

        //QUERY NATIVE SQL
        $query = 'UPDATE barang SET status=? WHERE id_barang = ?';
        $values = [0, $id];
        $sql = DB::update($query, $values);
        if ($sql) {
            return redirect()->route('barang.index')->with('success', 'Data Berhasil Terhapus !');
        }
    }
    public function restore($id)
    {
        //QUERY BUILDER
        // $barangs = DB::table('barang')->where('id_barang',$id);
        // $valid=$barangs->update(['status'=>1]);

        //QUERY SQL NATIVE
        $query = 'UPDATE barang SET status = ? WHERE id_barang = ?';
        $values = [1, $id];
        $sql = DB::update($query, $values);
        if ($sql) {
            return redirect()->route('barang.trash')->with('success', 'Data Berhasil Terestore  !');
        }
    }

    public function restoreall()
    {
        // QUERY BUILDER
        // $barangs = DB::table('barang')->where('status',0)->update(['status'=>1]);

        //QUERY SQL NATIVE

        $query = 'UPDATE barang SET status =? WHERE status = ?';
        $values = [1, 0];
        $sql = DB::update($query, $values);

        if ($sql) {
            return redirect()->route('barang.trash')->with('success', 'Semua Data Berhasil Di Restore');
        }
    }

    public function caribarang(Request $request)
    {
        //print_r($request->all());
        $brg = $request->barang;

        $barang = DB::table('barang')
            ->whereRaw("upper(nama_barang) LIKE upper('%$brg%')")
            ->get()
            ->toArray();
        return response()->json($barang);
    }
}
