<?php

use App\Http\Controllers\Api\KeteranganController;
use App\Http\Controllers\Api\PekerjaanController;
use App\Http\Controllers\Api\PembimbingController;
use App\Http\Controllers\Api\PesertaController;
use App\Http\Controllers\Api\PresensiMasukController;
use App\Http\Controllers\Api\PresensiPulangController;
use App\Http\Controllers\Api\ProgressController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//API Pembimbing
Route::get('/pembimbing', [PembimbingController::class, 'index']);
Route::post('/masuk-pembimbing',[PembimbingController::class,'login']);
Route::get('/pembimbing/{id}', [PembimbingController::class, 'getPembimbing']);

//API Peserta
Route::get('/peserta/{id_pembimbing}', [PesertaController::class, 'index']);
Route::post('/login-peserta',[PesertaController::class,'login']);
Route::post('/daftar',[PesertaController::class,'daftar']);
Route::get('/peserta',[PesertaController::class,'peserta']);
Route::get('/check-username', [PesertaController::class, 'checkUsername']);
Route::middleware('auth:sanctum')->post('/logout', [PesertaController::class, 'logout']);
Route::put('/update/{id}', [PesertaController::class, 'update']);

//API presensi masuk
Route::post('/presensi-masuk', [PresensiMasukController::class, 'store']);
Route::get('/masuk',[PresensiMasukController::class, 'masuk']);

//API presensi keluar
Route::post('/presensi-pulang', [PresensiPulangController::class, 'store']);
Route::get('/pulang',[PresensiPulangController::class, 'pulang']);

//API Pekerjaan
Route::post('/tambah-judul', [PekerjaanController::class, 'tambahJudul']);
Route::get('/judul', [PekerjaanController::class, 'index']);

//API Progress
Route::post('/tambah-progress', [ProgressController::class, 'tambahProgress']);
Route::get('/progress/{id_peserta}', [ProgressController::class, 'index']);

//API Keterangan
Route::post('/keterangan', [KeteranganController::class, 'store']);
Route::get('/keterangan/{id_peserta}', [KeteranganController::class, 'index']);

