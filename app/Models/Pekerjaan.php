<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pekerjaan extends Model
{
    protected $table = 'pekerjaan'; // Ganti dengan nama tabel Anda
    protected $primaryKey = 'id';
    protected $fillable = [
        'judul',
        'id_peserta',
    ];

    public function progress(): HasMany
    {
        return $this->hasMany(ProgressMagang::class, 'id_pekerjaan');
    }
    
    public function peserta(): BelongsTo
    {
        return $this->belongsTo(Peserta::class, 'id_peserta', 'id');
    }
}
