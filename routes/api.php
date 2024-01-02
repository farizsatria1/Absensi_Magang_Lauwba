<?php

use App\Http\Controllers\Api\CarouselController;
use App\Http\Controllers\Api\KeteranganController;
use App\Http\Controllers\Api\PekerjaanController;
use App\Http\Controllers\Api\PembimbingController;
use App\Http\Controllers\Api\PesertaController;
use App\Http\Controllers\Api\PresensiMasukController;
use App\Http\Controllers\Api\PresensiPulangController;
use App\Http\Controllers\Api\ProgressController;
use App\Http\Controllers\Api\PiketController;
use App\Http\Controllers\Api\TrainerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//API Pembimbing
Route::get('/pembimbing', [PembimbingController::class, 'index']);
Route::post('/masuk-pembimbing',[PembimbingController::class,'login']);
Route::get('/pembimbing/{id}', [PembimbingController::class, 'getPembimbing']);

//API Peserta
Route::get('/peserta/{id_pembimbing}', [PesertaController::class, 'index']);
Route::post('/login-peserta',[PesertaController::class,'login']);
Route::get('/peserta',[PesertaController::class,'peserta']);
Route::put('/peserta/{id}/update-password', [PesertaController::class, 'update']);

//API presensi masuk
Route::post('/presensi-masuk', [PresensiMasukController::class, 'store']);
Route::get('/masuk',[PresensiMasukController::class, 'masuk']);
Route::get('/allMasuk/{id_pembimbing}',[PresensiMasukController::class, 'index']);

//API presensi keluar
Route::post('/presensi-pulang', [PresensiPulangController::class, 'store']);
Route::get('/pulang',[PresensiPulangController::class, 'pulang']);

//API Pekerjaan
Route::post('/tambah-judul', [PekerjaanController::class, 'tambahJudul']);
Route::get('/judul', [PekerjaanController::class, 'index']);

//API Progress
Route::post('/tambah-progress', [ProgressController::class, 'tambahProgress']);
Route::get('/progress/{id_peserta}', [ProgressController::class, 'index']);
Route::get('/progress', [ProgressController::class, 'progress']);
Route::get('/progress-magang/{id_peserta}', [ProgressController::class, 'progressByPeserta']);
Route::get('/allProgress/{id_pembimbing}', [ProgressController::class, 'allProgress']);
Route::post('/progress/{id}/update-progress', [ProgressController::class, 'updateProgress']);
Route::put('/progress/{id}/update-status', [ProgressController::class, 'updateStatus']);
Route::put('/progress/{id}/update-approve', [ProgressController::class, 'updatePesertaApprove']);


//API Keterangan
Route::post('/keterangan', [KeteranganController::class, 'store']);
Route::get('/keterangan/{id_peserta}', [KeteranganController::class, 'index']);

//API Carousel
Route::get('/carousel', [CarouselController::class, 'index']);

//API Piket
Route::get('/piket', [PiketController::class, 'piket']);
Route::get('/piket/{id_peserta}', [PiketController::class, 'piketPeserta']);

