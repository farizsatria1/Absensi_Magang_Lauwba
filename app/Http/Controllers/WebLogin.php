<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebLogin extends Controller
{
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        // Retrieve the admin by email
        $admin = Admin::where('email', $email)->first();

        // Check if the admin exists and the password is correct
        if ($admin && password_verify($password, $admin->password)) {
            return redirect()->intended('/default');
        }

        return redirect()->back()->withInput()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout()
    {
        // Perform any logout logic here
        return redirect('/');
    }
}
