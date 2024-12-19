<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LevelModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class PersonilAkademikModel extends Model
{
    protected $table = 'personil_akademik';
    protected $primaryKey = 'id_personil';

    use HasFactory;

    protected $fillable = ['id_level', 'username', 'nama', 'password'];

    protected $hidden = ['password'];
    
    protected $casts = [
        'password' => 'hashed'
    ];

    public function level(): BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'id_level', 'id_level');
    }
    public function geRoleName(): string {
        return $this->level->nama_level;
    }
    public function hasRole($role): bool {
        return $this->level->kode_level == $role;
    }
    public function getRole() {
        return $this->level->kode_level;
    }
}
