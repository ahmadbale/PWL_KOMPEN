<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputBuktiModel extends Model
{
    use HasFactory;    use HasFactory;

    // Nama tabel (opsional jika nama model tidak sesuai dengan nama tabel di database)
    protected $table = 'input_bukti';

    // Primary Key
    protected $primaryKey = 'id_input_bukti';

    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'id_kompen',
        'id_mahasiswa',
        'uploud',
        'status',
    ];

    // Jika tabel menggunakan kolom timestamp, ubah ke true. Jika tidak, tetap false.
    public $timestamps = false;

    // Relasi ke tabel kompensasi
    public function kompen()
    {
        return $this->belongsTo(KompenModel::class, 'id_kompen', 'id_kompen');
    }

    // Relasi ke tabel mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(MahasiswaModel::class, 'id_mahasiswa', 'id_mahasiswa');
    }
}
