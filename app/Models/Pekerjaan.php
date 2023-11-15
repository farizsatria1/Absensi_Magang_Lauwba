<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pekerjaan extends Model
{
    protected $table = 'pekerjaan'; // Ganti dengan nama tabel Anda
    protected $primaryKey = 'id';
    protected $fillable = [
        'judul',
        'id_peserta',
    ];

    public function progress()
    {
        return $this->hasMany(Progress::class, 'id_pekerjaan');
    }
    
    public function peserta(): BelongsTo
    {
        return $this->belongsTo(Peserta::class, 'id_peserta', 'id');
    }
}
