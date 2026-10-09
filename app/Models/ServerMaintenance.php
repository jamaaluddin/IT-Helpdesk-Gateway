<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServerMaintenance extends Model
{
    protected $table = 'server_maintenance';

    protected $fillable = [
        'office_id',
        'performed_by',
        'ip_address',
        'security',
        'bandwidth',
        'maintenance_date',
        'result',
        'remarks',
    ];

    protected $casts = [
        'maintenance_date' => 'date',
    ];

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class);
    }

    public function performedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'performed_by');
    }
}
