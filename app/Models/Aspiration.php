<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspiration extends Model
{
    protected $table = 'aspirations';
    protected $primaryKey = 'id_aspirasi';

    protected $fillable = [
        'kode_aspirasi',
        'nama_pengirim',
        'nim',
        'prodi',
        'email',
        'isi_aspirasi',
        'status',
        'tanggapan',
        'tanggal_kirim',
    ];

    public function invitation()
        {
    return $this->hasOne(\App\Models\Invitation::class, 'id_aspirasi', 'id_aspirasi');
        }


}
