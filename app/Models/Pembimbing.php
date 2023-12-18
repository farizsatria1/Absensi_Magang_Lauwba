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
        'ttd'
    ];

    protected $hidden = [
        'password',
        'nip',
    ];
    public function peserta()
    {
        return $this->hasMany(Peserta::class, 'id_pembimbing');
    }
}
