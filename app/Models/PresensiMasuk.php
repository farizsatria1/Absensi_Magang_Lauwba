<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PresensiMasuk extends Model
{
    protected $table = 'presensi_masuk'; // Ganti dengan nama tabel Anda
    protected $primaryKey = 'id';
    protected $fillable = [
        'tgl_masuk',
        'jam_masuk',
        'id_peserta'
    ];
    
    public function peserta(): BelongsTo
    {
        return $this->belongsTo(Peserta::class, 'id_peserta', 'id');
    }
}
