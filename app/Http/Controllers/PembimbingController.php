<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembimbingController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('nip', 'password');

        if (Auth::attempt($credentials)) {
            $pembimbing = Auth::user();
            return response()->json([
                'id' => $pembimbing->id,
                'nama' => $pembimbing->nama,
                'nip' => $pembimbing->nip,
            ]);
        }

        return response()->json(['message' => 'Login failed'], 401);
    }
}
