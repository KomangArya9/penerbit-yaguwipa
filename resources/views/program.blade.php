@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto px-4 py-16">

        <!-- Judul Header -->
        <div class="text-center mb-16 animate-on-scroll delay-100">
            <h2 class="text-3xl font-bold text-gray-900 mb-3">@lang('program.page_title')</h2>
            <p class="text-gray-600 text-sm max-w-lg mx-auto">
                @lang('program.page_subtitle')
            </p>
        </div>

        <!-- Cek apakah data program kosong atau ada -->
        @if(isset($programs) && $programs->count() > 0)
            <!-- Wrapper List Program dari Database -->
            <div class="space-y-24">
                @foreach($programs as $index => $program)
                    <div id="{{ $program->slug }}"
                        class="{{ $index % 2 == 0 ? 'animate-fade-left' : 'animate-fade-right' }} flex flex-col md:flex-row gap-12 items-center {{ $index % 2 != 0 ? 'md:flex-row-reverse' : '' }}">

                        <!-- Container Ikon / Gambar -->
                        <div class="flex items-center justify-center p-4 bg-gray-50 rounded-xl">
                            @if($program->icon)
                                <img src="{{ asset('storage/' . $program->icon) }}" alt="{{ $program->title }}"
                                    class="w-24 h-24 object-contain block filter-red">
                            @else
                                <img src="{{ asset('images/default.png') }}" alt="{{ $program->title }}"
                                    class="w-24 h-24 object-contain block filter-red">
                            @endif
                        </div>

                        <!-- Teks -->
                        <div class="w-full md:w-1/2">
                            <h3 class="text-2xl font-bold mb-4 text-gray-900">{{ $program->title }}</h3>
                            <div class="text-gray-600 text-sm leading-relaxed">
                                {!! nl2br(e($program->content)) !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Pesan jika data belum diinput dari admin -->
            <div class="text-center py-12">
                <p class="text-gray-500 italic">@lang('program.no_programs')</p>
            </div>
        @endif

    </div>
@endsection