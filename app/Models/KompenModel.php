<?php

namespace App\Models;

use App\Models\JenisKompenModel;
use App\Models\PersonilAkademikModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KompenModel extends Model
{
    protected $table = 'kompen';
    protected $primaryKey = 'id_kompen';
    protected $fillable = [
        'nomor_kompen',
        'nama',
        'deskripsi',
        'id_personil',
        'id_jenis_kompen',
        'kuota',
        'jam_kompen',
        'status',
        'is_selesai',
        'tanggal_mulai',
        'tanggal_selesai'
    ];
    protected $casts = [
        'status' => 'boolean',
        'is_selesai' => 'boolean',
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime',
        'kuota' => 'integer',
        'jam_kompen' => 'integer',
    ];
    public static $rules = [
        'nomor_kompen' => 'required|string|max:35|unique:kompen,nomor_kompen',
        'nama' => 'required|string|max:40',
        'deskripsi' => 'required|string|max:255',
        'id_personil' => 'required|exists:period,id_personil',
        'id_jenis_kompen' => 'required|exists:jenis_kompen,id_jenis_kompen',
        'kuota' => 'required|integer|min:1',
        'jam_kompen' => 'required|integer|min:1',
        'status' => 'boolean',
        'is_selesai' => 'boolean',
        'tanggal_mulai' => 'required|date',
        'tanggal_selesai' => 'required|date|after:tanggal_mulai',
    ];

    public function jenisKompen(): BelongsTo
    {
        return $this->belongsTo(JenisKompenModel::class, 'id_jenis_kompen', 'id_jenis_kompen');
    }

    public function personil(): BelongsTo
    {
        return $this->belongsTo(PersonilAkademikModel::class, 'id_personil', 'id_personil');
    }

    public function pengajuankompen(): HasMany {
        return $this->hasMany(PengajuanKompenModel::class, 'id_kompen', 'id_kompen' );
    }
    
    public function getPersonilName(): string
    {
        return $this->personil->nama;
    }
    public function getPersonilUsername(): string
    {
        return $this->personil->username;
    }

    public function getJenisKompenName(): string
    {
        return $this->jenisKompen->nama_jenis;
    }

    public function Active($query)
    {
        return $query->where('status', true);
    }

    public function Completed($query)
    {
        return $query->where('is_selesai', true);
    }

    public function Ongoing($query)
    {
        return $query->where('is_selesai', false);
    }

    public function isAvailable(): bool
    {
        return $this->status 
            && !$this->is_selesai 
            && $this->kuota > 0 
            && now()->between($this->tanggal_mulai, $this->tanggal_selesai);
    }

    public function getRemainingQuotaAttribute(): int
    {
        // Assuming you have a pendaftaran_kompen table that tracks registrations
        $used = $this->pendaftaran()->count();
        return max(0, $this->kuota - $used);
    }

    protected static function boot()
    {
        parent::boot();

        // Auto-generate nomor_kompen if not provided
        static::creating(function ($kompen) {
            if (!$kompen->nomor_kompen) {
                $kompen->nomor_kompen = 'KMP-' . date('Ym') . '-' . str_pad(static::count() + 1, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}