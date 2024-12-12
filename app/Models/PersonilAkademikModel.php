<?php

namespace App\Models;

use App\Models\LevelModel;
use App\Models\KompenModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class PersonilAkademikModel extends Authenticatable implements JWTSubject
{
    public function getJWTIdentifier(){
        return $this->getKey();
    }
    public function getJWTCustomClaims(){
        return [];
    }
    
    protected $table = 'personil_akademik';
    protected $primaryKey = 'id_personil';
    protected $fillable = ['id_personil', 'nomor_induk', 'image', 'username', 'nama', 'nomor_telp', 'id_level',  'password'];

    protected $hidden = ['password'];

    protected $casts = [
        'password' => 'hashed'
    ];

    public function level(): BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'id_level', 'id_level');
    }

    public function kompen(): HasMany
    {
        return $this->hasMany(KompenModel::class, 'id_personil', 'id_personil');
    }


    public function getroleName(): string
    {
        return $this->level->nama_level;
    }

    public function hasRole($role): bool
    {
        return $this->level->kode_level == $role;
    }

    public function getRole()
    {
        return $this->level->kode_level;
    }
}