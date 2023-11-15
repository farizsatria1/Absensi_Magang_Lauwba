<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pembimbing extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
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
    public function peserta()
    {
        return $this->hasMany(Peserta::class, 'id_pembimbing');
    }
}
