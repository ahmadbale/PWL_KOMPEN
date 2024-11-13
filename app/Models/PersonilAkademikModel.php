<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LevelModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PersonilAkademikModel extends Model
{
    
    protected $table = 'personil_akademik';
    protected $primaryKey = 'id_personil';

    use HasFactory;

    protected $fillable = ['id_personil', 'nomor_induk', 'username', 'nama', 'password', 'nomor_telp', 'id_level'];

    protected $hidden = ['password'];

    protected $casts = [
        'password' => 'hashed'
    ];

    public function level(): BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'id_level', 'id_level');
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