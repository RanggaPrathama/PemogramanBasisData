<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(){

        //QUERY BUILDER
        // $users= DB::table('users')
        //         ->select('*','roles.nama_role')
        //         ->join('roles','users.id_role','=','roles.id_role')
                    //->where('status',1)
        //         ->get();

        //QUERY  SQL NATIVE
        $query = 'SELECT u.id_user, u.username, u.email, u.password, u.status, u.id_role, r.nama_role
                  FROM user u
                  JOIN role r ON r.id_role = u.id_role
                  WHERE u.status = ?';
        $kondisi = [1];
        $users = DB::select($query,$kondisi);
        return view('pages.admin.table.user.index',['users'=>$users]);
    }

    public function trash(){
        //QUERY BUILDER
        // $users= DB::table('users')
        //         ->select('*','roles.nama_role')
        //         ->join('roles','users.id_role','=','roles.id_role')
                    //->where('status',0)
        //         ->get();

        //QUERY SQL NATIVE
        $query = 'SELECT u.id_user, u.username, u.email, u.password, u.status, u.id_role, r.nama_role
        FROM user u
        JOIN role r ON r.id_role = u.id_role
        WHERE u.status = ?';
        $kondisi = [0];
        $users = DB::select($query,$kondisi);
        return view('pages.admin.table.user.trash',['users'=>$users]);

    }
    public function create(){
        //QUERY BUILDER
        // $roles = DB::table('role')->where('status',1)->get();

        //QUERY SQL NATIVE
        $query = 'SELECT * FROM role WHERE status = ?';
        $kondisi = [1];
        $roles = DB::select($query,$kondisi);
        return view('pages.admin.table.user.create',['roles'=>$roles]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'username'=>'required',
            'email' => 'required|unique:user,email',
            'password'=>'required|min:8|confirmed',
            'id_role'=>'required',
        ],
    [
        'username.required'=>'Username Wajib Diisi',
        'email.required'=>'Email Wajib Diisi',
        'email.unique' =>'email sudah ada',
        'password.required'=>'Password Wajib Diisi',
        'id_role.required'=>'Role Wajib Dipilih',
    ]);

        $data = [
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password'=>bcrypt($validatedData['password']),
            'id_role'=>$validatedData['id_role'],
        ];

        //QUERY BUILDER
        // $cek = DB::table('user')->insert($data);

        //QUERY SQL NATIVE
        $query = 'INSERT INTO user (id_role,username,email,password) VALUES (?,?,?,?)';
        $values = [$data['id_role'],$data['username'],$data['email'],$data['password']];
        $sql = DB::insert($query,$values);
        if($sql){
            return redirect()->route('user.index')->with('success','Berhasil !');
        }
    }

    public function edit($id){
        //QUERY BUILDER
        // $users = DB::table('user')->select('*')->where('id_user',$id)->first();
        // $roles = DB::table('roles')->select('*')->get();

        //QUERY SQL NATIVE
        $query = 'SELECT * FROM user WHERE id_user = ? ';
        $kondisi = [$id];
        $users = DB::select($query,$kondisi);

        $query = 'SELECT * FROM role WHERE status = ?';
        $kondisi = [1];
        $roles = DB::select($query,$kondisi);

        return view('pages.admin.table.user.update',['users'=>$users,'roles'=>$roles]);
    }

    public function update(Request $request, $id){
        $validatedData = $request->validate([
            'username'=>'required',
            'email' => 'required',
            'password'=>'required|confirmed',
            'id_role'=>'required',
        ],
    [
        'username.required'=>'Username Wajib Diisi',
        'email.required'=>'Email Wajib Diisi',
        'password.required'=>'Password Wajib Diisi',
        'id_role.required'=>'Role Wajib Dipilih',
    ]);

        $data = [
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password'=>bcrypt($validatedData['password']),
            'id_role'=>$validatedData['id_role'],
        ];

        //QUERY BUILDER
        // $user = DB::table('user')->where('id_user',$id);
        // $valid = $user->update($data);

        //QUERY SQL NATIVE
        $query = 'UPDATE user SET id_role = ? , username= ?, email = ?, password = ? WHERE id_user = ?';
        $values = [$data['id_role'],$data['username'],$data['email'],$data['password'],$id];
        $sql = DB::update($query,$values);
        if($sql){
            return redirect()->route('user.index')->with('success','Berhasil!');
        }
    }

    public function destroy($id){
        //QUERY BUILDER
        // DB::table('user')->where('id_user',$id)->update(['status'=>0]);

        //Query Native sql
        $query = 'UPDATE user SET status = ? WHERE id_user =?';
        $values = [0,$id];
        $sql = DB::update($query,$values);

        if($sql){
        return redirect()->route('user.index')->with('success','Berhasil Terhapus !');
        }
    }

    public function restore($id){
        //QUERY BUILDER
        // DB::table('user')->where('id_user',$id)->update(['status'=>1]);

        //QUERY SQL NATIVE
        $query = 'UPDATE user SET status = ? WHERE id_user =?';
        $values = [1,$id];
        $sql = DB::update($query,$values);

        if($sql){
        return redirect()->route('user.trash')->with('success','Berhasil di Restore !');
        }
    }

    public function restoreall(){
        //QUERY BUILDER
        // DB::table('user')->where('status',0)->update(['status'=> 1]);

        //QUERY SQL NATIVE
        $query = 'UPDATE user SET status = ? WHERE status = ?';
        $values =[1,0];
        $sql = DB::update($query,$values);
        if($sql){
            return redirect()->route('user.trash')->with('success','Semua Data Berhasil Di Restore !');
        }
    }
}
