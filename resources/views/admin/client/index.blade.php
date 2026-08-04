@extends('admin.layouts.admin')

@section('title', 'Partners & Clients')

@section('content')
    <div class="p-8">
        <div class="mb-6 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">@lang('admin.client_index_title')</h1>
                <p class="text-slate-500 text-sm">@lang('admin.client_index_description')</p>
            </div>
            <a href="{{ route('client.create') }}"
                class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-semibold shadow-sm transition">
                + @lang('common.add_data')
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-600 rounded-xl text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-slate-500 text-xs uppercase font-semibold">
                            <th class="p-4 w-16">@lang('common.no_label')</th>
                            <th class="p-4">@lang('admin.client_label_name')</th>
                            <th class="p-4">@lang('common.logo')</th>
                            <th class="p-4">@lang('common.status')</th>
                            <th class="p-4 text-center w-36">@lang('common.action')</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 text-slate-700 text-sm">
                        @forelse($clients as $index => $item)
                            <tr>
                                <td class="p-4 font-medium text-slate-500">{{ $index + 1 }}</td>
                                <td class="p-4 font-semibold text-slate-800">{{ $item->title }}</td>
                                <td class="p-4">
                                    <div
                                        class="w-24 h-12 bg-slate-50 border border-slate-100 rounded-lg flex items-center justify-center p-1">
                                        <img src="{{ asset('storage/' . $item->img) }}" alt="{{ $item->title }}"
                                            class="max-h-full max-w-full object-contain">
                                    </div>
                                </td>
                                <td class="p-4">
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-semibold {{ $item->status == 'Show' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td class="p-4 text-center space-x-1">
                                    <a href="{{ route('client.edit', $item->title) }}"
                                        class="inline-block px-3 py-1.5 bg-cyan-500 hover:bg-cyan-600 text-white rounded-lg text-xs font-medium transition">
                                        @lang('common.edit')
                                    </a>
                                    <form action="{{ route('client.destroy', $item->title) }}" method="POST" class="inline"
                                        onsubmit="return confirm('@lang('admin.client_confirm_delete')')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-3 py-1.5 bg-rose-500 hover:bg-rose-600 text-white rounded-lg text-xs font-medium transition">
                                            @lang('common.delete')
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-slate-400">@lang('admin.client_empty')</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection