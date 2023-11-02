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
        'catatan',
        'id_pekerjaan',
        'foto_dokumentasi'
    ];
    
    public function pekerjaan(): BelongsTo
    {
        return $this->belongsTo(Pekerjaan::class, 'id_pekerjaan', 'id');
    }
}
