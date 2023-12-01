<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use App\Models\PresensiMasuk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PresensiMasukController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_peserta' => 'required|exists:peserta,id',
            'password' => 'required',
            'jam_masuk' => 'required',
            'coordinat' => 'required',
            'alamat' => 'required',
        ]);

        $peserta = Peserta::findOrFail($validatedData['id_peserta']);

        // Cek apakah peserta sudah melakukan absensi hari ini
        $today = Carbon::now()->toDateString();
        $existingPresensi = PresensiMasuk::where('id_peserta', $peserta->id)
            ->whereDate('tgl_masuk', $today)
            ->first();

        if ($existingPresensi) {
            return response()->json(['message' => 'Anda sudah melakukan absensi hari ini.']);
        }

        if (Hash::check($validatedData['password'], $peserta->password)) {
            $presensiMasuk = PresensiMasuk::create([
                'id_peserta' => $validatedData['id_peserta'],
                'jam_masuk' => $validatedData['jam_masuk'],
                'coordinat' => $validatedData['coordinat'],
                'alamat' => $validatedData['alamat'],
                'tgl_masuk' => $today, // Gunakan tanggal hari ini
            ]);

            return response()->json(['message' => 'Presensi masuk berhasil disimpan.']);
        } else {
            return response()->json(['message' => 'Password tidak valid.'], 401);
        }
    }


    public function masuk(Request $request)
    {
        $id_peserta = $request->input('id_peserta');
        $masuk = PresensiMasuk::where('id_peserta', $id_peserta)->get();
        return response()->json($masuk);
    }

    public function index(Request $request, $id_Pembimbing)
    {
        $masuk = PresensiMasuk::with(['peserta' => function ($query) {
            $query->select('id', 'nama', 'nama_pgl', 'id_pembimbing');
        }])
            ->whereHas('peserta', function ($query) use ($id_Pembimbing) {
                $query->where('id_pembimbing', $id_Pembimbing);
            })
            ->get();

        return response()->json($masuk);
    }
}
