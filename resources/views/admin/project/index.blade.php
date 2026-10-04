@extends('admin.layouts.admin')

@section('title', 'Portofolio & Proyek')

@section('content')
<div class="p-8 max-w-7xl mx-auto space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Portofolio & Proyek</h1>
            <p class="text-slate-500 text-sm mt-1">Kelola portofolio karya penerbitan, buku cetak, kolaborasi institusi, dan proyek perbukuan.</p>
        </div>
        <div>
            <a href="{{ route('admin.project.create') }}"
                class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white font-medium px-4 py-2 rounded-lg text-sm transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Portofolio
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
                        <th class="p-4 text-center w-24">Foto</th>
                        <th class="p-4">Judul Proyek / Buku</th>
                        <th class="p-4">Kategori</th>
                        <th class="p-4">Tanggal</th>
                        <th class="p-4 text-center w-24">Hits</th>
                        <th class="p-4 text-center w-28">Status</th>
                        <th class="p-4 text-center w-36">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                    @forelse($projects as $index => $item)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="p-4 text-center font-medium text-slate-400">{{ $index + 1 }}</td>
                            <td class="p-4 text-center">
                                @php
                                    $primaryPhoto = $item->fotos->first();
                                @endphp
                                @if($primaryPhoto && $primaryPhoto->img)
                                    <img src="{{ asset('storage/' . $primaryPhoto->img) }}" alt="{{ $item->title }}"
                                        class="w-14 h-14 object-cover rounded-lg border border-slate-200 shadow-2xs mx-auto">
                                @else
                                    <div class="w-14 h-14 rounded-lg bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-400 text-xs mx-auto">
                                        No Img
                                    </div>
                                @endif
                            </td>
                            <td class="p-4 font-semibold text-slate-800">
                                {{ $item->title }}
                                @if($item->lokasi)
                                    <span class="text-xs text-slate-400 flex items-center gap-1 font-normal mt-0.5">
                                        <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        {{ $item->lokasi }}
                                    </span>
                                @endif
                            </td>
                            <td class="p-4 text-slate-600">
                                <span class="bg-slate-100 px-2.5 py-0.5 rounded text-xs">
                                    {{ $item->kategoriProject ? $item->kategoriProject->title : '-' }}
                                </span>
                            </td>
                            <td class="p-4 text-xs font-mono text-slate-500">
                                {{ $item->date }}
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
                                <a href="{{ route('admin.project.edit', $item->id) }}"
                                    class="inline-flex items-center px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-xs font-medium transition">
                                    Edit
                                </a>
                                <form action="{{ route('admin.project.destroy', $item->id) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Yakin ingin menghapus portofolio {{ $item->title }}?')">
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
                            <td colspan="8" class="p-8 text-center text-slate-400 text-sm">
                                Belum ada data portofolio & proyek yang ditambahkan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection