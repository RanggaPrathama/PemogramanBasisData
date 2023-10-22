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
        //QUERY BUILDER
        // $vendors= DB::table('vendor')
        //         ->select('*')
        //         ->where('status',1)
        //         ->get();

        //QUERY SQL NATIVE
        $sql = 'SELECT * FROM vendor WHERE status = ?';
        $values = [1];
        $vendors = DB::select($sql,$values);
        return view('pages.admin.table.vendor.index',['vendors'=>$vendors]);

    }

    public function trash()
    {
        //QUERY BUILDER
        // $vendors= DB::table('vendors')
        //         ->select('*')
        //         ->where('status',0)
        //         ->get();

        // QUERY SQL NATIVE

        $query = 'SELECT * FROM vendor WHERE status = ?';
        $values = [0];
        $vendors = DB::select($query,$values);
        return view('pages.admin.table.vendor.trash',['vendors'=>$vendors]);
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
            'nama_vendor'=>'required|unique:vendor,nama_vendor',
            'badan_hukum'=>'required'
        ],[
            'nama_vendor.required'=>'Nama Vendor Harus Diisi',
            'badan_hukum.required'=>'Badan Hukum Harus Diisi',
            'nama_vendor.unique'=>'nama_vendor sudah ada ',
        ]);

        //QUERY BUILDER
        // $vendor = DB::table('vendor')->insert($validateddata);

        //QUERY SQL NATIVE
        $query = 'INSERT INTO vendor (nama_vendor,badan_hukum) VALUES (?,?)';
        $values = [$validateddata['nama_vendor'],$validateddata['badan_hukum']];
        $sql = DB::insert($query,$values);
        if($sql){
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
        //QUERY BUILDER
        // $vendors= DB::table('vendor')
        //     ->select('*')
        //     ->where('id_vendor',$id)
        //     ->first();

        //QUERY SQL NATIVE
        $query = 'SELECT * from vendor where id_vendor = ?';
        $values = [$id];
        $vendors = DB::select($query,$values);
        return view('pages.admin.table.vendor.update',['vendors'=>$vendors]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $validateddata = $request->validate([
            'nama_vendor'=>'required',
            'badan_hukum'=>'required'
        ],[
            'nama_vendor.required'=>'Nama Vendor Harus Diisi',
            'badan_hukum.required'=>'Badan Hukum Harus Diisi',

        ]);

        // QUERY BUILDER
        // $vendors = DB::table('vendor')->where('id_vendor',$id);
        // $valid = $vendors->update($validateddata);

        //QUERY SQL NATIVE
        $query = 'UPDATE vendor SET nama_vendor = ?, badan_hukum = ? WHERE id_vendor = ?';
        $values = [$validateddata['nama_vendor'],$validateddata['badan_hukum'],$id];
        $sql = DB::update($query,$values);
        if($sql){
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
        //QUERY BUILDER
        // $vendors =DB::table('vendor')->where('id_vendor',$id);
        // $valid= $vendors->update(['status'=>0]);

        //QUERY SQL NATIVE
        $query = 'UPDATE vendor SET status=? WHERE id_vendor=?';
        $values = [0,$id];
        $sql = DB::update($query,$values);
        if($sql){
            return redirect()->route('vendor.index')->with('success','Berhasil Terhapus !');
        }

    }

    public function restore($id){
        //QUERY BUILDER
        // $vendors = DB::table('vendor')->where('id_vendor',$id);
        // $valid= $vendors->update(['status'=>1]);

        //QUERY SQL NATIVE
        $query = 'UPDATE vendor SET status=? WHERE id_vendor=?';
        $value = [1,$id];
        $sql = DB::update($query,$value);
        if($sql){
            return redirect()->route('vendor.trash')->with('success','Berhasil di Restore !');
    }
}
public function restoreall(){
    //QUERY BUILDER
//    DB::table('vendor')->where('status', 0)->update(['status' => 1]);

    //QUERY SQL NATIVE

    $query = 'UPDATE vendor SET status = ? WHERE status = ?';
    $value = [1,0];
    $sql = DB::update($query,$value);
    if($sql){
        return redirect()->route('vendor.trash')->with('success','Semua Data Berhasil Di Restore Semua');
    }


}
}
