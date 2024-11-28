<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use illuminate\Database\Eloquent\Relations\BelongsTo;


class PengajuanKompenModel extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'pengajuan_kompen';

    // Primary key
    protected $primaryKey = 'id_pengajuan_kompen';

    // Kolom yang dapat diisi
    protected $fillable = [
        'id_kompen',
        'id_mahasiswa',
        'status',
    ];

    // Relasi ke mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(MahasiswaModel::class, 'id_mahasiswa', 'id_mahasiswa');
    }

    // Relasi ke kompen
    public function kompen()
    {
        return $this->belongsTo(KompenModel::class, 'id_kompen', 'id_kompen');
    }

    public function getMahasiswaName(): string
    {
        return $this->mahasiswa->nama;
    }

    public function getKompenName(): string
    {
        return $this->kompen->nama;
    }
    
}
