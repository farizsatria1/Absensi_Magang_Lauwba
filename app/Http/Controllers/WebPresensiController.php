<?php

namespace App\Http\Controllers;

use App\Models\PresensiMasuk;
use Illuminate\Http\Request;

class WebPresensiController extends Controller
{
    public function index($id_peserta)
    {
        // Ambil data presensi masuk berdasarkan id_peserta
        $presensiMasuk = PresensiMasuk::with('peserta')
            ->where('id_peserta', $id_peserta)
            ->get();

        if ($presensiMasuk->isEmpty()) {
            return abort(404);
        }

        return view('cetak.cetak_presensi', ['presensiMasuk' => $presensiMasuk]);
    }
}
