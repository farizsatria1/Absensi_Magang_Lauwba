<?php

namespace App\Http\Controllers;

use App\Models\Pekerjaan;
use App\Models\Peserta;
use App\Models\ProgressMagang;
use Illuminate\Http\Request;

class WebProgressController extends Controller
{
    public function index(Request $request)
    {
        $progress = ProgressMagang::latest()->paginate(10);
        return view('peserta.progress.progress', ['progress' => $progress]);
    }

    public function filter(Request $request)
    {
        // Ambil peserta yang dipilih dari permintaan
        $participantId = $request->input('participant');

        // Filter data progres berdasarkan peserta dengan join ke Pekerjaan
        $progress = ProgressMagang::join('pekerjaan', 'progress.id_pekerjaan', '=', 'pekerjaan.id')
            ->where('pekerjaan.id_peserta', $participantId)
            ->get();

        // Ambil daftar peserta
        $pesertaList = Peserta::pluck('nama', 'id');

        return view('peserta.progress.progress', [
            'progress' => $progress,
            'pesertaList' => $pesertaList,
        ]);
    }
}
