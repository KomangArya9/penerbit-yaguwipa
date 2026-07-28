<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';
    
    // Tambahkan 'url' di sini agar bisa mass assignment
    protected $fillable = [
        'title', 
        'url', 
        'status', 
        'urutan', 
        'parent_id'
    ];

    // Relasi untuk anak menu (sub-menu)
    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('urutan');
    }

    // Relasi opsional jika ingin mengambil parent-nya kembali
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }
}