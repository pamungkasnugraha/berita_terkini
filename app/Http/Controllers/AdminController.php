<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Source;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_articles' => Article::count(),
            'total_categories' => Category::count(),
            'total_sources' => Source::count(),
        ];
        
        $articles = Article::latest()->take(10)->get();
        return view('admin.dashboard', compact('stats', 'articles'));
    }

    public function deleteArticle($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->back()->with('success', 'Artikel berhasil dihapus.');
    }
}