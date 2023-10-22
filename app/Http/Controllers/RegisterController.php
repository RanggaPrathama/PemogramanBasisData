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
            'email'=>'required|unique:users,email',
            'password'=>'required|confirmed',

        ],
    [
        'username.required'=>'Silahkan mengisi Username Anda !',
        'email.required'=>'Silahkan mengisi Email Anda !',
        'email.unique'=>'Email Sudah Ada !',
        'password.required'=>'Silahkan mengisi Password Anda !',
        'password.confirmed'=>'Password Tidak Sama !'
    ]);

        $role = DB::table('roles')->select('id_role')->where('nama_role','admin')->first();
        $data = [
            'id_role'=> $role->id_role,
            'username'=> $request->input('username'),
            'email'=> $request->input('email'),
            'password'=>bcrypt($request->input('password')),

        ];

       $tes= User::create($data);
      if($tes){
        return redirect()->route('login')->with('success','Berhasil !');
      }

    }

}
