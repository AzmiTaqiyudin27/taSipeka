<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengajuanInsidental extends Model
{
    use HasFactory;
    protected $table = 'pelaporan_insidentals';
    protected $guarded = [
        'id'
    ];

    public function audit_insidental(): HasOne
    {
        return $this->hasOne(AuditInsidental::class);
    }
    public function pelapor(): BelongsTo
    {
        return $this->belongsTo(User::class); 
    }
    public function dokumen_laporan_insidentsl(): BelongsTo
    {
        return $this->belongsTo(DokumenLaporInsidental::class);
    }
}
