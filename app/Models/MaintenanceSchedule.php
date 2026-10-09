<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MaintenanceSchedule extends Model
{
    protected $fillable = [
        'asset_id',
        'office_id',
        'scheduled_by',
        'scheduled_date',
        'actual_date',
        'status',
        'result',
        'remarks',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
        'actual_date' => 'date',
    ];

    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class);
    }

    public function scheduledBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'scheduled_by');
    }

    public function records(): HasMany
    {
        return $this->hasMany(MaintenanceRecord::class);
    }
}
