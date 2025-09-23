<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Aspiration;
use Carbon\Carbon;

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

    public function aspiration()
    {
        return $this->belongsTo(Aspiration::class, 'id_aspirasi');
    }

    // Isi otomatis isi_undangan saat create & update
    protected static function booted()
    {
        static::saving(function ($invitation) {
            // Hanya generate jika tanggal, waktu, tempat tersedia
            if ($invitation->tanggal && $invitation->waktu && $invitation->tempat) {
                $tanggal = Carbon::parse($invitation->tanggal)->translatedFormat('d F Y');
                $waktu = Carbon::parse($invitation->waktu)->format('H:i');

                $invitation->isi_undangan = "Halo! Terima kasih telah menyampaikan aspirasi Anda. "
                    . "Untuk menindaklanjuti hal tersebut, kami mengundang Anda untuk hadir dalam pertemuan bersama tim DPM:\n\n"
                    . "📅 Tanggal: {$tanggal}\n"
                    . "🕒 Waktu: {$waktu}\n"
                    . "📍 Tempat: {$invitation->tempat}\n\n"
                    . "Mari berdiskusi dan mencari solusi bersama. Kehadiran Anda sangat berarti bagi kami!";
            }
        });
    }
}