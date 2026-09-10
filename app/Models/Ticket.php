<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    protected $table = 'tickets';

    protected $fillable = [
        'ticket_number',
        'user_id',
        'office_id',
        'department_id',
        'category_id',
        'subject',
        'description',
        'problem_image',
        'resolution_notes',
        'reopen_reason',
        'evidence',
        'priority',
        'status',
        'assigned_to',
        'assigned_at',
        'resolved_at',
        'closed_at',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(TicketCategory::class, 'category_id');
    }


    public function user(): BelongsTo
    {
    return $this->belongsTo(User::class, 'user_id');
    }
}
