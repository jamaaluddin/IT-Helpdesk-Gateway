
<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Http\JsonResponse;

class AssetController extends Controller
{
    public function index(): JsonResponse
    {
        $assets = Asset::query()
            ->select([
                'id',
                'asset_type_id',
                'office_id',
                'department_id',
                'asset_code',
                'name',
                'brand',
                'model',
                'serial_number',
                'condition',
                'status',
                'purchase_date',
                'created_at',
                'updated_at',
            ])
            ->orderByDesc('created_at')
            ->paginate(15);

        return response()->json([
            'success' => true,
            'message' => 'Asset list retrieved successfully.',
            'data' => $assets->items(),
            'meta' => [
                'current_page' => $assets->currentPage(),
                'last_page' => $assets->lastPage(),
                'per_page' => $assets->perPage(),
                'total' => $assets->total(),
            ],
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $asset = Asset::query()
            ->select([
                'id',
                'asset_type_id',
                'office_id',
                'department_id',
                'asset_code',
                'name',
                'brand',
                'model',
                'serial_number',
                'condition',
                'status',
                'purchase_date',
                'created_at',
                'updated_at',
            ])
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Asset detail retrieved successfully.',
            'data' => $asset,
        ]);
    }
}
