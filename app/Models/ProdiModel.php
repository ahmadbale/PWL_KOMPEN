<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProdiModel extends Model
{
    protected $table = 'prodi';
    protected $primarykey = 'id_prodi';

    protected $fillable = ['id_prodi', 'kode_prodi', 'nama_prodi'];

    public function mahasiswa():BelongsTo{
        return $this->belongsTo(MahasiswaModel::class);
    }
}