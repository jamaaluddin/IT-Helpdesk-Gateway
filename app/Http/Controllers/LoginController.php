<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = \App\Models\User::where('email', $credentials['email'])->first();

        if (!$user) {
            return back()
                ->withErrors([
                    'email' => 'Email atau password salah.',
                ])
                ->withInput();
        }

        if ($user->status !== 'active') {
            return back()
                ->withErrors([
                    'email' => 'Akun Anda belum aktif. Silakan menunggu persetujuan Admin.',
                ])
                ->withInput();
        }

        if (!Auth::attempt($credentials)) {
            return back()
                ->withErrors([
                    'email' => 'Email atau password salah.',
                ])
                ->withInput();
        }

        $request->session()->regenerate();

        if ($user->role_id === 3) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role_id === 2) {
            return redirect()->route('it-support.dashboard');
        }

        if ($user->role_id === 1) {
            return redirect()->route('user.dashboard');
        }

        return redirect('/');
    }
}
