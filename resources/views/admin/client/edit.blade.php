@extends('admin.layouts.admin')

@section('title', 'Edit Mitra & Klien')

@section('content')
<div class="p-8 max-w-4xl mx-auto space-y-6">
    <!-- Page Header & Back Button -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Edit Mitra & Klien</h1>
            <p class="text-slate-500 text-sm mt-1">Perbarui data logo dan informasi mitra "{{ $client->title }}".</p>
        </div>
        <a href="{{ route('client.index') }}"
            class="inline-flex items-center gap-1.5 px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-sm font-medium transition">
            &larr; Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white p-8 rounded-xl shadow-sm border border-slate-200">
        <form action="{{ route('client.update', $client->title) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Nama Client -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Mitra / Instansi <span class="text-rose-500">*</span></label>
                <input type="text" name="title" value="{{ old('title', $client->title) }}" required
                    class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none"
                    placeholder="Contoh: Universitas Indonesia / Dinas Pendidikan">
                @error('title')
                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Upload Logo -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Logo Saat Ini</label>
                <div class="mb-3 w-28 h-16 bg-white border border-slate-200 rounded-lg flex items-center justify-center p-2 shadow-2xs">
                    <img src="{{ asset('storage/' . $client->img) }}" alt="{{ $client->title }}"
                        class="max-h-full max-w-full object-contain">
                </div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Ganti Logo (Opsional)</label>
                <input type="file" name="img"
                    class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
                <p class="text-xs text-slate-400 mt-1">Biarkan kosong jika tidak ingin mengubah file logo saat ini.</p>
                @error('img')
                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Website URL -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Website / Tautan Resmi <span class="text-rose-500">*</span></label>
                <input type="url" name="url" value="{{ old('url', $client->url) }}" placeholder="https://example.ac.id" required
                    class="border border-slate-300 p-2.5 rounded-lg w-full text-sm font-mono focus:ring-2 focus:ring-red-500 focus:outline-none">
                @error('url')
                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Status Tampilan</label>
                <select name="status"
                    class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none bg-white">
                    <option value="Show" {{ old('status', $client->status) == 'Show' ? 'selected' : '' }}>Tampilkan (Show)</option>
                    <option value="Hide" {{ old('status', $client->status) == 'Hide' ? 'selected' : '' }}>Sembunyikan (Hide)</option>
                </select>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                <a href="{{ route('client.index') }}"
                    class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-sm font-medium transition">
                    Batal
                </a>
                <button type="submit"
                    class="px-6 py-2.5 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white rounded-lg text-sm font-medium transition shadow-sm">
                    Perbarui Mitra
                </button>
            </div>
        </form>
    </div>
</div>
@endsection