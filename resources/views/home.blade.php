@extends('layouts.app')

@section('content')
    <!-- 1. Hero Section -->
    <section class="py-24 md:py-32 bg-gradient-to-b from-stone-50/80 via-white to-white text-center border-b border-stone-100">
        <div class="container mx-auto px-6">
            <!-- Menggunakan data header/company atau intro dari database -->
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold font-serif tracking-tight text-stone-900 mb-6 max-w-4xl mx-auto leading-tight animate-on-scroll fade-down">
                {{ $setting->intro ?? 'Penerbit Yaguwipa' }}
            </h1>

            <p class="text-lg md:text-xl text-stone-600 max-w-2xl mx-auto mb-10 leading-relaxed animate-on-scroll fade-up"
                style="transition-delay: 0.2s;">
                {{ $setting->seo ?? 'Penerbit YAGUWIPA berperan aktif menyebarluaskan hasil riset, IPTEKS, dan karya sastra...' }}
            </p>

            <div class="flex justify-center gap-4">
                <a href="/program"
                    class="bg-[#B6171E] text-white px-8 py-3.5 rounded-xl font-medium shadow-sm 
                           hover:bg-[#9e141a] hover:shadow-md hover:scale-[1.02] active:scale-[0.98] 
                           transition-all duration-200 animate-on-scroll zoom-in"
                    style="transition-delay: 0.2s;">
                    Pelajari Program
                </a>
            </div>
        </div>
    </section>

    <!-- 2. Program Utama (Grid 4 Kolom) -->
    <section class="py-20 bg-stone-50/60 border-b border-stone-100">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl md:text-4xl font-bold font-serif text-stone-900 text-center mb-12 animate-on-scroll fade-up" style="transition-delay: 0.1s;">
                {{ $setting->home_program_title ?? 'Program Utama Kami' }}
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 auto-rows-fr">
                @if(isset($programs) && $programs->count() > 0)
                    @foreach($programs as $index => $program)
                        <div class="bg-white p-7 rounded-2xl border border-stone-200/80 shadow-[0_2px_8px_rgba(0,0,0,0.03)] hover:shadow-xl hover:border-stone-300 hover:-translate-y-1 animate-on-scroll program-reveal flex flex-col h-full transition-all duration-300 ease-out group"
                            style="transition-delay: {{ $index < 4 ? (0.2 + ($index * 0.1)) : (0.4 + (($index - 4) * 0.05)) }}s;">

                            <!-- BAGIAN IKON -->
                            <div class="w-12 h-12 rounded-xl bg-red-50/80 border border-red-100/70 flex items-center justify-center mb-5 transition-transform duration-300 group-hover:scale-105">
                                @if($program->icon)
                                    <img src="{{ asset('storage/' . $program->icon) }}" alt="{{ $program->title }}"
                                        class="w-6 h-6 object-contain block">
                                @else
                                    <img src="{{ asset('images/default.png') }}" alt="{{ $program->title }}"
                                        class="w-6 h-6 object-contain block">
                                @endif
                            </div>

                            <!-- JUDUL -->
                            <h3 class="font-serif font-bold text-lg text-[#EB3E35] mb-2.5 h-14 flex items-center group-hover:opacity-85 transition-opacity leading-snug">
                                {{ $program->title }}
                            </h3>

                            <!-- RINGKASAN PROGRAM -->
                            <p class="text-sm text-stone-600 mb-6 flex-grow leading-relaxed">
                                {{ $program->short ?: Str::limit(strip_tags($program->content), 150, '...') }}
                            </p>

                            <!-- Tombol -->
                            <a href="{{ route('program') }}#{{ $program->slug }}"
                                class="text-[#B6171E] font-medium text-sm simple-link mt-auto inline-flex items-center group/btn">
                                Pelajari Lebih Lanjut
                                <span class="ml-1.5 transition-transform duration-200 group-hover/btn:translate-x-1">→</span>
                            </a>
                        </div>
                    @endforeach
                @else
                    <div class="col-span-4 text-center py-8">
                        <p class="text-stone-500 italic">Belum ada program utama yang ditampilkan.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- 3. About Section -->
    <section class="py-24 container mx-auto px-6">
        <div class="flex flex-col md:flex-row items-center gap-16">
            <!-- Teks Kiri -->
            <div class="md:w-1/2 animate-on-scroll fade-right">
                <span class="text-[#B6171E] font-semibold tracking-wider uppercase text-xs mb-3 inline-block">
                    Tentang Kami
                </span>
                <h2 class="text-3xl md:text-4xl font-bold font-serif text-stone-900 mb-6 leading-tight">{{ $setting->home_about_title ?? 'Menyebarluaskan Ilmu, Membangun Literasi' }}</h2>

                <p class="text-stone-600 mb-8 leading-relaxed text-base md:text-lg">
                    {{ $setting->home_about_desc ?? 'Penerbit YAGUWIPA hadir sebagai penerbit kredibel yang berkomitmen menyebarluaskan hasil riset, IPTEKS, dan karya sastra bermutu tinggi guna memajukan literasi dan kebudayaan bangsa.' }}
                </p>

                <a href="/profile"
                    class="inline-flex items-center text-white bg-stone-900 px-7 py-3 rounded-full hover:bg-[#B6171E] shadow-sm hover:shadow-md transition-all duration-200 group active:scale-[0.98]">
                    Selengkapnya <span class="ml-2 transform group-hover:translate-x-1 transition-transform duration-200">→</span>
                </a>
            </div>

            <!-- Gambar Kanan (Mengambil dari file background/logo/header yang di-upload di admin) -->
            <div class="md:w-1/2 animate-on-scroll zoom-out" style="transition-delay: 0.3s;">
                <div
                    class="relative w-full h-[280px] sm:h-[360px] md:h-[450px] rounded-2xl overflow-hidden border border-stone-200/80 shadow-xl group">
                    @if($setting && $setting->background && Storage::disk('public')->exists($setting->background))
                        <img src="{{ asset('storage/' . $setting->background) }}" alt="Tentang Yaguwipa"
                            class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">
                    @else
                        <img src="{{ asset('images/default-about.jpg') }}" alt="Tentang Yaguwipa"
                            class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-stone-900/30 via-transparent to-transparent">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Katalog Unggulan -->
    <section class="py-20 container mx-auto px-6 border-t border-stone-100">
        <div class="flex justify-between items-end mb-10 animate-on-scroll fade-up">
            <h2 class="text-3xl font-bold font-serif text-stone-900">{{ $setting->home_katalog_title ?? 'Katalog Unggulan' }}</h2>
            <a href="{{ route('catalog.index') }}"
                class="text-[#B6171E] font-medium flex items-center group transition-colors hover:text-[#9e141a]">
                Lihat Semua
                <span class="ml-1.5 transform transition-transform duration-200 group-hover:translate-x-1">→</span>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 sm:gap-8">
            @if(isset($catalogs) && $catalogs->count() > 0)
                @foreach($catalogs as $index => $catalog)
                    <div class="animate-on-scroll program-reveal group" style="transition-delay: {{ 0.2 + ($index * 0.1) }}s;">
                        <a href="{{ route('catalog.show', $catalog->id) }}" class="block">
                            <div class="bg-stone-100 aspect-[3/4] mb-3.5 overflow-hidden rounded-xl border border-stone-200/80 shadow-sm transition-all duration-300 group-hover:shadow-lg group-hover:-translate-y-1">
                                @if($catalog->cover || $catalog->img)
                                    <img src="{{ asset('storage/' . ($catalog->cover ?? $catalog->img)) }}" alt="{{ $catalog->Judul }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                @else
                                    <img src="{{ asset('images/default-book.png') }}" alt="{{ $catalog->Judul }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                @endif
                            </div>

                            <!-- 1. Kategori (Huruf kecil/besar disesuaikan dengan database) -->
                            <span
                                class="text-[11px] font-semibold tracking-wider text-[#B6171E] uppercase mb-1 block">
                                {{ $catalog->kategori ?? 'Kategori' }}
                            </span>

                            <!-- 2. Judul Buku -->
                            <h3
                                class="font-serif font-bold text-stone-900 group-hover:text-[#B6171E] transition-colors line-clamp-1 mb-1.5 text-base">
                                {{ $catalog->judul }}
                            </h3>
                        </a>

                        <!-- 3. Harga -->
                        <p class="font-semibold text-stone-900 text-sm">
                            @if($catalog->harga)
                                Rp {{ number_format($catalog->harga, 0, ',', '.') }}
                            @else
                                <span class="text-stone-500 font-normal">Gratis / Hubungi Admin</span>
                            @endif
                        </p>
                    </div>
                @endforeach
            @else
                <div class="col-span-4 text-center py-8">
                    <p class="text-stone-500 italic">Belum ada katalog unggulan yang ditampilkan.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- 5. Testimonial Section -->
    <section class="py-20 bg-stone-50/70 border-t border-stone-100 overflow-hidden">
        <div class="container mx-auto px-6 relative">
            <!-- Header Section -->
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold font-serif text-stone-900 mb-3">{{ $setting->home_testimoni_title ?? 'Ulasan & Testimoni' }}</h2>
                <p class="text-stone-500 max-w-2xl mx-auto text-base">{{ $setting->home_testimoni_subtitle ?? 'Kepercayaan para penulis dan pembaca menjadi motivasi kami untuk terus menghadirkan layanan penerbitan terbaik' }}</p>
            </div>

            <!-- Wrapper Slider -->
            <div class="relative group px-4 md:px-12">
                <!-- Tombol Kiri -->
                <button onclick="scrollSlider(-1)"
                    aria-label="Previous Review"
                    class="absolute left-0 top-1/2 -translate-y-1/2 z-20 w-10 h-10 rounded-full bg-white/95 border border-stone-200 shadow-md text-stone-600 hover:text-[#B6171E] hover:border-stone-300 flex items-center justify-center transition-all active:scale-95">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>

                <!-- Slider Container -->
                <div id="testimoni-slider"
                    class="flex gap-6 overflow-x-auto snap-x snap-mandatory scroll-smooth pb-10 w-full no-scrollbar">
                    @forelse($reviews as $item)
                        <div
                            class="card-item min-w-[85%] sm:min-w-[48%] lg:min-w-[31%] bg-white p-7 border border-stone-200/80 shadow-sm hover:shadow-md rounded-2xl snap-center flex flex-col items-center justify-between transition-all duration-300">
                            <div class="text-amber-400 mb-4 tracking-widest text-sm">
                                @for($s = 0; $s < $item->starts; $s++)★@endfor
                            </div>
                            <p class="text-stone-700 italic text-center mb-6 leading-relaxed flex-grow text-sm sm:text-base font-serif">
                                "{{ $item->review }}"
                            </p>
                            <div class="text-center">
                                <div class="font-semibold text-stone-900 text-sm">{{ $item->nama }}</div>
                                <div class="text-xs text-stone-500 mt-0.5">{{ $item->pekerjaan }}</div>
                            </div>
                        </div>
                    @empty
                        <div class="w-full text-center py-8 text-stone-400 italic">
                            Belum ada review yang ditampilkan.
                        </div>
                    @endforelse
                </div>

                <!-- Tombol Kanan -->
                <button onclick="scrollSlider(1)"
                    aria-label="Next Review"
                    class="absolute right-0 top-1/2 -translate-y-1/2 z-20 w-10 h-10 rounded-full bg-white/95 border border-stone-200 shadow-md text-stone-600 hover:text-[#B6171E] hover:border-stone-300 flex items-center justify-center transition-all active:scale-95">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>
        </div>
    </section>
@endsection