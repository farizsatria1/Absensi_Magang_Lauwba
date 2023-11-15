<?php

use App\Http\Controllers\WebKeteranganController;
use App\Http\Controllers\WebPembimbingController;
use App\Http\Controllers\WebPesertaController;
use App\Http\Controllers\WebProgressController;
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
    return view('layouts.login');
}); 
Route::post('/', [WebLogin::class, 'login'])->name('login');
Route::post('/logout', [WebLogin::class, 'logout'])->name('logout');

//Peserta
Route::get('/peserta',[WebPesertaController::class, 'index'])->name('peserta.index'); 
Route::get('/peserta/create',[WebPesertaController::class, 'create'])->name('peserta.create'); 
Route::post('/peserta',[WebPesertaController::class, 'store'])->name('peserta.store');
Route::get('/peserta/{id}/edit',[WebPesertaController::class, 'edit'])->name('peserta.edit');
Route::put('/peserta/{id}',[WebPesertaController::class, 'update'])->name('peserta.update');
Route::get('/peserta/{id}',[WebPesertaController::class, 'destroy'])->name('peserta.destroy');

//Keterangan Izin Peserta
Route::get('/keterangan',[WebKeteranganController::class, 'index'])->name('keterangan.index');  
Route::get('/keterangan/filter',[WebKeteranganController::class, 'filter'])->name('keterangan.filter');  

//Progress Peserta
Route::get('/progress',[WebProgressController::class, 'index'])->name('progress.index'); 
Route::get('/progress/filter',[WebProgressController::class, 'filter'])->name('progress.filter'); 

//Pembimbing
Route::get('/pembimbing',[WebPembimbingController::class, 'index'])->name('pembimbing.index'); 
Route::get('/pembimbing/create',[WebPembimbingController::class, 'create'])->name('pembimbing.create'); 
Route::post('/pembimbing',[WebPembimbingController::class, 'store'])->name('pembimbing.store'); 
Route::get('/pembimbing/{id}/edit',[WebPembimbingController::class, 'edit'])->name('pembimbing.edit'); 
Route::put('/pembimbing/{id}',[WebPembimbingController::class, 'update'])->name('pembimbing.update'); 
Route::get('/pembimbing/{id}',[WebPembimbingController::class, 'destroy'])->name('pembimbing.destroy'); 
