<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriProject extends Model
{
    use HasFactory;

    protected $table = 'kategori_project'; // Sesuaikan dengan nama tabel aslimu di database
    protected $fillable = [
        'title',
        'slug',
    ];

    // Relasi ke tabel project
    public function projects()
    {
        return $this->hasMany(Project::class, 'kategori_project_id');
    }
}