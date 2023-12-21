<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Peserta extends Model
{
    protected $table = 'peserta'; // Ganti dengan nama tabel Anda
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama',
        'asal',
        'username',
        'password',
        'asal_sekolah',
        'no_hp',
        'tgl_mulai',
        'id_pembimbing',
        'ttd',
        'status'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function pembimbing(): BelongsTo
    {
        return $this->belongsTo(Pembimbing::class, 'id_pembimbing', 'id');
    }

    public function pekerjaan(): HasMany
    {
        return $this->hasMany(Pekerjaan::class, 'id_peserta');
    }

    public function presensi_masuk(): HasMany
    {
        return $this->hasMany(PresensiMasuk::class, 'id_peserta');
    }

    public function presensi_pulang(): HasMany
    {
        return $this->hasMany(PresensiPulang::class, 'id_peserta');
    }
}
