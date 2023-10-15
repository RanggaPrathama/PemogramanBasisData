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
        $barangs = DB::table('barangs')
                ->select('barangs.id_barang','barangs.jenis','barangs.nama_barang','barangs.status','barangs.harga','satuans.id_satuan','satuans.nama_satuan')
                ->join('satuans','barangs.id_satuan','=','satuans.id_satuan')
                ->get();
        return view('pages.admin.table.barang.index',['barangs'=>$barangs]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $satuans = DB::table('satuans')
                    ->select('id_satuan','nama_satuan')
                    ->get();
        return view('pages.admin.table.barang.create',['satuans'=>$satuans]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateddata = $request->validate([
            'nama_barang'=>'required|unique:barangs,nama_barang',
            'id_satuan'=>'required',
            'jenis'=>'required',
            'harga'=>'required|numeric'
        ],
        [
            'nama_barang.required'=>'Nama Barang wajib diisi',
            'id_satuan.required'=>'Satuan wajib diisi',
            'jenis.required'=>'Jenis Wajib diisi',
            'harga.required'=>'Harga Wajib diisi',
            'harga.numeric'=>'Harga Bersifat Numeric'
        ]);

        $data = Barang::create($validateddata);
        if($data){
            return redirect()->route('barang.index')->with('success','Berhasil !');
        }
        else{
            return redirect()->back()->with('errors','Gagal!')->withInput();
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
        $barangs = DB::table('barangs')
        ->select('barangs.id_barang','barangs.jenis','barangs.nama_barang','barangs.status','barangs.harga','barangs.id_satuan')
        ->where('id_barang',$id)
        ->first();
        $satuans = DB::table('satuans')
                ->select('id_satuan','nama_satuan')
                ->get();

        return view('pages.admin.table.barang.update',['barangs'=>$barangs,'satuans'=>$satuans]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $validateddata = $request->validate([
            'nama_barang'=>'required|unique:barangs,nama_barang',
            'id_satuan'=>'required',
            'jenis'=>'required',
            'harga'=>'required|numeric'
        ],
        [
            'nama_barang.required'=>'Nama Barang wajib diisi',
            'id_satuan.required'=>'Satuan wajib diisi',
            'jenis.required'=>'Jenis Wajib diisi',
            'harga.required'=>'Harga Wajib diisi',
            'harga.numeric'=>'Harga Bersifat Numeric'
        ]);

        $barangs = Barang::where('id_barang',$id);
        $valid =$barangs->update($validateddata);
        if($valid){
            return redirect()->route('barang.index')->with('success','Berhasil!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $barangs = Barang::where('id_barang',$id);
        $valid=$barangs->update(['status'=>0]);
        if($valid){
            return redirect()->route('barang.index')->with('success','Data Berhasil Terhapus !');
        }
    }
    public function restore($id)
    {
        $barangs = Barang::where('id_barang',$id);
        $valid=$barangs->update(['status'=>1]);
        if($valid){
            return redirect()->route('barang.index')->with('success','Data Berhasil Terestore  !');
        }
    }
}
