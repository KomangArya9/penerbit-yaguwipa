<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    use HasFactory;

    protected $table = 'catalog';
    
    protected $fillable = [
    'judul', 'penulis', 'editor', 'penerbit',
    'i_penulis', 'i_editor', 'jenis', 'kategori', 'bidang',
    'isbn', 'issn', 'ukuran', 'jumlah', 'terbit',
    'kondisi', 'ketersediaan', 'keterangan', 'deskripsi',
    'info', 'harga', 'diskon', 'penjual', 'wa',
    'alamat', 'ktp', 'bank', 'norek',
    'slug', 'status', 'cover', 'cover_belakang', 'img', 'soft_file', 'hite'
];

    /**
     * Relasi ke tabel ulasan
     * Satu catalog/buku bisa memiliki banyak ulasan
     */
    public function ulasans()
    {
        return $this->hasMany(Ulasan::class, 'id_catalog', 'id');
    }
}