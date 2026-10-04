@extends('admin.layouts.admin')

@section('title', 'Manajemen Review')

@section('content')
<div class="p-8">
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Manajemen Review & Testimoni</h1>
            <p class="text-slate-500">Kelola review dan testimoni dari pembaca/pengunjung untuk ditampilkan di halaman utama (Home).</p>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-600 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-slate-500 text-xs uppercase font-semibold">
                        <th class="p-4 w-16">No</th>
                        <th class="p-4">Nama</th>
                        <th class="p-4">Pekerjaan</th>
                        <th class="p-4">Rating</th>
                        <th class="p-4 max-w-xs">Review</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 text-center whitespace-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 text-slate-700 text-sm">
                    @forelse($reviews as $index => $item)
                    <tr class="hover:bg-slate-50/70 transition">
                        <td class="p-4">{{ $index + 1 }}</td>
                        <td class="p-4 font-medium text-slate-800">{{ $item->nama }}</td>
                        <td class="p-4 text-slate-500">{{ $item->pekerjaan }}</td>
                        <td class="p-4">
                            <span class="inline-flex items-center text-amber-500 font-bold bg-amber-50 px-2 py-0.5 rounded">
                                ★ {{ $item->starts }}
                            </span>
                        </td>
                        <td class="p-4 max-w-xs text-slate-600 truncate" title="{{ $item->review }}">{{ $item->review }}</td>
                        <td class="p-4 whitespace-nowrap">
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
                            @if($item->status == 'Pending')
                                <!-- Tombol Setujui -->
                                <form action="{{ route('admin.review.updateStatus', $item->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="Show">
                                    <button type="submit" class="px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs font-medium transition shadow-sm" title="Setujui Review">
                                        ✓ Setujui
                                    </button>
                                </form>
                                <!-- Tombol Tolak/Sembunyikan -->
                                <form action="{{ route('admin.review.updateStatus', $item->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="Hide">
                                    <button type="submit" class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-xs font-medium transition">
                                        Tolak
                                    </button>
                                </form>
                            @elseif($item->status == 'Show')
                                <!-- Tombol Sembunyikan -->
                                <form action="{{ route('admin.review.updateStatus', $item->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="Hide">
                                    <button type="submit" class="px-3 py-1.5 bg-amber-50 hover:bg-amber-100 text-amber-700 rounded-lg text-xs font-medium transition">
                                        Sembunyikan
                                    </button>
                                </form>
                            @else
                                <!-- Tombol Tampilkan -->
                                <form action="{{ route('admin.review.updateStatus', $item->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="Show">
                                    <button type="submit" class="px-3 py-1.5 bg-red-50 hover:bg-red-100 text-red-700 rounded-lg text-xs font-medium transition">
                                        Tampilkan
                                    </button>
                                </form>
                            @endif

                            <!-- Tombol Hapus -->
                            <form action="{{ route('admin.review.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus review ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1.5 bg-rose-50 text-rose-600 hover:bg-rose-100 rounded-lg text-xs font-medium transition">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="p-6 text-center text-slate-400">Belum ada review yang masuk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection