<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    protected $table = 'ulasan';

    protected $fillable = [
        'id_catalog',
        'nama',
        'ulasan',
        'stars',
        'status',
    ];

    public function catalog()
    {
        return $this->belongsTo(Catalog::class, 'id_catalog', 'id');
    }
}