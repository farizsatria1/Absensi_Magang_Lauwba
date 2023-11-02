<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PresensiPulang extends Model
{
    protected $table = 'presensi_pulang'; // Ganti dengan nama tabel Anda
    protected $primaryKey = 'id';
    protected $fillable = [
        'tgl_pulang',
        'jam_pulang',
        'id_peserta'
    ];
    
    public function peserta(): BelongsTo
    {
        return $this->belongsTo(Peserta::class, 'id_peserta', 'id');
    }
}
