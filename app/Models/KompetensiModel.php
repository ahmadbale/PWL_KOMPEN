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
    protected $fillable = ['id_kompetensi','nama_kompetensi', 'deskripsi_kompetensi'];

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(MahasiswaModel::class, 'id_mahasiswa', 'id_mahasiswa');
    }
}
