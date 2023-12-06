<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(){
        return view('pages.auth.login');
    }

    public function login_post(Request $request){
        $validateddata = $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);

        $infoLogin = [
            'email'=>$request->input('email'),
            'password'=>$request->input('password'),
        ];

        // if(Auth::attempt($infoLogin)){
        //     $request->session()->regenerate();
        //     return redirect()->route('admin.home')->with('success','Selamat Datang ADMIN !');
        // }
        // else{
        //     return redirect()->back()->with('errors','Gagal !')->withInput();
        // }

    // $validUser = DB::table('user')
    // ->where('email', $infoLogin['email'])
    // ->first();

    $query = 'SELECT * from user where email = ?';
    $kondisi = [$infoLogin['email']];
    $validUser = DB::select($query,$kondisi);

    if ($validUser && Hash::check($infoLogin['password'], $validUser[0]->password)) {
        Auth::loginUsingId($validUser[0]->id_user); // Autentikasi pengguna
        $request->session()->regenerate();
        return redirect()->route('admin.home')->with('success', 'Selamat Datang ADMIN!');
    } else {
        return redirect()->back()->with('errors', 'Gagal!')->withInput();
    }







}

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }

    protected function loggedOut(Request $request)
    {
        //
    }
}
