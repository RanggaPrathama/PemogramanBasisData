<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Query Builder
        // $roles=DB::table('role')->select('*')->where('status',1)->get();

        // SQL MENTAH QUERY RAW
        $roles = DB::select('SELECT * FROM role WHERE status = ?',[1]);
        return view('pages.admin.table.role.index',['roles'=>$roles]);
    }

    public function trash(){
        //Query Builder
        // $roles=DB::table('role')->select('*')->where('status',0)->get();

        // Query Mentah (Query raw sql native)
        $roles=DB::select('SELECT * FROM role WHERE status = ?',[0]);
        return view('pages.admin.table.role.trash',['roles'=>$roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.table.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateddata = $request->validate([
            'nama_role'=>'required|unique:role,nama_role'
        ],
    ['nama_role.required'=>'nama role sudah digunakan']);

        //Query Builder
    //    $data = DB::table('role')->insert($validateddata);

        //Query Sql Native

        $query = 'INSERT INTO role (nama_role) VALUE (?)';
        $values = [$validateddata['nama_role']];
        $data = DB::insert($query,$values);
        if($data){
            return redirect()->route('role.index')->with('success','Berhasil !');
        }
        else{
            return redirect()->back()->with('errors','GAGAL !')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //Query Builder
        // $roles = DB::table('role')
        //         ->select('id_role','nama_role')
        //         ->where('id_role',$id)
        //         ->first();

        // Query sql native
        $roles = DB::select('SELECT * FROM role where id_role=?',[$id]);
        return view('pages.admin.table.role.update',['roles'=>$roles]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $validateddata = $request->validate(
            ['nama_role'=>'required|unique:role,nama_role' ],
        ['nama_role.required'=>'nama role sudah digunakan']);

        //QUERY BUILDER
        // $roles = DB::table('role')->select('*')->where('id_role',$id);
        // $Data= $roles->update($validateddata);

        //SQL NATIVE QUERY RAW
        $sql = 'UPDATE role SET nama_role = ? WHERE id_role = ?';
        $values = [$validateddata['nama_role'],$id];
        $Data = DB::update($sql,$values);
            if($Data){
                return redirect()->route('role.index')->with('success','Berhasil !');
            }
            else{
                return redirect()->back()->with('errors','GAGAL !')->withInput();
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //QueryBuilder
        // $roles = DB::table('role')->where('id_role',$id);
        // $roles->update(['status'=>0]);

        //Query Native
        $sql = 'UPDATE role SET status = ? WHERE id_role = ?';
        $values = [0,$id];
        $query = DB::update($sql,$values);
        if($query){
        return redirect()->route('role.index')->with('success','Berhasil Dihapus !');
        }
        else{
            return redirect()->back()->with('errors','GAGAL !')->withInput();
        }
    }

    public function restore($id){
        //QUERY BUILDER
        // $roles=DB::table('role')->where('id_role',$id);
        // $roles->update(['status'=>1]);

        //QUERY NATIVE
        $sql = 'UPDATE role set status=? WHERE id_role = ?';
        $values = ['1',$id];
        $query = DB::update($sql,$values);
        if($query){
        return redirect()->route('role.trash')->with('success','Data Berhasil Di Restore');
        }
        else{
            return redirect()->back()->with('errors','GAGAL !')->withInput();
        }
    }

    public function restoreall(){
        //QUERY BUILDER
        // DB::table('role')->where('status', 0)->update(['status' => 1]);

        //QUERY NATIVE
        $sql = 'UPDATE role SET status = ? WHERE status = ?';
        $value =[1,0];
        $query = DB::update($sql,$value);
        if($query){
        return redirect()->route('role.trash')->with('success','Semua Data Berhasil Di Restore ');
        }
        else{
            return redirect()->back()->with('errors','GAGAL !')->withInput();
        }
    }
}
