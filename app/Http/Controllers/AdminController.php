<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $pendingUsers = User::where('status', 'pending')->get();

        return view('admin.dashboard', compact('pendingUsers'));
    }
}
