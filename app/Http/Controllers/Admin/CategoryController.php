<?php

namespace App\Http\Controllers\Admin; // <-- Ini wajib ada dan harus persis seperti ini

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // Menampilkan daftar kategori dan form tambah
    public function index()
    {
        // Mengambil data kategori beserta jumlah berita di dalamnya
        $categories = Category::withCount('articles')->latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    // Menyimpan kategori baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name'
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique' => 'Kategori ini sudah ada di database.'
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return back()->with('success', 'Kategori baru berhasil ditambahkan!');
    }

    // Menghapus kategori
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        
        // Proteksi: Jangan izinkan hapus jika masih ada berita di dalamnya
        if ($category->articles()->count() > 0) {
            return back()->with('error', 'Gagal dihapus! Kategori ini masih dipakai oleh beberapa berita.');
        }

        $category->delete();
        return back()->with('success', 'Kategori berhasil dihapus!');
    }
}