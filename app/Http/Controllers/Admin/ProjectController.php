<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\KategoriProject;
use App\Models\Program;
use App\Models\ProjectFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['kategoriProject', 'fotos'])->latest()->get();
        return view('admin.project.index', compact('projects'));
    }

    public function create()
    {
        $kategoriProjects = KategoriProject::all();
        $services = Program::all();
        return view('admin.project.create', compact('kategoriProjects', 'services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_project_id' => 'required',
            'id_service' => 'required',
            'date' => 'required|max:20',
            'title' => 'required|max:500|unique:project,title',
            'lokasi' => 'required',
            'content' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'hit' => 'nullable|integer',
            'url' => 'nullable',
            'status' => 'required|in:Show,Hide',
        ]);

        $project = Project::create([
            'kategori_project_id' => $request->kategori_project_id,
            'id_service' => $request->id_service,
            'date' => $request->date,
            'title' => $request->title,
            'lokasi' => $request->lokasi,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'hit' => $request->hit ?? 0,
            'url' => $request->url ?? '',
            'status' => $request->status,
        ]);

        if ($request->hasFile('img')) {
            $path = $request->file('img')->store('projects', 'public');

            $project->fotos()->create([
                'img' => $path
            ]);
        }

        return redirect()->route('admin.project.index')->with('success', 'Project beserta foto berhasil ditambahkan!');
    }

    public function edit(Project $project)
    {
        // Memuat relasi fotos agar data foto lama terpanggil dengan benar
        $project->load('fotos');
        $kategoriProjects = KategoriProject::all();
        $services = Program::all();
        return view('admin.project.edit', compact('project', 'kategoriProjects', 'services'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'kategori_project_id' => 'required',
            'id_service' => 'required',
            'date' => 'required|max:20',
            'title' => 'required|max:500|unique:project,title,' . $project->id,
            'lokasi' => 'required',
            'content' => 'required',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'hit' => 'nullable|integer',
            'url' => 'nullable',
            'status' => 'required|in:Show,Hide',
        ]);

        $project->update([
            'kategori_project_id' => $request->kategori_project_id,
            'id_service' => $request->id_service,
            'date' => $request->date,
            'title' => $request->title,
            'lokasi' => $request->lokasi,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'hit' => $request->hit ?? $project->hit,
            'url' => $request->url ?? '',
            'status' => $request->status,
        ]);

        if ($request->hasFile('img')) {
            $oldFoto = $project->fotos()->first();

            // Disamakan menggunakan folder 'projects'
            $photoPath = $request->file('img')->store('projects', 'public');

            if ($oldFoto) {
                if (Storage::disk('public')->exists($oldFoto->img)) {
                    Storage::disk('public')->delete($oldFoto->img);
                }
                $oldFoto->update([
                    'img' => $photoPath
                ]);
            } else {
                ProjectFoto::create([
                    'project_id' => $project->id,
                    'img' => $photoPath
                ]);
            }
        }

        return redirect()->route('admin.project.index')->with('success', 'Project berhasil diperbarui!');
    }

    public function destroy(Project $project)
    {
        foreach ($project->fotos as $foto) {
            if (Storage::disk('public')->exists($foto->img)) {
                Storage::disk('public')->delete($foto->img);
            }
            $foto->delete();
        }

        $project->delete();

        return redirect()->route('admin.project.index')->with('success', 'Project beserta seluruh fotonya berhasil dihapus!');
    }
}