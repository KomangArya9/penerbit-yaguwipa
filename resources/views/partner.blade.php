@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-20">

        <!-- 1. Header Section -->
        <div class="text-center mb-16 max-w-3xl mx-auto animate-on-scroll">
            <h1 class="text-4xl font-bold text-gray-900 mb-6 tracking-tight">Partner & Klien</h1>


            <p class="text-gray-600 text-lg leading-relaxed">
                Kami bangga bekerja sama dengan berbagai institusi dan mitra strategis dalam memajukan dunia literasi.
                Kolaborasi ini memperkuat komitmen kami pada penyebaran ilmu pengetahuan.
            </p>
        </div>

        <!-- Grid Logo dengan logika delay per baris yang pasti -->
        <div class="px-4 md:px-12">
            <div class="grid grid-cols-5 md:grid-cols-8 lg:grid-cols-10 gap-6 md:gap-8 items-center justify-items-center">
                @php
                    $logos = range(1, 50); 
                @endphp

                @foreach($logos as $i)
                    @php
                        // Kita bagi 10 untuk menentukan baris, gunakan sisanya untuk posisi kolom
                        // Delay: (posisi_kolom * 60ms) + (nomor_baris * 100ms)
                        $col = ($i - 1) % 10;
                        $row = floor(($i - 1) / 10);
                        $delay = ($col * 60) + ($row * 100);
                    @endphp

                    <div class="animate-on-scroll w-full h-20 flex items-center justify-center p-2 group"
                        style="transition-delay: {{ $delay }}ms;">

                        <img src="https://placehold.co/200x200/ffffff/000000?text=LOGO+{{ $i }}" alt="Partner {{ $i }}"
                            class="max-h-16 max-w-full object-contain opacity-60 group-hover:opacity-100 group-hover:scale-110 grayscale group-hover:grayscale-0 transition-all duration-500 cursor-pointer">
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection