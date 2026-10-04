<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuManagerController extends Controller
{
    public function index()
    {
        $this->resequenceMenus();
        
        // Ambil parent beserta children-nya terurut rapi
        $parents = Menu::with(['children' => function($q) {
            $q->orderBy('urutan', 'asc');
        }])->whereNull('parent_id')->orderBy('urutan', 'asc')->get();

        $data_menu = collect();
        foreach ($parents as $parent) {
            $data_menu->push($parent);
            foreach ($parent->children as $child) {
                $data_menu->push($child);
            }
        }

        $totalMenu = Menu::count();
        $totalShow = Menu::where('status', 'Show')->count();
        $totalHide = Menu::where('status', 'Hide')->count();

        return view('admin.menu.index', compact('data_menu', 'totalMenu', 'totalShow', 'totalHide'));
    }

    public function create()
    {
        $parentMenus = Menu::whereNull('parent_id')->orderBy('urutan', 'asc')->get();
        $nextUrutan = (Menu::whereNull('parent_id')->max('urutan') ?? 0) + 1;
        return view('admin.menu.create', compact('parentMenus', 'nextUrutan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'status' => 'required|in:Show,Hide',
            'parent_id' => 'nullable|exists:menus,id',
            'urutan' => 'nullable|integer',
        ]);

        $parentId = $request->parent_id ?: null;
        $data = $request->only(['title', 'url', 'status']);
        $data['parent_id'] = $parentId;

        $targetUrutan = (int)($request->urutan ?? 0);
        $maxUrutan = Menu::where('parent_id', $parentId)->max('urutan') ?? 0;

        if ($targetUrutan > 0 && $targetUrutan <= $maxUrutan) {
            // Geser menu yang sama-sama ber-urutan >= targetUrutan ke bawah (tambah 1)
            Menu::where('parent_id', $parentId)
                ->where('urutan', '>=', $targetUrutan)
                ->increment('urutan');
            $data['urutan'] = $targetUrutan;
        } else {
            $data['urutan'] = $maxUrutan + 1;
        }

        Menu::create($data);
        $this->resequenceMenus();

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $parentMenus = Menu::whereNull('parent_id')->where('id', '!=', $id)->orderBy('urutan', 'asc')->get();
        return view('admin.menu.edit', compact('menu', 'parentMenus'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'status' => 'required|in:Show,Hide',
            'parent_id' => 'nullable|exists:menus,id',
            'urutan' => 'nullable|integer',
        ]);

        $menu = Menu::findOrFail($id);
        $data = $request->only(['title', 'url', 'status']);

        // Cegah self-parent
        $newParentId = ($request->parent_id && $request->parent_id != $id) ? $request->parent_id : null;
        $oldParentId = $menu->parent_id;
        $data['parent_id'] = $newParentId;

        $newUrutan = (int)($request->urutan ?? $menu->urutan ?? 1);
        $oldUrutan = (int)($menu->urutan ?? 1);

        if ($oldParentId === $newParentId) {
            if ($newUrutan < $oldUrutan) {
                Menu::where('parent_id', $newParentId)
                    ->where('id', '!=', $id)
                    ->whereBetween('urutan', [$newUrutan, $oldUrutan - 1])
                    ->increment('urutan');
            } elseif ($newUrutan > $oldUrutan) {
                Menu::where('parent_id', $newParentId)
                    ->where('id', '!=', $id)
                    ->whereBetween('urutan', [$oldUrutan + 1, $newUrutan])
                    ->decrement('urutan');
            }
        } else {
            // Pindah parent: tutup celah di parent lama
            Menu::where('parent_id', $oldParentId)
                ->where('id', '!=', $id)
                ->where('urutan', '>', $oldUrutan)
                ->decrement('urutan');

            // Beri ruang di parent baru
            Menu::where('parent_id', $newParentId)
                ->where('urutan', '>=', $newUrutan)
                ->increment('urutan');
        }

        $data['urutan'] = $newUrutan;
        $menu->update($data);
        $this->resequenceMenus();

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function toggleStatus($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->status = ($menu->status === 'Show') ? 'Hide' : 'Show';
        $menu->save();

        return redirect()->back()->with('success', 'Status menu "' . $menu->title . '" berhasil diubah menjadi ' . $menu->status . '.');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        Menu::where('parent_id', $id)->update(['parent_id' => null]);
        $menu->delete();
        $this->resequenceMenus();

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil dihapus!');
    }

    // Menampilkan halaman struktur menu (Sorting Data)
    public function sorting()
    {
        $this->resequenceMenus();
        $menus = Menu::with(['children' => function($q) {
            $q->orderBy('urutan', 'asc');
        }])->whereNull('parent_id')->orderBy('urutan', 'asc')->get();

        return view('admin.menu.sorting', compact('menus'));
    }

    // Simpan urutan massal dari halaman sorting dengan normalisasi tanpa duplikasi
    public function updateSorting(Request $request)
    {
        $request->validate([
            'urutan' => 'required|array',
            'urutan.*' => 'required|integer',
        ]);

        // Urutkan input berdasarkan angka urutan secara ascending
        $submittedUrutan = $request->urutan;
        asort($submittedUrutan);

        // Pisahkan parent dan children agar re-index berurutan per kelompok parent/child
        $allMenuIds = array_keys($submittedUrutan);
        $menusDb = Menu::whereIn('id', $allMenuIds)->get()->keyBy('id');

        $parentItems = [];
        $childItems = [];

        foreach ($submittedUrutan as $id => $val) {
            $item = $menusDb->get($id);
            if ($item) {
                if (is_null($item->parent_id)) {
                    $parentItems[$id] = $val;
                } else {
                    $childItems[$item->parent_id][$id] = $val;
                }
            }
        }

        // Terapkan urutan 1, 2, 3... berurutan tanpa celah atau nomor kembar untuk Parent
        $parentRank = 1;
        foreach ($parentItems as $id => $val) {
            Menu::where('id', $id)->update(['urutan' => $parentRank++]);
        }

        // Terapkan urutan 1, 2, 3... untuk masing-masing Child di tiap Parent
        foreach ($childItems as $pId => $children) {
            $childRank = 1;
            foreach ($children as $cId => $cVal) {
                Menu::where('id', $cId)->update(['urutan' => $childRank++]);
            }
        }

        // Jalankan normalisasi akhir
        $this->resequenceMenus();

        return redirect()->route('admin.menu.sorting')->with('success', 'Urutan menu navigasi berhasil disimpan dan dinormalisasi tanpa duplikasi!');
    }

    /**
     * Memastikan setiap menu di level yang sama memiliki nomor urutan (1, 2, 3...) yang unik dan berurutan
     */
    private function resequenceMenus()
    {
        // 1. Resequence Menu Utama (Top-level / Parent)
        $parents = Menu::whereNull('parent_id')
            ->orderBy('urutan', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        foreach ($parents as $index => $parent) {
            $expectedUrutan = $index + 1;
            if ($parent->urutan !== $expectedUrutan) {
                Menu::where('id', $parent->id)->update(['urutan' => $expectedUrutan]);
            }

            // 2. Resequence Sub-menu (Children) di bawah parent ini
            $children = Menu::where('parent_id', $parent->id)
                ->orderBy('urutan', 'asc')
                ->orderBy('id', 'asc')
                ->get();

            foreach ($children as $cIndex => $child) {
                $childExpected = $cIndex + 1;
                if ($child->urutan !== $childExpected) {
                    Menu::where('id', $child->id)->update(['urutan' => $childExpected]);
                }
            }
        }
    }
}