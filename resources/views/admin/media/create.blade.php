@extends('admin.layouts.admin')

@section('content')
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Tambah Sosial Media
        </h2>

        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <form action="{{ route('admin.media.store') }}" method="POST">
                @csrf

                <!-- Input Title -->
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400 font-semibold">Title</span>
                    <input type="text" name="title" value="{{ old('title') }}"
                        class="block w-full mt-1 px-3 py-2 text-sm bg-white border border-gray-300 rounded-lg dark:border-gray-600 dark:bg-gray-700 focus:border-blue-400 focus:outline-none dark:text-gray-300 @error('title') border-red-600 @enderror"
                        placeholder="Title..." required>
                    @error('title')
                        <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                    @enderror
                </label>

                <!-- Input URL -->
                <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400 font-semibold">Url</span>
                    <input type="url" name="url" value="{{ old('url') }}"
                        class="block w-full mt-1 px-3 py-2 text-sm bg-white border border-gray-300 rounded-lg dark:border-gray-600 dark:bg-gray-700 focus:border-blue-400 focus:outline-none dark:text-gray-300 @error('url') border-red-600 @enderror"
                        placeholder="Url..." required>
                    @error('url')
                        <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span>
                    @enderror
                </label>

                <!-- Tombol Aksi -->
                <div class="flex mt-6 space-x-4">
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none">
                        Simpan
                    </button>
                    <a href="{{ route('admin.media.index') }}"
                        class="px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-gray-300 border border-transparent rounded-lg active:bg-gray-400 hover:bg-gray-400 focus:outline-none">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection