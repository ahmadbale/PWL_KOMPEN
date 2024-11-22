<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LevelModel extends Model
{
<<<<<<< HEAD
    protected $table = 'level';        // Mendefinisikan nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'id_level';  //Mendefinisikan primary key dari tabel yang digunakan

    protected $fillable = ['id_level','kode_level','nama_level'];
    public function user():BelongsTo {
        return $this->belongsTo(PersonilAkademikModel::class);
=======
    use HasFactory;

    protected $table = 'level';
    protected $primaryKey = 'id_level';
    protected $fillable = ['id_level','kode_level', 'nama_level'];

    public function user():HasMany {
        return $this->hasMany(PersonilAkademikModel::class,'id_level', 'id_level');
    }

    public function mahasiswa():HasMany{
        return $this->hasMany(MahasiswaModel::class, 'id_level', 'id_level');
>>>>>>> fd60cadf1c891c84847424257210cf7e3735a76b
    }
}