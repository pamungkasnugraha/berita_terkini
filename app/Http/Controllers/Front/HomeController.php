<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
// Pastikan Anda memanggil Facades Cache dan Request
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // 1. MATIKAN SCRAPER DI SINI! (Sangat Penting)
        // Jalankan scraper menggunakan php artisan schedule:run di background, BUKAN di controller.
        // app(\App\Services\NewsScraperService::class)->fetchBeritaTerbaru();

        // Tentukan lama cache dalam detik (Contoh: 600 detik = 10 Menit)
        $cacheWaktu = 600;

        // 2. Ambil 5 berita paling baru (untuk Headline atas) dengan Cache Pagination
        $page = $request->get('page', 1);
        $latestArticles = Cache::remember('headline_news_page_' . $page, $cacheWaktu, function () {
            return Article::latest('published_at')->paginate(8);
        });

        // 3. Cache Berita CNN
        $cnnNews = Cache::remember('cnn_news_home', $cacheWaktu, function () {
            return Article::where('source_name', 'CNN Indonesia')
                ->latest('published_at')
                ->take(8)
                ->get();
        });

        // 4. Cache Berita Antara
        $antaraNews = Cache::remember('antara_news_home', $cacheWaktu, function () {
            return Article::where('source_name', 'Antara News')
                ->latest('published_at')
                ->take(8)
                ->get();
        });

        // 5. Cache Berita Tempo
        $tempoNews = Cache::remember('tempo_news_home', $cacheWaktu, function () {
            return Article::where('source_name', 'Tempo Nasional')
                ->latest('published_at')
                ->take(8)
                ->get();
        });

        // 6. Cache Berita Internasional
        $internasionalNews = Cache::remember('internasional_news_home', $cacheWaktu, function () {
            return Article::where('source_type', 'internasional')
                ->latest('published_at')
                ->take(5)
                ->get();
        });

        return view('pages.home', compact('latestArticles', 'cnnNews', 'antaraNews', 'tempoNews', 'internasionalNews'));
    }
}