@extends('admin.layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="p-8">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-800">Dashboard</h1>
        <p class="text-slate-500">Selamat datang di Admin Panel Penerbit Yaguwipa.</p>
    </div>

    <!-- Container Statistik -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
        @php
            // Menggunakan ?? 0 agar jika $data tidak ada, dia otomatis jadi 0
            $stats = [
                ['label' => 'Total Catalog', 'value' => $data['totalCatalog'] ?? 0],
                ['label' => 'Total Blog',    'value' => $data['totalBlog'] ?? 0],
                ['label' => 'Total Project', 'value' => $data['totalProject'] ?? 0],
                ['label' => 'Total Review',  'value' => $data['totalReview'] ?? 0],
                ['label' => 'Total Authors', 'value' => $data['totalAuthors'] ?? 0],
            ];
        @endphp

        @foreach($stats as $item)
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <h3 class="text-slate-500 text-sm font-medium">{{ $item['label'] }}</h3>
            <p class="text-3xl font-bold text-slate-800 mt-2">{{ $item['value'] }}</p>
        </div>
        @endforeach
    </div>
</div>
@endsection