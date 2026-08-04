@extends('admin.layouts.admin')

@section('content')
<div class="p-6 max-w-xl mx-auto bg-white rounded-xl shadow border border-gray-100">
    <h2 class="text-xl font-bold text-gray-800 mb-4">@lang('admin.password_title')</h2>

    @if(session('success'))
        <div class="mb-4 p-4 bg-emerald-100 text-emerald-700 rounded-lg text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 p-4 bg-rose-100 text-rose-700 rounded-lg text-sm">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.password.update') }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">@lang('admin.password_label_old')</label>
            <input type="password" name="current_password" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm" required>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">@lang('admin.password_label_new')</label>
            <input type="password" name="password" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm" required>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">@lang('admin.password_label_confirm')</label>
            <input type="password" name="password_confirmation" class="w-full rounded-lg border-gray-300 border p-2.5 text-sm" required>
        </div>

        <div class="flex justify-end gap-2 pt-2">
            <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 shadow">
                @lang('admin.password_button')
            </button>
        </div>
    </form>
</div>
@endsection