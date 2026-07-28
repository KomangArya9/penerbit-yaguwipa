@extends('admin.layouts.admin')

@section('content')
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Portofolio</h2>
            <a href="{{ route('admin.project.create') }}"
                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-semibold shadow transition flex items-center gap-2">
                + Add Data
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-emerald-100 text-emerald-700 rounded-lg text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow overflow-x-auto border border-gray-100">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="bg-gray-50 text-gray-700 text-xs uppercase tracking-wider border-b border-gray-200">
                        <th class="p-4 w-12 text-center">No</th>
                        <th class="p-4">Date</th>
                        <th class="p-4">Kategori</th>
                        <th class="p-4">Services</th>
                        <th class="p-4">Title</th>
                        <th class="p-4">Lokasi</th>
                        <th class="p-4 text-center">Image</th>
                        <th class="p-4 text-center">Hit</th>
                        <th class="p-4 text-center">Status</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm text-gray-600">
                    @forelse($projects as $index => $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 text-center font-medium">{{ $index + 1 }}</td>
                            <td class="p-4">{{ $item->date }}</td>
                            <td class="p-4">{{ $item->kategoriProject ? $item->kategoriProject->title : '-' }}</td>
                            <td class="p-4">{{ $item->id_service }}</td>
                            <td class="p-4 font-semibold text-gray-800">{{ $item->title }}</td>
                            <td class="p-4">{{ $item->lokasi }}</td>
                            <td class="p-4 text-center">
                                @php
    $primaryPhoto = $item->fotos->first();
@endphp

@if($primaryPhoto && $primaryPhoto->img)
    <img src="{{ asset('storage/' . $primaryPhoto->img) }}" alt="{{ $item->title }}" class="w-16 h-16 object-cover rounded">
@else
    <span class="text-gray-400 text-xs">No Image</span>
@endif
                            </td>
                            <td class="p-4 text-center font-medium">{{ $item->hit }}</td>
                            <td class="p-4 text-center">
                                <span
                                    class="px-2.5 py-1 text-xs font-semibold rounded {{ $item->status == 'Show' ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td class="p-4 text-center space-x-1">
                                <a href="{{ route('admin.project.edit', $item->id) }}"
                                    class="inline-block px-3 py-1.5 bg-cyan-500 hover:bg-cyan-600 text-white rounded-lg text-xs font-medium transition">
                                    Edit
                                </a>
                                <form action="{{ route('admin.project.destroy', $item->id) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Yakin ingin menghapus portofolio ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1.5 bg-rose-500 hover:bg-rose-600 text-white rounded-lg text-xs font-medium transition">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="p-6 text-center text-gray-400">Belum ada data portofolio.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection