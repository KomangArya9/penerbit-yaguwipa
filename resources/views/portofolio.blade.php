@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-6 py-16 md:py-20">

        <!-- 1. Header -->
        <div class="mb-12 animate-on-scroll">
            <h1 class="text-4xl sm:text-5xl font-bold font-serif text-stone-900 mb-3 tracking-tight">{{ $setting->portofolio_title ?? 'Portofolio' }}</h1>
            <p class="text-stone-600 text-base md:text-lg">{{ $setting->portofolio_subtitle ?? 'Rekam jejak karya dan proyek yang telah diselesaikan.' }}</p>
        </div>

        <!-- 2. Filter Tab Dinamis dari Database -->
        <div class="flex gap-8 mb-12 flex-wrap border-b border-stone-200">
            <!-- Tombol 'Semua' (Default) -->
            <a href="{{ route('portofolio') }}"
                class="-mb-px pb-3 border-b-2 {{ !request('category') ? 'border-[#B6171E] text-[#B6171E] font-semibold' : 'border-transparent text-stone-500 hover:text-stone-900 font-medium' }} transition-colors duration-200 whitespace-nowrap text-sm">
                Semua
            </a>

            <!-- Perulangan Kategori dari Database Admin -->
            @foreach($categories as $category)
                <a href="{{ route('portofolio', ['category' => $category->slug]) }}"
                    class="-mb-px pb-3 border-b-2 {{ request('category') == $category->slug ? 'border-[#B6171E] text-[#B6171E] font-semibold' : 'border-transparent text-stone-500 hover:text-stone-900 font-medium' }} transition-colors duration-200 whitespace-nowrap text-sm">
                    {{ $category->title }}
                </a>
            @endforeach
        </div>

        <!-- 3. Grid Container (Dinamis dari Database - Bersih Tanpa Card Mencolok) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @forelse($projects as $index => $project)
                <a href="{{ route('portofolio.show', $project->slug) }}" 
                    class="portfolio-entry group cursor-pointer block"
                    style="transition-delay: {{ $index * 100 }}ms;">
                    
                    <!-- Container Gambar Bersih -->
                    <div class="aspect-[3/4] bg-stone-100 rounded-2xl mb-3.5 overflow-hidden border border-stone-200/60 shadow-2xs">
                        @php
                            $primaryPhoto = $project->fotos->first();
                        @endphp

                        @if($primaryPhoto && $primaryPhoto->img)
                            <img src="{{ asset('storage/' . $primaryPhoto->img) }}" alt="{{ $project->title }}"
                                class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-stone-400 text-xs italic">No Image</div>
                        @endif
                    </div>

                    <!-- Kategori -->
                    <p class="text-[11px] font-semibold text-[#B6171E] mb-1 uppercase tracking-wider">
                        {{ $project->kategoriProject ? strtoupper($project->kategoriProject->title) : '-' }}
                    </p>
                    
                    <!-- Judul -->
                    <h3 class="font-serif font-bold text-lg text-stone-900 mb-1 leading-snug group-hover:text-[#B6171E] transition-colors line-clamp-2">
                        {{ $project->title }}
                    </h3>

                    <!-- Lokasi -->
                    @if($project->lokasi)
                        <p class="text-xs text-stone-500 line-clamp-1 mt-1 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 text-stone-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            {{ $project->lokasi }}
                        </p>
                    @endif
                </a>
            @empty
                <div class="col-span-full text-center py-16 text-stone-400 italic">
                    Belum ada portofolio yang tersedia untuk kategori ini.
                </div>
            @endforelse
        </div>

        <!-- 4. Pagination Bawaan Laravel -->
        @if($projects->hasPages())
            <div class="portfolio-entry mt-12 flex gap-1 opacity-0 translate-y-8" style="transition-delay: 250ms;">
                {{ $projects->links() }}
            </div>
        @endif
    </div>
@endsection