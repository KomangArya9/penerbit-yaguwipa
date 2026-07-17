<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    // Mematikan fitur timestamps karena tabel tidak memiliki created_at/updated_at
    public $timestamps = false;

    // Menambahkan 'nama' ke dalam fillable agar bisa diisi
    protected $fillable = ['username', 'password', 'nama', 'level'];

    protected $hidden = ['password', 'remember_token'];

    // Menggunakan hashing otomatis untuk password
    protected function casts(): array
    {
        return ['password' => 'hashed'];
    }

    // Menentukan bahwa login menggunakan 'username'
    public function getAuthIdentifierName(): string
    {
        return 'username';
    }

    // Mengizinkan akses ke panel admin
    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }
}