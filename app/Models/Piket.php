<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Piket extends Model
{
    protected $table = 'piket'; // Ganti dengan nama tabel Anda
    protected $primaryKey = 'id';
    protected $fillable = [
        'hari',
        'id_pembimbing',
        'id_peserta',
    ];
    public function pembimbing(): BelongsTo
    {
        return $this->belongsTo(Pembimbing::class, 'id_pembimbing', 'id');
    }

    public function peserta(): BelongsTo
    {
        return $this->belongsTo(Peserta::class, 'id_peserta', 'id');
    }

}
