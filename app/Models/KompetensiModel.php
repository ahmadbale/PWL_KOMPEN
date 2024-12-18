<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KompetensiModel extends Model
{
    use HasFactory;

    protected $table = 'kompetensi';
    protected $primaryKey = 'id_kompetensi';
    protected $fillable = ['id_kompetensi', 'nama_kompetensi', 'deskripsi_kompetensi'];

    public function kompetensi_mahasiswa()
    {
        return $this->hasMany(KompetensiMahasiswaModel::class, 'id_kompetensi', 'id_kompetensi');
    }
}