@extends('admin.layouts.admin')

@section('title', 'Tambah Video')

@section('content')
<div class="p-8 max-w-4xl mx-auto space-y-6">
    <!-- Page Header & Back Button -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Tambah Video Baru</h1>
            <p class="text-slate-500 text-sm mt-1">Tambahkan tautan video YouTube dokumentasi atau kegiatan literasi.</p>
        </div>
        <a href="{{ route('admin.video.index') }}"
            class="inline-flex items-center gap-1.5 px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-sm font-medium transition">
            &larr; Kembali
        </a>
    </div>

    <!-- Alert Error Jika Validasi Gagal -->
    @if ($errors->any())
        <div class="p-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-xl shadow-2xs">
            <p class="font-semibold text-sm">Terdapat kesalahan pengisian formulir:</p>
            <ul class="list-disc list-inside text-xs mt-1.5 space-y-0.5 text-rose-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Card -->
    <div class="bg-white p-8 rounded-xl shadow-sm border border-slate-200">
        <form action="{{ route('admin.video.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Judul Video <span class="text-rose-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" required maxlength="100" placeholder="Contoh: Liputan Bedah Buku & Seminar Nasional"
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
                    @error('title') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Tanggal Video <span class="text-rose-500">*</span></label>
                    <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none bg-white">
                    @error('date') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Tautan / Link Video YouTube <span class="text-rose-500">*</span></label>
                <input type="text" name="source" value="{{ old('source') }}" required placeholder="https://www.youtube.com/watch?v=... atau youtu.be/..."
                    class="border border-slate-300 p-2.5 rounded-lg w-full text-sm font-mono focus:ring-2 focus:ring-red-500 focus:outline-none">
                <p class="text-xs text-slate-400 mt-1">Bisa berupa link biasa, link pendek (youtu.be), atau kode embed iframe YouTube.</p>
                @error('source') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Deskripsi / Catatan Video <span class="text-xs font-normal text-slate-400">(Opsional)</span></label>
                <textarea name="content" rows="4" placeholder="Keterangan singkat mengenai isi video dokumentasi..."
                    class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">{{ old('content') }}</textarea>
                @error('content') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Status Publikasi</label>
                    <select name="status"
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none bg-white">
                        <option value="Show" {{ old('status') == 'Show' ? 'selected' : '' }}>Tampilkan (Show)</option>
                        <option value="Hide" {{ old('status') == 'Hide' ? 'selected' : '' }}>Sembunyikan (Hide)</option>
                    </select>
                    @error('status') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Hits / Dilihat <span class="text-xs font-normal text-slate-400">(Opsional)</span></label>
                    <input type="number" name="hit" value="{{ old('hit', 0) }}" min="0"
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none bg-white font-mono">
                    @error('hit') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                <a href="{{ route('admin.video.index') }}"
                    class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-sm font-medium transition">
                    Batal
                </a>
                <button type="submit"
                    class="px-6 py-2.5 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white rounded-lg text-sm font-medium transition shadow-sm">
                    Simpan Video
                </button>
            </div>
        </form>
    </div>
</div>
@endsection