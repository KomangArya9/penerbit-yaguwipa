<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    protected $table = 'pengaturan'; 
    
    public $incrementing = false;
    protected $primaryKey = null; 
    public $timestamps = false; 

    protected $fillable = [
        'company', 'address', 'phone', 'fax', 'email', 'website', 
        'map', 'script', 'intro', 'cek', 'url_popup', 'header', 
        'favicon', 'popup', 'background', 'copyright', 'meta_title', 
        'meta_description', 'seo', 'team', 'logo'
    ];
}