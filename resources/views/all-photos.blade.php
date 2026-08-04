@extends('layouts.app')

@section('content')
<div class="bg-gray-50 py-16">
    <div class="container mx-auto px-4 md:px-12">
        <div class="mb-8">
            <a href="{{ route('profile') }}" class="text-sm text-[#B6171E] font-semibold hover:underline">← @lang('photos.back_to_profile')</a>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2">@lang('photos.page_title')</h1>
        </div>

        <!-- Grid dengan ukuran portrait vertikal h-64 md:h-72 -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
            @forelse($albums as $album)
                <!-- Kotak album dengan tinggi portrait vertikal dan efek hover gradasi halus -->
                <div class="relative group overflow-hidden rounded shadow h-64 md:h-72">
                    <img src="{{ asset('storage/' . ($album->fotos->first()->img ?? 'default.jpg')) }}" alt="{{ $album->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">

                    <!-- Overlay Gradasi Halus -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-end p-3">
                        <span class="text-white text-xs font-semibold drop-shadow truncate">{{ $album->title }}</span>
                        <span class="text-gray-200 text-[10px] drop-shadow">{{ date('d M Y', strtotime($album->date)) }}</span>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 text-gray-500 bg-white rounded shadow">
                    @lang('photos.no_albums')
                </div>
            @endforelse
        </div>

        <!-- Pagination jika albumnya banyak -->
        <div class="mt-8">
            {{ $albums->links() }}
        </div>
    </div>
</div>
@endsection