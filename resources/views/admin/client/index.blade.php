@extends('admin.layouts.admin')

@section('title', 'Mitra & Klien')

@section('content')
<div class="p-8 max-w-7xl mx-auto space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Mitra & Klien Kerjasama</h1>
            <p class="text-slate-500 text-sm mt-1">Kelola daftar logo institusi, universitas, sekolah, dan perusahaan yang bermitra dengan Penerbit Yaguwipa.</p>
        </div>
        <div>
            <a href="{{ route('client.create') }}"
                class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white font-medium px-4 py-2 rounded-lg text-sm transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Mitra / Klien
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
                        <th class="p-4 text-center w-28">Logo Mitra</th>
                        <th class="p-4">Nama Mitra / Instansi</th>
                        <th class="p-4">Website / Tautan</th>
                        <th class="p-4 text-center w-28">Status</th>
                        <th class="p-4 text-center w-36">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                    @forelse($clients as $index => $item)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="p-4 text-center font-medium text-slate-400">{{ $index + 1 }}</td>
                            <td class="p-4 text-center">
                                <div class="w-20 h-12 bg-white border border-slate-200 rounded-lg flex items-center justify-center p-1.5 shadow-2xs mx-auto">
                                    <img src="{{ asset('storage/' . $item->img) }}" alt="{{ $item->title }}"
                                        class="max-h-full max-w-full object-contain">
                                </div>
                            </td>
                            <td class="p-4 font-semibold text-slate-800">
                                {{ $item->title }}
                            </td>
                            <td class="p-4">
                                @if($item->url)
                                    <a href="{{ $item->url }}" target="_blank"
                                        class="text-red-600 hover:underline inline-flex items-center gap-1 font-mono text-xs">
                                        {{ $item->url }}
                                        <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                    </a>
                                @else
                                    <span class="text-xs text-slate-400">-</span>
                                @endif
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
                                <a href="{{ route('client.edit', $item->title) }}"
                                    class="inline-flex items-center px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-xs font-medium transition">
                                    Edit
                                </a>
                                <form action="{{ route('client.destroy', $item->title) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Yakin ingin menghapus mitra {{ $item->title }}?')">
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
                                Belum ada data mitra & klien yang ditambahkan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection