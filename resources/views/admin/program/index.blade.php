@extends('admin.layouts.admin')

@section('content')
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">@lang('admin.program_index_title')</h2>
            <a href="{{ route('program.create') }}"
                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-semibold shadow transition flex items-center gap-2">
                + @lang('common.add_data')
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-emerald-100 text-emerald-700 rounded-lg text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow overflow-hidden border border-gray-100">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-700 text-xs uppercase tracking-wider border-b border-gray-200">
                        <th class="p-4 w-16 text-center">@lang('common.no_label')</th>
                        <th class="p-4">@lang('common.title')</th>
                        <th class="p-4">@lang('admin.program_label_content')</th>
                        <th class="p-4 text-center">@lang('admin.program_label_icon')</th>
                        <th class="p-4 text-center">@lang('common.image')</th>
                        <th class="p-4 text-center">@lang('common.status')</th>
                        <th class="p-4 text-center">@lang('common.action')</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm text-gray-600">
                    @forelse($programs as $index => $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 text-center font-medium">{{ $index + 1 }}</td>
                            <td class="p-4 font-semibold text-gray-800">{{ $item->title }}</td>
                            <td class="p-4 max-w-xs truncate">{{ $item->content }}</td>
                            <td class="p-4 text-center">
                                @if($item->icon)
                                    <img src="{{ asset('storage/' . $item->icon) }}"
                                        class="w-10 h-10 object-contain mx-auto rounded bg-gray-50 p-1 border">
                                @else
                                    <span class="text-xs text-gray-400">@lang('admin.program_no_icon')</span>
                                @endif
                            </td>
                            <td class="p-4 text-center">
                                @if($item->img)
                                    <img src="{{ asset('storage/' . $item->img) }}"
                                        class="w-12 h-10 object-cover mx-auto rounded border">
                                @else
                                    <span class="text-xs text-gray-400">@lang('admin.program_no_image')</span>
                                @endif
                            </td>
                            <td class="p-4 text-center">
                                <span
                                    class="px-3 py-1 rounded-full text-xs font-semibold {{ $item->status == 'Show' ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td class="p-4 text-center space-x-1">
                                <a href="{{ route('program.edit', $item->id) }}"
                                    class="inline-block px-3 py-1.5 bg-cyan-500 hover:bg-cyan-600 text-white rounded-lg text-xs font-medium transition">
                                    @lang('common.edit')
                                </a>

                                <form action="{{ route('program.destroy', $item->id) }}" method="POST" class="inline"
                                    onsubmit="return confirm('@lang('admin.program_confirm_delete')')">
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
                            <td colspan="7" class="p-6 text-center text-gray-400">@lang('admin.program_empty')</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection