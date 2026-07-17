@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-6 py-20">

        <!-- 1. Header -->
        <div class="mb-12 animate-on-scroll delay-100">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Portofolio</h1>
            <p class="text-gray-600">Rekam jejak karya dan proyek yang telah diselesaikan.</p>
        </div>

        <!-- 2. Filter Tab -->
        <div class="flex gap-8 border-b border-gray-200 mb-12 overflow-x-auto">
            <!-- Tombol dengan delay yang bertingkat -->
            <button
                class="animate-on-scroll pb-3 border-b-2 border-red-600 text-red-600 font-semibold transition-colors duration-300">
                Semua
            </button>
            <button
                class="animate-on-scroll delay-100 pb-3 text-gray-500 hover:text-gray-900 transition-colors duration-300">
                Web App
            </button>
            <button
                class="animate-on-scroll delay-200 pb-3 text-gray-500 hover:text-gray-900 transition-colors duration-300">
                Mobile
            </button>
            <button
                class="animate-on-scroll delay-300 pb-3 text-gray-500 hover:text-gray-900 transition-colors duration-300">
                UI/UX
            </button>
        </div>

        <!-- 3. Grid Container -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @php
                $projects = [
                    ['cat' => 'WEB APP', 'title' => 'Eduhub Management', 'desc' => 'Sistem Peminjaman Fasilitas'],
                    ['cat' => 'WEB APP', 'title' => 'TKR Dept Profile', 'desc' => 'Website Profil Jurusan'],
                    ['cat' => 'UI/UX', 'title' => 'Design System Mobile', 'desc' => 'Eksplorasi Figma'],
                    ['cat' => 'MOBILE', 'title' => 'Flutter Project', 'desc' => 'Aplikasi Pembelajaran']
                ];
            @endphp

            @foreach($projects as $index => $project)
                <!-- Menggunakan class 'portfolio-entry' untuk animasi khusus -->
                <div class="portfolio-entry group cursor-pointer" style="transition-delay: {{ $index * 100 }}ms;">
                    <!-- Image -->
                    <div class="aspect-[3/4] bg-gray-200 rounded-sm mb-4 overflow-hidden">
                        <img src="https://picsum.photos/seed/{{ $project['title'] }}/400/600" alt="{{ $project['title'] }}"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    </div>

                    <!-- Content -->
                    <p class="text-xs font-bold text-[#B6171E] mb-1 tracking-wider">{{ $project['cat'] }}</p>
                    <h3 class="text-lg font-bold text-gray-900 mb-1 leading-tight">{{ $project['title'] }}</h3>
                    <p class="text-sm text-gray-500">{{ $project['desc'] }}</p>
                </div>
            @endforeach
        </div>

        <!-- Pagination: Delay disesuaikan agar muncul tepat setelah kartu terakhir -->
        <div class="portfolio-entry flex gap-1 opacity-0 translate-y-8" style="transition-delay: 250ms;">
            <button class="px-3 py-1 border border-gray-300 text-sm hover:bg-gray-100 transition-colors">«</button>
            <button class="px-3 py-1 bg-[#B6171E] text-white text-sm shadow-md">1</button>
            <button class="px-3 py-1 border border-gray-300 text-sm hover:bg-gray-100 transition-colors">2</button>
            <button class="px-3 py-1 border border-gray-300 text-sm hover:bg-gray-100 transition-colors">3</button>
            <button class="px-3 py-1 border border-gray-300 text-sm cursor-default">...</button>
            <button class="px-3 py-1 border border-gray-300 text-sm hover:bg-gray-100 transition-colors">»</button>
        </div>
    </div>
@endsection