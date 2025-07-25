<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_agenda';

    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal',
        'waktu',
        'tempat',
    ];
}
