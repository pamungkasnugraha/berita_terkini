<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    // Menampilkan halaman daftar bookmark user
    public function index()
    {
        $bookmarks = Bookmark::where('user_id', Auth::id())
                            ->with('article.source', 'article.category')
                            ->latest()
                            ->paginate(12);

        return view('pages.bookmarks', compact('bookmarks'));
    }

    // Logika simpan/hapus (Toggle)
    public function toggleBookmark($articleId)
    {
        $userId = Auth::id();
        $exists = Bookmark::where('user_id', $userId)->where('article_id', $articleId)->first();

        if ($exists) {
            $exists->delete();
            return back()->with('info', 'Berita dihapus dari simpanan.');
        }

        Bookmark::create([
            'user_id' => $userId,
            'article_id' => $articleId
        ]);

        return back()->with('success', 'Berita berhasil disimpan!');
    }
}