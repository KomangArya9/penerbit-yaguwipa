@extends('admin.layouts.admin')

@section('content')
    <div class="p-6 max-w-6xl mx-auto bg-white rounded-xl shadow border border-gray-100">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">News & Events</h2>
            <span class="text-sm text-gray-500"><a href="{{ route('admin.blog.index') }}" class="hover:underline">Home</a> /
                Add</span>
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

        <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kategori -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Kategori</label>
                    <select name="id_category" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm bg-white"
                        required>
                        <option value="">Pilih Kategori...</option>
                        @foreach($kategoris as $kat)
                            <option value="{{ $kat->id }}" {{ old('id_category') == $kat->id ? 'selected' : '' }}>
                                {{ $kat->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Date -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Date</label>
                    <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}"
                        class="w-full rounded-lg border-gray-300 border p-2.5 text-sm" required>
                </div>
            </div>

            <!-- Title -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Title</label>
                <input type="text" name="title" value="{{ old('title') }}" placeholder="Title..."
                    class="w-full rounded-lg border-gray-300 border p-2.5 text-sm" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Content -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Content</label>
                    <textarea name="content" rows="8" placeholder="Tulis konten berita di sini..."
                        class="w-full rounded-lg border-gray-300 border p-2.5 text-sm"
                        required>{{ old('content') }}</textarea>
                </div>

                <!-- Image Upload -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Image</label>
                    <div
                        class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:bg-gray-50 transition cursor-pointer relative">
                        <input type="file" name="img" id="img-input"
                            class="absolute inset-0 opacity-0 cursor-pointer w-full h-full"
                            accept="image/png, image/jpeg, image/jpg, image/webp" onchange="previewFileName(this)">
                        <div class="flex flex-col items-center justify-center space-y-2">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <p id="file-name-display" class="text-sm text-gray-500 font-medium">Drag atau drop untuk memilih
                                file</p>
                        </div>
                    </div>
                    <p class="text-xs text-gray-400 mt-1">note: max. 2MB (PNG/JPG)</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Caption Image Blog -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Caption Image Blog</label>
                    <input type="text" name="caption" value="{{ old('caption') }}" placeholder="Caption Image Blog..."
                        class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
                </div>

                <!-- Tags -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Tags</label>
                    <input type="text" name="tags" value="{{ old('tags') }}" placeholder="Tags..."
                        class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
                    <p class="text-xs text-gray-400 mt-1">note: Jangan ada spasi diantara tanda baca dan jangan isi tanda
                        baca ex: blog;terbaru</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Meta Keywords -->
                <div class="md:col-span-1">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Meta Keywords</label>
                    <input type="text" name="keyword" value="{{ old('keyword') }}" placeholder="Meta Keywords..."
                        class="w-full rounded-lg border-gray-300 border p-2.5 text-sm">
                </div>

                <!-- Hit -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Hit</label>
                    <input type="number" name="hit" value="{{ old('hit', $blog->hit ?? 0) }}"
                        class="w-full rounded-lg border-gray-300 border p-2.5 text-sm" placeholder="0">
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm bg-white">
                        <option value="Show" {{ old('status') == 'Show' ? 'selected' : '' }}>Show</option>
                        <option value="Hide" {{ old('status') == 'Hide' ? 'selected' : '' }}>Hide</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end gap-2 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.blog.index') }}"
                    class="px-5 py-2.5 bg-gray-300 text-gray-700 rounded-lg text-sm font-semibold">Batal</a>
                <button type="submit"
                    class="px-5 py-2.5 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 shadow">Submit</button>
            </div>
        </form>
    </div>
@endsection

<!-- Script untuk Menampilkan Nama File -->
<script>
    function previewFileName(input) {
        const display = document.getElementById('file-name-display');
        if (input.files && input.files[0]) {
            display.textContent = '📄 ' + input.files[0].name;
            display.classList.remove('text-gray-500');
            display.classList.add('text-blue-600', 'font-semibold');
        }
    }
</script>