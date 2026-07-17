@extends('layouts.app')

@section('content')
    <!-- Container utama diperbarui menjadi px-6 md:px-24 agar sejajar dengan navbar -->
    <div class="max-w-[1440px] mx-auto px-6 md:px-24 py-16">

        <!-- Header -->
        <div class="mb-12 animate-on-scroll delay-100">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Hubungi Kami</h1>
            <p class="text-gray-600">
                Kami siap membantu kebutuhan penerbitan Anda.
                Jangan ragu untuk menghubungi kami melalui saluran di bawah ini.
            </p>
        </div>

        <!-- Grid Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <!-- Kolom Kiri: Informasi Kontak & Peta (Masuk dari kiri) -->
            <div class="space-y-6 animate-fade-left">
                <!-- Kartu Info Kontak -->
                <div class="border border-gray-200 p-8 bg-white">
                    <h2 class="text-xl font-bold mb-8">Informasi Kontak</h2>

                    <div class="space-y-6">
                        <!-- Alamat -->
                        <div class="flex gap-4">
                            <span class="text-red-800 text-xl">📍</span>
                            <div>
                                <p class="font-bold text-sm">Alamat Kantor</p>
                                <p class="text-gray-600 text-sm">Jl. Penerbitan No. 123, Blok C<br>Kawasan Literasi, Jakarta
                                    Selatan<br>DKI Jakarta, 12345</p>
                            </div>
                        </div>

                        <!-- Telepon -->
                        <div class="flex gap-4">
                            <span class="text-red-800 text-xl">📞</span>
                            <div>
                                <p class="font-bold text-sm">Telepon / WhatsApp</p>
                                <p class="text-gray-600 text-sm">+62 812 3456 7890</p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="flex gap-4">
                            <span class="text-red-800 text-xl">✉️</span>
                            <div>
                                <p class="font-bold text-sm">Email</p>
                                <p class="text-gray-600 text-sm">halo@penerbityaguwipa.com</p>
                            </div>
                        </div>

                        <!-- Jam Operasional -->
                        <div class="flex gap-4">
                            <span class="text-red-800 text-xl">🕒</span>
                            <div>
                                <p class="font-bold text-sm">Jam Operasional</p>
                                <p class="text-gray-600 text-sm">Senin - Jumat: 09.00 - 17.00 WIB<br>Sabtu - Minggu: Tutup
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Peta -->
                <div class="w-full h-64 border border-gray-200 overflow-hidden bg-gray-100">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d106.819565314769!3d-6.224134995494!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e498c4d29f%3A0x673c9f3796d10f44!2sSudirman%20Central%20Business%20District!5e0!3m2!1sid!2sid!4v1650000000000!5m2!1sid!2sid"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>

            <!-- Kolom Kanan: Form Kontak (Masuk dari kanan) -->
            <div class="border border-gray-200 p-8 bg-white h-fit animate-fade-right">
                <h2 class="text-xl font-bold mb-6">Kirim Pesan</h2>
                <form action="#" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-semibold mb-1">Nama Lengkap</label>
                        <input type="text" name="name"
                            class="w-full p-3 border border-gray-300 focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E] outline-none transition-all"
                            placeholder="Masukkan nama lengkap Anda">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1">Email</label>
                        <input type="email" name="email"
                            class="w-full p-3 border border-gray-300 focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E] outline-none transition-all"
                            placeholder="nama@email.com">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1">Subjek Pesan</label>
                        <input type="text" name="subject"
                            class="w-full p-3 border border-gray-300 focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E] outline-none transition-all"
                            placeholder="Tujuan pesan Anda">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1">Pesan</label>
                        <textarea name="message"
                            class="w-full p-3 border border-gray-300 focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E] outline-none transition-all"
                            placeholder="Tuliskan pesan atau pertanyaan Anda di sini..."></textarea>
                    </div>
                    <button type="submit"
                        class="bg-[#B6171E] text-white px-6 py-2 font-semibold text-sm hover:bg-red-900 transition">
                        Kirim Pesan
                    </button>
                </form>
            </div>

        </div>
    </div>
@endsection