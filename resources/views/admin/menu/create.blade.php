@extends('admin.layouts.admin')

@section('content')
    <div class="p-6 max-w-3xl mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">@lang('admin.menu_create_title')</h2>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <form action="{{ route('admin.menu.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">@lang('admin.menu_label_title')</label>
                    <input type="text" name="title" value="{{ old('title') }}"
                        class="border border-gray-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        required placeholder="@lang('admin.menu_placeholder_title')">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">@lang('admin.menu_label_url')</label>
                    <input type="text" name="url" value="{{ old('url', $menu->url ?? '') }}"
                        class="border border-gray-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        required placeholder="@lang('admin.menu_placeholder_url')">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">@lang('common.status')</label>
                    <select name="status"
                        class="border border-gray-300 p-2.5 rounded-lg w-full text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <option value="Show" {{ old('status') == 'Show' ? 'selected' : '' }}>@lang('common.show')</option>
                        <option value="Hide" {{ old('status') == 'Hide' ? 'selected' : '' }}>@lang('common.hide')</option>
                    </select>
                </div>

                <div class="flex justify-end gap-2 pt-4">
                    <a href="{{ route('admin.menu.index') }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition">@lang('common.cancel')</a>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm font-medium transition">@lang('common.save')</button>
                </div>
            </form>
        </div>
    </div>
@endsection