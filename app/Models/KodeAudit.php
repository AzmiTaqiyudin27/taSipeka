<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodeAudit extends Model
{
    use HasFactory;
        protected $guarded = [
        'id'
    ];

    public function auditsRutin()
    {
        return $this->hasMany(AuditRutin::class, 'kode_audit', 'kode_audit_rutin');
    }
}
