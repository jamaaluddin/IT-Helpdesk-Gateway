<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserApprovalController extends Controller
{
    public function approve(User $user)
    {
        $user->update([
            'status' => 'active',
            'approved_at' => now(),
        ]);

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'User berhasil disetujui.');
    }

    public function reject(User $user)
    {
        $user->update([
            'status' => 'rejected',
        ]);

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'User berhasil ditolak.');
    }
}
