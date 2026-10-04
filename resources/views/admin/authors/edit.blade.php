@extends('admin.layouts.admin')

@section('title', 'Edit Profil Penulis')

@section('content')
<div class="p-8 max-w-5xl mx-auto space-y-6">
    <!-- Page Header & Back Button -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Edit Profil Penulis</h1>
            <p class="text-slate-500 text-sm mt-1">Perbarui data profil, afiliasi, kontak, dan status tayang penulis.</p>
        </div>
        <a href="{{ route('admin.authors.index') }}"
            class="inline-flex items-center gap-1.5 px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-sm font-medium transition">
            &larr; Kembali
        </a>
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

    <form action="{{ route('admin.authors.update', $author->id) }}" method="POST" enctype="multipart/form-data"
        class="bg-white border border-slate-200 rounded-xl p-8 shadow-sm space-y-6">
        @csrf
        @method('PUT')

        <!-- Baris 1: Nama Lengkap & Institusi -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Lengkap <span class="text-rose-500">*</span></label>
                <input type="text" name="nama" value="{{ old('nama', $author->nama) }}" required
                    class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Institusi / Instansi Asal</label>
                <input type="text" name="institusi" value="{{ old('institusi', $author->institusi) }}"
                    class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
            </div>
        </div>

        <!-- Baris 2: Email, Nomor, Social Media -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Alamat Email</label>
                <input type="email" name="email" value="{{ old('email', $author->email) }}"
                    class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nomor WhatsApp / Telp</label>
                <input type="text" name="nomor" value="{{ old('nomor', $author->nomor) }}"
                    class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Social Media (Instagram/LinkedIn)</label>
                <input type="text" name="social_media" value="{{ old('social_media', $author->social_media ?? '') }}"
                    class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
            </div>
        </div>

        <!-- Baris 3: Keahlian & Alamat -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Bidang Keahlian</label>
                <input type="text" name="keahlian" value="{{ old('keahlian', $author->keahlian ?? '') }}" placeholder="Contoh: Sastra, Hukum, Ekonomi"
                    class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Domisili / Alamat</label>
                <input type="text" name="alamat" value="{{ old('alamat', $author->alamat ?? '') }}" placeholder="Contoh: Denpasar, Bali"
                    class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
            </div>
        </div>

        <!-- Profil Singkat -->
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Biografi Singkat</label>
            <textarea name="profile" rows="5" placeholder="Tuliskan biografi atau portofolio singkat penulis..."
                class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none leading-relaxed">{{ old('profile', $author->profile ?? '') }}</textarea>
        </div>

        <!-- Bagian Edit Foto Profil di Admin -->
        <div class="p-5 bg-slate-50/70 rounded-xl border border-slate-200">
            <label class="block text-sm font-semibold text-slate-700 mb-2">Foto Profil Penulis</label>
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                @if($author->foto)
                    <div class="relative group shrink-0">
                        <img src="{{ $author->foto_url }}" alt="Preview Foto"
                            class="w-20 h-20 rounded-xl object-cover border border-slate-300 shadow-sm">
                    </div>
                @endif
                <div class="flex-1 w-full">
                    <input type="file" name="foto"
                        class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
                    <p class="text-xs text-slate-400 mt-1">Maks. 2MB (PNG/JPG/WEBP). Kosongkan jika tidak ingin mengubah foto.</p>
                </div>
            </div>
        </div>

        <!-- Status -->
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Status Penayangan Profil</label>
            <select name="status" class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none bg-white">
                <option value="show" {{ $author->status == 'show' ? 'selected' : '' }}>Show (Tampilkan di Direktori)</option>
                <option value="pending" {{ $author->status == 'pending' ? 'selected' : '' }}>Pending (Menunggu Persetujuan)</option>
                <option value="hide" {{ $author->status == 'hide' ? 'selected' : '' }}>Hide (Sembunyikan)</option>
            </select>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
            <a href="{{ route('admin.authors.index') }}"
                class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-sm font-medium transition">
                Batal
            </a>
            <button type="submit"
                class="px-6 py-2.5 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white rounded-lg text-sm font-medium transition shadow-sm">
                Simpan Perubahan Penulis
            </button>
        </div>
    </form>
</div>
@endsection