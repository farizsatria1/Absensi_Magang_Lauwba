<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembimbing extends Model
{
    protected $table = 'pembimbing';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nip',
        'nama',
        'password',
    ];

    protected $hidden = [
        'password',
        'nip',
    ];
}
