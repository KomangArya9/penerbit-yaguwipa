<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    // Menyesuaikan dengan nama tabel di database
    protected $table = 'ulasan';

    protected $fillable = [
        'id_catalog',
        'nama',
        'ulasan',
        'stars',
        'status',
    ];

    /**
     * Relasi ke tabel Catalog
     */
    public function catalog()
    {
        return $this->belongsTo(Catalog::class, 'id_catalog', 'id');
    }
}