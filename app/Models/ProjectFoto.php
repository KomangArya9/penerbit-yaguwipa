<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectFoto extends Model
{
    use HasFactory;

    protected $table = 'project_foto';
    protected $fillable = ['project_id', 'img'];

    // Relasi balik ke model Portofolio (tabel project)
    public function project()
    {
        return $this->belongsTo(Portofolio::class, 'project_id', 'id');
    }
}