@extends('admin.layouts.admin')

@section('title', 'Menu Manager')

@section('content')
<div class="p-8 max-w-7xl mx-auto">
    <!-- Header Page -->
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Manajemen Menu Navigasi</h1>
            <p class="text-slate-500 text-sm mt-1">Atur tautan, urutan, dan struktur menu yang tampil di bilah navigasi utama website publik.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.menu.sorting') }}"
                class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white font-medium px-4 py-2 rounded-lg text-sm transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                </svg>
                Atur Urutan (Sorting)
            </a>
            <a href="{{ route('admin.menu.create') }}"
                class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white font-medium px-4 py-2 rounded-lg text-sm transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Menu
            </a>
        </div>
    </div>

    <!-- Alert Sukses -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <!-- Kartu Statistik Singkat -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-8">
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Menu</p>
                <p class="text-2xl font-bold text-slate-800 mt-1">{{ $totalMenu ?? count($data_menu) }}</p>
            </div>
            <div class="w-10 h-10 rounded-lg bg-red-50 text-red-600 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                </svg>
            </div>
        </div>
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Menu Aktif (Show)</p>
                <p class="text-2xl font-bold text-emerald-600 mt-1">{{ $totalShow ?? $data_menu->where('status', 'Show')->count() }}</p>
            </div>
            <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
        </div>
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Tersembunyi (Hide)</p>
                <p class="text-2xl font-bold text-slate-500 mt-1">{{ $totalHide ?? $data_menu->where('status', 'Hide')->count() }}</p>
            </div>
            <div class="w-10 h-10 rounded-lg bg-slate-100 text-slate-500 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Tabel Data Menu -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-slate-600 text-xs uppercase font-semibold">
                        <th class="p-4 w-20 text-center">Urutan</th>
                        <th class="p-4">Nama Menu</th>
                        <th class="p-4">URL / Link Target</th>
                        <th class="p-4">Tipe Menu</th>
                        <th class="p-4 text-center">Status</th>
                        <th class="p-4 text-center whitespace-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 text-sm">
                    @forelse($data_menu as $menu)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="p-4 text-center">
                                <span class="inline-flex items-center justify-center w-7 h-7 rounded-md bg-slate-100 text-slate-700 font-bold text-xs">
                                    {{ $menu->urutan ?? 0 }}
                                </span>
                            </td>
                            <td class="p-4 font-semibold text-slate-800">
                                @if($menu->parent_id)
                                    <span class="text-slate-400 mr-1.5 font-normal">↳</span>
                                @endif
                                {{ $menu->title }}
                            </td>
                            <td class="p-4">
                                <code class="px-2.5 py-1 bg-slate-100 text-slate-700 rounded text-xs font-mono">
                                    {{ $menu->url }}
                                </code>
                            </td>
                            <td class="p-4">
                                @if($menu->parent_id)
                                    <span class="text-xs text-slate-500 bg-slate-100 px-2.5 py-1 rounded">
                                        Sub Menu dari: <strong>{{ $menu->parent->title ?? 'Parent ID ' . $menu->parent_id }}</strong>
                                    </span>
                                @else
                                    <span class="text-xs text-red-700 bg-red-50 px-2.5 py-1 rounded font-medium">
                                        Menu Utama
                                    </span>
                                @endif
                            </td>
                            <td class="p-4 text-center">
                                <form action="{{ route('admin.menu.toggle', $menu->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    @if($menu->status === 'Show')
                                        <button type="submit" title="Klik untuk menyembunyikan menu ini"
                                            class="text-xs font-semibold text-emerald-600 hover:text-emerald-700 transition">
                                            Show (Aktif)
                                        </button>
                                    @else
                                        <button type="submit" title="Klik untuk mengaktifkan menu ini"
                                            class="text-xs font-semibold text-slate-500 hover:text-slate-700 transition">
                                            Hide (Nonaktif)
                                        </button>
                                    @endif
                                </form>
                            </td>
                            <td class="p-4 text-center whitespace-nowrap space-x-2">
                                <a href="{{ route('admin.menu.edit', $menu->id) }}"
                                    class="inline-flex items-center px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-xs font-medium transition">
                                    Edit
                                </a>
                                <form action="{{ route('admin.menu.destroy', $menu->id) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Yakin ingin menghapus menu \'{{ $menu->title }}\'?')">
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
                            <td colspan="6" class="p-8 text-center text-slate-400">
                                Belum ada data menu navigasi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection