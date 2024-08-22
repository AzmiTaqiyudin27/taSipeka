<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenLaporInsidental extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];

    public function dokumen_lapor_insidental(): BelongsTo
    {
        return $this->belongsTo(PelaporanInsidental::class);
    }
}
