<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('company.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 🔥 INI KUNCI UTAMA
        if (Auth::guard('company')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('company.dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid company credentials.',
        ]);
    }
}
