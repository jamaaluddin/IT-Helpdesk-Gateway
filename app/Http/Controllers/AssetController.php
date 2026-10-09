<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetType;
use App\Models\Office;
use App\Models\Department;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index()
    {
        $assets = Asset::with([
            'assetType',
            'office',
            'department'
        ])
        ->latest()
        ->get();

        return view('admin.assets.index', compact('assets'));
    }

    public function show(Asset $asset)
    {
        $asset->load([
            'assetType',
            'office',
            'department',
            'histories'
        ]);

        return view('admin.assets.show', compact('asset'));
    }

    public function edit(Asset $asset)
    {
        $assetTypes = AssetType::where('is_active', true)
            ->orderBy('name')
            ->get();

        $offices = Office::orderBy('name')
            ->get();

        $departments = Department::orderBy('name')
            ->get();

        return view('admin.assets.edit', compact(
            'asset',
            'assetTypes',
            'offices',
            'departments'
        ));
    }

    public function create()
    {
        $assetTypes = AssetType::where('is_active', true)
            ->orderBy('name')
            ->get();

        $offices = Office::orderBy('name')
            ->get();

        $departments = Department::orderBy('name')
            ->get();

        return view('admin.assets.create', compact(
            'assetTypes',
            'offices',
            'departments'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'asset_type_id' => 'required|exists:asset_types,id',
            'office_id' => 'required|exists:offices,id',
            'department_id' => 'nullable|exists:departments,id',

            'asset_code' => 'required|string|max:255|unique:assets,asset_code',
            'name' => 'required|string|max:255',

            'brand' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'serial_number' => 'nullable|string|max:255|unique:assets,serial_number',

            'purchase_price' => 'nullable|numeric|min:0',

            'condition' => 'required|in:good,minor_damage,major_damage,broken',

            'status' => 'required|in:available,in_use,maintenance,damaged,retired',

            'purchase_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        Asset::create($validated);

        return redirect()
            ->route('admin.assets.index')
            ->with('success', 'Aset berhasil ditambahkan.');
    }

    public function update(Request $request, Asset $asset)
    {
        $validated = $request->validate([
            'asset_type_id' => 'required|exists:asset_types,id',
            'office_id' => 'required|exists:offices,id',
            'department_id' => 'nullable|exists:departments,id',

            'asset_code' => 'required|string|max:255|unique:assets,asset_code,' . $asset->id,
            'name' => 'required|string|max:255',

            'brand' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'serial_number' => 'nullable|string|max:255|unique:assets,serial_number,' . $asset->id,

            'purchase_price' => 'nullable|numeric|min:0',

            'condition' => 'required|in:good,minor_damage,major_damage,broken',

            'status' => 'required|in:available,in_use,maintenance,damaged,retired',

            'purchase_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $asset->update($validated);

        return redirect()
            ->route('admin.assets.show', $asset)
            ->with('success', 'Data aset berhasil diperbarui.');
    }

    public function retire(Asset $asset)
    {
        $asset->update([
            'status' => 'retired',
        ]);

        return redirect()
            ->route('admin.assets.show', $asset)
            ->with('success', 'Aset berhasil dipensiunkan.');
    }

    public function destroy(Asset $asset)
    {
        $asset->histories()->delete();

        $asset->delete();

        return redirect()
            ->route('admin.assets.index')
            ->with('success', 'Aset berhasil dihapus.');
    }

}
