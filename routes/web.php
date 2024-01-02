<?php

use App\Http\Controllers\adminHomeController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KartuStokController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\marginPenjualanController;
use App\Http\Controllers\PenerimaanController;
use App\Http\Controllers\PengadaanController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReturController;
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
Route::get('/',[LoginController::class,'login'])->name('login');
Route::get('/register',[RegisterController::class,'register'])->name('register');
Route::post('/register',[RegisterController::class,'register_post']);
Route::post('/',[LoginController::class,'login_post']);
Route::post('/logout',[LoginController::class,'logout'])->name('logout');

// ADMIN Dashboard
Route::get('/homeAdmin',[adminHomeController::class,'index'])->name('admin.home');

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

Route::get('/storage/{path}', function ($path) {
    $file = storage_path('app/public/' . $path);

    if (file_exists($file)) {
        return response()->file($file);
    } else {
        abort(404);
    }
})->where('path', '.*');


//TABLE Pengadaan

Route::get('/pengadaan',[PengadaanController::class,'index'])->name('pengadaan.index');
Route::get('/pengadaan/detail/{id}',[PengadaanController::class,'detail'])->name('pengadaan.detail');
Route::get('/pengadaan/create',[PengadaanController::class,'create'])->name('pengadaan.create');
Route::post('/caribarang',[PengadaanController::class,'caribarang']);
Route::post('/pengadaan/store',[PengadaanController::class,'store'])->name('pengadaan.store');

// TABLE PENERIMAAN
Route::get('/penerimaan',[PenerimaanController::class,'index'])->name('penerimaan.index');
Route::get('/penerimaan/create',[PenerimaanController::class,'create'])->name('penerimaan.create');
Route::get('/penerimaan/detailPengadaan/{id}',[PenerimaanController::class,'detailPengadaan']);
Route::post('/penerimaan/store',[PenerimaanController::class,'store'])->name('penerimaan.store');
Route::get('/penerimaan/detail/{id}',[PenerimaanController::class,'detailPenerimaan']);


//TABLE RETUR
Route::get('/retur',[ReturController::class,'index'])->name('retur.index');
Route::get('/retur/create',[ReturController::class,'create'])->name('retur.create');
Route::get('retur/detilPenerimaan/{id}',[ReturController::class,'detilPenerimaan']);
Route::post('/retur/store',[ReturController::class,'store'])->name('retur.store');
Route::get('/retur/detail/{id}',[ReturController::class,'detail'])->name('retur.detail');

// KARTU STOCK
Route::get('/kartuStock',[KartuStokController::class,'index'])->name('kartuStok.index');
Route::get('/kartuStock/detail/{id}',[KartuStokController::class,'detail'])->name('karStok.detail');


//MARGIN PENJUALAN
Route::get('/marginPenjualan',[marginPenjualanController::class,'index'])->name('marginPenjualan.index');
Route::get('/marginPenjualan/create',[marginPenjualanController::class,'create'])->name('marginPenjualan.create');
Route::post('/marginPenjualan/store',[marginPenjualanController::class,'store'])->name('marginPenjualan.store');
//TAMPILAN KASIR
Route::get('/kasir',[KasirController::class,'index'])->name('kasir.home');
