@extends('admin.layouts.admin')

@section('title', 'Tambah Kontak')

@section('content')
<div class="p-8 max-w-4xl mx-auto space-y-6">
    <!-- Page Header & Back Button -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Tambah Kontak</h1>
            <p class="text-slate-500 text-sm mt-1">Tambahkan narahubung baru untuk website Penerbit Yaguwipa.</p>
        </div>
        <a href="{{ route('admin.kontak_kami.index') }}"
            class="inline-flex items-center gap-1.5 px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-sm font-medium transition">
            &larr; Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white p-8 rounded-xl shadow-sm border border-slate-200">
        <form action="{{ route('admin.kontak_kami.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Title -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Label / Nama Kontak <span class="text-rose-500">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}"
                    class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none"
                    placeholder="Contoh: WhatsApp Layanan ISBN / Customer Service" required>
                @error('title')
                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kontak -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nomor Telepon / WhatsApp <span class="text-rose-500">*</span></label>
                <input type="text" name="kontak" value="{{ old('kontak') }}"
                    class="border border-slate-300 p-2.5 rounded-lg w-full text-sm font-mono focus:ring-2 focus:ring-red-500 focus:outline-none"
                    placeholder="Contoh: +62 811-3996-698 / 0812-3456-7890" required>
                @error('kontak')
                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Dropdown Type -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Tipe Saluran Kontak <span class="text-rose-500">*</span></label>
                <select name="type"
                    class="border border-slate-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-red-500 focus:outline-none bg-white"
                    required>
                    <option value="" disabled {{ old('type') ? '' : 'selected' }}>-- Pilih Tipe Saluran --</option>
                    <option value="Whatsapp" {{ old('type') == 'Whatsapp' ? 'selected' : '' }}>WhatsApp</option>
                    <option value="Call" {{ old('type') == 'Call' ? 'selected' : '' }}>Telepon Langsung (Call)</option>
                </select>
                @error('type')
                    <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                <a href="{{ route('admin.kontak_kami.index') }}"
                    class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-sm font-medium transition">
                    Batal
                </a>
                <button type="submit"
                    class="px-6 py-2.5 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white rounded-lg text-sm font-medium transition shadow-sm">
                    Simpan Kontak
                </button>
            </div>
        </form>
    </div>
</div>
@endsection