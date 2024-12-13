<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class Kompen extends Model
// {
//     use HasFactory;
// }

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kompen extends Model
{
    use HasFactory;

    protected $table = 'kompen';
    protected $fillable = ['nomor_kompen','nama','deskripsi']; 

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'id_kompen');
    }
}

