<?php

namespace App\Http\Controllers;

use App\Models\Keterangan;
use App\Models\Peserta;
use Illuminate\Http\Request;

class WebKeteranganController extends Controller
{
    public function index(Request $request)
    {
        $keterangan = Keterangan::latest()->paginate(10); // Ubah "get()" menjadi "paginate(10)"
        $pesertaList = Peserta::pluck('nama', 'id');
        return view('peserta.keterangan.keterangan', [
            'keterangan' => $keterangan,
            compact('pesertaList')
        ]);
    }

    public function filter(Request $request)
    {
        // Ambil peserta yang dipilih dari permintaan
        $participantId = $request->input('participant');

        // Filter data keterangan berdasarkan peserta
        $keterangan = Keterangan::where('id_peserta', $participantId)->get();

        // Ambil daftar peserta
        $pesertaList = Peserta::pluck('nama', 'id');

        return view('peserta.keterangan.keterangan', [
            'keterangan' => $keterangan,
            'pesertaList' => $pesertaList,
        ]);
    }
}
