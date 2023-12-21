<?php

namespace App\Http\Controllers;

use App\Models\PresensiMasuk;
use App\Models\PresensiPulang;
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
            return view('cetak.notfound.404_presensi');
        }

        // Tambahkan kueri untuk mendapatkan data presensi pulang
        $presensiPulang = PresensiPulang::with('peserta')
            ->where('id_peserta', $id_peserta)
            ->get();

        // Menggabungkan data presensi pulang ke dalam data presensi masuk
        $presensiMasuk->each(function ($item) use ($presensiPulang) {
            $item->presensiPulang = $presensiPulang->where('id_peserta', $item->id_peserta)->where('tgl_pulang', $item->tgl_masuk)->first();
        });

        return view('cetak.cetak_presensi', ['presensiMasuk' => $presensiMasuk]);
    }
}
