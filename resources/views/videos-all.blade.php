@extends('layouts.app')

@section('content')
<div class="bg-gray-50 py-16">
    <div class="container mx-auto px-4 md:px-12 max-w-6xl">
        <!-- Header Navigasi & Judul -->
        <div class="mb-8">
            <a href="{{ route('profile') }}" class="text-sm text-[#B6171E] font-semibold hover:underline inline-flex items-center gap-1 mb-2">
                &larr; @lang('videos.back_to_profile')
            </a>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900">@lang('videos.page_title')</h1>
            <p class="text-sm text-gray-600 mt-1">@lang('videos.page_subtitle')</p>
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
                <!-- Efek hover tipis: hover:-translate-y-1, transition-all, dan shadow-md -->
                <div class="bg-white border border-gray-100 rounded-lg shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between overflow-hidden group">
                    <div>
                        <!-- Video Thumbnail & Play Button Overlay -->
                        <a href="{{ $video->source }}" target="_blank" class="aspect-video bg-black relative overflow-hidden block">
                            <!-- Gambar Thumbnail -->
                            <img src="{{ $thumbnailUrl }}" alt="{{ $video->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            
                            <!-- Overlay & Tombol Play (Posisinya persis di tengah) -->
                            <div class="absolute inset-0 bg-black/30 group-hover:bg-black/40 transition-colors flex items-center justify-center">
                                <div class="w-12 h-12 rounded-full bg-red-600 text-white flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                    <svg class="w-5 h-5 translate-x-0" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </div>
                            </div>

                            <!-- Badge YouTube -->
                            <span class="absolute bottom-2 right-2 bg-black/70 text-white text-[10px] font-bold px-2 py-0.5 rounded backdrop-blur-sm">
                                YouTube
                            </span>
                        </a>

                        <!-- Deskripsi Singkat -->
                        <div class="p-4">
                            <span class="text-xs text-gray-400 block mb-1">{{ date('d M Y', strtotime($video->date)) }}</span>
                            <h3 class="font-bold text-gray-800 text-sm md:text-base line-clamp-2 mb-2 group-hover:text-[#B6171E] transition-colors">{{ $video->title }}</h3>
                            <p class="text-xs text-gray-600 line-clamp-3">{{ $video->content }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-16 bg-white rounded-lg shadow">
                    <p class="text-gray-500 text-base">@lang('videos.no_videos')</p>
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