@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-16">
        <!-- Header News & Events -->
        <div class="text-center mb-16 animate-on-scroll">
            <h1 class="text-4xl sm:text-5xl font-bold font-serif text-stone-900 mb-4 tracking-tight">{{ $setting->news_title ?? 'News & Events' }}</h1>

            <p class="text-stone-600 text-base md:text-lg max-w-2xl mx-auto leading-relaxed">
                {{ $setting->news_subtitle ?? 'Ikuti perkembangan terbaru, berita industri, dan jadwal acara literasi dari Penerbit Yaguwipa.' }}
            </p>
        </div>

        <!-- Filter Kategori & Tags -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-12 gap-4 border-b border-stone-200 pb-6">
            <!-- Filter Kategori -->
            <div class="flex flex-wrap gap-2 items-center">
                <span class="text-xs font-semibold uppercase tracking-wider text-stone-500 mr-1">Kategori:</span>
                <a href="{{ route('news.index') }}"
                    class="px-3.5 py-1.5 text-xs font-medium rounded-full transition-all duration-200 {{ !request('category') ? 'bg-[#B6171E] text-white shadow-2xs' : 'bg-white text-stone-700 hover:bg-stone-100 border border-stone-200' }}">
                    Semua
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('news.index', array_merge(request()->all(), ['category' => $cat->id])) }}"
                        class="px-3.5 py-1.5 text-xs font-medium rounded-full transition-all duration-200 {{ request('category') == $cat->id ? 'bg-[#B6171E] text-white shadow-2xs' : 'bg-white text-stone-700 hover:bg-stone-100 border border-stone-200' }}">
                        {{ $cat->title }}
                    </a>
                @endforeach
            </div>

            <!-- Filter Tags (Dropdown 2 Kolom per Baris) -->
            <div class="relative inline-block text-left" x-data="{ open: false }">
                <div>
                    <button @click="open = !open" type="button"
                        class="inline-flex justify-center items-center gap-x-2 px-3.5 py-1.5 text-xs font-medium rounded-xl border border-stone-200 bg-white text-stone-700 hover:border-stone-300 shadow-2xs transition-all cursor-pointer">
                        <span>{{ request('tag') ? 'Tag: #' . request('tag') : 'Pilih Tags' }}</span>
                        <svg class="-mr-1 h-4 w-4 text-stone-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                <!-- Panel Dropdown dengan Grid 2 Kolom -->
                <div x-show="open" @click.away="open = false"
                    class="absolute right-0 z-20 mt-2 w-72 origin-top-right rounded-2xl bg-white shadow-xl ring-1 ring-black/5 focus:outline-none p-4 border border-stone-200"
                    style="display: none;">
                    <div class="mb-2 pb-2 border-b border-stone-100 flex justify-between items-center">
                        <span class="text-xs font-bold text-stone-700">Filter Berdasarkan Tag</span>
                        @if(request('tag'))
                            <a href="{{ route('news.index', array_merge(request()->except('tag'), ['page' => 1])) }}"
                                class="text-[10px] text-[#B6171E] font-medium hover:underline">Reset Tag</a>
                        @endif
                    </div>

                    <!-- Grid 2 Kolom -->
                    <div class="grid grid-cols-2 gap-1.5 max-h-48 overflow-y-auto pr-1">
                        @foreach($tagsList as $tag)
                            <a href="{{ route('news.index', array_merge(request()->all(), ['tag' => $tag->title, 'page' => 1])) }}"
                                class="text-[11px] px-2.5 py-1.5 rounded-lg truncate transition-colors text-center border {{ request('tag') == $tag->title ? 'bg-[#B6171E] text-white border-[#B6171E] font-medium' : 'bg-stone-50 text-stone-600 border-stone-200 hover:border-[#B6171E] hover:text-[#B6171E]' }}"
                                title="{{ $tag->title }}">
                                #{{ $tag->title }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Feature Section (Trending Otomatis Berdasarkan Hit Tertinggi) -->
        @if($trending && !request('category') && !request('tag'))
            <section
                class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16 border border-stone-200/80 rounded-2xl p-6 md:p-8 overflow-hidden bg-white shadow-[0_2px_8px_rgba(0,0,0,0.03)]">
                <!-- Foto: Muncul dari KIRI -->
                <div class="animate-left aspect-video bg-stone-100 w-full h-full overflow-hidden rounded-xl border border-stone-100">
                    @if($trending->img)
                        <img src="{{ asset('storage/' . $trending->img) }}" alt="{{ $trending->title }}"
                            class="w-full h-full object-cover">
                    @endif
                </div>

                <!-- Content: Muncul dari KANAN -->
                <div class="animate-right flex flex-col justify-center">
                    <div class="flex items-center gap-3 mb-4">
                        <span
                            class="bg-[#B6171E] text-white text-[10px] px-2.5 py-1 rounded-full tracking-wider uppercase font-semibold">Trending</span>
                        <span
                            class="text-xs text-stone-500 font-medium">{{ \Carbon\Carbon::parse($trending->date)->format('d M Y') }}</span>
                        @if($trending->kategori)
                            <span class="text-xs text-[#B6171E] font-medium">• {{ $trending->kategori->title }}</span>
                        @endif
                    </div>

                    <h2 class="text-2xl sm:text-3xl font-bold font-serif mb-4 text-stone-900 leading-snug">
                        {{ $trending->title }}
                    </h2>

                    <p class="text-stone-600 mb-6 leading-relaxed line-clamp-3 text-base">
                        {{ Str::limit(strip_tags($trending->content), 150) }}
                    </p>

                    <a href="{{ route('news.show', $trending->slug) }}"
                        class="group inline-flex items-center text-white bg-stone-900 px-5 py-2.5 rounded-full hover:bg-[#B6171E] transition-all duration-200 shadow-sm active:scale-95 w-fit">
                        <span class="text-xs font-medium">Selengkapnya</span>
                        <span
                            class="ml-2 transform group-hover:translate-x-1 transition-transform duration-200 ease-out">→</span>
                    </a>
                </div>
            </section>
        @endif

        <!-- News Grid & Events Section -->
        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-7 mb-16">
            @forelse($blogs as $index => $blog)
                <div class="animate-card border border-stone-200/80 rounded-2xl p-5 flex flex-col transition-all duration-300 hover:border-stone-300 hover:shadow-xl hover:-translate-y-1 bg-white shadow-2xs group"
                    style="animation-delay: {{ $index * 0.1 }}s;">

                    <!-- Image Placeholder / Database Image -->
                    <div class="aspect-video bg-stone-100 mb-4 overflow-hidden rounded-xl border border-stone-100">
                        @if($blog->img)
                            <img src="{{ asset('storage/' . $blog->img) }}" alt="{{ $blog->title }}"
                                class="w-full h-full object-cover transform transition-transform duration-500 ease-out group-hover:scale-105">
                        @else
                            <div class="w-full h-full bg-stone-200 flex items-center justify-center text-stone-400 text-xs italic">
                                No Image
                            </div>
                        @endif
                    </div>

                    <!-- Metadata -->
                    <div class="flex justify-between items-center text-xs text-stone-400 mb-2">
                        <span>{{ \Carbon\Carbon::parse($blog->date)->format('d M Y') }}</span>
                        @if($blog->kategori)
                            <span class="text-[#B6171E] font-medium">{{ $blog->kategori->title }}</span>
                        @endif
                    </div>

                    <!-- Title -->
                    <h3 class="font-serif font-bold text-lg mb-2 leading-snug line-clamp-2 text-stone-900 group-hover:text-[#B6171E] transition-colors">
                        {{ $blog->title }}
                    </h3>

                    <!-- Description -->
                    <p class="text-sm text-stone-600 mb-5 leading-relaxed line-clamp-3">
                        {{ Str::limit(strip_tags($blog->content), 90) }}
                    </p>

                    <!-- Link -->
                    <a href="{{ route('news.show', $blog->slug) }}"
                        class="group/btn inline-flex items-center text-[#B6171E] font-medium text-sm transition-colors mt-auto w-fit">
                        <span>
                            Baca Selengkapnya
                        </span>
                        <span class="ml-1.5 transition-transform duration-200 group-hover/btn:translate-x-1 inline-block">→</span>
                    </a>
                </div>
            @empty
                <div class="col-span-full text-center py-16 text-stone-400 italic">
                    <p class="text-base">Belum ada berita atau acara yang tersedia untuk kategori atau tag ini.</p>
                </div>
            @endforelse
        </section>

        <!-- Pagination -->
        <div class="flex justify-center mt-8 animate-pagination">
            {{ $blogs->links() }}
        </div>
    </div>
@endsection