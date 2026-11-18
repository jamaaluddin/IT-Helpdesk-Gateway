<?php

namespace App\Http\Controllers;

use App\Models\AssetType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AssetTypeController extends Controller
{
    public function index()
    {
        $assetTypes = AssetType::withCount('assets')
            ->orderBy('name')
            ->get();

        return view('admin.assets_types.index', compact('assetTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:asset_types,name',
            ],
            'description' => 'nullable|string|max:1000',
        ]);

        AssetType::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'is_active' => true,
        ]);

        return redirect()
            ->route('admin.asset-types.index')
            ->with('success', 'Jenis aset berhasil ditambahkan.');
    }

    public function update(Request $request, AssetType $assetType)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('asset_types', 'name')
                    ->ignore($assetType->id),
            ],
            'description' => 'nullable|string|max:1000',
        ]);

        $assetType->update($validated);

        return redirect()
            ->route('admin.asset-types.index')
            ->with('success', 'Jenis aset berhasil diperbarui.');
    }

    public function toggleStatus(AssetType $assetType)
    {
        $assetType->update([
            'is_active' => !$assetType->is_active,
        ]);

        return redirect()
            ->route('admin.asset-types.index')
            ->with('success', 'Status jenis aset berhasil diperbarui.');
    }
}
