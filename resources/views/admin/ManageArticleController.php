<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ManageArticleController extends Controller
{
    public function index()
    {
        // Mengambil semua artikel beserta sumber dan kategori, diurutkan dari yang terbaru
        $articles = Article::with(['category', 'source'])->latest('published_at')->paginate(15);
        return view('admin.articles.index', compact('articles'));
    }

    public function destroy($id)
    {
        // Fitur hapus berita jika ada hasil scraping yang tidak relevan (spam)
        Article::findOrFail($id)->delete();
        return back()->with('success', 'Berita berhasil dihapus dari sistem.');
    }
}