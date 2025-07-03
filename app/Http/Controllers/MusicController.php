<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Music;

class MusicController extends Controller
{
    public function index()
    {
        $musics = Music::all()->groupBy(function($item) {
            return $item->genre ? ucfirst($item->genre) : 'Unknown Genre';
        })->sortKeys();
        return view('musics.index', compact('musics'));
    }

    public function create()
    {
        return view('musics.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'album' => 'nullable|string|max:255',
            'year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'genre' => 'nullable|string|max:100',
            'duration' => 'nullable|string|max:8',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'music_file' => 'nullable|file|mimes:mp3,wav|max:20480',
        ]);

        $data = $request->all();
        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $coverPath = $file->store('covers', 'public');
            $data['cover_image'] = $coverPath;
        }
        if ($request->hasFile('music_file')) {
            $file = $request->file('music_file');
            $musicPath = $file->store('musics', 'public');
            $data['file_path'] = $musicPath;
        }

        Music::create($data);

        return redirect()->route('musics.index')
            ->with('success', 'Music created successfully.');
    }

    public function edit($id)
    {
        try {
            $music = Music::findOrFail($id);
            return view('musics.edit', compact('music'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('musics.index')
                ->with('error', 'Music not found.');
        }
    }

    public function show($id)
    {
        $music = Music::findOrFail($id);

        return view('musics.show', compact('music'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'album' => 'nullable|string|max:255',
            'year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'genre' => 'nullable|string|max:100',
            'duration' => 'nullable|string|max:8',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'music_file' => 'nullable|file|mimes:mp3,wav|max:20480',
        ]);

        $music = Music::find($id);
        if (!$music) {
            return redirect()->route('musics.index')
                ->with('error', 'Music not found.');
        }

        $data = $request->all();
        if ($request->hasFile('cover_image')) {
            // Hapus cover lama jika ada
            if ($music->cover_image && \Storage::disk('public')->exists($music->cover_image)) {
                \Storage::disk('public')->delete($music->cover_image);
            }
            $file = $request->file('cover_image');
            $coverPath = $file->store('covers', 'public');
            $data['cover_image'] = $coverPath;
        }
        if ($request->hasFile('music_file')) {
            // Hapus file musik lama jika ada
            if ($music->file_path && \Storage::disk('public')->exists($music->file_path)) {
                \Storage::disk('public')->delete($music->file_path);
            }
            $file = $request->file('music_file');
            $musicPath = $file->store('musics', 'public');
            $data['file_path'] = $musicPath;
        }

        $music->update($data);

        return redirect()->route('musics.index')
            ->with('success', 'Music updated successfully.');
    }

    public function destroy($id)
    {
        $music = Music::find($id);
        if (!$music) {
            return redirect()->route('musics.index')
                ->with('error', 'Music not found.');
        }

        $music->delete();

        return redirect()->route('musics.index')
            ->with('success', 'Music deleted successfully.');
    }
}