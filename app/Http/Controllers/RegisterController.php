<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function register(){
        return view('pages.auth.register');
    }

    public function register_post(Request $request){

        $validatedData = $request->validate([
            'username'=>'required|string',
            'email'=>'required|unique:user,email',
            'password'=>'required|confirmed',

        ],
    [
        'username.required'=>'Silahkan mengisi Username Anda !',
        'email.required'=>'Silahkan mengisi Email Anda !',
        'email.unique'=>'Email Sudah Ada !',
        'password.required'=>'Silahkan mengisi Password Anda !',
        'password.confirmed'=>'Password Tidak Sama !'
    ]);

        // $role = DB::table('role')->select('id_role')->where('nama_role','admin')->first();
        $users = DB::table('user')->count();
        if($users>=1){
            $query = 'SELECT id_role From role WHERE upper(nama_role) LIKE upper(?)';
            $kondisi = ['user'];
            $role = DB::select($query,$kondisi);
            $data = [
                'id_role'=> $role[0]->id_role,
                'username'=> $request->input('username'),
                'email'=> $request->input('email'),
                'password'=>bcrypt($request->input('password')),

            ];
        }
        else{
            $query = 'SELECT id_role From role WHERE upper(nama_role) LIKE upper(?)';
            $kondisi = ['admin'];
            $role = DB::select($query,$kondisi);
            $data = [
                'id_role'=> $role[0]->id_role,
                'username'=> $request->input('username'),
                'email'=> $request->input('email'),
                'password'=>bcrypt($request->input('password')),

            ];
        };


    //    $tes= DB::table('user')->insert($data);

    $query =  ' INSERT INTO user(id_role,username,email,password) VALUES (?,?,?,?)';
    $values = [$data['id_role'],$data['username'],$data['email'],$data['password']];
    $sql = DB::insert($query,$values);
      if($sql){
        return redirect()->route('login')->with('success','Berhasil !');
      }

    }

}
