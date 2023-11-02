<?php

namespace App\Http\Controllers;

use App\Models\Pekerjaan;
use App\Models\ProgressMagang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgressController extends Controller
{
    public function index($id_peserta)
    {
        $progress = ProgressMagang::with(['pekerjaan' => function ($query) use ($id_peserta) {
            $query->where('id_peserta', $id_peserta)->select('id', 'id_peserta', 'judul');
        }])->get();

        return response()->json($progress);
    }

    public function tambahProgress(Request $request)
    {
        try {
            $data = $request->validate([
                'catatan' => 'required',
                'id_pekerjaan' => 'required|exists:pekerjaan,id',
                'foto_dokumentasi' => 'image|max:2048',
            ]);

            // Ambil id_pekerjaan dari tabel pekerjaan
            $pekerjaan = Pekerjaan::findOrFail($data['id_pekerjaan']);

            if ($request->hasFile('foto_dokumentasi')) {
                $image = $request->file('foto_dokumentasi');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('public/images', $imageName); // simpan gambar di storage dengan nama yang unik
                $imageUrl = url('/') . Storage::url('images/' . $imageName); // mendapatkan URL gambar dari storage
            } else {
                $imageName = null;
                $imageUrl = null;
            }

            $progress = ProgressMagang::create([
                'catatan' => $data['catatan'],
                'id_pekerjaan' => $pekerjaan->id, // Gunakan id_pekerjaan dari model Pekerjaan
                'foto_dokumentasi' => $imageUrl, // simpan URL gambar di database
            ]);

            return response()->json(['message' => 'Data progress magang berhasil ditambahkan.'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
