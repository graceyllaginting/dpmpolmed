<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Aspiration;

class Invitation extends Model
{
    protected $primaryKey = 'id_undangan';

    protected $fillable = [
        'id_aspirasi',
        'isi_undangan',
        'tanggal',
        'waktu',
        'tempat',
        'status_konfirmasi',
    ];

    // Relasi ke tabel aspirasi
    public function aspiration()
    {
        return $this->belongsTo(Aspiration::class, 'id_aspirasi');
    }

    // Tidak ada logic booted agar tidak override isi_undangan yang dikirim dari form
}
