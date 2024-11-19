<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KompenModel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kompen';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_kompen';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'nomor_kompen',
        'nama',
        'deskripsi',
        'id_period',
        'id_jenis_kompen',
        'kuota',
        'jam_kompen',
        'status',
        'is_selesai',
        'tanggal_mulai',
        'tanggal_selesai'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => 'boolean',
        'is_selesai' => 'boolean',
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime',
        'kuota' => 'integer',
        'jam_kompen' => 'integer',
    ];

    /**
     * The validation rules for the model.
     *
     * @var array<string, string>
     */
    public static $rules = [
        'nomor_kompen' => 'required|string|max:35|unique:kompen,nomor_kompen',
        'nama' => 'required|string|max:40',
        'deskripsi' => 'required|string|max:255',
        'id_period' => 'required|exists:period,id_period',
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

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeCompleted($query)
    {
        return $query->where('is_selesai', true);
    }

    public function scopeOngoing($query)
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