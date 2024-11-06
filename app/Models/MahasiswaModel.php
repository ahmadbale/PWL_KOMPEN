<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use illuminate\Database\Eloquent\Factories\HasMany;
use illuminate\Database\Eloquent\Relations\BelongsTo;


class MahasiswaModel extends Model
{
    protected $table = 'mahasiswa';
    protected $primarykey = 'id_mahasiswa';

    use HasFactory;

    protected $fillable = ['id_prodi, username, nama, password'];
    protected $hidden = ["password"];
    protected $casts = [
        'password' => 'hashed'
    ];

    public function prodi(): BelongsTo
    {
        return $this->belongsTo(ProdiModel::class, 'id_prodi', 'id_prodi');
    }
}
