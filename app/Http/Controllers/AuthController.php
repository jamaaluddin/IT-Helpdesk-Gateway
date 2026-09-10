<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
   public function showRegister()
{
    $offices = \App\Models\Office::where('is_active', true)->get();
    $departments = \App\Models\Department::where('is_active', true)->get();

    return view('auth.register', compact('offices', 'departments'));
}
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'office_id' => 'required|exists:offices,id',
            'department_id' => 'required|exists:departments,id',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'role_id' => 1,
            'office_id' => $validated['office_id'],
            'department_id' => $validated['department_id'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'password' => $validated['password'],
            'status' => 'pending',
        ]);

        return redirect()
            ->route('login')
            ->with('success', 'Registrasi berhasil. Akun Anda menunggu persetujuan Admin.');
    }
}
