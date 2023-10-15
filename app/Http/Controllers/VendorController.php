<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Http\Requests\StoreVendorRequest;
use App\Http\Requests\UpdateVendorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendors= DB::table('vendors')
                ->select('*')
                ->get();

        return view('pages.admin.table.vendor.index',['vendors'=>$vendors]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.table.vendor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateddata = $request->validate([
            'nama_vendor'=>'required|unique:vendors,nama_vendor',
            'badan_hukum'=>'required'
        ],[
            'nama_vendor.required'=>'Nama Vendor Harus Diisi',
            'badan_hukum.required'=>'Badan Hukum Harus Diisi',
            'nama_vendor.unique'=>'nama_vendor sudah ada ',
        ]);

        $vendor = Vendor::create($validateddata);
        if($vendor){
            return redirect()->route('vendor.index')->with('success','Berhasil !');
        }
        else{
            return redirect()->back()->withInput()->with('errors','Gagal !');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $vendors= DB::table('vendors')
            ->select('*')
            ->where('id_vendor',$id)
            ->first();

        return view('pages.admin.table.vendor.update',['vendors'=>$vendors]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $validateddata = $request->validate([
            'nama_vendor'=>'required|unique:vendors,nama_vendor',
            'badan_hukum'=>'required'
        ],[
            'nama_vendor.required'=>'Nama Vendor Harus Diisi',
            'badan_hukum.required'=>'Badan Hukum Harus Diisi',
            'nama_vendor.unique'=>'nama_vendor sudah ada ',
        ]);

        $vendors = Vendor::where('id_vendor',$id);
        $valid = $vendors->update($validateddata);
        if($valid){
            return redirect()->route('vendor.index')->with('success','Berhasil di Update !');
        }
        else{
            return redirect()->back()->withInput()->with('errors','Gagal !');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $vendors = Vendor::where('id_vendor',$id);
        $valid= $vendors->update(['status'=>0]);
        if($valid){
            return redirect()->route('vendor.index')->with('success','Berhasil Terhapus !');
        }

    }

    public function restore($id){
        $vendors = Vendor::where('id_vendor',$id);
        $valid= $vendors->update(['status'=>1]);
        if($valid){
            return redirect()->route('vendor.index')->with('success','Berhasil di Restore !');
    }
}
}
