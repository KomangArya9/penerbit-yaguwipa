<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::latest()->get();
        return view('admin.program.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.program.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|unique:service,title',
            'content' => 'required',
            'status'  => 'required',
            'short'   => 'nullable',
            'icon'    => 'required|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'img'     => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'url'     => 'nullable|url',
        ]);

        $iconPath = $request->file('icon')->store('services/icons', 'public');
        $imgPath = $request->hasFile('img') ? $request->file('img')->store('services/images', 'public') : null;

        Program::create([
            'title'   => $request->title,
            'short'   => $request->short,
            'content' => $request->content,
            'icon'    => $iconPath,
            'img'     => $imgPath,
            'status'  => $request->status,
            'slug'    => Str::slug($request->title),
            'url'     => $request->url,
        ]);

        return redirect()->route('program.index')->with('success', 'Program berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $program = Program::findOrFail($id);
        return view('admin.program.edit', compact('program'));
    }

    public function update(Request $request, $id)
    {
        $program = Program::findOrFail($id);

        $request->validate([
            'title'   => 'required|unique:service,title,' . $id,
            'content' => 'required',
            'status'  => 'required',
            'short'   => 'nullable',
            'icon'    => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'img'     => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'url'     => 'nullable|url',
        ]);

        $iconPath = $program->icon;
        if ($request->hasFile('icon')) {
            if ($iconPath && Storage::disk('public')->exists($iconPath)) {
                Storage::disk('public')->delete($iconPath);
            }
            $iconPath = $request->file('icon')->store('services/icons', 'public');
        }

        $imgPath = $program->img;
        if ($request->hasFile('img')) {
            if ($imgPath && Storage::disk('public')->exists($imgPath)) {
                Storage::disk('public')->delete($imgPath);
            }
            $imgPath = $request->file('img')->store('services/images', 'public');
        }

        $program->update([
            'title'   => $request->title,
            'short'   => $request->short,
            'content' => $request->content,
            'icon'    => $iconPath,
            'img'     => $imgPath,
            'status'  => $request->status,
            'slug'    => Str::slug($request->title),
            'url'     => $request->url,
        ]);

        return redirect()->route('program.index')->with('success', 'Program berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $program = Program::findOrFail($id);

        if ($program->icon && Storage::disk('public')->exists($program->icon)) {
            Storage::disk('public')->delete($program->icon);
        }
        if ($program->img && Storage::disk('public')->exists($program->img)) {
            Storage::disk('public')->delete($program->img);
        }

        $program->delete();

        return redirect()->route('program.index')->with('success', 'Program berhasil dihapus!');
    }
}