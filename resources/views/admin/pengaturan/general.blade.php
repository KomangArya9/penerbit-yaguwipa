@extends('admin.layouts.admin')

@section('title', 'Pengaturan Umum')

@section('content')
<div class="p-8 max-w-7xl mx-auto space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Pengaturan Umum Website</h1>
            <p class="text-slate-500 text-sm mt-1">Kelola identitas penerbit, kontak, meta tag SEO, dan aset visual brand.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.dashboard') }}"
                class="inline-flex items-center gap-1.5 px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-sm font-medium transition">
                &larr; Dashboard
            </a>
        </div>
    </div>

    <!-- Alert Notifikasi -->
    @if(session('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl flex items-center gap-3 shadow-2xs">
            <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span class="text-sm font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <form action="{{ route('admin.pengaturan.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Bagian Visual & Gambar -->
        <div class="bg-white p-8 rounded-xl shadow-sm border border-slate-200">
            <h3 class="font-bold text-lg text-slate-800 mb-6 pb-3 border-b border-slate-100 flex items-center gap-2">
                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Logo & Identitas Visual
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Logo Utama -->
                <div class="p-4 bg-slate-50/70 rounded-xl border border-slate-200 flex flex-col justify-between">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Logo Utama</label>
                        @if(!empty($setting->logo))
                            <div class="relative inline-block mb-3">
                                <img src="{{ asset('storage/' . $setting->logo) }}"
                                    class="w-24 h-24 object-contain rounded-lg border border-slate-300 bg-white p-2 shadow-2xs">
                                <a href="{{ route('admin.pengaturan.delete.image', 'logo') }}"
                                    onclick="return confirm('Yakin ingin menghapus logo ini?')"
                                    class="absolute -top-2 -right-2 bg-rose-600 hover:bg-rose-700 text-white rounded-md p-1 shadow transition"
                                    title="Hapus Logo">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </a>
                            </div>
                        @endif
                    </div>
                    <input type="file" name="logo"
                        class="block w-full text-xs text-slate-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
                </div>

                <!-- Logo Home (header) -->
                <div class="p-4 bg-slate-50/70 rounded-xl border border-slate-200 flex flex-col justify-between">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Logo Navbar / Header</label>
                        @if(!empty($setting->header))
                            <div class="relative inline-block mb-3">
                                <img src="{{ asset('storage/' . $setting->header) }}"
                                    class="w-24 h-24 object-contain rounded-lg border border-slate-300 bg-white p-2 shadow-2xs">
                                <a href="{{ route('admin.pengaturan.delete.image', 'header') }}"
                                    onclick="return confirm('Yakin ingin menghapus header logo ini?')"
                                    class="absolute -top-2 -right-2 bg-rose-600 hover:bg-rose-700 text-white rounded-md p-1 shadow transition"
                                    title="Hapus Gambar">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </a>
                            </div>
                        @endif
                    </div>
                    <input type="file" name="header"
                        class="block w-full text-xs text-slate-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
                </div>

                <!-- Favicon -->
                <div class="p-4 bg-slate-50/70 rounded-xl border border-slate-200 flex flex-col justify-between">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Favicon (Icon Tab Browser)</label>
                        @if(!empty($setting->favicon))
                            <div class="relative inline-block mb-3">
                                <img src="{{ asset('storage/' . $setting->favicon) }}"
                                    class="w-16 h-16 object-contain rounded-lg border border-slate-300 bg-white p-2 shadow-2xs">
                                <a href="{{ route('admin.pengaturan.delete.image', 'favicon') }}"
                                    onclick="return confirm('Yakin ingin menghapus favicon ini?')"
                                    class="absolute -top-2 -right-2 bg-rose-600 hover:bg-rose-700 text-white rounded-md p-1 shadow transition"
                                    title="Hapus Favicon">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </a>
                            </div>
                        @endif
                    </div>
                    <input type="file" name="favicon"
                        class="block w-full text-xs text-slate-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
                </div>
            </div>
        </div>

        <!-- Informasi Kontak & Utama -->
        <div class="bg-white p-8 rounded-xl shadow-sm border border-slate-200">
            <h3 class="font-bold text-lg text-slate-800 mb-6 pb-3 border-b border-slate-100 flex items-center gap-2">
                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                Informasi Lembaga & Kontak
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Perusahaan / Penerbit</label>
                    <input type="text" name="company" value="{{ $setting->company ?? '' }}"
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Alamat Website</label>
                    <input type="text" name="website" value="{{ $setting->website ?? '' }}"
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nomor Telepon / WhatsApp</label>
                    <input type="text" name="phone" value="{{ $setting->phone ?? '' }}"
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email Resmi</label>
                    <input type="email" name="email" value="{{ $setting->email ?? '' }}"
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Tautan Form Unggah Naskah (Google Forms / Link Eksternal)</label>
                    <input type="url" name="cek" value="{{ $setting->cek ?? '' }}" placeholder="https://docs.google.com/forms/..."
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
                    <p class="text-xs text-slate-400 mt-1">Tautan ini digunakan otomatis untuk tombol "Form Unggah Naskah" pada halaman Penulis.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Alamat Lengkap Kantor</label>
                    <textarea name="address" rows="3"
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">{{ $setting->address ?? '' }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Embed Google Maps (Iframe / URL)</label>
                    <textarea name="map" rows="3"
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm font-mono text-xs focus:ring-2 focus:ring-red-500 focus:outline-none">{{ $setting->map ?? '' }}</textarea>
                </div>
            </div>
        </div>

        <!-- Judul, Konten & Deskripsi Halaman Website -->
        <div class="bg-white p-8 rounded-xl shadow-sm border border-slate-200">
            <h3 class="font-bold text-lg text-slate-800 mb-6 pb-3 border-b border-slate-100 flex items-center gap-2">
                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                </svg>
                Judul, Konten & Deskripsi Halaman Website
            </h3>

            <div class="space-y-8">
                <!-- Group 1: Beranda (Home Page) -->
                <div class="p-5 bg-slate-50/70 rounded-xl border border-slate-200">
                    <h4 class="font-semibold text-slate-800 text-sm mb-4">
                        Halaman Beranda (Home)
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Judul Headline Hero (Intro)</label>
                            <textarea name="intro" rows="2"
                                class="border border-slate-300 p-2.5 rounded-lg w-full text-sm bg-white focus:ring-2 focus:ring-red-500 focus:outline-none">{{ $setting->intro ?? '' }}</textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Sub-Headline Hero (SEO Intro)</label>
                            <textarea name="seo" rows="2"
                                class="border border-slate-300 p-2.5 rounded-lg w-full text-sm bg-white focus:ring-2 focus:ring-red-500 focus:outline-none">{{ $setting->seo ?? '' }}</textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Judul Bagian Program Utama</label>
                            <input type="text" name="home_program_title" value="{{ $setting->home_program_title ?? 'Program Utama Kami' }}"
                                class="border border-slate-300 p-2.5 rounded-lg w-full text-sm bg-white focus:ring-2 focus:ring-red-500 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Judul Bagian Katalog Unggulan</label>
                            <input type="text" name="home_katalog_title" value="{{ $setting->home_katalog_title ?? 'Katalog Unggulan' }}"
                                class="border border-slate-300 p-2.5 rounded-lg w-full text-sm bg-white focus:ring-2 focus:ring-red-500 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Judul Bagian Tentang Kami (Beranda)</label>
                            <input type="text" name="home_about_title" value="{{ $setting->home_about_title ?? 'Menyebarluaskan Ilmu, Membangun Literasi' }}"
                                class="border border-slate-300 p-2.5 rounded-lg w-full text-sm bg-white focus:ring-2 focus:ring-red-500 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Deskripsi Bagian Tentang Kami di Beranda</label>
                            <textarea name="home_about_desc" rows="2"
                                class="border border-slate-300 p-2.5 rounded-lg w-full text-sm bg-white focus:ring-2 focus:ring-red-500 focus:outline-none">{{ $setting->home_about_desc ?? 'Penerbit YAGUWIPA hadir sebagai penerbit kredibel yang berkomitmen menyebarluaskan hasil riset, IPTEKS, dan karya sastra bermutu tinggi guna memajukan literasi dan kebudayaan bangsa.' }}</textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Judul Bagian Ulasan & Testimoni</label>
                            <input type="text" name="home_testimoni_title" value="{{ $setting->home_testimoni_title ?? 'Ulasan & Testimoni' }}"
                                class="border border-slate-300 p-2.5 rounded-lg w-full text-sm bg-white focus:ring-2 focus:ring-red-500 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Subjudul Bagian Ulasan & Testimoni</label>
                            <textarea name="home_testimoni_subtitle" rows="2"
                                class="border border-slate-300 p-2.5 rounded-lg w-full text-sm bg-white focus:ring-2 focus:ring-red-500 focus:outline-none">{{ $setting->home_testimoni_subtitle ?? 'Kepercayaan para penulis dan pembaca menjadi motivasi kami untuk terus menghadirkan layanan penerbitan terbaik' }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Group 2: Halaman Profil (Tentang Kami) & Arsip Media -->
                <div class="p-5 bg-slate-50/70 rounded-xl border border-slate-200">
                    <h4 class="font-semibold text-slate-800 text-sm mb-4">
                        Halaman Profil (Tentang Kami) & Arsip Media
                    </h4>
                    
                    <!-- Bagian Utama Profil -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Badge / Label Atas Profil</label>
                            <input type="text" name="profile_badge" value="{{ $setting->profile_badge ?? 'PENERBIT TEPERCAYA' }}"
                                class="border border-slate-300 p-2.5 rounded-lg w-full text-sm bg-white focus:ring-2 focus:ring-red-500 focus:outline-none">
                            <p class="text-[11px] text-slate-400 mt-0.5">Teks kecil di atas judul profil (misal: PENERBIT TEPERCAYA).</p>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Judul Utama Halaman Profil</label>
                            <input type="text" name="profile_title" value="{{ $setting->profile_title ?? 'Tentang Penerbit Yaguwipa' }}"
                                class="border border-slate-300 p-2.5 rounded-lg w-full text-sm bg-white focus:ring-2 focus:ring-red-500 focus:outline-none">
                            <p class="text-[11px] text-slate-400 mt-0.5">Judul besar halaman Tentang Kami / Profil.</p>
                        </div>
                    </div>

                    <!-- Deskripsi Tentang Kami (url_popup) -->
                    <div class="mb-4">
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Deskripsi Tentang Kami (Narasi Utama Halaman Profil)</label>
                        <textarea name="url_popup" rows="6"
                            class="border border-slate-300 p-3 rounded-lg w-full text-sm bg-white focus:ring-2 focus:ring-red-500 focus:outline-none leading-relaxed">{{ $setting->url_popup ?? '' }}</textarea>
                        <p class="text-[11px] text-slate-400 mt-0.5">Teks narasi utama yang tampil pada halaman profil (/profile). Pisahkan paragraf dengan Enter.</p>
                    </div>

                    <!-- Quotes / Kutipan Filosofi Profil -->
                    <div class="mb-5">
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Quotes / Kutipan Filosofi Profil</label>
                        <textarea name="profile_quote" rows="2"
                            class="border border-slate-300 p-2.5 rounded-lg w-full text-sm bg-white focus:ring-2 focus:ring-red-500 focus:outline-none leading-relaxed">{{ $setting->profile_quote ?? 'Menghubungkan gagasan dengan dunia melalui publikasi yang berkualitas dan berintegritas.' }}</textarea>
                        <p class="text-[11px] text-slate-400 mt-0.5">Teks kutipan/filosofi yang tampil bergaris bawah di bawah narasi Tentang Kami pada halaman profil.</p>
                    </div>

                    <!-- Sub-section Profil & Arsip -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4 pt-4 border-t border-slate-200">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Judul Photo Archive</label>
                            <input type="text" name="profile_photo_title" value="{{ $setting->profile_photo_title ?? 'Photo Archive' }}"
                                class="border border-slate-300 p-2.5 rounded-lg w-full text-sm bg-white focus:ring-2 focus:ring-red-500 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Judul Documentary & Film</label>
                            <input type="text" name="profile_video_title" value="{{ $setting->profile_video_title ?? 'Documentary & Film' }}"
                                class="border border-slate-300 p-2.5 rounded-lg w-full text-sm bg-white focus:ring-2 focus:ring-red-500 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Judul Reader Perspectives</label>
                            <input type="text" name="profile_review_title" value="{{ $setting->profile_review_title ?? 'Reader Perspectives' }}"
                                class="border border-slate-300 p-2.5 rounded-lg w-full text-sm bg-white focus:ring-2 focus:ring-red-500 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Judul Form Share Experience</label>
                            <input type="text" name="profile_form_title" value="{{ $setting->profile_form_title ?? 'Share Your Experience' }}"
                                class="border border-slate-300 p-2.5 rounded-lg w-full text-sm bg-white focus:ring-2 focus:ring-red-500 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Judul Lokasi Kantor Kami</label>
                            <input type="text" name="profile_map_title" value="{{ $setting->profile_map_title ?? 'Lokasi Kantor Kami' }}"
                                class="border border-slate-300 p-2.5 rounded-lg w-full text-sm bg-white focus:ring-2 focus:ring-red-500 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Judul Halaman Semua Foto</label>
                            <input type="text" name="all_photos_title" value="{{ $setting->all_photos_title ?? 'Semua Foto Album' }}"
                                class="border border-slate-300 p-2.5 rounded-lg w-full text-sm bg-white focus:ring-2 focus:ring-red-500 focus:outline-none">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Judul Halaman Semua Video</label>
                            <input type="text" name="all_videos_title" value="{{ $setting->all_videos_title ?? 'Semua Koleksi Video & Dokumenter' }}"
                                class="border border-slate-300 p-2.5 rounded-lg w-full text-sm bg-white focus:ring-2 focus:ring-red-500 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Subjudul Halaman Semua Video</label>
                            <textarea name="all_videos_subtitle" rows="2"
                                class="border border-slate-300 p-2.5 rounded-lg w-full text-sm bg-white focus:ring-2 focus:ring-red-500 focus:outline-none">{{ $setting->all_videos_subtitle ?? 'Daftar lengkap dokumentasi video dan film yang telah dipublikasikan.' }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Group 3: Program & Portofolio -->
                <div class="p-5 bg-slate-50/70 rounded-xl border border-slate-200">
                    <h4 class="font-semibold text-slate-800 text-sm mb-4">
                        Halaman Program & Portofolio
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Judul Halaman Program</label>
                            <input type="text" name="program_title" value="{{ $setting->program_title ?? 'Program Kerja Kami' }}"
                                class="border border-slate-300 p-2.5 rounded-lg w-full text-sm bg-white focus:ring-2 focus:ring-red-500 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Judul Halaman Portofolio</label>
                            <input type="text" name="portofolio_title" value="{{ $setting->portofolio_title ?? 'Portofolio' }}"
                                class="border border-slate-300 p-2.5 rounded-lg w-full text-sm bg-white focus:ring-2 focus:ring-red-500 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Subjudul Halaman Program</label>
                            <textarea name="program_subtitle" rows="2"
                                class="border border-slate-300 p-2.5 rounded-lg w-full text-sm bg-white focus:ring-2 focus:ring-red-500 focus:outline-none">{{ $setting->program_subtitle ?? 'Dedikasi kami untuk menyediakan ekosistem yang menyeluruh bagi para akademisi, penulis, dan pembaca.' }}</textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Subjudul Halaman Portofolio</label>
                            <textarea name="portofolio_subtitle" rows="2"
                                class="border border-slate-300 p-2.5 rounded-lg w-full text-sm bg-white focus:ring-2 focus:ring-red-500 focus:outline-none">{{ $setting->portofolio_subtitle ?? 'Rekam jejak karya dan proyek yang telah diselesaikan.' }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Group 4: Penulis, Tim Redaksi, Katalog & Partner -->
                <div class="p-5 bg-slate-50/70 rounded-xl border border-slate-200">
                    <h4 class="font-semibold text-slate-800 text-sm mb-4">
                        Halaman Penulis, Tim Redaksi, Katalog & Partner
                    </h4>
                    <div class="space-y-4">
                        <!-- Sub: Penulis & Tim Redaksi -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pb-4 border-b border-slate-200/80">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Judul Halaman Penulis</label>
                                <input type="text" name="penulis_title" value="{{ $setting->penulis_title ?? 'Penulis Kami' }}"
                                    class="border border-slate-300 p-2.5 rounded-lg w-full text-sm bg-white focus:ring-2 focus:ring-red-500 focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Deskripsi Halaman Tim Redaksi (Penulis)</label>
                                <textarea name="team" rows="2"
                                    class="border border-slate-300 p-2.5 rounded-lg w-full text-sm bg-white focus:ring-2 focus:ring-red-500 focus:outline-none">{{ $setting->team ?? '' }}</textarea>
                            </div>
                        </div>

                        <!-- Sub: Katalog Buku -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pb-4 border-b border-slate-200/80">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Judul Halaman Katalog</label>
                                <input type="text" name="katalog_title" value="{{ $setting->katalog_title ?? 'Katalog Buku' }}"
                                    class="border border-slate-300 p-2.5 rounded-lg w-full text-sm bg-white focus:ring-2 focus:ring-red-500 focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Deskripsi Singkat Halaman Katalog</label>
                                <textarea name="meta_description" rows="2"
                                    class="border border-slate-300 p-2.5 rounded-lg w-full text-sm bg-white focus:ring-2 focus:ring-red-500 focus:outline-none">{{ $setting->meta_description ?? '' }}</textarea>
                            </div>
                        </div>

                        <!-- Sub: Partner & Klien -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Judul Halaman Partner & Klien</label>
                                <input type="text" name="partner_title" value="{{ $setting->partner_title ?? 'Partner & Klien' }}"
                                    class="border border-slate-300 p-2.5 rounded-lg w-full text-sm bg-white focus:ring-2 focus:ring-red-500 focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Subjudul Halaman Partner & Klien</label>
                                <textarea name="partner_subtitle" rows="2"
                                    class="border border-slate-300 p-2.5 rounded-lg w-full text-sm bg-white focus:ring-2 focus:ring-red-500 focus:outline-none">{{ $setting->partner_subtitle ?? 'Kami bangga bekerja sama dengan berbagai institusi dan mitra strategis dalam memajukan dunia literasi. Kolaborasi ini memperkuat komitmen kami pada penyebaran ilmu pengetahuan.' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Group 5: Berita (News & Events) -->
                <div class="p-5 bg-slate-50/70 rounded-xl border border-slate-200">
                    <h4 class="font-semibold text-slate-800 text-sm mb-4">
                        Halaman Berita (News & Events)
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Judul Halaman News & Events</label>
                            <input type="text" name="news_title" value="{{ $setting->news_title ?? 'News & Events' }}"
                                class="border border-slate-300 p-2.5 rounded-lg w-full text-sm bg-white focus:ring-2 focus:ring-red-500 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Judul Bagian "Berita Lainnya" (Detail)</label>
                            <input type="text" name="news_other_title" value="{{ $setting->news_other_title ?? 'Berita Lainnya' }}"
                                class="border border-slate-300 p-2.5 rounded-lg w-full text-sm bg-white focus:ring-2 focus:ring-red-500 focus:outline-none">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Subjudul Halaman News & Events</label>
                            <textarea name="news_subtitle" rows="2"
                                class="border border-slate-300 p-2.5 rounded-lg w-full text-sm bg-white focus:ring-2 focus:ring-red-500 focus:outline-none">{{ $setting->news_subtitle ?? 'Ikuti perkembangan terbaru, berita industri, dan jadwal acara literasi dari Penerbit Yaguwipa.' }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Group 6: Footer Credit -->
                <div class="p-5 bg-slate-50/70 rounded-xl border border-slate-200">
                    <h4 class="font-semibold text-slate-800 text-sm mb-4">
                        Kredit Footer
                    </h4>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Teks Kredit Perancang Footer</label>
                        <input type="text" name="footer_credit" value="{{ $setting->footer_credit ?? 'Designed by Yaguwipa Tech Team' }}"
                            class="border border-slate-300 p-2.5 rounded-lg w-full text-sm bg-white focus:ring-2 focus:ring-red-500 focus:outline-none">
                    </div>
                </div>
            </div>
        </div>

        <!-- Media Tambahan & SEO -->
        <div class="bg-white p-8 rounded-xl shadow-sm border border-slate-200">
            <h3 class="font-bold text-lg text-slate-800 mb-6 pb-3 border-b border-slate-100 flex items-center gap-2">
                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                </svg>
                Media Profil & Optimasi SEO
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Foto Tentang Kami -->
                <div class="p-4 bg-slate-50/70 rounded-xl border border-slate-200 flex flex-col justify-between">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Foto Profil Tentang Kami</label>
                        @if(!empty($setting->background))
                            <div class="relative inline-block mb-3">
                                <img src="{{ asset('storage/' . $setting->background) }}"
                                    class="w-32 h-20 object-cover rounded-lg border border-slate-300 bg-white p-1 shadow-2xs">
                                <a href="{{ route('admin.pengaturan.delete.image', 'background') }}"
                                    onclick="return confirm('Yakin ingin menghapus gambar ini?')"
                                    class="absolute -top-2 -right-2 bg-rose-600 hover:bg-rose-700 text-white rounded-md p-1 shadow transition"
                                    title="Hapus Gambar">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </a>
                            </div>
                        @endif
                    </div>
                    <input type="file" name="background"
                        class="block w-full text-xs text-slate-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
                </div>

                <!-- Custom Script -->
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Custom Script (Google Analytics / Tracking)</label>
                    <textarea name="script" rows="4" placeholder="<script>...</script>"
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-xs font-mono focus:ring-2 focus:ring-red-500 focus:outline-none">{{ $setting->script ?? '' }}</textarea>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Meta Title (SEO)</label>
                    <input type="text" name="meta_title" value="{{ $setting->meta_title ?? '' }}"
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Teks Copyright Footer</label>
                    <input type="text" name="copyright" value="{{ $setting->copyright ?? '' }}"
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Meta Keywords (SEO)</label>
                    <input type="text" name="fax" value="{{ $setting->fax ?? '' }}" placeholder="penerbit, buku, denpasar"
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>
            </div>
        </div>

        <!-- Tombol Simpan -->
        <div class="flex items-center justify-end gap-3 pt-4">
            <button type="submit"
                class="px-6 py-2.5 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white font-medium rounded-lg shadow-sm transition">
                Simpan Perubahan Pengaturan
            </button>
        </div>
    </form>
</div>
@endsection
