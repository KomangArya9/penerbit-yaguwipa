<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Tentukan primary key karena bukan bernama 'id'
    protected $primaryKey = 'username';
    protected $keyType = 'string'; // Karena username biasanya berupa teks/string
    public $incrementing = false;  // Karena username bukan angka auto-increment

    // Tetap gunakan ini karena database kamu tidak memiliki timestamps
    public $timestamps = false;

    // Field yang diizinkan untuk diisi massal
    protected $fillable = ['username', 'password', 'nama', 'level'];

    // Sembunyikan field sensitif dari output JSON
    protected $hidden = ['password', 'remember_token'];

    // Menggunakan hashing otomatis untuk password
    protected function casts(): array
    {
        return ['password' => 'hashed'];
    }

    // Mengganti default 'email' menjadi 'username' untuk proses login
    public function getAuthIdentifierName(): string
    {
        return 'username';
    }
}