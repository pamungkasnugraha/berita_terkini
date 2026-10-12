<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Source;
use App\Models\Category;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ApiFetchController extends Controller
{
    public function fetchFromApi()
    {
        // Contoh menggunakan NewsAPI.org (Gunakan API Key milik Anda)
        $apiKey = 'NEWS_API_KEY';
        $response = Http::get("https://newsapi.org/v2/top-headlines?country=id&apiKey={$apiKey}");

        if ($response->successful()) {
            $articles = $response->json()['articles'];

            foreach ($articles as $item) {
                // Pastikan Sumber (Source) ada di database
                $source = Source::firstOrCreate(
                    ['name' => $item['source']['name']],
                    ['url' => $item['url'], 'description' => 'Auto-generated source']
                );

                // Simpan atau update artikel berdasarkan URL agar tidak duplikat
                Article::updateOrCreate(
                    ['url' => $item['url']],
                    [
                        'title' => $item['title'],
                        'slug' => Str::slug($item['title']),
                        'content' => $item['description'] ?? $item['content'] ?? 'No content available',
                        'image_url' => $item['urlToImage'],
                        'category_id' => 1, // Default ke kategori pertama (misal: Berita Umum)
                        'source_id  ' => $source->id,
                        'published_at' => now(),
                    ]
                );
            }
            return redirect()->back()->with('success', 'Berita berhasil diperbarui dari API!');
        }

        return redirect()->back()->with('error', 'Gagal mengambil data dari API.');
    }
}