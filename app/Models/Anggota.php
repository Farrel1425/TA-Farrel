<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Anggota extends Authenticatable
{
     use HasFactory;

    protected $table = 'anggota';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_user', 'nis', 'nama_anggota', 'no_hp', 'alamat', 'jenis_kelamin', 'status_anggota',
    ];

    protected $hidden = ['password'];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
