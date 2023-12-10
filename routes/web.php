<?php

use App\Http\Controllers\adminHomeController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PengadaanController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Models\Satuan;
use App\Models\Vendor;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


//auth
Route::get('/login',[LoginController::class,'login'])->name('login');
Route::get('/register',[RegisterController::class,'register'])->name('register');
Route::post('/register',[RegisterController::class,'register_post']);
Route::post('/login',[LoginController::class,'login_post']);
Route::post('/logout',[LoginController::class,'logout'])->name('logout');

// ADMIN Dashboard
Route::get('/',[adminHomeController::class,'index'])->name('admin.home');

//Table Role
Route::get('/role',[RoleController::class,'index'])->name('role.index');
Route::get('role/create',[RoleController::class,'create'])->name('role.create');
Route::post('/role/store',[RoleController::class,'store'])->name('role.store');
Route::get('/role/edit/{id}',[RoleController::class,'edit'])->name('role.edit');
Route::put('/role/edit/{id}',[RoleController::class,'update'])->name('role.update');
Route::delete('/role/delete/{id}',[RoleController::class,'destroy'])->name('role.destroy');
Route::put('/role/restore/{id}',[RoleController::class,'restore'])->name('role.restore');
Route::get('/role/trash',[RoleController::class,'trash'])->name('role.trash');
Route::put('/role/restoreall',[RoleController::class,'restoreall'])->name('role.restoreall');

//Table User
Route::get('/user',[UserController::class,'index'])->name('user.index');
Route::get('/user/create',[UserController::class,'create'])->name('user.create');
Route::post('/user/store',[UserController::class,'store'])->name('user.store');
Route::get('/user/edit/{id}',[UserController::class,'edit'])->name('user.edit');
Route::put('/user/update/{id}',[UserController::class,'update'])->name('user.update');
Route::delete('/user/delete/{id}',[UserController::class,'destroy'])->name('user.destroy');
Route::get('/user/trash',[UserController::class,'trash'])->name('user.trash');
Route::put('/user/restore/{id}',[UserController::class,'restore'])->name('user.restore');
Route::put('/user/restoreall',[UserController::class,'restoreall'])->name('user.restoreall');


//Table Vendor
Route::get('/vendor',[VendorController::class,'index'])->name('vendor.index');
Route::get('/vendor/create',[VendorController::class,'create'])->name('vendor.create');
Route::post('/vendor/store',[VendorController::class,'store'])->name('vendor.store');
Route::get('/vendor/edit/{id}',[VendorController::class,'edit'])->name('vendor.edit');
Route::put('/vendor/edit/{id}',[VendorController::class,'update'])->name('vendor.update');
Route::delete('/vendor/delete/{id}',[VendorController::class,'destroy'])->name('vendor.destroy');
Route::put('/vendor/restore/{id}',[VendorController::class,'restore'])->name('vendor.restore');
Route::get('/vendor/trash',[VendorController::class,'trash'])->name('vendor.trash');
Route::put('/vendor/restoreall',[VendorController::class,'restoreall'])->name('vendor.restoreall');

//TABLE Satuan
Route::get('/satuan',[SatuanController::class,'index'])->name('satuan.index');
Route::get('/satuan/create',[SatuanController::class,'create'])->name('satuan.create');
Route::post('/satuan/store',[SatuanController::class,'store'])->name('satuan.store');
Route::get('satuan/edit/{id}',[SatuanController::class,'edit'])->name('satuan.edit');
Route::put('satuan/edit/{id}',[SatuanController::class,'update'])->name('satuan.update');
Route::delete('satuan/delete/{id}',[SatuanController::class,'destroy'])->name('satuan.destroy');
Route::put('satuan/restore/{id}',[SatuanController::class,'restore'])->name('satuan.restore');
Route::get('/satuan/trash',[SatuanController::class,'trash'])->name('satuan.trash');
Route::put('/satuan/restoreall',[SatuanController::class,'restoreall'])->name('satuan.restoreall');


//Table Barang
Route::get('/barang',[BarangController::class,'index'])->name('barang.index');
Route::get('/barang/create',[BarangController::class,'create'])->name('barang.create');
Route::post('/barang/store',[BarangController::class,'store'])->name('barang.store');
Route::get('/barang/edit/{id}',[BarangController::class,'edit'])->name('barang.edit');
Route::put('/barang/edit/{id}',[BarangController::class,'update'])->name('barang.update');
Route::delete('/barang/delete/{id}',[BarangController::class,'destroy'])->name('barang.destroy');
Route::put('/barang/restore/{id}',[BarangController::class,'restore'])->name('barang.restore');
Route::get('/barang/trash',[BarangController::class,'trash'])->name('barang.trash');
Route::put('/barang/restoreall',[BarangController::class,'restoreall'])->name('barang.restoreall');


Route::get('/coba',function(){
    return view('pages.admin.table.coba.form');
});


//Proses Pengadaan

Route::get('/Pengadaan',[PengadaanController::class,'index'])->name('pengadaan.index');
Route::get('/Pengadaan/create',[PengadaanController::class,'create'])->name('pengadaan.create');
Route::post('/caribarang',[PengadaanController::class,'caribarang']);
