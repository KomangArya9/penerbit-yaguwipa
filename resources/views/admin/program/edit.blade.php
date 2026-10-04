@extends('admin.layouts.admin')

@section('title', 'Edit Program & Layanan')

@section('content')
<div class="p-8 max-w-4xl mx-auto space-y-6">
    <!-- Page Header & Back Button -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Edit Program & Layanan</h1>
            <p class="text-slate-500 text-sm mt-1">Perbarui rincian program layanan "{{ $program->title }}".</p>
        </div>
        <a href="{{ route('program.index') }}"
            class="inline-flex items-center gap-1.5 px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-sm font-medium transition">
            &larr; Kembali
        </a>
    </div>

    <!-- Error Summary -->
    @if ($errors->any())
        <div class="p-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-xl text-sm shadow-2xs">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Card -->
    <div class="bg-white p-8 rounded-xl shadow-sm border border-slate-200">
        <form action="{{ route('program.update', $program->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Program / Layanan <span class="text-rose-500">*</span></label>
                <input type="text" name="title" value="{{ old('title', $program->title) }}"
                    class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none"
                    placeholder="Contoh: Paket Penerbitan Buku Ber-ISBN / Jasa Layout & Cover" required>
            </div>

            <!-- Short Content -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Ringkasan / Sub-judul Singkat</label>
                <textarea name="short" rows="2"
                    class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none"
                    placeholder="Deskripsi 1-2 kalimat untuk kartu layanan di halaman depan">{{ old('short', $program->short) }}</textarea>
            </div>

            <!-- Content Detail -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Deskripsi Lengkap Layanan <span class="text-rose-500">*</span></label>
                <textarea name="content" rows="5"
                    class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none"
                    placeholder="Rincian fitur dan fasilitas yang didapatkan penulis..." required>{{ old('content', $program->content) }}</textarea>
            </div>

            <!-- File Upload Ikon -->
            <div class="p-4 bg-slate-50/60 rounded-xl border border-slate-200/80">
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Ikon Layanan</label>
                @if($program->icon)
                    <div class="mb-2 flex items-center gap-3">
                        <img src="{{ asset('storage/' . $program->icon) }}" class="w-12 h-12 object-contain rounded-lg border border-red-100 bg-red-50/50 p-1">
                        <span class="text-xs text-slate-500">Ikon saat ini (otomatis berwarna merah)</span>
                    </div>
                @endif
                <input type="file" name="icon"
                    class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
                <p class="text-xs text-slate-400 mt-1">Biarkan kosong jika tidak ingin mengubah ikon.</p>
            </div>

            <!-- Grid Status & Link -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Status Publikasi</label>
                    <select name="status"
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none bg-white">
                        <option value="Show" {{ old('status', $program->status) == 'Show' ? 'selected' : '' }}>Tampilkan (Show)</option>
                        <option value="Hide" {{ old('status', $program->status) == 'Hide' ? 'selected' : '' }}>Sembunyikan (Hide)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Tautan Eksternal / WhatsApp (Opsional)</label>
                    <input type="url" name="url" value="{{ old('url', $program->url) }}" placeholder="https://wa.me/..."
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm font-mono focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                <a href="{{ route('program.index') }}"
                    class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-sm font-medium transition">
                    Batal
                </a>
                <button type="submit"
                    class="px-6 py-2.5 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white rounded-lg text-sm font-medium transition shadow-sm">
                    Perbarui Program
                </button>
            </div>
        </form>
    </div>
</div>
@endsection