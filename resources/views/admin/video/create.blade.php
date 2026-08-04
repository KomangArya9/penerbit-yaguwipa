@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">@lang('admin.video_create_title')</h1>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.video.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">@lang('common.date')</label>
                    <input type="date" name="date" value="{{ date('Y-m-d') }}" required class="w-full border-gray-300 rounded-lg shadow-sm border p-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">@lang('common.title')</label>
                    <input type="text" name="title" value="{{ old('title') }}" required placeholder="{{ __('common.title') }}..." class="w-full border-gray-300 rounded-lg shadow-sm border p-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">@lang('admin.video_label_content')</label>
                <!-- Textarea biasa tanpa Summernote -->
                <textarea name="content" rows="5" required placeholder="{{ __('admin.blog_placeholder_content') }}" class="w-full border-gray-300 rounded-lg shadow-sm border p-2 focus:ring-blue-500 focus:border-blue-500">{{ old('content') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">@lang('admin.video_label_source')</label>
                    <input type="text" name="source" value="{{ old('source') }}" required placeholder="https://www.youtube.com/watch?v=..." class="w-full border-gray-300 rounded-lg shadow-sm border p-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">@lang('common.status')</label>
                    <select name="status" class="w-full border-gray-300 rounded-lg shadow-sm border p-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="Show">@lang('common.show')</option>
                        <option value="Hide">@lang('common.hide')</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('admin.video.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium">@lang('common.cancel')</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg text-sm font-medium shadow">@lang('common.submit')</button>
            </div>
        </form>
    </div>
</div>
@endsection