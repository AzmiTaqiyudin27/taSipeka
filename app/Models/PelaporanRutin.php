<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PelaporanRutin extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];

    public function audit_rutin(): HasOne
    {
        return $this->hasOne(AuditRutin::class);
    }
    public function pelapor(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function dokumen_laporan_rutin(): HasMany
    {
        return $this->HasMany(DokumenLaporRutin::class);
    }
}
