<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ManageArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with(['source', 'category'])
                    ->latest('published_at')
                    ->paginate(20);

        return view('admin.articles.index', compact('articles'));
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('admin.articles.index')
                         ->with('success', 'Berita berhasil dihapus.');
    }

    // 👇 TAMBAHAN BARU: Fungsi untuk mengubah status Draft <-> Published
    public function toggleStatus($id)
    {
        $article = Article::findOrFail($id);
        
        // Cek status saat ini, lalu balikkan nilainya
        if ($article->status === 'published') {
            $article->status = 'draft';
        } else {
            $article->status = 'published';
        }
        
        $article->save();

        return back()->with('success', 'Status berita berhasil diubah menjadi ' . strtoupper($article->status) . '!');
    }
}