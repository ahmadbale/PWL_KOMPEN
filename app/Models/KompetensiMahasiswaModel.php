<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KompetensiMahasiswaModel extends Model
{
    use HasFactory;
    protected $table = 'kompetensi_mahasiswa';
    protected $primaryKey = 'id_kompetensi_mahasiswa';
    protected $fillable = [
        'id_kompetensi_mahasiswa',
        'id_mahasiswa',
        'id_kompetensi',
    ];
    public $timestamps = true;

    public function mahasiswa()
    {
        return $this->belongsTo(MahasiswaModel::class, 'id_mahasiswa', 'id_mahasiswa');
    }

    public function kompetensi()
    {
        return $this->belongsTo(KompetensiModel::class, 'id_kompetensi', 'id_kompetensi');
    }
}