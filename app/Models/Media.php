<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $table = 'media'; // Menyesuaikan dengan nama tabel di database
    
    protected $fillable = [
        'title',
        'url',
    ];
}