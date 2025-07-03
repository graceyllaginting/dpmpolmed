<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
     protected $table = 'structures';
    protected $primaryKey = 'id_struktur';

    protected $fillable = [
        'nama_anggota',
        'jabatan',
        'bagian',
        'prodi',
        'foto',
        'periode',
    ];
}
