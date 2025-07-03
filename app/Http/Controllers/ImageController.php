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
        \Log::info('Akses halaman upload gambar', ['user_id' => \Auth::id(), 'ip' => request()->ip()]);
        return view('upload');
    }

    // Menyimpan gambar ke storage dan database
    public function store(Request $request)
    {
        \Log::info('Proses upload gambar dimulai', ['user_id' => \Auth::id(), 'ip' => $request->ip(), 'request' => $request->all()]);
        try {
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

            \Log::info('Berhasil upload gambar', ['user_id' => \Auth::id(), 'image_id' => $image->id, 'title' => $image->title]);
            return view('upload', ['image' => $image])
                ->with('success', 'Gambar berhasil diunggah.');
        } catch (\Throwable $e) {
            \Log::error('Gagal upload gambar: ' . $e->getMessage(), [
                'user_id' => \Auth::id(),
                'request' => $request->all(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return back()->with('error', 'Terjadi kesalahan saat upload gambar.');
        }
    }

    // Menghapus gambar dari database dan file fisiknya
    public function destroy($id)
    {
        \Log::info('Proses hapus gambar dimulai', ['user_id' => \Auth::id(), 'image_id' => $id, 'ip' => request()->ip()]);
        try {
            $image = Image::findOrFail($id);

            // Hapus file fisik jika ada
            if (Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }

            // Hapus dari database
            $image->delete();

            \Log::info('Berhasil hapus gambar', ['user_id' => \Auth::id(), 'image_id' => $id]);
            return redirect()->back()->with('success', 'Gambar berhasil dihapus.');
        } catch (\Throwable $e) {
            \Log::error('Gagal hapus gambar: ' . $e->getMessage(), [
                'user_id' => \Auth::id(),
                'image_id' => $id,
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return back()->with('error', 'Terjadi kesalahan saat menghapus gambar.');
        }
    }
}