<?php

use App\Http\Controllers\adminHomeController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\VendorController;
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

Route::get('/', function () {
    return view('welcome');
});

// ADMIN Dashboard
Route::get('/adminDashboard',[adminHomeController::class,'index'])->name('admin.home');

//Table Role
Route::get('/role',[RoleController::class,'index'])->name('role.index');
Route::get('role/create',[RoleController::class,'create'])->name('role.create');
Route::post('/role/store',[RoleController::class,'store'])->name('role.store');
Route::get('/role/edit/{id}',[RoleController::class,'edit'])->name('role.edit');
Route::put('/role/edit/{id}',[RoleController::class,'update'])->name('role.update');
Route::delete('/role/delete/{id}',[RoleController::class,'destroy'])->name('role.destroy');
Route::put('/role/restore/{id}',[RoleController::class,'restore'])->name('role.restore');

//Table Vendor
Route::get('/vendor',[VendorController::class,'index'])->name('vendor.index');
Route::get('/vendor/create',[VendorController::class,'create'])->name('vendor.create');
Route::post('/vendor/store',[VendorController::class,'store'])->name('vendor.store');
Route::get('/vendor/edit/{id}',[VendorController::class,'edit'])->name('vendor.edit');
Route::put('/vendor/edit/{id}',[VendorController::class,'update'])->name('vendor.update');
Route::delete('/vendor/delete/{id}',[VendorController::class,'destroy'])->name('vendor.destroy');
Route::put('/vendor/restore/{id}',[VendorController::class,'restore'])->name('vendor.restore');

//TABLE Satuan
Route::get('/satuan',[SatuanController::class,'index'])->name('satuan.index');
Route::get('/satuan/create',[SatuanController::class,'create'])->name('satuan.create');
Route::post('/satuan/store',[SatuanController::class,'store'])->name('satuan.store');
Route::get('satuan/edit/{id}',[SatuanController::class,'edit'])->name('satuan.edit');
Route::put('satuan/edit/{id}',[SatuanController::class,'update'])->name('satuan.update');
Route::delete('satuan/delete/{id}',[SatuanController::class,'destroy'])->name('satuan.destroy');
Route::put('satuan/restore/{id}',[SatuanController::class,'restore'])->name('satuan.restore');

//Table Barang
Route::get('/barang',[BarangController::class,'index'])->name('barang.index');
Route::get('/barang/create',[BarangController::class,'create'])->name('barang.create');
Route::post('/barang/store',[BarangController::class,'store'])->name('barang.store');
Route::get('/barang/edit/{id}',[BarangController::class,'edit'])->name('barang.edit');
Route::put('/barang/edit/{id}',[BarangController::class,'update'])->name('barang.update');
Route::delete('/barang/delete/{id}',[BarangController::class,'destroy'])->name('barang.destroy');
Route::put('/barang/restore/{id}',[BarangController::class,'restore'])->name('barang.restore');
