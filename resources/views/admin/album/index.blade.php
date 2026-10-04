@extends('admin.layouts.admin')

@section('title', 'Galeri Foto & Album')

@section('content')
<div class="p-8 max-w-7xl mx-auto space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Galeri Foto & Album Kegiatan</h1>
            <p class="text-slate-500 text-sm mt-1">Kelola album dokumentasi, foto seminar, bedah buku, dan kegiatan literasi Penerbit Yaguwipa.</p>
        </div>
        <div>
            <a href="{{ route('admin.album.create') }}"
                class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white font-medium px-4 py-2 rounded-lg text-sm transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Album Baru
            </a>
        </div>
    </div>

    <!-- Alert Sukses -->
    @if(session('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl flex items-center gap-3 shadow-2xs">
            <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span class="text-sm font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Data Table Card -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-slate-600 text-xs uppercase font-semibold">
                        <th class="p-4 w-16 text-center">No</th>
                        <th class="p-4 text-center w-24">Cover Foto</th>
                        <th class="p-4">Nama Album</th>
                        <th class="p-4 text-center w-24">Dilihat (Hits)</th>
                        <th class="p-4 text-center w-28">Status</th>
                        <th class="p-4 text-center w-36">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                    @forelse($albums as $index => $item)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="p-4 text-center font-medium text-slate-400">{{ $index + 1 }}</td>
                            <td class="p-4 text-center">
                                @php
                                    $cover = $item->img ?: ($item->fotos->first()?->img ?? null);
                                @endphp
                                @if($cover)
                                    <img src="{{ asset('storage/' . $cover) }}" alt="{{ $item->title }}"
                                        class="w-16 h-12 object-cover rounded-lg border border-slate-200 shadow-2xs mx-auto">
                                @else
                                    <div class="w-16 h-12 rounded-lg bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-400 text-xs mx-auto">
                                        No Image
                                    </div>
                                @endif
                            </td>
                            <td class="p-4 font-semibold text-slate-800">
                                {{ $item->title }}
                                <span class="text-xs text-slate-400 block font-normal mt-0.5">
                                    {{ $item->fotos->count() }} Foto dalam album
                                </span>
                            </td>
                            <td class="p-4 text-center font-mono text-xs text-slate-500">
                                {{ $item->hit ?? 0 }}
                            </td>
                            <td class="p-4 text-center whitespace-nowrap">
                                @if($item->status == 'Show')
                                    <span class="text-xs font-semibold text-emerald-600">
                                        Show
                                    </span>
                                @else
                                    <span class="text-xs font-semibold text-slate-500">
                                        Hide
                                    </span>
                                @endif
                            </td>
                            <td class="p-4 text-center whitespace-nowrap space-x-2">
                                <a href="{{ route('admin.album.edit', $item->id) }}"
                                    class="inline-flex items-center px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-xs font-medium transition">
                                    Edit
                                </a>
                                <form action="{{ route('admin.album.destroy', $item->id) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Yakin ingin menghapus album {{ $item->title }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-600 rounded-lg text-xs font-medium transition">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-slate-400 text-sm">
                                Belum ada data album kegiatan yang ditambahkan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection