@extends('admin.layouts.admin')

@section('content')
    <div class="p-6 max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">@lang('admin.settings_title')</h2>
            <nav class="text-sm text-gray-500">
                <a href="{{ route('admin.dashboard') }}" class="hover:underline">@lang('common.home')</a> / Edit
            </nav>
        </div>

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-6 shadow">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.pengaturan.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Bagian Visual & Gambar -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h3 class="font-bold text-lg text-gray-800 mb-4 pb-2 border-b">@lang('admin.settings_section_visual')</h3>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <!-- Logo -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">@lang('admin.settings_label_logo')</label>
                        <div class="border-2 border-dashed border-gray-200 rounded-lg p-3 text-center bg-gray-50">
                            @if(!empty($setting->logo))
                                <div class="relative inline-block mb-2">
                                    <img src="{{ asset('storage/' . $setting->logo) }}"
                                        class="w-20 h-20 object-contain mx-auto border rounded bg-white p-1">
                                    <a href="{{ route('admin.pengaturan.delete.image', 'logo') }}"
                                        onclick="return confirm('@lang('admin.settings_confirm_delete_img')')"
                                        class="absolute -top-2 -right-2 bg-red-600 text-white rounded-full p-1 hover:bg-red-700 shadow"
                                        title="@lang('admin.delete')">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12">
                                            </path>
                                        </svg>
                                    </a>
                                </div>
                            @endif
                            <input type="file" name="logo"
                                class="block w-full text-xs text-gray-500 file:mr-2 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700">
                        </div>
                    </div>

                    <!-- Logo Home (header) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">@lang('admin.settings_label_logo_home')</label>
                        <div class="border-2 border-dashed border-gray-200 rounded-lg p-3 text-center bg-gray-50">
                            @if(!empty($setting->header))
                                <div class="relative inline-block mb-2">
                                    <img src="{{ asset('storage/' . $setting->header) }}"
                                        class="w-20 h-20 object-contain mx-auto border rounded bg-white p-1">
                                    <a href="{{ route('admin.pengaturan.delete.image', 'header') }}"
                                        onclick="return confirm('@lang('admin.settings_confirm_delete_img')')"
                                        class="absolute -top-2 -right-2 bg-red-600 text-white rounded-full p-1 hover:bg-red-700 shadow"
                                        title="@lang('admin.delete')">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12">
                                            </path>
                                        </svg>
                                    </a>
                                </div>
                            @endif
                            <input type="file" name="header"
                                class="block w-full text-xs text-gray-500 file:mr-2 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700">
                        </div>
                    </div>

                    <!-- Favicon -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">@lang('admin.settings_label_favicon')</label>
                        <div class="border-2 border-dashed border-gray-200 rounded-lg p-3 text-center bg-gray-50">
                            @if(!empty($setting->favicon))
                                <div class="relative inline-block mb-2">
                                    <img src="{{ asset('storage/' . $setting->favicon) }}"
                                        class="w-12 h-12 object-contain mx-auto border rounded bg-white p-1">
                                    <a href="{{ route('admin.pengaturan.delete.image', 'favicon') }}"
                                        onclick="return confirm('@lang('admin.settings_confirm_delete_img')')"
                                        class="absolute -top-2 -right-2 bg-red-600 text-white rounded-full p-1 hover:bg-red-700 shadow"
                                        title="@lang('admin.delete')">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12">
                                            </path>
                                        </svg>
                                    </a>
                                </div>
                            @endif
                            <input type="file" name="favicon"
                                class="block w-full text-xs text-gray-500 file:mr-2 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700">
                        </div>
                    </div>

                </div>
            </div>

            <!-- Informasi Kontak & Utama -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h3 class="font-bold text-lg text-gray-800 mb-4 pb-2 border-b">@lang('admin.settings_section_contact')</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">@lang('admin.settings_label_company')</label>
                        <input type="text" name="company" value="{{ $setting->company ?? '' }}"
                            class="border border-gray-300 p-2.5 rounded-lg w-full text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">@lang('admin.settings_label_website')</label>
                        <input type="text" name="website" value="{{ $setting->website ?? '' }}"
                            class="border border-gray-300 p-2.5 rounded-lg w-full text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">@lang('admin.settings_label_phone')</label>
                        <input type="text" name="phone" value="{{ $setting->phone ?? '' }}"
                            class="border border-gray-300 p-2.5 rounded-lg w-full text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">@lang('admin.settings_label_email')</label>
                        <input type="email" name="email" value="{{ $setting->email ?? '' }}"
                            class="border border-gray-300 p-2.5 rounded-lg w-full text-sm">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">@lang('admin.settings_label_address')</label>
                        <textarea name="address" rows="3"
                            class="border border-gray-300 p-2.5 rounded-lg w-full text-sm">{{ $setting->address ?? '' }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">@lang('admin.settings_label_map')</label>
                        <textarea name="map" rows="3"
                            class="border border-gray-300 p-2.5 rounded-lg w-full text-sm">{{ $setting->map ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Konten & Deskripsi -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h3 class="font-bold text-lg text-gray-800 mb-4 pb-2 border-b">@lang('admin.settings_section_content')</h3>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">@lang('admin.settings_label_intro')</label>
                        <textarea name="intro" rows="2"
                            class="border border-gray-300 p-2.5 rounded-lg w-full text-sm">{{ $setting->intro ?? '' }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">@lang('admin.settings_label_content_intro')</label>
                        <textarea name="seo" rows="2"
                            class="border border-gray-300 p-2.5 rounded-lg w-full text-sm">{{ $setting->seo ?? '' }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">@lang('admin.settings_label_tentang_kami')</label>
                        <textarea name="url_popup" rows="3"
                            class="border border-gray-300 p-2.5 rounded-lg w-full text-sm">{{ $setting->url_popup ?? '' }}</textarea>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">@lang('admin.settings_label_desc_catalog')</label>
                            <textarea name="meta_description" rows="3"
                                class="border border-gray-300 p-2.5 rounded-lg w-full text-sm">{{ $setting->meta_description ?? '' }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">@lang('admin.settings_label_desc_team')</label>
                            <textarea name="team" rows="3"
                                class="border border-gray-300 p-2.5 rounded-lg w-full text-sm">{{ $setting->team ?? '' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Media Tambahan & SEO -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h3 class="font-bold text-lg text-gray-800 mb-4 pb-2 border-b">@lang('admin.settings_section_media_seo')</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Foto Tentang Kami (popup) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">@lang('admin.settings_label_foto_tentang')</label>
                        <div class="border-2 border-dashed border-gray-200 rounded-lg p-3 text-center bg-gray-50">
                            @if(!empty($setting->background))
                                <div class="relative inline-block mb-2">
                                    <img src="{{ asset('storage/' . $setting->background) }}"
                                        class="w-24 h-20 object-contain mx-auto border rounded bg-white p-1">
                                    <a href="{{ route('admin.pengaturan.delete.image', 'background') }}"
                                        onclick="return confirm('@lang('admin.settings_confirm_delete_img')')"
                                        class="absolute -top-2 -right-2 bg-red-600 text-white rounded-full p-1 hover:bg-red-700 shadow"
                                        title="@lang('admin.delete')">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12">
                                            </path>
                                        </svg>
                                    </a>
                                </div>
                            @endif
                            <input type="file" name="background"
                                class="block w-full text-xs text-gray-500 file:mr-2 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">@lang('admin.settings_label_script')</label>
                        <textarea name="script" rows="4"
                            class="border border-gray-300 p-2.5 rounded-lg w-full text-sm">{{ $setting->script ?? '' }}</textarea>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">@lang('admin.settings_label_meta_title')</label>
                        <input type="text" name="meta_title" value="{{ $setting->meta_title ?? '' }}"
                            class="border border-gray-300 p-2.5 rounded-lg w-full text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">@lang('admin.settings_label_copyright')</label>
                        <input type="text" name="copyright" value="{{ $setting->copyright ?? '' }}"
                            class="border border-gray-300 p-2.5 rounded-lg w-full text-sm">
                    </div>
                    <!-- Meta Keyword (menggunakan kolom fax) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">@lang('admin.settings_label_meta_keyword')</label>
                        <input type="text" name="fax" value="{{ $setting->fax ?? '' }}"
                            class="border border-gray-300 p-2.5 rounded-lg w-full text-sm">
                    </div>
                </div>
            </div>

            <!-- Tombol Simpan -->
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2.5 rounded-lg shadow-sm transition">
                    @lang('admin.settings_button_save')
                </button>
            </div>
        </form>
    </div>
@endsection