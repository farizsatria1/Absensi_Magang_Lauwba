<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Keterangan extends Model
{
    protected $table = 'keterangan'; // Ganti dengan nama tabel Anda
    protected $primaryKey = 'id';
    protected $fillable = [
        'keterangan',
        'id_peserta',
        'id_presensi_masuk',
        'catatan'
    ];

    public function peserta(): BelongsTo
    {
        return $this->belongsTo(Peserta::class, 'id_peserta', 'id');
    }

    public function presensi_masuk(): BelongsTo
    {
        return $this->belongsTo(PresensiMasuk::class, 'id_presensi_masuk', 'id');
    }
}
