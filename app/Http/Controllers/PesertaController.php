<?php

namespace App\Http\Controllers;

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

    public function daftar(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama' => 'required|string|max:255',
                'asal' => 'required|string|max:255',
                'no_hp' => 'required|string|max:255',
                'asal_sekolah' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:peserta',
                'password' => 'required|string|min:8',
                'tgl_mulai' => 'required|string',
                'id_pembimbing' => 'required|exists:pembimbing,id' // Validate that the id_pembimbing exists in the 'pembimbing' table
            ]);

            $peserta = Peserta::create([
                'nama' => $request->nama,
                'asal' => $request->asal,
                'no_hp' => $request->no_hp,
                'asal_sekolah' => $request->asal_sekolah,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'tgl_mulai' => $request->tgl_mulai,
                'id_pembimbing' => $request->id_pembimbing // Assign the id_pembimbing here
            ]);

            $token = $peserta->createToken('pesertaToken')->plainTextToken;

            return response()->json(['message' => 'Registrasi berhasil', 'token' => $token], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }


    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('username', 'password'))) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $peserta = Peserta::where('username', $request['username'])->firstOrFail();

        $token = $peserta->createToken('pesertaToken')->plainTextToken;
        $peserta->token = $token;
        $peserta->token_type = 'Bearer';
        $peserta->pembimbing;

        return response()->json([
            'success' => true,
            'message' => 'Hi ' . $peserta->nama . ', selamat datang di sistem presensi',
            'data' => [
                'peserta' => $peserta,
            ]
        ]);
    }


    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();

            return response()->json(['message' => 'Logout berhasil'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
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

    public function update(Request $request, Peserta $peserta)
    {
        $peserta->update($request->all());
        return response()->json($peserta, 200);
    }
}
