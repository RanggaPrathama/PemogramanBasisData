<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use App\Http\Requests\StoreSatuanRequest;
use App\Http\Requests\UpdateSatuanRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $satuans = DB::table('satuans')
                    ->select('id_satuan','nama_satuan','status')
                    ->where('status',1)
                    ->get();
        return view('pages.admin.table.satuan.index',['satuans'=>$satuans]);
    }

    public function trash(){
        $satuans=DB::table('satuans')->select('id_satuan','nama_satuan','status')->where('status',0)->get();
        return view('pages.admin.table.satuan.trash',['satuans'=>$satuans]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.table.satuan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData= $request->validate([
            'nama_satuan'=>'required|unique:satuans,nama_satuan'
        ],
        [
            'nama_satuan.required'=>'Nama Satuan Sudah Ada'
        ]);

        $data = Satuan::create($validatedData);
        if($data){
            return redirect()->route('satuan.index')->with('success','Berhasil !');
        }
        else{
            return redirect()->back()->with('errors','Gagal !')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Satuan $satuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $satuans=DB::table('satuans')
                    ->select('*')
                    ->where('id_satuan',$id)
                    ->first();
        return view('pages.admin.table.satuan.update',['satuans'=>$satuans]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $validatedData= $request->validate([
            'nama_satuan'=>'required|unique:satuans,nama_satuan'
        ],
        [
            'nama_satuan.required'=>'Nama Satuan Sudah Ada'
        ]);

        $satuans = Satuan::where('id_satuan',$id);
       $valid= $satuans->update($validatedData);
        if($valid){
            return redirect()->route('satuan.index')->with('success','Berhasil !');
        }
        else{
            return redirect()->back()->with('errors','Gagal !')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $satuans = Satuan::where('id_satuan',$id);
       $valid= $satuans->update(['status'=>0]);
       if($valid){
        return redirect()->route('satuan.index')->with('success','Berhasil Terhapus');
       }
    }

    public function restore($id){
        $vendors = Satuan::where('id_satuan',$id);
        $valid= $vendors->update(['status'=>1]);
        if($valid){
            return redirect()->route('satuan.trash')->with('success','Berhasil di Restore !');
    }
}
public function restoreall(){
    Satuan::where('status', 0)->update(['status' => 1]);
    return redirect()->route('satuan.trash')->with('success','Data Berhasil Di Restore Semua');
}
}
