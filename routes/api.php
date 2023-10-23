<?php

use App\Http\Controllers\PembimbingController;
use App\Http\Controllers\PesertaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//API Pembimbing
Route::post('/pembimbing',[PembimbingController::class,'login']);

//API Peserta
Route::post('/peserta',[PesertaController::class,'login']);
Route::post('/daftar',[PesertaController::class,'daftar']);
Route::get('/check-username', [PesertaController::class, 'checkUsername']);
Route::middleware('auth:sanctum')->post('/logout', [PesertaController::class, 'logout']);