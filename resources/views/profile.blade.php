@extends('layouts.app')

@section('content')

    <!-- Wrapper Utama -->
    <div class="bg-gray-50 py-16">
        <div class="container mx-auto px-4 md:px-12">

            <section class="text-center max-w-3xl mx-auto mb-20">
                <!-- 1. Label: Fade In Slide Up -->
                <h4 class="animate-on-scroll text-[#B91C1C] font-bold text-xs uppercase tracking-widest mb-4">
                    PENERBIT TEPERCAYA
                </h4>

                <!-- 2. Judul: Delay sedikit -->
                <h1 class="animate-on-scroll delay-100 text-4xl md:text-5xl text-gray-900 mb-6">
                    Tentang Penerbit YAGUWIPA
                </h1>

                <!-- 3. Deskripsi: Delay lebih panjang -->
                <p class="animate-on-scroll delay-200 text-gray-600 font-sans text-lg leading-relaxed mb-8">
                    Penerbit YAGUWIPA merupakan penerbit profesional yang berkomitmen menyebarluaskan hasil riset, IPTEKS,
                    humaniora, dan karya sastra melalui penerbitan buku ber-ISBN, prosiding, serta layanan publikasi ilmiah.
                    Sebagai anggota resmi IKAPI dan FORPIN, kami hadir sebagai mitra terpercaya bagi akademisi, peneliti,
                    pendidik, praktisi, dan penulis dalam menghadirkan karya yang berkualitas dan berdampak.
                </p>

                <!-- 4. Quote: Terakhir -->
                <p class="animate-on-scroll delay-300 text-gray-500 leading-relaxed italic border-t border-gray-300 pt-6">
                    "Menghubungkan gagasan dengan dunia melalui publikasi yang berkualitas dan berintegritas."
                </p>
            </section>

            <!-- Section: Photo Archive & Documentary -->


            <div class="bg-gray-100 pt-16 pb-24 mb-24 w-screen ml-[calc(-50vw+50%)] relative">


                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 px-6 md:px-12">

                    <section class="animate-on-scroll">
                        <h3 class="text-xl font-bold mb-6 flex items-center gap-2 text-gray-900">
                            📷 Photo Archive
                        </h3>
                        <div class="grid grid-cols-2 gap-2">
                            <!-- Foto 1: Muncul pertama -->
                            <div class="animate-on-scroll delay-100 bg-gray-300 h-40 w-full object-cover"></div>
                            <!-- Foto 2: Muncul setelahnya -->
                            <div class="animate-on-scroll delay-200 bg-gray-300 h-40 w-full object-cover"></div>
                            <!-- Foto 3: Muncul setelahnya -->
                            <div class="animate-on-scroll delay-300 bg-gray-300 h-40 w-full object-cover"></div>
                            <!-- Foto 4/Tombol: Terakhir -->
                            <div
                                class="animate-on-scroll delay-400 bg-gray-200 flex items-center justify-center font-semibold text-sm cursor-pointer hover:bg-gray-300 transition">
                                View All Photos
                            </div>
                        </div>
                    </section>

                    <section class="animate-on-scroll delay-200">
                        <h3 class="text-xl font-bold mb-6 flex items-center gap-2 text-gray-900">
                            🎥 Documentary & Film
                        </h3>

                        <!-- Video Player: Efek Scale-Up halus -->
                        <div
                            class="animate-on-scroll delay-300 bg-black aspect-video flex items-center justify-center text-white w-full mb-4 shadow-xl hover:shadow-2xl transition-all duration-700">
                            Video Player
                        </div>

                        <!-- Thumbnail Pendukung: Muncul berurutan setelah video -->
                        <div class="grid grid-cols-2 gap-4">
                            <div class="animate-on-scroll delay-400 h-24 bg-gray-200 hover:bg-gray-300 transition"></div>
                            <div class="animate-on-scroll delay-500 h-24 bg-gray-200 hover:bg-gray-300 transition"></div>
                        </div>
                    </section>
                </div>
            </div>

            <!-- Section: Reader Perspectives & Form -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">

                <!-- List Ulasan (Kiri: scrollable) -->
                <div class="md:col-span-2">
                    <h3 class="animate-on-scroll text-xl font-bold mb-8 text-gray-900">Reader Perspectives</h3>

                    <!-- Container Scroll -->
                    <div
                        class="animate-on-scroll delay-100 overflow-y-auto h-[500px] pr-4 scrollbar-thin scrollbar-thumb-gray-200 scrollbar-track-transparent">

                        <!-- Loop Data Review Anda -->
                        @for($i = 0; $i < 6; $i++)
                            <div
                                class="bg-white p-6 border border-gray-100 mb-6 shadow-sm hover:shadow-md transition-all duration-500 rounded-lg">
                                <div class="text-[#B6171E] mb-2">★★★★★</div>
                                <p class="italic mb-4 text-gray-700 leading-relaxed">"Penerbit yang sangat inspiratif,
                                    buku-bukunya membuka wawasan saya."</p>
                                <p class="font-bold text-sm">— Budi Santoso, <span
                                        class="text-gray-500 font-normal">Akademisi</span></p>
                            </div>
                        @endfor

                    </div>
                </div>

                <!-- Form Ulasan (Kanan) -->
                <aside
                    class="animate-on-scroll delay-200 bg-white p-8 border border-gray-100 shadow-sm self-start rounded-lg">
                    <h3 class="font-bold mb-6 text-gray-900">Share Your Experience</h3>

                    <form action="#" method="POST" class="space-y-4">
                        @csrf
                        <input type="text" placeholder="Full Name"
                            class="w-full p-3 border border-gray-300 focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E] outline-none transition-all">
                        <input type="text" placeholder="Pekerjaan"
                            class="w-full p-3 border border-gray-300 focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E] outline-none transition-all">

                        <select
                            class="w-full p-3 border border-gray-300 focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E] outline-none transition-all">
                            <option>Rating (1-5)</option>
                            <option>5 Bintang</option>
                        </select>

                        <textarea placeholder="Your Message"
                            class="w-full p-3 border border-gray-300 focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E] outline-none transition-all"></textarea>

                        <button type="submit"
                            class="w-full bg-[#B6171E] text-white px-8 py-3 font-semibold hover:bg-red-800 transition-all duration-300">
                            SUBMIT REVIEW
                        </button>
                </aside>
            </div>

        </div>
    </div>

@endsection