@extends('admin.layouts.admin')

@section('content')
<div class="p-6 max-w-7xl mx-auto bg-white rounded-xl shadow border border-gray-100">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Ulasan</h2>

    @if(session('success'))
        <div class="mb-4 p-4 bg-emerald-100 text-emerald-700 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b bg-gray-50 text-gray-600 text-sm">
                    <th class="p-3">No</th>
                    <th class="p-3">Catalog</th>
                    <th class="p-3">Nama</th>
                    <th class="p-3">Ulasan</th>
                    <th class="p-3">Rating</th>
                    <th class="p-3">Status</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-700">
                @forelse($ulasans as $index => $item)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">{{ $index + 1 }}</td>
                    <td class="p-3 font-medium">{{ $item->catalog->judul ?? 'Catalog Dihapus' }}</td>
                    <td class="p-3">{{ $item->nama }}</td>
                    <td class="p-3">{{ $item->ulasan }}</td>
                    <td class="p-3">{{ $item->stars }} Bintang</td>
                    <td class="p-3">
                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold 
                            {{ $item->status == 'Show' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                            {{ $item->status }}
                        </span>
                    </td>
                    <td class="p-3 text-center space-x-2">
                        <!-- Form untuk Ubah Status (Approve / Sembunyikan) -->
                        <form action="{{ route('admin.ulasan.updateStatus', $item->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('PUT')
                            @if($item->status == 'Pending')
                                <input type="hidden" name="status" value="Show">
                                <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded text-xs hover:bg-blue-700">Setujui</button>
                            @else
                                <input type="hidden" name="status" value="Pending">
                                <button type="submit" class="px-3 py-1 bg-gray-500 text-white rounded text-xs hover:bg-gray-600">Sembunyikan</button>
                            @endif
                        </form>

                        <!-- Tombol Hapus -->
                        <form action="{{ route('admin.ulasan.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus ulasan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-rose-600 text-white rounded text-xs hover:bg-rose-700">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="p-4 text-center text-gray-400">No data available in table</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection