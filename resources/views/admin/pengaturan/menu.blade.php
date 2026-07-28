@extends('admin.layouts.admin')

@section('content')
<div class="p-8">
    <h1 class="text-2xl font-bold mb-6">Menu Manager</h1>

    <!-- Tombol Add Data -->
    <button class="bg-blue-600 text-white px-4 py-2 rounded mb-4">+ Add Data</button>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-slate-100">
                <tr>
                    <th class="p-4">No</th>
                    <th class="p-4">Title</th>
                    <th class="p-4">Status</th>
                    <th class="p-4">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($menus as $index => $menu)
                <tr class="border-t">
                    <td class="p-4">{{ $index + 1 }}</td>
                    <td class="p-4">{{ $menu->title }}</td>
                    <td class="p-4">
                        <span class="px-2 py-1 text-xs text-white rounded {{ $menu->status == 'Show' ? 'bg-green-600' : 'bg-red-600' }}">
                            {{ $menu->status }}
                        </span>
                    </td>
                    <td class="p-4">
                        <button class="bg-sky-500 text-white px-3 py-1 rounded text-sm">Edit</button>
                        <button class="bg-red-500 text-white px-3 py-1 rounded text-sm">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection