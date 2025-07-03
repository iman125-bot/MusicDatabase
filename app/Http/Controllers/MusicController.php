<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Music;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class MusicController extends Controller
{
    public function index()
    {
        $query = request('q');
        $musicQuery = Music::query();
        if ($query) {
            $musicQuery->where(function($q) use ($query) {
                $q->where('title', 'like', "%$query%")
                  ->orWhere('artist', 'like', "%$query%")
                  ->orWhere('album', 'like', "%$query%")
                  ->orWhere('genre', 'like', "%$query%")
                  ->orWhere('year', 'like', "%$query%") ;
            });
        }
        $musics = $musicQuery->get()->groupBy(function($item) {
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
        try {
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

            $music = Music::create($data);
            Log::info('Berhasil menyimpan data musik', [
                'user_id' => Auth::id(),
                'music_id' => $music->id,
                'title' => $music->title,
                'request' => $request->all()
            ]);

            return redirect()->route('musics.index')
                ->with('success', 'Music created successfully.');
        } catch (\Throwable $e) {
            Log::error('Gagal menyimpan data musik: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'request' => $request->all(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
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

        try {
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
            Log::info('Berhasil mengupdate data musik', [
                'user_id' => Auth::id(),
                'music_id' => $music->id,
                'title' => $music->title,
                'request' => $request->all()
            ]);

            return redirect()->route('musics.index')
                ->with('success', 'Music updated successfully.');
        } catch (\Throwable $e) {
            Log::error('Gagal mengupdate data musik: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'music_id' => $id,
                'request' => $request->all(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return back()->with('error', 'Terjadi kesalahan saat mengupdate data.');
        }
    }

    public function destroy($id)
    {
        $music = Music::find($id);
        if (!$music) {
            return redirect()->route('musics.index')
                ->with('error', 'Music not found.');
        }
        try {
            $music->delete();
            Log::info('Berhasil menghapus data musik', [
                'user_id' => Auth::id(),
                'music_id' => $music->id,
                'title' => $music->title
            ]);
            return redirect()->route('musics.index')
                ->with('success', 'Music deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('Gagal menghapus data musik: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'music_id' => $id,
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return back()->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }
}