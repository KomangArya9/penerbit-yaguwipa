@extends('admin.layouts.admin')

@section('title', 'Manajemen Penulis')

@section('content')
<div class="p-8 max-w-7xl mx-auto space-y-6">
    <!-- Header Halaman -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Verifikasi & Manajemen Penulis</h1>
            <p class="text-slate-500 text-sm mt-1">Daftar penulis yang mendaftar dari website publik. Review profil dan tentukan status penayangannya.</p>
        </div>
    </div>

    <!-- Alert Notifikasi Sukses -->
    @if(session('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl flex items-center gap-3 shadow-2xs">
            <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span class="text-sm font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Tabel Data Penulis -->
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-slate-600 uppercase text-xs font-semibold">
                        <th class="py-3.5 px-4 w-14 text-center">No</th>
                        <th class="py-3.5 px-4 w-16 text-center">Foto</th>
                        <th class="py-3.5 px-4">Nama Lengkap & Institusi</th>
                        <th class="py-3.5 px-4">Email</th>
                        <th class="py-3.5 px-4">Nomor WhatsApp</th>
                        <th class="py-3.5 px-4 text-center">Status</th>
                        <th class="py-3.5 px-4 text-center w-36">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse($authors as $index => $author)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-4 px-4 text-center font-medium text-slate-400">
                                {{ $authors->firstItem() + $index }}
                            </td>
                            <td class="py-4 px-4 text-center">
                                <img src="{{ $author->foto_url }}" alt="{{ $author->nama }}" class="w-10 h-10 rounded-xl object-cover border border-slate-200 mx-auto shadow-2xs">
                            </td>
                            <td class="py-4 px-4 font-semibold text-slate-800">
                                {{ $author->nama }}
                                @if($author->institusi)
                                    <span class="block text-xs font-normal text-slate-400">{{ $author->institusi }}</span>
                                @endif
                            </td>
                            <td class="py-4 px-4 text-slate-600 text-xs">
                                {{ $author->email ?? '-' }}
                            </td>
                            <td class="py-4 px-4 text-slate-600 text-xs">
                                {{ $author->nomor ?? '-' }}
                            </td>
                            <td class="py-4 px-4 text-center whitespace-nowrap">
                                <!-- Form Ubah Status Langsung (Show / Hide / Pending) -->
                                <form action="{{ route('admin.authors.updateStatus', $author->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" onchange="this.form.submit()"
                                        class="text-xs font-semibold px-2 py-1 rounded-md border border-slate-200 bg-white cursor-pointer transition-all focus:outline-none
                                        {{ strtolower($author->status) == 'show' ? 'text-emerald-600' : '' }}
                                        {{ strtolower($author->status) == 'hide' ? 'text-slate-500' : '' }}
                                        {{ strtolower($author->status) == 'pending' ? 'text-amber-600' : '' }}">
                                        <option value="show" {{ strtolower($author->status) == 'show' ? 'selected' : '' }}>Show</option>
                                        <option value="pending" {{ strtolower($author->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="hide" {{ strtolower($author->status) == 'hide' ? 'selected' : '' }}>Hide</option>
                                    </select>
                                </form>
                            </td>
                            <td class="py-4 px-4 text-center whitespace-nowrap space-x-2">
                                <a href="{{ route('admin.authors.edit', $author->id) }}"
                                    class="inline-flex items-center px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-xs font-medium transition">
                                    Edit
                                </a>
                                <form action="{{ route('admin.authors.destroy', $author->id) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Yakin ingin menghapus data penulis {{ $author->nama }}?')">
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
                            <td colspan="7" class="py-12 text-center text-slate-400">
                                <div class="flex flex-col items-center justify-center space-y-2">
                                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    <span>Belum ada pendaftaran penulis masuk.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginasi -->
        @if($authors->hasPages())
            <div class="p-4 border-t border-slate-200 bg-slate-50/50">
                {{ $authors->links() }}
            </div>
        @endif
    </div>
</div>
@endsection