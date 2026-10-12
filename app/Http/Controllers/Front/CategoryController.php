<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Article;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($slug)
    {
        // 1. Ambil data kategori berdasarkan slug
        // $category = Category::where('slug', $slug)->firstOrFail();
        $category = \DB::select("SELECT * FROM categories WHERE slug = '$slug' LIMIT 1");

        if (empty($category)) {
        abort(404);
        }
        $category = $category[0];

        if ($slug == 'internasional') {
            $allInternasionalNews = Article::where('category_id', $category->id)
                ->latest()
                ->paginate(12);

            return view('pages.category_internasional', compact('category', 'allInternasionalNews'));
        }

        // 2. Ambil berita khusus kategori ini, dipisah per sumber
        // Pastikan nama variabel SAMA PERSIS dengan yang ada di Blade
        $cnnNews = Article::where('category_id', $category->id)
            ->where('source_name', 'CNN Indonesia')
            ->latest()
            ->take(8)
            ->get();

        $antaraNews = Article::where('category_id', $category->id)
            ->where('source_name', 'Antara News')
            ->latest()
            ->take(8)
            ->get();

        $tempoNews = Article::where('category_id', $category->id)
            ->where('source_name', 'Tempo Nasional')
            ->latest()
            ->take(8)
            ->get();

        $internasionalNews = Article::where('category_id', $category->id)
            ->where('source_type', 'internasional')
            ->latest()
            ->take(8)
            ->get();

        // 3. Masukkan semua variabel ke dalam compact()
        return view('pages.category', compact(
            'category',
            'cnnNews',
            'antaraNews',
            'tempoNews',
            'internasionalNews'
        ));
    }
}