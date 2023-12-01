<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class WebLoginController extends Controller
{
    public function showLogin()
    {
        return view('layouts.login');
    }

    // Fungsi untuk proses login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Jika login berhasil, redirect ke halaman yang diinginkan
            return redirect()->intended('/peserta');
        }

        // Jika login gagal, kembalikan ke halaman login dengan pesan error
        return redirect()->route('login')->with('error', 'Email atau password salah');
    }

    // Fungsi untuk proses logout
    public function logout()
    {
        Auth::logout();

        // Redirect ke halaman login setelah logout
        return redirect()->route('login');
    }
}
