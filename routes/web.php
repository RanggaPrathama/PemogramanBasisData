<?php

use App\Http\Controllers\adminHomeController;
use App\Http\Controllers\RoleController;
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

// ADMIN
Route::get('/adminDashboard',[adminHomeController::class,'index'])->name('admin.home');

//tableRole
Route::get('/role',[RoleController::class,'index'])->name('role.index');
Route::get('role/create',[RoleController::class,'create'])->name('role.create');
Route::post('/role/store',[RoleController::class,'store'])->name('role.store');
Route::get('/role/update/{id}',[RoleController::class,'edit'])->name('role.edit');
Route::put('/role/edit/{id}',[RoleController::class,'update'])->name('role.update');
Route::delete('/role/destroy/{id}',[RoleController::class,'destroy'])->name('role.destroy');
Route::put('/role/restore/{id}',[RoleController::class,'restore'])->name('role.restore');
