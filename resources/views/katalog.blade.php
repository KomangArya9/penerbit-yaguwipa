@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-16">

        <!-- 1. Header Halaman -->
        <div class="text-center mb-16 animate-on-scroll">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Katalog Buku</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Jelajahi koleksi karya sastra, non-fiksi, dan kajian akademik unggulan dari Penerbit Yaguwipa yang dikurasi
                khusus untuk memperkaya literasi dan intelektualitas Anda.
            </p>
        </div>

        <div class="flex flex-col md:flex-row gap-12">
            <!-- 2. Sidebar Filter -->
            <aside class="portfolio-entry w-full md:w-64 shrink-0" style="transition-delay: 100ms;">
                <div class="mb-8">
                    <h3 class="font-bold text-sm mb-4 border-b border-gray-300 pb-2 text-gray-900 tracking-wider">KATEGORI
                    </h3>
                    <ul class="space-y-3 text-sm text-gray-600">
                        @foreach(['Fiksi & Sastra', 'Non-Fiksi & Esai', 'Kajian Akademik', 'Puisi & Teater'] as $item)
                            <li>
                                <label class="flex items-center cursor-pointer group">
                                    <input type="checkbox" {{ $loop->first ? 'checked' : '' }}
                                        class="mr-3 w-4 h-4 rounded border-gray-300 accent-[#B6171E] transition-all">
                                    <span
                                        class="group-hover:text-[#B6171E] group-hover:translate-x-1 transition-all duration-300">
                                        {{ $item }}
                                    </span>
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div>
                    <h3 class="font-bold text-sm mb-4 border-b border-gray-300 pb-2 text-gray-900 tracking-wider">TAHUN
                        TERBIT</h3>
                    <ul class="space-y-3 text-sm text-gray-600">
                        @foreach(['Semua Tahun', '2024 (Terkini)', '2020-2023', 'Sebelum 2020'] as $tahun)
                            <li>
                                <label class="flex items-center cursor-pointer group">
                                    <input type="radio" name="tahun" {{ $loop->first ? 'checked' : '' }}
                                        class="mr-3 w-4 h-4 border-gray-300 accent-[#B6171E] transition-all">
                                    <span
                                        class="group-hover:text-[#B6171E] group-hover:translate-x-1 transition-all duration-300">
                                        {{ $tahun }}
                                    </span>
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>

            <!-- 3. Katalog Grid Section -->
            <main class="flex-1">
                <!-- Header Filter & Sort -->
                <div class="portfolio-entry flex justify-between items-center mb-8 text-sm"
                    style="transition-delay: 200ms;">
                    <p class="text-gray-600">Menampilkan 12 dari 48 buku</p>
                    <div class="flex items-center">
                        <span class="mr-2">Urutkan:</span>
                        <select
                            class="border border-gray-300 p-2 outline-none cursor-pointer hover:border-[#B6171E] transition-colors focus:border-[#B6171E]">
                            <option>Terbaru</option>
                            <option>Terpopuler</option>
                            <option>Abjad (A-Z)</option>
                        </select>
                    </div>
                </div>

                <!-- Grid Buku -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                    @php
                        $books = [
                            ['cat' => 'FIKSI & SASTRA', 'title' => 'Lembayang di Ufuk Timur', 'desc' => 'Sebuah novel epik yang menelusuri jejak sejarah dan perjuangan manusia di tanah...'],
                            ['cat' => 'KAJIAN AKADEMIK', 'title' => 'Arsitektur Kultural Nusantara', 'desc' => 'Analisis mendalam mengenai evolusi ruang dan bentuk dalam tradisi membangun masyarakat...'],
                            ['cat' => 'NON-FIKSI & ESAI', 'title' => 'Metafora Keseharian', 'desc' => 'Kumpulan esai tajam yang mendekonstruksi makna di balik rutinitas hidup urban modern...'],
                            ['cat' => 'PUISI & TEATER', 'title' => 'Bait-Bait Sunyi', 'desc' => 'Antologi puisi yang mengeksplorasi kedalaman emosi manusia dalam...'],
                        ];
                    @endphp

                    @foreach($books as $index => $book)
                        <!-- Kartu Buku: Delay dikurangi agar muncul lebih cepat -->
                        <div class="portfolio-entry border border-gray-200 p-6 flex flex-col hover:shadow-xl transition-all duration-500 opacity-0 translate-y-8"
                            style="transition-delay: {{ 100 + ($index * 100) }}ms;">

                            <!-- Image Wrapper -->
                            <div class="aspect-[2/3] bg-gray-100 mb-6 overflow-hidden relative">
                                <img src="https://picsum.photos/seed/{{ $book['title'] }}/400/600" alt="{{ $book['title'] }}"
                                    class="w-full h-full object-cover hover:scale-110 transition-transform duration-700 ease-in-out">
                            </div>

                            <!-- Info Buku -->
                            <p class="text-[10px] font-bold text-[#B6171E] mb-2 tracking-widest">{{ $book['cat'] }}</p>
                            <h3
                                class="font-bold text-lg mb-2 leading-tight text-gray-900 group-hover:text-[#B6171E] transition-colors">
                                {{ $book['title'] }}
                            </h3>
                            <p class="text-sm text-gray-600 mb-6 flex-1 line-clamp-3">{{ $book['desc'] }}</p>

                            <a href="#"
                                class="inline-flex items-center text-[#B6171E] font-bold text-sm hover:translate-x-2 transition-transform duration-300">
                                Lihat Detail
                                <span class="ml-2">→</span>
                            </a>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination: Delay disesuaikan agar muncul tepat setelah kartu terakhir -->
                <div class="portfolio-entry flex gap-1 opacity-0 translate-y-8" style="transition-delay: 500ms;">
                    <button class="px-3 py-1 border border-gray-300 text-sm hover:bg-gray-100 transition-colors">«</button>
                    <button class="px-3 py-1 bg-[#B6171E] text-white text-sm shadow-md">1</button>
                    <button class="px-3 py-1 border border-gray-300 text-sm hover:bg-gray-100 transition-colors">2</button>
                    <button class="px-3 py-1 border border-gray-300 text-sm hover:bg-gray-100 transition-colors">3</button>
                    <button class="px-3 py-1 border border-gray-300 text-sm cursor-default">...</button>
                    <button class="px-3 py-1 border border-gray-300 text-sm hover:bg-gray-100 transition-colors">»</button>
                </div>
            </main>
        </div>

        <!-- Section 2: Formulir Pengajuan Naskah -->
        <section class="portfolio-entry mt-20 border-t border-gray-300 pt-20 max-w-4xl mx-auto animate-on-scroll"
            style="transition-delay: 200ms;">

            <!-- Tombol Form Unggah Naskah (Langsung ke Link Google Form) -->
            <a href="https://docs.google.com/forms/d/e/1FAIpQLScflolJ88GIIsQmBnR6-kEwd4Z9YvfSWk7d4ps458a6pM2PYg/viewform"
                target="_blank"
                class="block text-center bg-[#B6171E] border-2 border-gray-300 text-white px-10 py-2.5 rounded-lg font-medium hover:bg-white hover:text-gray-700 transition-all duration-300 animate-on-scroll fade-in-up"
                style="transition-delay: 0.2s;">
                Form Unggah Naskah
            </a>

        </section>
    </div>
@endsection