<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use illuminate\Database\Eloquent\Factories\HasMany;
use illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;


class MahasiswaModel extends Authenticatable 
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id_mahasiswa';

    use HasFactory;

    protected $fillable = ['nomor_induk', 'username', 'nama', 'periode_tahun','password','jam_alpha','jam_kompen','jam_kompen_selesai','id_prodi','created_at','updated_at'];
    protected $hidden = ["password"];
    protected $casts = ['password' => 'hashed'];

    public function prodi(): BelongsTo
    {
        return $this->belongsTo(ProdiModel::class, 'id_prodi', 'id_prodi');
    }
    public function level(): BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'id_level', 'id_level');
    }

    public function getProdiName(): string
    {
        return $this->prodi->nama_prodi;
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