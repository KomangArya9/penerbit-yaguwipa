@extends('admin.layouts.admin')

@section('title', 'Edit Album Foto')

@section('content')
<div class="p-8 max-w-4xl mx-auto space-y-6">
    <!-- Page Header & Back Button -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Edit Album Foto</h1>
            <p class="text-slate-500 text-sm mt-1">Perbarui judul atau cover album kegiatan "{{ $album->title }}".</p>
        </div>
        <a href="{{ route('admin.album.index') }}"
            class="inline-flex items-center gap-1.5 px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-sm font-medium transition">
            &larr; Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white p-8 rounded-xl shadow-sm border border-slate-200">
        <form action="{{ route('admin.album.update', $album->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama / Judul Album <span class="text-rose-500">*</span></label>
                <input type="text" name="title" value="{{ old('title', $album->title) }}" required maxlength="100"
                    class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
                @error('title') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Thumbnail Image -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Thumbnail Saat Ini</label>
                @if($album->img)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $album->img) }}" alt="{{ $album->title }}"
                            class="w-24 h-16 object-cover rounded-lg border border-slate-200 shadow-2xs">
                    </div>
                @endif
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Ganti Thumbnail (Opsional)</label>
                <input type="file" name="img"
                    class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
                <p class="text-xs text-slate-400 mt-1">Biarkan kosong jika tidak ingin mengubah thumbnail saat ini.</p>
                @error('img') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Grid: Date & Status -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Tanggal Kegiatan <span class="text-rose-500">*</span></label>
                    <input type="date" name="date" value="{{ old('date', $album->date) }}" required
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none bg-white">
                    @error('date') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Status Publikasi</label>
                    <select name="status"
                        class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none bg-white">
                        <option value="Show" {{ old('status', $album->status) == 'Show' ? 'selected' : '' }}>Tampilkan (Show)</option>
                        <option value="Hide" {{ old('status', $album->status) == 'Hide' ? 'selected' : '' }}>Sembunyikan (Hide)</option>
                    </select>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                <a href="{{ route('admin.album.index') }}"
                    class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-sm font-medium transition">
                    Batal
                </a>
                <button type="submit"
                    class="px-6 py-2.5 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white rounded-lg text-sm font-medium transition shadow-sm">
                    Perbarui Album
                </button>
            </div>
        </form>
    </div>
</div>
@endsection