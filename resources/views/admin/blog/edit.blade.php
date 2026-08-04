@extends('admin.layouts.admin')

@section('content')
    <div class="p-6 max-w-6xl mx-auto bg-white rounded-xl shadow border border-gray-100">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">@lang('admin.blog_edit_title')</h2>
            <span class="text-sm text-gray-500"><a href="{{ route('admin.blog.index') }}" class="hover:underline">@lang('common.home')</a> /
                @lang('common.edit_label')</span>
        </div>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-rose-100 text-rose-700 rounded-lg text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kategori -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">@lang('common.category')</label>
                    <select name="id_category" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm bg-white"
                        required>
                        <option value="">@lang('admin.blog_select_kategori')</option>
                        @foreach($kategoris as $kat)
                            <option value="{{ $kat->id }}" {{ old('id_category', $blog->id_category) == $kat->id ? 'selected' : '' }}>{{ $kat->title }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Date -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">@lang('common.date')</label>
                    <input type="date" name="date" value="{{ old('date', $blog->date) }}"
                        class="w-full rounded-lg border-gray-300 border p-2.5 text-sm" required>
                </div>
            </div>

            <!-- Title -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">@lang('common.title')</label>
                <input type="text" name="title" value="{{ old('title', $blog->title) }}"
                    class="w-full rounded-lg border-gray-300 border p-2.5 text-sm" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Content -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">@lang('common.content')</label>
                    <textarea name="content" rows="8" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm"
                        required>{{ old('content', $blog->content) }}</textarea>
                </div>

                <!-- Image Upload -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">@lang('common.image')</label>
                    @if($blog->img)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $blog->img) }}" alt="Preview"
                                class="w-20 h-20 object-cover rounded-lg shadow-sm border">
                        </div>
                    @endif
                    <div
                        class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:bg-gray-50 transition cursor-pointer relative">
                        <input type="file" name="img" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full"
                            accept="image/png, image/jpeg, image/jpg, image/webp" onchange="previewEditFileName(this)">
                        <div class="flex flex-col items-center justify-center space-y-1">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <p id="edit-file-name-display" class="text-xs text-gray-500 font-medium">@lang('admin.blog_edit_change_file')</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Caption Image Blog -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">@lang('admin.blog_label_caption')</label>
                    <input type="text" name="caption" value="{{ old('caption', $blog->caption) }}"
                        class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
                </div>

                <!-- Tags -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">@lang('common.tags')</label>
                    <input type="text" name="tags" value="{{ old('tags', $blog->tags) }}"
                        class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
                    <p class="text-xs text-gray-400 mt-1">@lang('admin.blog_note_tags')</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Meta Keywords -->
                <div class="md:col-span-1">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">@lang('common.meta_keywords')</label>
                    <input type="text" name="keyword" value="{{ old('keyword', $blog->keyword) }}"
                        class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
                </div>

                <!-- Hit -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">@lang('common.hit')</label>
                    <input type="number" name="hit" value="{{ old('hit', $blog->hit ?? 0) }}"
                        class="w-full rounded-lg border-gray-300 border p-2.5 text-sm" placeholder="0">
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">@lang('common.status')</label>
                    <select name="status" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm bg-white">
                        <option value="Show" {{ old('status', $blog->status) == 'Show' ? 'selected' : '' }}>@lang('common.show')</option>
                        <option value="Hide" {{ old('status', $blog->status) == 'Hide' ? 'selected' : '' }}>@lang('common.hide')</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end gap-2 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.blog.index') }}"
                    class="px-5 py-2.5 bg-gray-300 text-gray-700 rounded-lg text-sm font-semibold">@lang('common.cancel')</a>
                <button type="submit"
                    class="px-5 py-2.5 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 shadow">@lang('common.update')</button>
            </div>
        </form>
    </div>
@endsection

<!-- Script untuk Menampilkan Nama File Edit -->
<script>
    function previewEditFileName(input) {
        const display = document.getElementById('edit-file-name-display');
        if (input.files && input.files[0]) {
            display.textContent = '📄 ' + input.files[0].name;
            display.classList.remove('text-gray-500');
            display.classList.add('text-blue-600', 'font-semibold');
        }
    }
</script>