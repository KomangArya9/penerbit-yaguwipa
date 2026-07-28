<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function index()
    {
        // Mengambil data tanpa klausa order by yang mencari kolom id/created_at
        $clients = Client::all();
        return view('admin.client.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.client.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'status' => 'required',
            'url' => 'required|url',
        ]);

        $imagePath = $request->file('img')->store('clients', 'public');

        Client::create([
            'title' => $request->title,
            'img' => $imagePath,
            'status' => $request->status,
            'url' => $request->url,
        ]);

        return redirect()->route('client.index')->with('success', 'Client berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('admin.client.edit', compact('client'));
    }

    public function update(Request $request, $title)
    {
        $client = Client::findOrFail($title);

        $request->validate([
            'title' => 'required',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'status' => 'required',
            'url' => 'required|url',
        ]);

        $imagePath = $client->img;
        if ($request->hasFile('img')) {
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('img')->store('clients', 'public');
        }

        $client->update([
            'title' => $request->title,
            'img' => $imagePath,
            'status' => $request->status,
            'url' => $request->url,
        ]);

        return redirect()->route('client.index')->with('success', 'Client berhasil diubah!');
    }

    public function destroy($title)
    {
        $client = Client::findOrFail($title);

        if ($client->img && Storage::disk('public')->exists($client->img)) {
            Storage::disk('public')->delete($client->img);
        }

        $client->delete();

        return redirect()->route('client.index')->with('success', 'Client berhasil dihapus!');
    }
}