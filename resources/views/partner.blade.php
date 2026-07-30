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

        <!-- Grid Logo dengan data dari Database -->
        <div class="px-4 md:px-12">
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6 md:gap-8 items-center justify-items-center">
                @forelse($clients as $index => $client)
                    @php
                        // Logika penyesuaian delay per kolom dan baris (asumsi 6 kolom di layar besar)
                        $col = $index % 6;
                        $row = floor($index / 6);
                        $delay = ($col * 60) + ($row * 100);
                    @endphp

                    <div class="animate-on-scroll w-full h-24 flex items-center justify-center p-3 bg-white border border-gray-100 rounded-xl shadow-sm hover:shadow-md group transition-all duration-300"
                        style="transition-delay: {{ $delay }}ms;">

                        <a href="{{ $client->url }}" target="_blank" rel="noopener noreferrer" class="w-full h-full flex items-center justify-center">
                            <img src="{{ asset('storage/' . $client->img) }}" alt="{{ $client->title }}"
                                class="max-h-16 max-w-full object-contain opacity-70 group-hover:opacity-100 group-hover:scale-105 transition-all duration-300 cursor-pointer" title="{{ $client->title }}">
                        </a>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-gray-400">
                        <p>Belum ada partner atau klien yang ditampilkan.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
@endsection