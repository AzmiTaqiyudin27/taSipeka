<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuditRutin extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];

    public function pelaporan_rutin(): BelongsTo
    {
        return $this->belongsTo(PelaporanRutin::class);
    }
    public function auditor(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function kodeAudit()
    {
        return $this->belongsTo(KodeAudit::class, 'kode_audit', 'kode_audit');
    }
    public function unitkerja(){
        return $this->belongsTo(User::class, 'unitkerja_id');
    }

}
