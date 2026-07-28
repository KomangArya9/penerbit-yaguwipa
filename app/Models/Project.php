<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'project'; 
    protected $guarded = [];

    // Tambahkan relasi ini di model Project
    public function kategoriProject()
    {
        return $this->belongsTo(KategoriProject::class, 'kategori_project_id');
    }

    public function fotos()
    {
        return $this->hasMany(ProjectFoto::class, 'project_id', 'id');
    }
}