<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LevelModel extends Model
{
    use HasFactory;

    protected $table = 'level';
    protected $primaryKey = 'id_level';
    protected $fillable = ['id_level','kode_level', 'nama_level'];

    public function user():HasMany {
        return $this->hasMany(PersonilAkademikModel::class,'id_level', 'id_level');
    }

    public function mahasiswa():HasMany{
        return $this->hasMany(MahasiswaModel::class, 'id_level', 'id_level');
    }
}