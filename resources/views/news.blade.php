@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-16">
        <!-- Header News & Events -->
        <div class="text-center mb-16 animate-on-scroll">
            <h1 class="text-4xl font-bold text-gray-900 mb-6 tracking-tight">News & Events</h1>

            <p class="text-gray-600 text-lg max-w-2xl mx-auto leading-relaxed">
                Ikuti perkembangan terbaru, berita industri, dan jadwal acara literasi
                dari Penerbit Yaguwipa.
            </p>
        </div>


        <!-- Feature Section (Terpilih & Elegan) -->
        <section class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16 border border-gray-200 p-6 overflow-hidden">

            <!-- Foto: Muncul dari KIRI -->
            <div class="animate-left aspect-video bg-gray-300 w-full h-full"></div>

            <!-- Content: Muncul dari KANAN -->
            <div class="animate-right flex flex-col justify-center">
                <div class="flex items-center gap-3 mb-4">
                    <span class="bg-[#B6171E] text-white text-[10px] px-2 py-1 tracking-widest uppercase font-bold">Trending</span>
                    <span class="text-xs text-gray-500 font-medium">24 Okt 2024</span>
                </div>

                <h2 class="text-2xl font-bold mb-4 text-gray-900 leading-tight">
                    Peluncuran Buku Antologi Puisi 'Senja di Kota Lama'
                </h2>

                <p class="text-gray-600 mb-6 leading-relaxed">
                    Bergabunglah bersama kami dalam malam penuh makna, merayakan peluncuran karya terbaru...
                </p>

                <a href="#"
                    class="group inline-flex items-center text-white bg-gray-900 px-4 py-1.5 rounded-full hover:bg-[#B6171E] transition-all duration-300 w-fit">
                    <span class="text-xs font-semibold">Selengkapnya</span>
                    <span
                        class="ml-1.5 transform group-hover:translate-x-1 transition-transform duration-300 ease-out">→</span>
                </a>
            </div>
        </section>

        <!-- News Grid -->
        <section class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            @for($i = 0; $i < 3; $i++)
                <div class="animate-card border border-gray-200 p-4 transition-all duration-500 hover:border-gray-400 hover:shadow-lg"
                    style="animation-delay: {{ $i * 0.2 }}s;">

                    <!-- Image Placeholder -->
                    <div class="aspect-video bg-gray-200 mb-4 overflow-hidden">
                        <div class="w-full h-full bg-gray-300 transform transition-transform duration-700 hover:scale-105">
                        </div>
                    </div>

                    <!-- Metadata -->
                    <p class="text-xs text-gray-500 mb-2">12 Okt 2024</p>

                    <!-- Title -->
                    <h3 class="font-bold text-lg mb-2 leading-snug">
                        Penerbit Yaguwipa Raih Penghargaan Desain Sampul...
                    </h3>

                    <!-- Description -->
                    <p class="text-sm text-gray-600 mb-4 leading-relaxed">
                        Dedikasi kami terhadap estetika visual dan relevansi makna...
                    </p>

                    <a href="#"
                        class="group inline-flex items-center text-red-800 font-semibold text-sm transition-all duration-300 w-fit">
                        <!-- Teks bergerak sedikit ke kanan mengikuti panah -->
                        <span class="transition-transform duration-300 group-hover:translate-x-1">
                            Baca Selengkapnya
                        </span>
                        <!-- Panah tetap bergerak ke kanan -->
                        <span class="ml-1 transition-transform duration-300 group-hover:translate-x-1 inline-block">→</span>
                    </a>
                </div>
            @endfor
        </section>

        <!-- Events Section -->
        <section class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">

            <!-- News Card -->
            <div class="animate-card border border-gray-200 p-4 flex flex-col transition-all duration-500 hover:shadow-xl hover:border-red-800"
                style="animation-delay: 0.5s;">
                <div class="aspect-video bg-gray-200 mb-4 overflow-hidden">
                    <div class="w-full h-full bg-gray-300 hover:scale-105 transition-transform duration-700"></div>
                </div>
                <p class="text-xs text-gray-500 mb-2">15 Sep 2024</p>
                <h3 class="font-bold text-lg mb-4">Ulasan Buku: Menelusuri Jejak Aksara Kuno</h3>

                <!-- Tombol dengan animasi sinkron -->
                <a href="#"
                    class="group inline-flex items-center text-red-800 font-semibold text-sm transition-all duration-300 mt-auto">
                    <span class="transition-transform duration-300 group-hover:translate-x-1">Baca Selengkapnya</span>
                    <span class="ml-1 transition-transform duration-300 group-hover:translate-x-1 inline-block">→</span>
                </a>
            </div>
        </section>

        <!-- Pagination -->
        <div class="flex justify-center gap-2 animate-pagination">
            <!-- Tombol Prev -->
            <button
                class="px-4 py-2 border border-gray-200 hover:border-red-800 hover:text-red-800 transition-all duration-300">
                &lt;
            </button>

            <!-- Angka Halaman -->
            <button class="px-4 py-2 bg-red-800 text-white shadow-md">1</button>
            <button class="px-4 py-2 border border-gray-200 hover:bg-gray-100 transition-colors duration-300">2</button>
            <button class="px-4 py-2 border border-gray-200 hover:bg-gray-100 transition-colors duration-300">3</button>

            <!-- Tombol Next -->
            <button
                class="px-4 py-2 border border-gray-200 hover:border-red-800 hover:text-red-800 transition-all duration-300">
                &gt;
            </button>
        </div>
    </div>
@endsection