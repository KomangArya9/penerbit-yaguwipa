@extends('layouts.app')

@section('content')
    <!-- 1. Hero Section -->
    <section class="py-24 bg-white text-center">
        <div class="container mx-auto px-6">
            <!-- Menggunakan data header/company atau intro dari database -->
            <h1 class="text-6xl font-bold tracking-tight text-gray-900 mb-6 animate-on-scroll fade-down">
                {{ $setting->intro ?? 'Penerbit Yaguwipa' }}
            </h1>

            <p class="text-xl text-gray-600 max-w-2xl mx-auto mb-10 leading-relaxed animate-on-scroll fade-up"
                style="transition-delay: 0.2s;">
                {{ $setting->seo ?? 'Penerbit YAGUWIPA berperan aktif menyebarluaskan hasil riset, IPTEKS, dan karya sastra...' }}
            </p>

            <div class="flex justify-center gap-4">
                <a href="/program"
                    class="bg-[var(--color-yaguwipa-red)] text-white px-8 py-3 rounded-lg font-semibold 
                                                                        hover:brightness-90 hover:opacity-90 hover:scale-[1.02] 
                                                                        transition-all duration-300 animate-on-scroll zoom-in"
                    style="transition-delay: 0.2s;">
                    Pelajari Program
                </a>
            </div>
        </div>
    </section>

    <!-- 2. Program Utama (Grid 4 Kolom) -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12 animate-on-scroll fade-up" style="transition-delay: 0.1s;">
                Program Utama Kami
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 auto-rows-fr">
                @if(isset($programs) && $programs->count() > 0)
                    @foreach($programs as $index => $program)
                        <div class="bg-white p-8 border border-gray-100 shadow-sm card-hover animate-on-scroll program-reveal flex flex-col h-full transition-all duration-300 ease-in-out group"
                            style="transition-delay: {{ $index < 4 ? (0.2 + ($index * 0.1)) : (0.4 + (($index - 4) * 0.05)) }}s;">

                            <!-- BAGIAN IKON -->
                            <div class="mb-4 transition-transform duration-500 group-hover:scale-110">
                                @if($program->icon)
                                    <img src="{{ asset('storage/' . $program->icon) }}" alt="{{ $program->title }}"
                                        class="w-12 h-12 object-contain block filter-red">
                                @else
                                    <img src="{{ asset('images/default.png') }}" alt="{{ $program->title }}"
                                        class="w-12 h-12 object-contain block filter-red">
                                @endif
                            </div>

                            <!-- JUDUL -->
                            <h3 class="font-bold text-lg mb-3 h-16 flex items-center">
                                {{ $program->title }}
                            </h3>

                            <!-- DESKRIPSI (Ringkas otomatis) -->
                            <p class="text-sm text-gray-600 mb-6 flex-grow">
                                {{ Str::limit(strip_tags($program->content), 150, '...') }}
                            </p>

                            <!-- Tombol -->
                            <a href="{{ route('program') }}#{{ $program->slug }}"
                                class="text-[var(--color-yaguwipa-red)] font-semibold text-sm simple-link mt-auto inline-flex items-center">
                                Pelajari Lebih Lanjut
                                <span class="ml-1 transition-transform duration-300 group-hover:translate-x-1">→</span>
                            </a>
                        </div>
                    @endforeach
                @else
                    <div class="col-span-4 text-center py-8">
                        <p class="text-gray-500 italic">Belum ada program utama yang ditampilkan.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>


    <!-- 3. About Section -->
    <section class="py-20 container mx-auto px-6">
        <div class="flex flex-col md:flex-row items-center gap-16">
            <!-- Teks Kiri -->
            <div class="md:w-1/2 animate-on-scroll fade-right">
                <span class="text-[var(--color-yaguwipa-red)] font-semibold tracking-widest uppercase text-sm mb-4 block">
                    Tentang Kami
                </span>
                <h2 class="text-4xl font-bold mb-6 leading-tight">Menyebarluaskan Ilmu, Membangun Literasi</h2>

                <!-- Mengambil teks dari kolom 'team' atau 'intro' (sesuaikan dengan inputan form admin kamu) -->
                <p class="text-gray-600 mb-8 leading-relaxed">
                    {{ $setting->url_popup ?? 'Penerbit YAGUWIPA hadir sebagai penerbit kredibel...' }}
                </p>

                <a href="/profile"
                    class="inline-flex items-center text-white bg-gray-900 px-6 py-3 rounded-full hover:bg-[var(--color-yaguwipa-red)] transition-all duration-300 group">
                    Selengkapnya <span class="ml-2 transform group-hover:translate-x-1 transition-transform">→</span>
                </a>
            </div>

            <!-- Gambar Kanan (Mengambil dari file background/logo/header yang di-upload di admin) -->
            <div class="md:w-1/2 animate-on-scroll zoom-out" style="transition-delay: 0.3s;">
                <div
                    class="relative w-full h-[450px] rounded-2xl overflow-hidden card-hover border-4 border-white shadow-2xl">
                    @if($setting && $setting->background && Storage::disk('public')->exists($setting->background))
                        <img src="{{ asset('storage/' . $setting->background) }}" alt="Tentang Yaguwipa"
                            class="w-full h-full object-cover">
                    @else
                        <img src="{{ asset('images/default-about.jpg') }}" alt="Tentang Yaguwipa"
                            class="w-full h-full object-cover">
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-tr from-[var(--color-yaguwipa-red)]/20 to-transparent">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Katalog Unggulan -->
    <section class="py-16 container mx-auto px-6">
        <div class="flex justify-between items-end mb-10 animate-on-scroll fade-up">
            <h2 class="text-3xl font-bold">Katalog Unggulan</h2>
            <a href="{{ route('catalog.index') }}"
                class="text-[var(--color-yaguwipa-red)] font-semibold flex items-center group transition-opacity duration-300 hover:opacity-80">
                Lihat Semua
                <span class="ml-2 transform transition-transform duration-300 group-hover:translate-x-2">→</span>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            @if(isset($catalogs) && $catalogs->count() > 0)
                @foreach($catalogs as $index => $catalog)
                    <div class="animate-on-scroll program-reveal" style="transition-delay: {{ 0.2 + ($index * 0.1) }}s;">
                        <a href="{{ route('catalog.show', $catalog->id) }}" class="block">
                            <div class="bg-gray-200 aspect-[3/4] mb-4 overflow-hidden rounded-lg shadow-sm card-hover">
                                @if($catalog->cover || $catalog->img)
                                    <img src="{{ asset('storage/' . ($catalog->cover ?? $catalog->img)) }}" alt="{{ $catalog->Judul }}"
                                        class="w-full h-full object-cover img-zoom">
                                @else
                                    <img src="{{ asset('images/default-book.png') }}" alt="{{ $catalog->Judul }}"
                                        class="w-full h-full object-cover img-zoom">
                                @endif
                            </div>

                            <!-- 1. Kategori (Huruf kecil/besar disesuaikan dengan database) -->
                            <span
                                class="text-xs font-semibold tracking-wider text-[var(--color-yaguwipa-red)] uppercase mb-1 block">
                                {{ $catalog->kategori ?? 'Kategori' }}
                            </span>

                            <!-- 2. Judul Buku -->
                            <h3
                                class="font-bold text-gray-900 group-hover:text-[var(--color-yaguwipa-red)] transition-colors line-clamp-1 mb-2">
                                {{ $catalog->judul }}
                            </h3>
                        </a>

                        <!-- 3. Harga -->
                        <p class="font-bold text-gray-900">
                            @if($catalog->harga)
                                Rp {{ number_format($catalog->harga, 0, ',', '.') }}
                            @else
                                Gratis / Hubungi Admin
                            @endif
                        </p>
                    </div>
                @endforeach
            @else
                <div class="col-span-4 text-center py-8">
                    <p class="text-gray-500 italic">Belum ada katalog unggulan yang ditampilkan.</p>
                </div>
            @endif
        </div>
    </section>

    <section class="py-20 bg-gray-50 overflow-hidden">
        <div class="container mx-auto px-6 relative">
            <!-- Header Section -->
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Ulasan & Testimoni</h2>
                <p class="text-gray-500 max-w-2xl mx-auto">Kepercayaan para penulis dan pembaca menjadi motivasi kami untuk terus menghadirkan layanan penerbitan terbaik</p>
            </div>

            <!-- Wrapper Slider -->
            <div class="relative group px-4 md:px-12">
                <!-- Tombol Kiri -->
                <button onclick="scrollSlider(-1)"
                    class="absolute left-0 top-1/2 -translate-y-1/2 z-20 p-1 md:p-2 text-gray-400 hover:text-[#B6171E] transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>

                <!-- Slider Container -->
                <div id="testimoni-slider"
                    class="flex gap-6 overflow-x-auto snap-x snap-mandatory scroll-smooth pb-10 w-full no-scrollbar">
                    @forelse($reviews as $item)
                        <div
                            class="card-item min-w-[80%] md:min-w-[45%] lg:min-w-[30%] bg-white p-8 border border-gray-100 shadow-sm rounded-xl snap-center flex flex-col items-center justify-between transition-all duration-700">
                            <div class="text-orange-400 mb-4">
                                @for($s = 0; $s < $item->starts; $s++)★@endfor
                            </div>
                            <p class="text-gray-700 italic text-center mb-6 leading-relaxed flex-grow break-all">
                                "{{ $item->review }}"
                            </p>
                            <div class="text-center">
                                <div class="font-bold text-gray-900">{{ $item->nama }}</div>
                                <div class="text-xs text-gray-500 mt-0.5">{{ $item->pekerjaan }}</div>
                            </div>
                        </div>
                    @empty
                        <div class="w-full text-center py-8 text-gray-400 italic">
                            Belum ada review yang ditampilkan.
                        </div>
                    @endforelse
                </div>

                <!-- Tombol Kanan -->
                <button onclick="scrollSlider(1)"
                    class="absolute right-0 top-1/2 -translate-y-1/2 z-20 p-1 md:p-2 text-gray-400 hover:text-[#B6171E] transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>
        </div>
    </section>
@endsection