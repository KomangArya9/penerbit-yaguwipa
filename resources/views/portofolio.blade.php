@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-6 py-20">

        <!-- 1. Header -->
        <div class="mb-12 animate-on-scroll delay-100">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Portofolio</h1>
            <p class="text-gray-600">Rekam jejak karya dan proyek yang telah diselesaikan.</p>
        </div>

        <!-- 2. Filter Tab Dinamis dari Database -->
        <div class="flex gap-8 mb-12 flex-wrap">
            <!-- Tombol 'Semua' (Default) -->
            <a href="{{ route('portofolio') }}"
                class="animate-on-scroll opacity-0 translate-y-8 pb-3 border-b-2 {{ !request('category') ? 'border-[#B6171E] text-[#B6171E]' : 'border-transparent text-gray-500 hover:text-gray-900' }} font-semibold transition-colors duration-300 whitespace-nowrap"
                style="transition-delay: 100ms;">
                Semua
            </a>

            <!-- Perulangan Kategori dari Database Admin -->
            @foreach($categories as $index => $category)
                <a href="{{ route('portofolio', ['category' => $category->slug]) }}"
                    class="animate-on-scroll opacity-0 translate-y-8 pb-3 border-b-2 {{ request('category') == $category->slug ? 'border-[#B6171E] text-[#B6171E]' : 'border-transparent text-gray-500 hover:text-gray-900' }} font-semibold transition-colors duration-300 whitespace-nowrap"
                    style="transition-delay: {{ ($index + 2) * 100 }}ms;">
                    {{ $category->title }}
                </a>
            @endforeach
        </div>

        <!-- 3. Grid Container (Dinamis dari Database) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($projects as $index => $project)
                <!-- BUNGKUS DENGAN TAG <a> DI SINI -->
                <a href="{{ route('portofolio.show', $project->slug) }}" class="portfolio-entry group cursor-pointer block"
                    style="transition-delay: {{ $index * 100 }}ms;">
                    <div class="aspect-[3/4] bg-gray-200 rounded-sm mb-4 overflow-hidden">
                        @php
                            $primaryPhoto = $project->fotos->first();
                        @endphp

                        @if($primaryPhoto && $primaryPhoto->img)
                            <img src="{{ asset('storage/' . $primaryPhoto->img) }}" alt="{{ $project->title }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400 text-xs">No Image</div>
                        @endif
                    </div>

                    <!-- Content -->
                    <p class="text-xs font-bold text-[#B6171E] mb-1 tracking-wider">
                        {{ $project->kategoriProject ? strtoupper($project->kategoriProject->title) : '-' }}
                    </p>
                    <h3 class="text-lg font-bold text-gray-900 mb-1 leading-tight group-hover:text-[#B6171E] transition-colors">
                        {{ $project->title }}</h3>
                    <p class="text-sm text-gray-500 line-clamp-2">{{ $project->lokasi }}</p>
                </a>
            @empty
                <div class="col-span-full text-center py-12 text-gray-400">
                    Belum ada portofolio yang tersedia untuk kategori ini.
                </div>
            @endforelse
        </div>

        <!-- 4. Pagination Bawaan Laravel -->
        @if($projects->hasPages())
            <div class="portfolio-entry mt-12 flex gap-1 opacity-0 translate-y-8" style="transition-delay: 250ms;">
                {{ $projects->links() }}
            </div>
        @endif
    </div>
@endsection