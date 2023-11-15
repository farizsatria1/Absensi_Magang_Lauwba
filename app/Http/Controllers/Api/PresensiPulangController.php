<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use App\Models\PresensiPulang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PresensiPulangController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_peserta' => 'required|exists:peserta,id',
            'password' => 'required',
            'jam_pulang' => 'required',
        ]);

        $peserta = Peserta::findOrFail($validatedData['id_peserta']);

        // Cek apakah peserta sudah melakukan absensi hari ini
        $today = Carbon::now()->toDateString();
        $existingPresensi = PresensiPulang::where('id_peserta', $peserta->id)
            ->whereDate('tgl_pulang', $today)
            ->first();

        if ($existingPresensi) {
            return response()->json(['message' => 'Anda sudah melakukan absensi hari ini.']);
        }

        if (Hash::check($validatedData['password'], $peserta->password)) {
            $presensiPulang = PresensiPulang::create([
                'id_peserta' => $validatedData['id_peserta'],
                'jam_pulang' => $validatedData['jam_pulang'],
                'tgl_pulang' => $today, // Gunakan tanggal hari ini
            ]);

            return response()->json(['message' => 'Presensi pulang berhasil disimpan.']);
        } else {
            return response()->json(['message' => 'Password tidak valid.'], 401);
        }
    }


    public function pulang(Request $request)
    {
        $id_peserta = $request->input('id_peserta');
        $pulang = PresensiPulang::where('id_peserta', $id_peserta)->get();
        return response()->json($pulang);
    }
}
