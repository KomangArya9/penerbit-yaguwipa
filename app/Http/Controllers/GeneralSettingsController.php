<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GeneralSettingsController extends Controller
{
    public function edit()
    {
        $setting = Pengaturan::first() ?? new Pengaturan();
        return view('admin.pengaturan.general', compact('setting'));
    }

    public function deleteImage($field)
    {
        $setting = Pengaturan::first();

        if ($setting && $setting->$field) {
            // Hapus file fisik dari folder storage jika ada
            if (Storage::disk('public')->exists($setting->$field)) {
                Storage::disk('public')->delete($setting->$field);
            }

            // Kosongkan nilai kolom di database
            $setting->$field = null;
            $setting->save();
        }

        return back()->with('success', 'Gambar berhasil dihapus!');
    }

    public function update(Request $request)
    {
        $setting = Pengaturan::first() ?? new Pengaturan();
        $data = $request->except(['_token', '_method']);

        // 1. Logika untuk file gambar
        $imageFields = ['logo', 'header', 'favicon', 'background', 'popup'];

        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                if ($setting->$field && Storage::disk('public')->exists($setting->$field)) {
                    Storage::disk('public')->delete($setting->$field);
                }
                $data[$field] = $request->file($field)->store('settings', 'public');
            } else {
                $data[$field] = $setting->$field;
            }
        }

        // 2. Logika untuk field teks (bersifat opsional, dikosongkan jadi null)
        $textFields = [
            'company',
            'address',
            'phone',
            'fax',
            'email',
            'website',
            'map',
            'script',
            'intro',
            'cek',
            'url_popup',
            'copyright',
            'meta_title',
            'meta_description',
            'seo',
            'team',
            'home_program_title',
            'home_about_title',
            'home_katalog_title',
            'home_testimoni_title',
            'home_testimoni_subtitle',
            'program_title',
            'program_subtitle',
            'portofolio_title',
            'portofolio_subtitle',
            'penulis_title',
            'katalog_title',
            'partner_title',
            'partner_subtitle',
            'news_title',
            'news_subtitle',
            'news_other_title',
            'profile_photo_title',
            'profile_video_title',
            'profile_review_title',
            'profile_form_title',
            'profile_map_title',
            'all_photos_title',
            'all_videos_title',
            'all_videos_subtitle',
            'profile_badge',
            'profile_title',
            'profile_quote',
            'profile_content',
            'home_about_desc',
            'footer_credit'
        ];

        foreach ($textFields as $field) {
            if (empty($data[$field])) {
                $data[$field] = null;
            }
        }

        // 3. Simpan ke database
        $setting->fill($data);
        $setting->save();

        return redirect()->back()->with('success', 'Data berhasil diupdate!');
    }
}