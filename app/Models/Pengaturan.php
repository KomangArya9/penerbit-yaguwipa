<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    protected $table = 'pengaturan'; 

    protected $fillable = [
        'company', 'address', 'phone', 'fax', 'email', 'website', 
        'map', 'script', 'intro', 'cek', 'url_popup', 'header', 
        'favicon', 'popup', 'background', 'copyright', 'meta_title', 
        'meta_description', 'seo', 'team', 'logo',
        'home_program_title', 'home_about_title', 'home_katalog_title',
        'home_testimoni_title', 'home_testimoni_subtitle',
        'program_title', 'program_subtitle',
        'portofolio_title', 'portofolio_subtitle',
        'penulis_title', 'katalog_title',
        'partner_title', 'partner_subtitle',
        'news_title', 'news_subtitle', 'news_other_title',
        'profile_photo_title', 'profile_video_title', 'profile_review_title',
        'profile_form_title', 'profile_map_title',
        'all_photos_title', 'all_videos_title', 'all_videos_subtitle',
        'profile_badge', 'profile_title', 'profile_quote', 'profile_content', 'home_about_desc',
        'footer_credit'
    ];
}