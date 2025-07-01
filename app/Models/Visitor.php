<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    public $timestamps = false; // karena tidak pakai created_at / updated_at

    protected $fillable = [
        'ip_address',
        'user_agent',
        'path',
        'visited_at',
    ];
}
