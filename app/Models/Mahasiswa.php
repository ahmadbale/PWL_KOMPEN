<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class Mahasiswa extends Model
// {
//     use HasFactory;
// }

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';
    protected $fillable = ['id_mahasiswa','nomor_induk','username','nama','periode_tahun','password','jam_alpha','jam_kompen', 'id_prodi', 'id_level','id_kompen']; // Sesuaikan kolom

    public function kompen()
    {
        return $this->belongsTo(Kompen::class, 'id_kompen');
    }
}

