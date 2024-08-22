<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenLaporRutin extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];

    public function dokumen_lapor_rutin(): BelongsTo
    {
        return $this->belongsTo(PelaporanRutin::class);
    }
}
