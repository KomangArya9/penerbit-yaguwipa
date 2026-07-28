@extends('admin.layouts.admin')

@section('content')
    <div class="p-6 max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Struktur Menu Website</h2>
            <a href="{{ route('admin.menu.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                &larr; Kembali ke Menu Manager
            </a>
        </div>

        <div class="space-y-2">
            @forelse($menus as $menu)
                <!-- Menu Utama (Parent) -->
                <div class="bg-white border border-gray-300 rounded shadow-sm p-3 flex justify-between items-center">
                    <span class="font-medium text-gray-800">{{ $menu->title }}</span>
                    <span class="text-xs text-gray-500 font-mono">#</span>
                </div>

                <!-- Sub Menu (Children) jika ada -->
                @if($menu->children->count() > 0)
                    <div class="pl-8 space-y-2">
                        @foreach($menu->children as $child)
                            <div class="bg-white border border-gray-300 rounded shadow-sm p-3 flex justify-between items-center">
                                <span class="text-sm font-medium text-gray-700">{{ $child->title }}</span>
                                <span class="text-xs text-gray-500 font-mono">#</span>
                            </div>
                        @endforeach
                    </div>
                @endif
            @empty
                <div class="bg-white p-6 rounded text-center text-gray-400 border">
                    Belum ada data struktur menu.
                </div>
            @endforelse
        </div>
    </div>
@endsection