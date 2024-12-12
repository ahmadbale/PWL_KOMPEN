<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListKompetensiMahasiswaModel extends Model
{
    use HasFactory;

    protected $table = 'list_kompetensi_mahasiswa';
    protected $primaryKey = 'id_list_kompetensi_mahasiswa';
    protected $fillable = ['id_list_kompetensi_mahasiswa','id_mahasiswa', 'id_kompetensi'];

}
