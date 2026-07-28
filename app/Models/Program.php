<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'service';
    
    // Mengaktifkan kembali timestamps karena migration baru menggunakan $table->timestamps()
    public $timestamps = true; 

    // Menggunakan 'id' sebagai primary key (default Laravel)
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'title',
        'short',
        'content',
        'icon',
        'img',
        'status',
        'slug',
        'url',
    ];
}