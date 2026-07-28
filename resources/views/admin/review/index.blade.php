@extends('admin.layouts.admin')

@section('title', 'Manajemen Review')

@section('content')
<div class="p-8">
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Manajemen Review</h1>
            <p class="text-slate-500">Kelola ulasan yang dikirimkan oleh pengguna.</p>
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
                    <tr>
                        <td class="p-4">{{ $index + 1 }}</td>
                        <td class="p-4 font-medium text-slate-800">{{ $item->nama }}</td>
                        <td class="p-4 text-slate-500">{{ $item->pekerjaan }}</td>
                        <td class="p-4">
                            <span class="text-amber-500 font-bold">★ {{ $item->starts }}</span>
                        </td>
                        <td class="p-4 max-w-xs truncate">{{ $item->review }}</td>
                        <td class="p-4">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $item->status == 'Show' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">
                                {{ $item->status }}
                            </span>
                        </td>
                        <!-- Tambahkan whitespace-nowrap agar tombol aksi tidak turun ke bawah -->
                        <td class="p-4 text-center whitespace-nowrap space-x-1">
                            <!-- Tombol Toggle Status -->
                            <form action="{{ route('admin.review.toggle', $item->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="px-3 py-1.5 bg-amber-50 text-amber-600 hover:bg-amber-100 rounded-lg text-xs font-medium transition">
                                    {{ $item->status == 'Show' ? 'Hide' : 'Show' }}
                                </button>
                            </form>

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