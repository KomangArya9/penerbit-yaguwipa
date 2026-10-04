<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'institusi',
        'nomor',
        'email',
        'social_media',
        'alamat',
        'keahlian',
        'profile',
        'slug',
        'status',
        'foto',
    ];

    public function getFotoUrlAttribute(): string
    {
        if (!$this->foto) {
            return asset('images/default-avatar.svg');
        }

        if (str_starts_with($this->foto, 'uploads/')) {
            return file_exists(public_path($this->foto)) 
                ? asset($this->foto) 
                : asset('images/default-avatar.svg');
        }

        if (\Illuminate\Support\Facades\Storage::disk('public')->exists($this->foto)) {
            return asset('storage/' . $this->foto);
        }

        return asset('images/default-avatar.svg');
    }
}