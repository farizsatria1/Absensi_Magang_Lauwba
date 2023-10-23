<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PesertaController extends Controller
{
    public function daftar(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama' => 'required|string|max:255',
                'asal' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:peserta',
                'password' => 'required|string|min:8',
            ]);

            $peserta = Peserta::create([
                'nama' => $request->nama,
                'asal' => $request->asal,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'id_pembimbing' => $request->id_pembimbing,
            ]);

            $token = $peserta->createToken('pesertaToken')->plainTextToken;

            return response()->json(['message' => 'Registrasi berhasil', 'token' => $token], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }


    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('username', 'password')))
        {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }

        $peserta = Peserta::where('username', $request['username'])->firstOrFail();

        $token = $peserta->createToken('pesertaToken')->plainTextToken;
        $peserta->token = $token;
        $peserta->token_type = 'Bearer';

        return response()
            ->json([
                'success' => true,
                'message' => 'Hi '.$peserta->nama.', selamat datang di sistem presensi',
                'data' => $peserta
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
}
