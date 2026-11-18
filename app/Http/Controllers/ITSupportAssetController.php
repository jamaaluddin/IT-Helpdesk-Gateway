<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetType;
use App\Models\Office;
use App\Models\Department;
use App\Models\AssetHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ITSupportAssetController extends Controller
{
    /**
     * Menampilkan halaman utama kategori aset.
     */
    public function index()
    {
        $assetTypes = AssetType::where('is_active', true)
            ->withCount('assets')
            ->orderBy('name')
            ->get();

        return view('it-support.assets.index', compact('assetTypes'));
    }

    /**
     * Menampilkan daftar aset berdasarkan kategori.
     */
    public function category(AssetType $assetType)
    {
        if (!$assetType->is_active) {
            abort(404);
        }

        $assets = Asset::with([
            'assetType',
            'office',
            'department',
        ])
            ->where('asset_type_id', $assetType->id)
            ->orderBy('asset_code')
            ->get();

        return view('it-support.assets.category', compact(
            'assetType',
            'assets'
        ));
    }


    /**
     * Menampilkan detail aset.
     */
   public function show(Asset $asset)
    {
        $asset->load(['assetType', 'office', 'department']);

        $histories = $asset->histories()
            ->with(['user', 'office'])
            ->orderByDesc('action_date')
            ->orderByDesc('created_at')
            ->get();

        return view('it-support.assets.show', compact('asset', 'histories'));
    }
    /**
     * Menampilkan riwayat aktivitas aset.
     */
    public function history(Asset $asset)
    {
        $asset->load([
            'assetType',
            'office',
            'department',
        ]);

        $histories = $asset->histories()
            ->with(['user', 'office'])
            ->orderByDesc('action_date')
            ->orderByDesc('created_at')
            ->get();

        return view('it-support.assets.history', compact(
            'asset',
            'histories'
        ));
    }

    /**
     * Menampilkan form tambah aset.
     */
    public function create()
    {
        $assetTypes = AssetType::where('is_active', true)
            ->orderBy('name')
            ->get();

        $offices = Office::orderBy('name')->get();
        $departments = Department::orderBy('name')->get();

        return view('it-support.assets.create', compact(
            'assetTypes',
            'offices',
            'departments'
        ));
    }

    /**
     * Menyimpan aset baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'asset_type_id' => [
                'required',
                Rule::exists('asset_types', 'id')
                    ->where('is_active', true),
            ],
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

        DB::transaction(function () use ($validated) {
            $asset = Asset::create($validated);

            AssetHistory::create([
                'asset_id' => $asset->id,
                'user_id' => auth()->id(),
                'office_id' => $asset->office_id,
                'action' => 'created',
                'description' => 'Aset baru ditambahkan oleh IT Support.',
                'condition' => $asset->condition,
                'action_date' => now()->toDateString(),
            ]);
        });

        return redirect()
            ->route('it-support.assets.category', $validated['asset_type_id'])
            ->with('success', 'Aset berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit aset.
     */
    public function edit(Asset $asset)
    {
        $assetTypes = AssetType::where(function ($query) use ($asset) {
            $query->where('is_active', true)
                ->orWhere('id', $asset->asset_type_id);
        })
            ->orderBy('name')
            ->get();

        $offices = Office::orderBy('name')->get();
        $departments = Department::orderBy('name')->get();

        return view('it-support.assets.edit', compact(
            'asset',
            'assetTypes',
            'offices',
            'departments'
        ));
    }

    /**
     * Memperbarui data aset.
     */
    public function update(Request $request, Asset $asset)
    {
        $validated = $request->validate([
            'asset_type_id' => [
                'required',
                Rule::exists('asset_types', 'id')
                    ->where(function ($query) use ($asset) {
                        $query->where('is_active', true)
                            ->orWhere('id', $asset->asset_type_id);
                    }),
            ],

            'office_id' => 'required|exists:offices,id',
            'department_id' => 'nullable|exists:departments,id',

            'asset_code' => [
                'required',
                'string',
                'max:255',
                Rule::unique('assets', 'asset_code')->ignore($asset->id),
            ],

            'name' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',

            'serial_number' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('assets', 'serial_number')->ignore($asset->id),
            ],

            'purchase_price' => 'nullable|numeric|min:0',
            'condition' => 'required|in:good,minor_damage,major_damage,broken',
            'status' => 'required|in:available,in_use,maintenance,damaged,retired',
            'purchase_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        DB::transaction(function () use ($asset, $validated) {

            $asset->fill($validated);

            $dirtyFields = array_keys($asset->getDirty());

            $fieldLabels = [
                'asset_type_id' => 'Kategori aset',
                'office_id' => 'Kantor',
                'department_id' => 'Departemen',
                'asset_code' => 'Kode aset',
                'name' => 'Nama aset',
                'brand' => 'Merek',
                'model' => 'Model',
                'serial_number' => 'Nomor seri',
                'purchase_price' => 'Harga pembelian',
                'condition' => 'Kondisi',
                'status' => 'Status',
                'purchase_date' => 'Tanggal pembelian',
                'notes' => 'Catatan',
            ];

            $changedLabels = collect($dirtyFields)
                ->map(fn ($field) => $fieldLabels[$field] ?? $field)
                ->values()
                ->all();

            if (!empty($dirtyFields)) {
                $asset->save();

                AssetHistory::create([
                    'asset_id' => $asset->id,
                    'user_id' => auth()->id(),
                    'office_id' => $asset->office_id,
                    'action' => 'updated',
                    'description' => 'Data aset diperbarui oleh IT Support. Bagian yang diubah: '
                        . implode(', ', $changedLabels) . '.',
                    'condition' => $asset->condition,
                    'action_date' => now()->toDateString(),
                ]);
            }
        });

        return redirect()
            ->route('it-support.assets.category', $asset->fresh()->asset_type_id)
            ->with('success', 'Data aset berhasil diperbarui.');
    }
}
