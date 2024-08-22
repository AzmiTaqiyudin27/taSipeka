<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuditInsidental extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function pelaporan_insidental(): BelongsTo
    {
        return $this->belongsTo(PelaporanInsidental::class);
    }
    public function auditor(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
     public function kodeAudit()
    {
        return $this->belongsTo(KodeAudit::class, 'kode_audit', 'kode_audit_rutin');
    }

    public function unitkerja(){
         return $this->belongsTo(User::class, 'unitkerja_id');
    }
}
