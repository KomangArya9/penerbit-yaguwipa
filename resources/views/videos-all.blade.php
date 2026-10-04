@extends('layouts.app')

@section('content')
<div class="py-16">
    <div class="container mx-auto px-6 md:px-12 max-w-6xl">
        <!-- Header Navigasi & Judul -->
        <div class="mb-10">
            <a href="{{ route('profile') }}" class="inline-flex items-center gap-2 text-sm font-medium text-stone-600 hover:text-[#B6171E] transition-colors py-2 px-3.5 rounded-xl hover:bg-stone-100 w-fit mb-3">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Kembali ke Profil
            </a>
            <h1 class="text-3xl md:text-5xl font-bold font-serif text-stone-900 tracking-tight">{{ $setting->all_videos_title ?? 'Semua Koleksi Video & Dokumenter' }}</h1>
            <p class="text-base text-stone-600 mt-2">{{ $setting->all_videos_subtitle ?? 'Daftar lengkap dokumentasi video dan film yang telah dipublikasikan.' }}</p>
        </div>

        <!-- Grid Daftar Video -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($videos as $video)
                @php
                    // Ekstraksi ID video YouTube secara otomatis untuk mendapatkan thumbnail resminya
                    preg_match('~(?:http|https)?:?//(?:www\.)?(?:youtube\.com/(?:watch\?v=|embed/)|youtu\.be/)([\w-]+)~', $video->source, $matches);
                    $videoId = $matches[1] ?? '';
                    $thumbnailUrl = $videoId ? "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg" : asset('images/default.jpg');
                @endphp
                <div class="bg-white border border-stone-200/80 rounded-2xl shadow-2xs hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between overflow-hidden group">
                    <div>
                        <!-- Video Thumbnail & Play Button Overlay -->
                        <a href="{{ $video->source }}" target="_blank" class="aspect-video bg-black relative overflow-hidden block">
                            <!-- Gambar Thumbnail -->
                            <img src="{{ $thumbnailUrl }}" alt="{{ $video->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            
                            <!-- Overlay & Tombol Play -->
                            <div class="absolute inset-0 bg-black/30 group-hover:bg-black/40 transition-colors flex items-center justify-center">
                                <div class="w-10 h-10 rounded-full bg-red-600 text-white flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                    <svg class="w-4 h-4 translate-x-0" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </div>
                            </div>

                            <!-- Badge YouTube -->
                            <span class="absolute bottom-2 right-2 bg-black/70 text-white text-[10px] font-semibold px-2 py-0.5 rounded-md backdrop-blur-xs">
                                YouTube
                            </span>
                        </a>

                        <!-- Deskripsi Singkat -->
                        <div class="p-4">
                            <span class="text-xs text-stone-400 block mb-1">{{ date('d M Y', strtotime($video->date)) }}</span>
                            <h3 class="font-serif font-bold text-stone-900 text-sm md:text-base line-clamp-2 mb-1.5 group-hover:text-[#B6171E] transition-colors">{{ $video->title }}</h3>
                            <p class="text-xs text-stone-600 line-clamp-3 leading-relaxed">{{ $video->content }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-16 bg-white rounded-2xl border border-stone-200 shadow-2xs italic">
                    <p class="text-stone-400 text-base">Belum ada video yang ditampilkan.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination Links -->
        <div class="mt-10">
            {{ $videos->links() }}
        </div>
    </div>
</div>
@endsection