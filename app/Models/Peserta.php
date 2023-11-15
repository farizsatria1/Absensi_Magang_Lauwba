<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Peserta extends Authenticatable
{
    use SoftDeletes;
    use HasFactory, Notifiable, HasApiTokens;

    protected $dates = ['deleted_at'];
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
        'id_pembimbing'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function pembimbing(): BelongsTo
    {
        return $this->belongsTo(Pembimbing::class, 'id_pembimbing', 'id');
    }
}
