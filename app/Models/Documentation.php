<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Documentation extends Model
{
    protected $table = 'documentations';
    protected $primaryKey = 'id_dokumentasi';

    protected $fillable = [
        'id_kategori',
        'judul',
        'deskripsi',
        'file',
        'tanggal',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'id_kategori', 'id_kategori');
    }
}
