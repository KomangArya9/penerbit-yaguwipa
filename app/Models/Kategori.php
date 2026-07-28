<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori'; // Menyesuaikan dengan nama tabel di database
    protected $fillable = [
        'title',
        'slug',
    ];
}