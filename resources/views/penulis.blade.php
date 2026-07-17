@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-6 py-16">

        <!-- 1. Header Halaman -->
        <div class="text-center mb-16 animate-on-scroll">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Penulis Kami</h1>
            <p class="text-gray-600">Mengenal lebih dekat suara-suara di balik karya-karya bermakna.</p>
        </div>

        <!-- 2. Grid Kartu Penulis -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-20">
            @php
                $authors = [
                    ['name' => 'Dr. Aria Setyawan', 'role' => 'Akademisi', 'spec' => 'SOSIOLOGI & SEJARAH', 'works' => ['Jejak Peradaban Timur', 'Dinamika Masyarakat Modern'], 'photo' => 'aria.jpg'],
                    ['name' => 'Lina Kusuma', 'role' => 'Penulis', 'spec' => 'FIKSI SASTRA', 'works' => ['Senja di Pelabuhan Ratu', 'Kumpulan Cerpen: Gema'], 'photo' => 'lina.jpg'],
                    ['name' => 'Budi Santoso', 'role' => 'Ekonom', 'spec' => 'EKONOMI & BISNIS', 'works' => ['Strategi UMKM Bangkit'], 'photo' => 'budi.jpg']
                ];
            @endphp

            @foreach($authors as $index => $author)
                <!-- Menambahkan class portfolio-entry untuk animasi elegan & delay dinamis -->
                <div class="portfolio-entry border border-gray-200 p-6 shadow-sm hover:shadow-lg transition-all duration-300"
                    style="transition-delay: {{ $index * 150 }}ms;">

                    <!-- Foto Profil -->
                    <div class="w-24 h-24 mb-6 overflow-hidden rounded-full mx-auto border-4 border-white shadow-sm">
                        <img src="{{ asset('images/' . $author['photo']) }}" alt="{{ $author['name'] }}"
                            class="w-full h-full object-cover">
                    </div>

                    <div class="flex justify-between items-start mb-4">
                        <h3 class="font-bold text-lg">{{ $author['name'] }}</h3>
                        <span class="text-[10px] font-bold bg-[#B6171E] text-white px-2 py-1 uppercase tracking-wider">
                            {{ $author['role'] }}
                        </span>
                    </div>

                    <p class="text-xs font-bold text-[#B6171E] mb-4">{{ $author['spec'] }}</p>

                    <div class="border-t pt-4">
                        <p class="text-sm font-semibold mb-2 text-gray-900">Karya Diterbitkan:</p>
                        <ul class="text-sm text-gray-600 space-y-1">
                            @foreach($author['works'] as $work)
                                <li>• {{ $work }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach

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

        <!-- 3. Section Formulir -->
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Pemicu Form Penulis -->
            <button onclick="document.getElementById('modal-penulis').classList.remove('hidden')"
                class="border-2 border-gray-300 text-gray-700 px-10 py-2.5 rounded-lg font-medium hover:bg-[#B6171E] hover:text-white hover:border-[#B6171E] transition-all duration-300 animate-on-scroll fade-in-up">
                Form Penulis
            </button>

            <!-- Tombol Form Unggah Naskah (Langsung ke Link Google Form) -->
            <a href="https://docs.google.com/forms/d/e/1FAIpQLScflolJ88GIIsQmBnR6-kEwd4Z9YvfSWk7d4ps458a6pM2PYg/viewform" target="_blank"
                class="block text-center bg-[#B6171E] border-2 border-gray-300 text-white px-10 py-2.5 rounded-lg font-medium hover:bg-white hover:text-gray-700 transition-all duration-300 animate-on-scroll fade-in-up"
                style="transition-delay: 0.2s;">
                Form Unggah Naskah
            </a>
        </div>

        <!-- Modal Form Penulis -->
        <div id="modal-penulis"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden p-4">
            <div class="bg-white p-8 rounded-lg shadow-xl w-full max-w-md relative">
                <button onclick="document.getElementById('modal-penulis').classList.add('hidden')"
                    class="absolute top-4 right-4 text-gray-500 hover:text-black text-xl font-bold">&times;</button>
                <h2 class="text-2xl font-bold mb-6 text-gray-900">Daftar Menjadi Penulis</h2>
                <form class="space-y-4">
                    <input type="text" placeholder="Nama Lengkap"
                        class="w-full p-3 border border-gray-300 outline-none focus:border-gray-500">
                    <input type="text" placeholder="Keahlian / Spesialisasi"
                        class="w-full p-3 border border-gray-300 outline-none focus:border-gray-500">
                    <input type="email" placeholder="Email"
                        class="w-full p-3 border border-gray-300 outline-none focus:border-gray-500">
                    <input type="text" placeholder="Tautan Portofolio (Opsional)"
                        class="w-full p-3 border border-gray-300 outline-none focus:border-gray-500">
                    <button type="submit"
                        class="w-full bg-[#B6171E] text-white px-8 py-3 font-semibold hover:bg-red-900 transition-all duration-300">Daftar
                        Sekarang</button>
                </form>
            </div>
        </div>
    </div>
@endsection