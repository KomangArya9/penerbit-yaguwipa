@extends('admin.layouts.admin')

@section('title', 'Atur Urutan Menu')

@section('content')
<div class="p-8 max-w-4xl mx-auto">
    <!-- Header & Tombol Kembali -->
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Atur Urutan Menu Navigasi</h1>
            <p class="text-slate-500 text-sm mt-1">Ubah angka urutan menu untuk menentukan posisi tampilannya dari kiri ke kanan pada website.</p>
        </div>
        <a href="{{ route('admin.menu.index') }}"
            class="inline-flex items-center gap-1.5 px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-sm font-medium transition">
            &larr; Kembali ke Daftar Menu
        </a>
    </div>

    <!-- Alert Sukses -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl flex items-center gap-2 shadow-sm">
            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <form action="{{ route('admin.menu.updateSorting') }}" method="POST" id="sortingForm">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-6">
            <div class="p-4 bg-slate-50 border-b border-slate-200 flex justify-between items-center text-xs font-semibold text-slate-600 uppercase tracking-wider">
                <span>Struktur & Posisi Menu</span>
                <span>Atur Posisi Urutan</span>
            </div>

            <div class="divide-y divide-slate-100 p-2" id="parentMenuList">
                @forelse($menus as $menu)
                    <!-- Group Menu Item -->
                    <div class="menu-item-group py-2" data-id="{{ $menu->id }}">
                        <!-- Item Menu Utama -->
                        <div class="p-3.5 hover:bg-slate-50/80 rounded-lg flex items-center justify-between gap-4 transition bg-white border border-slate-100">
                            <div class="flex items-center gap-3">
                                <span class="position-badge w-6 h-6 rounded-md bg-slate-100 text-slate-700 font-mono text-xs font-bold flex items-center justify-center border border-slate-200">
                                    {{ $menu->urutan }}
                                </span>
                                <div>
                                    <span class="font-semibold text-slate-800 text-sm">{{ $menu->title }}</span>
                                    <span class="ml-2 font-mono text-xs text-slate-400">/{{ ltrim($menu->url, '/') }}</span>
                                    @if($menu->status === 'Hide')
                                        <span class="ml-2 px-2 py-0.5 rounded text-[10px] font-semibold bg-slate-200 text-slate-600">Hidden</span>
                                    @endif
                                </div>
                            </div>

                            <div class="flex items-center gap-2">
                                <!-- Tombol Naik / Turun Cepat -->
                                <div class="flex items-center bg-slate-100 p-0.5 rounded-lg border border-slate-200">
                                    <button type="button" onclick="moveItem(this, -1)" title="Geser ke Atas"
                                        class="p-1 hover:bg-white text-slate-600 hover:text-slate-900 rounded transition cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7"/>
                                        </svg>
                                    </button>
                                    <button type="button" onclick="moveItem(this, 1)" title="Geser ke Bawah"
                                        class="p-1 hover:bg-white text-slate-600 hover:text-slate-900 rounded transition cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </button>
                                </div>

                                <span class="text-xs text-slate-400 ml-1">No:</span>
                                <input type="number" name="urutan[{{ $menu->id }}]" value="{{ $menu->urutan ?? 0 }}" min="1" max="{{ count($menus) }}"
                                    class="urutan-input w-16 border border-slate-300 rounded-lg py-1 px-2 text-center text-sm font-semibold focus:ring-2 focus:ring-red-500 focus:outline-none"
                                    onchange="handlePositionChange(this)">
                            </div>
                        </div>

                        <!-- Sub Menu jika ada -->
                        @if($menu->children && $menu->children->count() > 0)
                            <div class="child-menu-list pl-10 pr-2 py-1.5 space-y-1 bg-slate-50/50 rounded-lg my-1.5 border border-dashed border-slate-200">
                                @foreach($menu->children as $child)
                                    <div class="child-item p-2.5 bg-white border border-slate-200/80 rounded-lg flex items-center justify-between gap-4 shadow-2xs" data-id="{{ $child->id }}">
                                        <div class="flex items-center gap-2.5">
                                            <span class="text-slate-400 text-xs">↳</span>
                                            <span class="child-position-badge text-[11px] font-mono px-1.5 py-0.5 rounded bg-slate-100 text-slate-600 font-semibold border border-slate-200">
                                                #{{ $child->urutan }}
                                            </span>
                                            <span class="font-medium text-slate-700 text-sm">{{ $child->title }}</span>
                                            <span class="ml-2 font-mono text-xs text-slate-400">/{{ ltrim($child->url, '/') }}</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <div class="flex items-center bg-slate-100 p-0.5 rounded border border-slate-200">
                                                <button type="button" onclick="moveChildItem(this, -1)" title="Geser ke Atas"
                                                    class="p-0.5 hover:bg-white text-slate-600 rounded transition cursor-pointer">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7"/>
                                                    </svg>
                                                </button>
                                                <button type="button" onclick="moveChildItem(this, 1)" title="Geser ke Bawah"
                                                    class="p-0.5 hover:bg-white text-slate-600 rounded transition cursor-pointer">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                                                    </svg>
                                                </button>
                                            </div>
                                            <input type="number" name="urutan[{{ $child->id }}]" value="{{ $child->urutan ?? 0 }}" min="1" max="{{ $menu->children->count() }}"
                                                class="child-urutan-input w-14 border border-slate-300 rounded-lg py-0.5 px-2 text-center text-xs font-semibold focus:ring-2 focus:ring-red-500 focus:outline-none"
                                                onchange="handleChildPositionChange(this)">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="p-8 text-center text-slate-400 text-sm">
                        Belum ada menu untuk diurutkan.
                    </div>
                @endforelse
            </div>
        </div>

        @if(count($menus) > 0)
            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.menu.index') }}"
                    class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-sm font-medium transition">
                    Batal
                </a>
                <button type="submit"
                    class="px-6 py-2.5 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white rounded-lg text-sm font-semibold transition shadow-sm flex items-center gap-2 cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan Perubahan Urutan
                </button>
            </div>
        @endif
    </form>
</div>

<script>
    function moveItem(btn, direction) {
        const itemGroup = btn.closest('.menu-item-group');
        const parentList = document.getElementById('parentMenuList');
        if (direction === -1) {
            const prev = itemGroup.previousElementSibling;
            if (prev && prev.classList.contains('menu-item-group')) {
                parentList.insertBefore(itemGroup, prev);
            }
        } else if (direction === 1) {
            const next = itemGroup.nextElementSibling;
            if (next && next.classList.contains('menu-item-group')) {
                parentList.insertBefore(next, itemGroup);
            }
        }
        renumberAll();
    }

    function moveChildItem(btn, direction) {
        const childItem = btn.closest('.child-item');
        const list = childItem.closest('.child-menu-list');
        if (direction === -1) {
            const prev = childItem.previousElementSibling;
            if (prev && prev.classList.contains('child-item')) {
                list.insertBefore(childItem, prev);
            }
        } else if (direction === 1) {
            const next = childItem.nextElementSibling;
            if (next && next.classList.contains('child-item')) {
                list.insertBefore(next, childItem);
            }
        }
        renumberChildren(list);
    }

    function handlePositionChange(input) {
        const itemGroup = input.closest('.menu-item-group');
        const parentList = document.getElementById('parentMenuList');
        const allGroups = Array.from(parentList.querySelectorAll(':scope > .menu-item-group'));
        let targetPos = parseInt(input.value);
        if (isNaN(targetPos) || targetPos < 1) targetPos = 1;
        if (targetPos > allGroups.length) targetPos = allGroups.length;

        const currentIndex = allGroups.indexOf(itemGroup);
        if (currentIndex !== -1 && currentIndex !== (targetPos - 1)) {
            allGroups.splice(currentIndex, 1);
            allGroups.splice(targetPos - 1, 0, itemGroup);
            allGroups.forEach(group => parentList.appendChild(group));
        }
        renumberAll();
    }

    function handleChildPositionChange(input) {
        const childItem = input.closest('.child-item');
        const list = childItem.closest('.child-menu-list');
        const allChildren = Array.from(list.querySelectorAll(':scope > .child-item'));
        let targetPos = parseInt(input.value);
        if (isNaN(targetPos) || targetPos < 1) targetPos = 1;
        if (targetPos > allChildren.length) targetPos = allChildren.length;

        const currentIndex = allChildren.indexOf(childItem);
        if (currentIndex !== -1 && currentIndex !== (targetPos - 1)) {
            allChildren.splice(currentIndex, 1);
            allChildren.splice(targetPos - 1, 0, childItem);
            allChildren.forEach(item => list.appendChild(item));
        }
        renumberChildren(list);
    }

    function renumberAll() {
        const items = document.querySelectorAll('#parentMenuList > .menu-item-group');
        items.forEach((item, index) => {
            const num = index + 1;
            const input = item.querySelector('.urutan-input');
            const badge = item.querySelector('.position-badge');
            if (input) input.value = num;
            if (badge) badge.innerText = num;
        });
    }

    function renumberChildren(container) {
        if (!container) return;
        const children = container.querySelectorAll('.child-item');
        children.forEach((child, index) => {
            const num = index + 1;
            const input = child.querySelector('.child-urutan-input');
            const badge = child.querySelector('.child-position-badge');
            if (input) input.value = num;
            if (badge) badge.innerText = '#' + num;
        });
    }

    document.getElementById('sortingForm')?.addEventListener('submit', function() {
        renumberAll();
        document.querySelectorAll('.child-menu-list').forEach(list => renumberChildren(list));
    });
</script>
@endsection