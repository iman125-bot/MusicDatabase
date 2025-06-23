<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Music;

class MusicController extends Controller
{
    public function index()
    {
        $musics = Music::all();
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
        ]);

        Music::create($request->all());

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
        ]);

        $music = Music::find($id);
        if (!$music) {
            return redirect()->route('musics.index')
                ->with('error', 'Music not found.');
        }

        $music->update($request->all());

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