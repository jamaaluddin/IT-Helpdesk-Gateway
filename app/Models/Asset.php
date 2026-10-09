<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Asset extends Model
{
    protected $fillable = [
        'asset_type_id',
        'office_id',
        'department_id',
        'asset_code',
        'name',
        'brand',
        'model',
        'serial_number',
        'purchase_price',
        'condition',
        'status',
        'purchase_date',
        'notes',
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'purchase_price' => 'decimal:2',
    ];

    public function assetType(): BelongsTo
    {
        return $this->belongsTo(AssetType::class);
    }

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function histories(): HasMany
    {
        return $this->hasMany(AssetHistory::class);
    }
}
