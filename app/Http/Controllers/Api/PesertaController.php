<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PesertaController extends Controller
{
    public function index(Request $request, $id_pembimbing)
    {
        $peserta = Peserta::where('id_pembimbing', $id_pembimbing)->get();
        if ($peserta->isEmpty()) {
            return response()->json(['message' => 'Peserta not found'], 404);
        }
        $pesertaNama = $peserta;
        return response()->json(['peserta' => $pesertaNama], 200);
    }

    public function login(Request $request)
    {
        try {
            // Validasi input
            $validatedData = $request->validate([
                'username' => 'required|string',
                'password' => 'required|string',
            ]);

            // Ambil data pengguna dari database
            $peserta = Peserta::where('username', $validatedData['username'])->first();
            $peserta->pembimbing;

            // Periksa keberadaan pengguna dan cocokkan kata sandi
            if ($peserta && Hash::check($validatedData['password'], $peserta->password)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Hi ' . $peserta->nama . ', selamat datang di sistem presensi',
                    'data' => [
                        'peserta' => $peserta,
                    ]
                ]);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }

        // Jika tidak berhasil login
        return response()->json(['message' => 'Login failed'], 401);
    }

    public function checkUsername(Request $request)
    {
        $username = $request->query('username');
        $user = Peserta::where('username', $username)->first();
        if ($user) {
            return response()->json(['exists' => true]);
        } else {
            return response()->json(['exists' => false]);
        }
    }

    public function peserta()
    {
        $peserta = Peserta::with('pembimbing:id,nama')->get();
        return response()->json($peserta);
    }

    public function update(Request $request, $id)
    {
        try {
            // Validate input
            $validatedData = $request->validate([
                'password' => 'required|string|min:8',
            ]);

            // Find the Peserta by ID
            $peserta = Peserta::find($id);

            // Check if the Peserta exists
            if (!$peserta) {
                return response()->json(['message' => 'Peserta not found'], 404);
            }

            // Update the password
            $peserta->password = Hash::make($validatedData['password']);
            $peserta->save();

            return response()->json(['message' => 'Password updated successfully'], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return response()->json(['message' => $e->getMessage()], 422);
        } catch (\Exception $e) {
            // Handle other exceptions
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
