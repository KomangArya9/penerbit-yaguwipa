@extends('admin.layouts.admin')

@section('content')
<div class="p-6 max-w-7xl mx-auto bg-white rounded-xl shadow border border-gray-100">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">@lang('admin.ulasan_index_title')</h2>

    @if(session('success'))
        <div class="mb-4 p-4 bg-emerald-100 text-emerald-700 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b bg-gray-50 text-gray-600 text-sm">
                    <th class="p-3">@lang('common.no_label')</th>
                    <th class="p-3">@lang('admin.ulasan_label_catalog')</th>
                    <th class="p-3">@lang('admin.ulasan_label_name')</th>
                    <th class="p-3">@lang('admin.ulasan_label_review')</th>
                    <th class="p-3">@lang('common.rating')</th>
                    <th class="p-3">@lang('common.status')</th>
                    <th class="p-3 text-center">@lang('common.action')</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-700">
                @forelse($ulasans as $index => $item)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">{{ $index + 1 }}</td>
                    <td class="p-3 font-medium">{{ $item->catalog->judul ?? __('admin.ulasan_catalog_deleted') }}</td>
                    <td class="p-3">{{ $item->nama }}</td>
                    <td class="p-3">{{ $item->ulasan }}</td>
                    <td class="p-3">{{ $item->stars }} @lang('common.stars')</td>
                    <td class="p-3">
                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold 
                            {{ $item->status == 'Show' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                            {{ $item->status }}
                        </span>
                    </td>
                    <td class="p-3 text-center space-x-2">
                        <!-- Form untuk Ubah Status (Approve / Sembunyikan) -->
                        <form action="{{ route('admin.ulasan.updateStatus', $item->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('PUT')
                            @if($item->status == 'Pending')
                                <input type="hidden" name="status" value="Show">
                                <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded text-xs hover:bg-blue-700">@lang('admin.ulasan_button_approve')</button>
                            @else
                                <input type="hidden" name="status" value="Pending">
                                <button type="submit" class="px-3 py-1 bg-gray-500 text-white rounded text-xs hover:bg-gray-600">@lang('admin.ulasan_button_hide')</button>
                            @endif
                        </form>

                        <!-- Tombol Hapus -->
                        <form action="{{ route('admin.ulasan.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('@lang('admin.ulasan_confirm_delete')')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-rose-600 text-white rounded text-xs hover:bg-rose-700">@lang('common.delete')</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="p-4 text-center text-gray-400">@lang('admin.ulasan_empty')</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection