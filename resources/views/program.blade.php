@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-6 py-16 md:py-20">

        <!-- Judul Header -->
        <div class="text-center mb-12 md:mb-14 animate-on-scroll">
            <h1 class="text-4xl sm:text-5xl font-bold font-serif text-stone-900 mb-4 tracking-tight">{{ $setting->program_title ?? 'Program Kerja Kami' }}</h1>
            <p class="text-stone-600 text-base max-w-lg mx-auto leading-relaxed">
                {{ $setting->program_subtitle ?? 'Dedikasi kami untuk menyediakan ekosistem yang menyeluruh bagi para akademisi, penulis, dan pembaca.' }}
            </p>
        </div>

        <!-- Cek apakah data program kosong atau ada -->
        @if(isset($programs) && $programs->count() > 0)
            <!-- Wrapper List Program dari Database (Tanpa Card) -->
            <div class="max-w-3xl mx-auto space-y-10 md:space-y-12">
                @foreach($programs as $index => $program)
                    <div id="{{ $program->slug }}"
                        class="scroll-mt-28 flex flex-col sm:flex-row items-start gap-6 sm:gap-8 pb-10 border-b border-stone-200/60 last:border-b-0 last:pb-0">

                        <!-- Container Ikon / Gambar Sederhana -->
                        <div class="w-20 h-20 sm:w-24 sm:h-24 shrink-0 flex items-center justify-center p-3 bg-red-50/50 rounded-2xl border border-red-100/80 shadow-2xs">
                            @if($program->icon)
                                <img src="{{ asset('storage/' . $program->icon) }}" alt="{{ $program->title }}"
                                    class="w-full h-full object-contain block">
                            @else
                                <img src="{{ asset('images/default.png') }}" alt="{{ $program->title }}"
                                    class="w-full h-full object-contain block">
                            @endif
                        </div>

                        <!-- Teks Judul & Deskripsi -->
                        <div class="flex-1 min-w-0 pt-1">
                            <h2 class="text-2xl sm:text-3xl font-bold font-serif text-[#EB3E35] mb-2 leading-snug">
                                {{ $program->title }}
                            </h2>
                            <div class="text-stone-600 text-sm sm:text-base leading-relaxed">
                                {!! nl2br(e($program->content)) !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Pesan jika data belum diinput dari admin -->
            <div class="text-center py-16 bg-white rounded-2xl border border-stone-200">
                <p class="text-stone-400 italic">Belum ada program yang ditambahkan oleh admin.</p>
            </div>
        @endif

    </div>
@endsection