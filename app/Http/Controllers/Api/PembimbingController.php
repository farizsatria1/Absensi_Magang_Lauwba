<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ListPembimbingResource;
use App\Models\Pembimbing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PembimbingController extends Controller
{
    public $table = "pembimbing";

    public function index()
    {
        $pembimbings = Pembimbing::all();
        return ListPembimbingResource::collection($pembimbings);
    }

    public function login(Request $request)
    {
        try {
            // Validasi input
            $validatedData = $request->validate([
                'nip' => 'required|string',
                'password' => 'required|string',
            ]);

            // Ambil data pengguna dari database
            $pembimbing = Pembimbing::where('nip', $validatedData['nip'])->first();

            // Periksa keberadaan pengguna dan cocokkan kata sandi
            if ($pembimbing && Hash::check($validatedData['password'], $pembimbing->password)) {
                return response()->json([
                    'id' => $pembimbing->id,
                    'nama' => $pembimbing->nama,
                    'nip' => $pembimbing->nip,
                ]);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }

        // Jika tidak berhasil login
        return response()->json(['message' => 'Login failed'], 401);
    }
}
