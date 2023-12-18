<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgressMagang extends Model
{
    protected $table = 'progress'; // Ganti dengan nama tabel Anda
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_pekerjaan',
        'catatan',
        'trainer_pembimbing',
        'trainer_peserta',
        'foto_dokumentasi',
    ];

    public function pekerjaan(): BelongsTo
    {
        return $this->belongsTo(Pekerjaan::class, 'id_pekerjaan', 'id');
    }

    public function pembimbing(): BelongsTo
    {
        return $this->belongsTo(Pembimbing::class, 'trainer_pembimbing', 'id');
    }
    
    public function peserta(): BelongsTo
    {
        return $this->belongsTo(Peserta::class, 'trainer_peserta', 'id');
    }
}
