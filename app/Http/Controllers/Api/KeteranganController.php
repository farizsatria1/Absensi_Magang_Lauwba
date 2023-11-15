<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Keterangan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KeteranganController extends Controller
{
    public function index($id_peserta)
    {
        try {
            $data = Keterangan::where('id_peserta', $id_peserta)->get();

            if ($data->isEmpty()) {
                return response()->json(['message' => 'Data not found'], 404);
            }

            return response()->json(['data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error retrieving data: ' . $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'keterangan' => 'required',
                'catatan' => 'nullable',
                'id_peserta' => 'required',
            ]);

            $existingKeterangan = Keterangan::whereDate('created_at', Carbon::today())
                ->where('id_peserta', $data['id_peserta'])
                ->first();

            if ($existingKeterangan) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Hanya diperbolehkan mengisi keterangan sekali dalam satu hari.'
                ], 422);
            }

            $keterangan = Keterangan::create($data);

            return response()->json([
                'status' => 'success',
                'data' => $keterangan,
                'message' => 'Data keterangan berhasil ditambahkan.'
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
