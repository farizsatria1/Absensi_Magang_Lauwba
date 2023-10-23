<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Peserta extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'peserta'; // Ganti dengan nama tabel Anda
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama',
        'asal',
        'username',
        'password',
        'tgl_mulai',
        'id_pembimbing'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
