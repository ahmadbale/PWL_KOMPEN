<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class JenisKompenModel extends Model
{
    use HasFactory;

    protected $table = 'jenis_kompen';
    protected $primaryKey = 'id_jenis_kompen';
    protected $fillable = ['id_jenis_kompen','kode_jenis', 'nama_jenis'];
    
    // public function mahasiswa(): BelongsTo
    // {
    //     return $this->belongsTo(MahasiswaModel::class, 'id_mahasiswa', 'id_mahasiswa');
    // }
}
