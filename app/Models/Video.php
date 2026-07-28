<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $table = 'video'; // Menentukan nama tabel secara eksplisit tanpa 's'

    protected $fillable = [
        'date',
        'title',
        'content',
        'source',
        'hit',
        'status',
        'slug',
    ];
}