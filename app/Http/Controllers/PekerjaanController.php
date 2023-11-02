<?php

namespace App\Http\Controllers;

use App\Models\Pekerjaan;
use Illuminate\Http\Request;

class PekerjaanController extends Controller
{
    public function index()
    {
        $pekerjaan = Pekerjaan::all();
        return response()->json($pekerjaan);
    }


    public function tambahJudul(Request $request)
    {
        try {
            $data = $request->validate([
                'judul' => 'required',
                'id_peserta' => 'required',
            ]);

            $pekerjaan = Pekerjaan::create($data);

            return response()->json([
                'status' => 'success',
                'data' => $pekerjaan,
                'message' => 'Data judul pekerjaan berhasil ditambahkan.'
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
