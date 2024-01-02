<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pekerjaan;
use App\Models\Pembimbing;
use App\Models\Peserta;
use App\Models\ProgressMagang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgressController extends Controller
{
    public function index($id_peserta)
    {
        $progress = ProgressMagang::with([
            'pekerjaan' => function ($query) use ($id_peserta) {
                $query->where('id_peserta', $id_peserta)->select('id', 'id_peserta', 'judul');
            },
            'pembimbing' => function ($query) {
                $query->select('id', 'nama'); // asumsikan 'nama' adalah kolom untuk nama pembimbing
            },
            'peserta' => function ($query) {
                $query->select('id', 'nama'); // asumsikan 'nama' adalah kolom untuk nama peserta
            }
        ])->get();

        return response()->json($progress);
    }

    public function progress()
    {
        $progressMagang = ProgressMagang::with(['pekerjaan' => function ($query) {
            $query->with('peserta:id,nama,nama_pgl,status,id_pembimbing');
        }])
            ->with('pembimbing:id,nama')
            ->with('peserta:id,nama')
            ->get();

        return response()->json($progressMagang);
    }

    public function progressByPeserta($id_peserta)
    {
        $progressMagang = ProgressMagang::with(['pekerjaan' => function ($query) use ($id_peserta) {
            $query->where('id_peserta', $id_peserta)->select('id', 'id_peserta', 'judul');
        }])
            ->with('pembimbing:id,nama')
            ->with('peserta:id,nama')
            ->get();

        return response()->json($progressMagang);
    }

    public function allProgress(Request $request, $id_pembimbing)
    {
        $peserta = Peserta::where('id_pembimbing', $id_pembimbing)
            ->with(['pekerjaan' => function ($query) {
                $query->select('id', 'id_peserta', 'judul');
            }, 'pekerjaan.progress' => function ($query) {
                $query->select('id', 'id_pekerjaan', 'foto_dokumentasi');
            }])
            ->select('id', 'id_pembimbing', 'nama')
            ->get();

        if ($peserta->isEmpty()) {
            return response()->json(['message' => 'Peserta not found'], 404);
        }

        return response()->json(['peserta' => $peserta,], 200);
    }


    public function tambahProgress(Request $request)
    {
        try {
            $data = $request->validate([
                'id_pekerjaan' => 'required|exists:pekerjaan,id',
                'catatan' => 'required',
                'trainer_pembimbing' => 'nullable|exists:pembimbing,id',
                'trainer_peserta' => 'nullable|exists:peserta,id',
                'foto_dokumentasi' => 'image|max:2048',
            ]);

            // Ambil id_pekerjaan dari tabel pekerjaan
            $pekerjaan = Pekerjaan::findOrFail($data['id_pekerjaan']);
            $pembimbing = null;
            if ($data['trainer_pembimbing'] != null) {
                $pembimbing = Pembimbing::findOrFail($data['trainer_pembimbing']);
            }
            $peserta = null;
            if ($data['trainer_peserta'] != null) {
                $peserta = Peserta::findOrFail($data['trainer_peserta']);
            }

            $imageName = null; // Initialize imageName as null

            if ($request->hasFile('foto_dokumentasi')) {
                $image = $request->file('foto_dokumentasi');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('public/images', $imageName); // simpan gambar di storage dengan nama yang unik
            }

            $progress = ProgressMagang::create([
                'id_pekerjaan' => $pekerjaan->id,
                'catatan' => $data['catatan'],
                'trainer_pembimbing' => $pembimbing != null ? $pembimbing->id : null,
                'trainer_peserta' => $peserta != null ? $peserta->id : null,
                'foto_dokumentasi' => $imageName, // Store only the image name in the database
                'created_at' => now(),
            ]);

            return response()->json(['message' => 'Data progress magang berhasil ditambahkan.'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function updateProgress(Request $request, $id)
    {
        try {
            $data = $request->validate([
                'catatan' => 'required',
                'foto_dokumentasi' => 'image|max:2048',
            ]);

            // Ambil id_progress dari tabel progress_magang
            $progress = ProgressMagang::findOrFail($id);

            $oldImageName = $progress->foto_dokumentasi; // Get the current image name

            // Delete the old image
            Storage::delete('public/images/' . $oldImageName);

            if ($request->hasFile('foto_dokumentasi')) {
                $image = $request->file('foto_dokumentasi');
                $newImageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('public/images', $newImageName); // simpan gambar di storage dengan nama yang unik

                $progress->update([
                    'catatan' => $data['catatan'],
                    'foto_dokumentasi' => $newImageName, // Store only the image name in the database
                ]);
            } else {
                $progress->update([
                    'catatan' => $data['catatan'],
                ]);
            }

            return response()->json(['message' => 'Data progress magang berhasil diperbarui.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }



    public function updateStatus(Request $request, $id)
    {
        try {
            $data = $request->validate([
                'status' => 'required|in:0,1,2', // Status harus 0 atau 1
            ]);

            // Temukan progress magang berdasarkan ID
            $progress = ProgressMagang::findOrFail($id);

            // Perbarui status
            $progress->status = $data['status'];
            $progress->save();

            return response()->json(['message' => 'Status progress magang berhasil diperbarui.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function updatePesertaApprove(Request $request, $id)
    {
        try {
            $data = $request->validate([
                'peserta_approve' => 'required|in:0,1', // Status harus 0 atau 1
            ]);

            // Temukan progress magang berdasarkan ID
            $progress = ProgressMagang::findOrFail($id);

            // Perbarui peserta_approve
            $progress->peserta_approve = $data['peserta_approve'];
            $progress->save();

            return response()->json(['message' => 'Status progress magang berhasil diperbarui.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
