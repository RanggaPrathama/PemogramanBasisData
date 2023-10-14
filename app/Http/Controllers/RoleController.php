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
        $roles=DB::table('roles')->select('*')->get();
        return view('pages.admin.table.role.index',['roles'=>$roles]);
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
            'nama_role'=>'required|unique:roles,nama_role'
        ],
    ['nama_role.required'=>'nama role sudah digunakan']);

        $data = Role::create($validateddata);
        if($data){
            return redirect()->route('role.index')->with('success','Berhasil !');
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
        $roles = DB::table('roles')
                ->select('id_role','nama_role')
                ->where('id_role',$id)
                ->first();
        return view('pages.admin.table.role.update',['roles'=>$roles]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $validateddata = $request->validate(
            ['nama_role'=>'required|unique:roles,nama_role' ],
        ['nama_role.required'=>'nama role sudah digunakan']);

        $roles = DB::table('roles')->select('*')->where('id_role',$id);
        $Data= $roles->update($validateddata);
            if($Data){
                return redirect()->route('role.index')->with('success','Berhasil !');
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $roles = Role::where('id_role',$id);

        $roles->update(['status'=>0]);
        return redirect()->route('role.index')->with('success','Berhasil Dihapus !');
    }

    public function restore($id){
        $roles=Role::where('id_role',$id);
        $roles->update(['status'=>1]);
        return redirect()->route('role.index')->with('success','Data Berhasil Di Restore');
    }
}
