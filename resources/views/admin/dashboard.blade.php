@extends('admin.layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="p-8">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-800">@lang('admin.dashboard_title')</h1>
        <p class="text-slate-500">@lang('admin.dashboard_welcome')</p>
    </div>

    <!-- Container Statistik -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
        @php
            // Menggunakan ?? 0 agar jika $data tidak ada, dia otomatis jadi 0
            $stats = [
                ['label' => __('admin.dashboard_stats_total_catalog'), 'value' => $data['totalCatalog'] ?? 0],
                ['label' => __('admin.dashboard_stats_total_blog'),    'value' => $data['totalBlog'] ?? 0],
                ['label' => __('admin.dashboard_stats_total_project'), 'value' => $data['totalProject'] ?? 0],
                ['label' => __('admin.dashboard_stats_total_review'),  'value' => $data['totalReview'] ?? 0],
                ['label' => __('admin.dashboard_stats_total_authors'), 'value' => $data['totalAuthors'] ?? 0],
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