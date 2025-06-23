<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    // Menampilkan form upload
    public function create()
    {
        return view('upload');
    }

    // Menyimpan gambar ke storage dan database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Simpan file ke storage/app/public/images
        $imagePath = $request->file('image')->store('images', 'public');

        // Simpan data ke database
        $image = Image::create([
            'title' => $request->title,
            'image_path' => $imagePath,
        ]);

        return view('upload', ['image' => $image])
            ->with('success', 'Gambar berhasil diunggah.');
    }

    // Menghapus gambar dari database dan file fisiknya
    public function destroy($id)
    {
        $image = Image::findOrFail($id);

        // Hapus file fisik jika ada
        if (Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }

        // Hapus dari database
        $image->delete();

        return redirect()->back()->with('success', 'Gambar berhasil dihapus.');
    }
}