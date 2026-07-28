<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clinet';
    
    public $timestamps = false; 

    // Beritahu Laravel bahwa kita menggunakan 'title' sebagai pengenal unik (karena tidak ada kolom id)
    protected $primaryKey = 'title';
    public $incrementing = false; // Karena title berupa teks/string, bukan angka auto-increment
    protected $keyType = 'string';

    protected $fillable = [
        'title',
        'img',
        'status',
        'url',
    ];
}