<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BeritaAcara extends Model
{
    protected $table = 'berita_acara';

    protected $fillable = [
        'document_number',
        'title',
        'document_type',
        'document_date',
        'content',
        'related_parties',
        'signature_blocks',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'document_date' => 'date',
            'related_parties' => 'array',
            'signature_blocks' => 'array',
        ];
    }

    // Relasi ke User pembuat dokumen
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
