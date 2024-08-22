<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable 
{
    protected $guarded = [
        'id'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'role',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function pelaporan_rutin(): HasMany
    {
        return $this->hasMany(PelaporanRutin::class);
    }
    public function pelaporan_insidental(): HasMany
    {
        return $this->hasMany(PelaporanInsidental::class);
    }
    public function audit_rutin(): HasMany
    {
        return $this->hasMany(AuditRutin::class);
    }
    public function audit_insidental(): HasMany
    {
        return $this->hasMany(AuditInsidental::class);
    }

    public function unit_kerja(){
        return $this->hasMany(AuditInsidental::class, 'unitkerja_id');
    }
     public function auditsRutin()
    {
        return $this->hasMany(AuditRutin::class, 'unitkerja_id');
    }

}
