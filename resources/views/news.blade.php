@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-16">
        <!-- Header News & Events -->
        <div class="text-center mb-12 animate-on-scroll">
            <h1 class="text-4xl font-bold text-gray-900 mb-6 tracking-tight">@lang('news.page_title')</h1>

            <p class="text-gray-600 text-lg max-w-2xl mx-auto leading-relaxed">
                @lang('news.page_subtitle')
            </p>
        </div>

        <!-- Filter Kategori & Tags -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-12 gap-4 border-b border-gray-200 pb-6">
            <!-- Filter Kategori -->
            <div class="flex flex-wrap gap-2 items-center">
                <span class="text-sm font-semibold text-gray-700 mr-2">@lang('news.category_label')</span>
                <a href="{{ route('news.index') }}"
                    class="px-3 py-1.5 text-xs font-medium rounded-full transition-all duration-300 {{ !request('category') ? 'bg-red-800 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    @lang('common.all')
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('news.index', array_merge(request()->all(), ['category' => $cat->id])) }}"
                        class="px-3 py-1.5 text-xs font-medium rounded-full transition-all duration-300 {{ request('category') == $cat->id ? 'bg-red-800 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                        {{ $cat->title }}
                    </a>
                @endforeach
            </div>

            <!-- Filter Tags (Dropdown 2 Kolom per Baris) -->
            <div class="relative inline-block text-left" x-data="{ open: false }">
                <div>
                    <button @click="open = !open" type="button"
                        class="inline-flex justify-center items-center gap-x-1.5 px-3 py-1.5 text-xs font-medium rounded border border-gray-200 bg-white text-gray-700 hover:bg-gray-50 transition-all">
                        <span>{{ request('tag') ? __('news.tag_prefix') . request('tag') : __('news.select_tags') }}</span>
                        <svg class="-mr-1 h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                <!-- Panel Dropdown dengan Grid 2 Kolom -->
                <div x-show="open" @click.away="open = false"
                    class="absolute right-0 z-10 mt-2 w-72 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none p-3"
                    style="display: none;">
                    <div class="mb-2 pb-2 border-b border-gray-100 flex justify-between items-center">
                        <span class="text-xs font-bold text-gray-500">@lang('news.filter_by_tag')</span>
                        @if(request('tag'))
                            <a href="{{ route('news.index', array_merge(request()->except('tag'), ['page' => 1])) }}"
                                class="text-[10px] text-red-800 hover:underline">@lang('news.reset_tag')</a>
                        @endif
                    </div>

                    <!-- Grid 2 Kolom -->
                    <div class="grid grid-cols-2 gap-1.5 max-h-48 overflow-y-auto pr-1">
                        @foreach($tagsList as $tag)
                            <a href="{{ route('news.index', array_merge(request()->all(), ['tag' => $tag->title, 'page' => 1])) }}"
                                class="text-[11px] px-2 py-1.5 rounded truncate transition-colors text-center border {{ request('tag') == $tag->title ? 'bg-red-800 text-white border-red-800 font-semibold' : 'bg-gray-50 text-gray-600 border-gray-200 hover:border-red-800 hover:text-red-800' }}"
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
                class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16 border border-gray-200 p-6 overflow-hidden bg-gray-50/50">
                <!-- Foto: Muncul dari KIRI -->
                <div class="animate-left aspect-video bg-gray-300 w-full h-full overflow-hidden">
                    @if($trending->img)
                        <img src="{{ asset('storage/' . $trending->img) }}" alt="{{ $trending->title }}"
                            class="w-full h-full object-cover">
                    @endif
                </div>

                <!-- Content: Muncul dari KANAN -->
                <div class="animate-right flex flex-col justify-center">
                    <div class="flex items-center gap-3 mb-4">
                        <span
                            class="bg-[#B6171E] text-white text-[10px] px-2 py-1 tracking-widest uppercase font-bold">@lang('news.trending')</span>
                        <span
                            class="text-xs text-gray-500 font-medium">{{ \Carbon\Carbon::parse($trending->date)->format('d M Y') }}</span>
                        @if($trending->kategori)
                            <span class="text-xs text-red-800 font-semibold">• {{ $trending->kategori->title }}</span>
                        @endif
                    </div>

                    <h2 class="text-2xl font-bold mb-4 text-gray-900 leading-tight">
                        {{ $trending->title }}
                    </h2>

                    <p class="text-gray-600 mb-6 leading-relaxed line-clamp-3">
                        {{ Str::limit(strip_tags($trending->content), 150) }}
                    </p>

                    <a href="{{ route('news.show', $trending->slug) }}"
                        class="group inline-flex items-center text-white bg-gray-900 px-4 py-1.5 rounded-full hover:bg-[#B6171E] transition-all duration-300 w-fit">
                        <span class="text-xs font-semibold">@lang('news.read_more')</span>
                        <span
                            class="ml-1.5 transform group-hover:translate-x-1 transition-transform duration-300 ease-out">→</span>
                    </a>
                </div>
            </section>
        @endif

        <!-- News Grid & Events Section -->
        <section class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            @forelse($blogs as $index => $blog)
                <div class="animate-card border border-gray-200 p-4 flex flex-col transition-all duration-500 hover:border-gray-400 hover:shadow-lg bg-white"
                    style="animation-delay: {{ $index * 0.1 }}s;">

                    <!-- Image Placeholder / Database Image -->
                    <div class="aspect-video bg-gray-200 mb-4 overflow-hidden">
                        @if($blog->img)
                            <img src="{{ asset('storage/' . $blog->img) }}" alt="{{ $blog->title }}"
                                class="w-full h-full object-cover transform transition-transform duration-700 hover:scale-105">
                        @else
                            <div class="w-full h-full bg-gray-300 transform transition-transform duration-700 hover:scale-105">
                            </div>
                        @endif
                    </div>

                    <!-- Metadata -->
                    <div class="flex justify-between items-center text-xs text-gray-500 mb-2">
                        <span>{{ \Carbon\Carbon::parse($blog->date)->format('d M Y') }}</span>
                        @if($blog->kategori)
                            <span class="text-red-800 font-medium">{{ $blog->kategori->title }}</span>
                        @endif
                    </div>

                    <!-- Title -->
                    <h3 class="font-bold text-lg mb-2 leading-snug line-clamp-2">
                        {{ $blog->title }}
                    </h3>

                    <!-- Description -->
                    <p class="text-sm text-gray-600 mb-4 leading-relaxed line-clamp-3">
                        {{ Str::limit(strip_tags($blog->content), 90) }}
                    </p>

                    <!-- Link -->
                    <a href="{{ route('news.show', $blog->slug) }}"
                        class="group inline-flex items-center text-red-800 font-semibold text-sm transition-all duration-300 mt-auto w-fit">
                        <span class="transition-transform duration-300 group-hover:translate-x-1">
                            @lang('news.read_full')
                        </span>
                        <span class="ml-1 transition-transform duration-300 group-hover:translate-x-1 inline-block">→</span>
                    </a>
                </div>
            @empty
                <div class="col-span-full text-center py-16 text-gray-400">
                    <p class="text-lg">@lang('news.no_news')</p>
                </div>
            @endforelse
        </section>

        <!-- Pagination -->
        <div class="flex justify-center mt-8 animate-pagination">
            {{ $blogs->links() }}
        </div>
    </div>
@endsection