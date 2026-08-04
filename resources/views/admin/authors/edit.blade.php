@extends('admin.layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">

        <div class="mb-6 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">@lang('admin.authors_edit_title')</h1>
                <p class="text-sm text-gray-600 mt-1">@lang('admin.authors_edit_description')</p>
            </div>
            <a href="{{ route('admin.authors.index') }}" class="text-sm text-gray-600 hover:text-gray-900 font-medium">
                &larr; @lang('admin.authors_back_to_list')
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.authors.update', $author->id) }}" method="POST" enctype="multipart/form-data"
            class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm space-y-6">
            @csrf
            @method('PUT')

            <!-- Baris 1: Nama Lengkap & Institusi -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">@lang('admin.authors_label_nama_lengkap')</label>
                    <input type="text" name="nama" value="{{ old('nama', $author->nama) }}" required
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">@lang('admin.authors_label_institusi')</label>
                    <input type="text" name="institusi" value="{{ old('institusi', $author->institusi) }}"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
            </div>

            <!-- Baris 2: Email, Nomor, Social Media -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">@lang('common.email')</label>
                    <input type="email" name="email" value="{{ old('email', $author->email) }}"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">@lang('common.phone')</label>
                    <input type="text" name="nomor" value="{{ old('nomor', $author->nomor) }}"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">@lang('admin.authors_label_social_media')</label>
                    <input type="text" name="social_media" value="{{ old('social_media', $author->social_media ?? '') }}"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
            </div>

            <!-- Baris 3: Keahlian & Alamat -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">@lang('admin.authors_label_expertise')</label>
                    <input type="text" name="keahlian" value="{{ old('keahlian', $author->keahlian ?? '') }}"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">@lang('admin.authors_label_alamat')</label>
                    <input type="text" name="alamat" value="{{ old('alamat', $author->alamat ?? '') }}"
                        class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">
                </div>
            </div>

            <!-- Profil Singkat -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">@lang('admin.authors_label_profil_singkat')</label>
                <textarea name="profile" rows="5"
                    class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] focus:ring-1 focus:ring-[#B6171E]">{{ old('profile', $author->profile ?? '') }}</textarea>
            </div>

            <!-- Bagian Edit Foto Profil di Admin -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">@lang('admin.authors_label_photo')</label>

                <!-- Kotak Preview Foto Lama (Menyesuaikan seperti Foto ke-2) -->
                <div class="border border-gray-300 p-4 rounded-lg bg-gray-50 mb-3 flex justify-center items-center">
                    @if($author->foto && file_exists(public_path($author->foto)))
                        <img src="{{ asset($author->foto) }}" alt="Preview Foto"
                            class="max-h-48 object-contain rounded shadow-sm">
                    @else
                        <div class="py-6 text-gray-400 text-sm italic">@lang('admin.authors_no_photo')</div>
                    @endif
                </div>

                <!-- Input File untuk Ganti Foto -->
                <input type="file" name="foto"
                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-[#B6171E] hover:file:bg-red-100">
                <p class="text-xs text-gray-400 mt-1">@lang('admin.authors_note_photo')</p>
            </div>

            <!-- Status -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">@lang('common.status')</label>
                <select name="status"
                    class="w-full p-3 border border-gray-300 rounded-lg text-sm outline-none focus:border-[#B6171E] bg-white">
                    <option value="pending" {{ $author->status == 'pending' ? 'selected' : '' }}>@lang('admin.authors_option_pending')</option>
                    <option value="show" {{ $author->status == 'show' ? 'selected' : '' }}>@lang('admin.authors_option_show')</option>
                    <option value="hide" {{ $author->status == 'hide' ? 'selected' : '' }}>@lang('admin.authors_option_hide')</option>
                </select>
            </div>

            <!-- Tombol Update -->
            <div class="flex justify-end pt-4 border-t border-gray-200">
                <button type="submit"
                    class="px-8 py-3 bg-[#B6171E] hover:bg-red-800 text-white rounded-lg font-bold text-sm transition-all shadow-md">
                    @lang('common.save_changes')
                </button>
            </div>
        </form>
    </div>
@endsection