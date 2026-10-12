<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function show($slug)
    {
        // Cari berita berdasarkan slug di URL, jika tidak ada tampilkan 404
        $article = Article::with(['source', 'category'])->where('slug', $slug)->firstOrFail();
        
        // Cek apakah user yang sedang login sudah menyimpan berita ini
        $isBookmarked = false;
        if (Auth::check()) {
            $isBookmarked = Bookmark::where('user_id', Auth::id())
                                    ->where('article_id', $article->id)
                                    ->exists();
        }
        

        return view('pages.article-detail', compact('article', 'isBookmarked'));
    }
}