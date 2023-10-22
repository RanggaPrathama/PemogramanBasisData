<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use App\Http\Requests\StoreSatuanRequest;
use App\Http\Requests\UpdateSatuanRequest;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;


class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //QUERY BUILDER
        // $satuans = DB::table('satuan')
        //             ->select('id_satuan','nama_satuan','status')
        //             ->where('status',1)
        //             ->get();

        //QUERY SQL NATIVE
        $query = 'SELECT * FROM satuan WHERE status = ?';
        $values = [1];
        $satuans = DB::select($query,$values);
        return view('pages.admin.table.satuan.index',['satuans'=>$satuans]);
    }

    public function trash(){
        //QUERY BUILDER
        // $satuans=DB::table('satuan')->select('id_satuan','nama_satuan','status')->where('status',0)->get();


        //QUERY SQL NATIVE
        $query = 'SELECT * FROM satuan WHERE status = ?';
        $values = [0];
        $satuans = DB::select($query,$values);
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
            'nama_satuan'=>'required|unique:satuan,nama_satuan'
        ],
        [
            'nama_satuan.required'=>'Nama Satuan Sudah Ada'
        ]);

        // QUERY BUILDER
        // $data = DB::table('satuan')->insert($validatedData);

        //QUERY SQL NATIVE
        $query = 'INSERT INTO satuan (nama_satuan) VALUE (?)';
        $values = [$validatedData['nama_satuan']];
        $sql = DB::insert($query,$values);
        if($sql){
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
        //QUERY BUILDER
        // $satuans=DB::table('satuans')
        //             ->select('*')
        //             ->where('id_satuan',$id)
        //             ->first();

        //QUERY SQL NATIVE
        $query = 'SELECT * FROM satuan where id_satuan = ?';
        $kondisi = [$id];
        $satuans = DB::select($query,$kondisi);
        return view('pages.admin.table.satuan.update',['satuans'=>$satuans]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $validatedData= $request->validate([
            'nama_satuan'=>'required|unique:satuan,nama_satuan'
        ],
        [
            'nama_satuan.required'=>'Nama Satuan Sudah Ada'
        ]);

        //QUERY BUILDER
    //     $satuans = DB::table('satuan')->where('id_satuan',$id);
    //    $valid= $satuans->update($validatedData);

        //QUERY SQL NATIVE
        $query = 'UPDATE satuan SET nama_satuan=? WHERE id_satuan = ?';
        $values = [$validatedData['nama_satuan'],$id];
        $sql = DB::update($query,$values);
        if($sql){
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

        //QUERY BUILDER SUB JOIN
//      DB::transaction(function () use ($id) {

//         DB::table('satuan')
//             ->whereIn('id_satuan', function ($query) use ($id) {
//                 $query->select('id_satuan')
//                     ->from('satuans')
//                     ->where('id_satuan', $id);
//             })
//             ->update(['status' => 0]);


//        DB::table('barang')
//             ->whereIn('id_satuan', function ($query) use ($id) {
//                 $query->select('id_satuan')
//                     ->from('satuans')
//                     ->where('id_satuan', $id);
//             })
//             ->update(['status' => 0]);
//     }
// );

    //Query builder biasa
    //  DB::table('satuan')->where('id_satuan',$id)->update(['status'=>0]);

    
    //QUERY SQL NATIVE
    $query = 'UPDATE satuan SET status = ? WHERE id_satuan = ?';
    $value = [0,$id];
    $sql = DB::update($query,$value);

    // $query = 'UPDATE barang SET status = ? WHERE id_satuan = (SELECT * FROM satuan WHERE id_satuan = ?)';
    // $values = [0,$id];
    // $sql = DB::update($query,$values);

    if($sql){

        return redirect()->route('satuan.index')->with('success', 'Berhasil Terhapus');
    }
    }


    public function restore($id){

        //QUERY BUILDER SUB QUEERY
        // DB::transaction(function () use ($id) {

        //     DB::table('satuans')
        //         ->whereIn('id_satuan', function ($query) use ($id) {
        //             $query->select('id_satuan')
        //                 ->from('satuans')
        //                 ->where('id_satuan', $id);
        //         })
        //         ->update(['status' => 1]);


        //    DB::table('barangs')
        //         ->whereIn('id_satuan', function ($query) use ($id) {
        //             $query->select('id_satuan')
        //                 ->from('satuans')
        //                 ->where('id_satuan', $id);
        //         })
        //         ->update(['status' => 1]);
        // });

        //QUERY SQL NATIVE
        $query = 'UPDATE satuan SET status = ? WHERE id_satuan =?';
        $values = [1,$id];
        $sql = DB::update($query,$values);

        if($sql){
            return redirect()->route('satuan.trash')->with('success','Berhasil di Restore !');
        }
}
public function restoreall(){

    //QUERY BUILDER SUB JOIN
    // DB::transaction(function ()  {

    //     DB::table('satuans')
    //         ->whereIn('id_satuan', function ($query)  {
    //             $query->select('id_satuan')
    //                 ->from('satuans');

    //         })
    //         ->update(['status' => 1]);


    //    DB::table('barangs')
    //         ->whereIn('id_satuan', function ($query) {
    //             $query->select('id_satuan')
    //                 ->from('satuans');

    //         })
    //         ->update(['status' => 1]);
    // });

    //QUERY SQL NATIVE

    $query=('UPDATE satuan SET status=? WHERE status = ?');
    $values=[1,0];
    $sql = DB::update($query,$values);
    if($sql){
    return redirect()->route('satuan.trash')->with('success','Semua Data Berhasil Di Restore');
    }
}
}
