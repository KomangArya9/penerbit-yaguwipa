@extends('admin.layouts.admin')

@section('title', 'Katalog Buku')

@section('content')
<div class="p-8 max-w-7xl mx-auto space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Katalog Buku</h1>
            <p class="text-slate-500 text-sm mt-1">Kelola data buku yang terbit, persetujuan self-publishing, dan etalase karya.</p>
        </div>
        <div>
            <a href="{{ route('admin.catalog.create') }}"
                class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white font-medium px-4 py-2 rounded-lg text-sm transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Buku
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
                        <th class="p-4 w-14 text-center">No</th>
                        <th class="p-4 w-16 text-center">Cover</th>
                        <th class="p-4">Judul & Kategori</th>
                        <th class="p-4">Penulis & Editor</th>
                        <th class="p-4">Penerbit</th>
                        <th class="p-4 text-right">Harga</th>
                        <th class="p-4 text-center">Hit</th>
                        <th class="p-4 text-center">Status</th>
                        <th class="p-4 text-center w-48">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                    @forelse($catalogs as $index => $item)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="p-4 text-center font-medium text-slate-400">{{ $index + 1 }}</td>
                            <td class="p-4 text-center">
                                @if($item->cover)
                                    <img src="{{ asset('storage/' . $item->cover) }}" alt="Cover"
                                        class="w-10 h-14 object-cover rounded shadow-2xs border border-slate-200 mx-auto">
                                @else
                                    <div class="w-10 h-14 bg-slate-100 rounded border border-slate-200 flex items-center justify-center text-slate-400 mx-auto text-[10px] italic">
                                        No Cover
                                    </div>
                                @endif
                            </td>
                            <td class="p-4">
                                <div class="font-semibold text-slate-800 line-clamp-1" title="{{ $item->judul }}">{{ $item->judul }}</div>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="inline-block px-2 py-0.5 bg-slate-100 text-slate-600 rounded text-[11px] font-medium">
                                        {{ $item->jenis ?? 'Buku' }}
                                    </span>
                                    @if($item->kategori)
                                        <span class="inline-block px-2 py-0.5 bg-red-50 text-red-700 rounded text-[11px] font-medium">
                                            {{ $item->kategori }}
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="p-4">
                                <div class="text-slate-800 font-medium">{{ $item->penulis ?? '-' }}</div>
                                @if($item->editor)
                                    <div class="text-xs text-slate-400">Ed: {{ $item->editor }}</div>
                                @endif
                            </td>
                            <td class="p-4 text-slate-600 text-xs">
                                {{ $item->penerbit ?? 'Yaguwipa' }}
                            </td>
                            <td class="p-4 text-right font-medium text-slate-800 whitespace-nowrap">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </td>
                            <td class="p-4 text-center text-xs font-semibold text-slate-600 whitespace-nowrap">
                                {{ number_format($item->hite ?? 0) }}
                            </td>
                            <td class="p-4 text-center whitespace-nowrap">
                                @if($item->status == 'Show')
                                    <span class="text-xs font-semibold text-emerald-600">
                                        Show
                                    </span>
                                @elseif($item->status == 'Pending')
                                    <span class="text-xs font-semibold text-amber-600">
                                        Pending
                                    </span>
                                @else
                                    <span class="text-xs font-semibold text-slate-500">
                                        Hide
                                    </span>
                                @endif
                            </td>
                            <td class="p-4 text-center whitespace-nowrap space-x-1.5">
                                <!-- Tombol Setujui / Sembunyikan -->
                                <form action="{{ route('admin.catalog.approve', $item->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    @if($item->status == 'Pending')
                                        <input type="hidden" name="status" value="Show">
                                        <button type="submit" class="inline-flex items-center px-2.5 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs rounded-lg font-medium transition shadow-2xs" title="Setujui agar tampil di website">
                                            ✓ Setujui
                                        </button>
                                    @elseif($item->status == 'Show')
                                        <input type="hidden" name="status" value="Hide">
                                        <button type="submit" class="inline-flex items-center px-2.5 py-1.5 bg-amber-50 hover:bg-amber-100 text-amber-700 text-xs rounded-lg font-medium transition" title="Sembunyikan dari website">
                                            Sembunyikan
                                        </button>
                                    @else
                                        <input type="hidden" name="status" value="Show">
                                        <button type="submit" class="inline-flex items-center px-2.5 py-1.5 bg-red-50 hover:bg-red-100 text-red-700 text-xs rounded-lg font-medium transition" title="Tampilkan kembali di website">
                                            Tampilkan
                                        </button>
                                    @endif
                                </form>

                                <a href="{{ route('admin.catalog.edit', $item->id) }}"
                                    class="inline-flex items-center px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-xs font-medium transition">
                                    Edit
                                </a>
                                <form action="{{ route('admin.catalog.destroy', $item->id) }}" method="POST"
                                    class="inline-block" onsubmit="return confirm('Yakin ingin menghapus buku {{ $item->judul }}?')">
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
                            <td colspan="9" class="p-8 text-center text-slate-400">
                                <div class="flex flex-col items-center justify-center space-y-2">
                                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    <span>Belum ada data katalog buku.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection