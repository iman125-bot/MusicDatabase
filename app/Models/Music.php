<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'MUSIC';
    
    protected $fillable = [
        'title',
        'artist',
        'album',
        'year',
        'genre',
        'duration'
    ];

    // Hapus semua method static jika menggunakan database
    // Jika ingin tetap pakai data dummy, hapus 'use HasFactory' dan extends Model
}