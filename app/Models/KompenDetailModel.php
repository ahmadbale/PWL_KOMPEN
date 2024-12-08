<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KompenDetailModel extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'kompen_detail';

    // Primary key
    protected $primaryKey = 'id_kompen_detail';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'id_kompen_detail',
        'id_kompen',
        'id_mahasiswa',
        'progres_1',
        'progres_2',
    ];

    // Relasi ke tabel Kompen
    public function kompen()
    {
        return $this->belongsTo(KompenModel::class, 'id_kompen', 'id_kompen');
    }

    // Relasi ke tabel Mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(MahasiswaModel::class, 'id_mahasiswa', 'id_mahasiswa');
    }
}
