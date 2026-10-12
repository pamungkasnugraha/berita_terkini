<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Source;
use App\Models\Category;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class NewsScraperService
{
    public function fetchBeritaTerbaru()
    {
        $this->fetchFromRssNasional();
        $this->fetchFromApiInternasional();
    }

    protected function fetchFromRssNasional()
    {
        $sources = [
            ['name' => 'CNN Indonesia', 'url' => 'https://www.cnnindonesia.com/rss'],
            ['name' => 'Antara News', 'url' => 'https://www.antaranews.com/rss/top-news.xml'],
            ['name' => 'Tempo Nasional', 'url' => 'https://rss.tempo.co/nasional']
        ];

        foreach ($sources as $sourceData) {
            try {
                $feed = @simplexml_load_file($sourceData['url']);
                if (!$feed) continue;

                $source = Source::firstOrCreate(
                    ['name' => $sourceData['name']],
                    [
                        'url' => $sourceData['url'],
                        'type' => 'rss',
                        'is_active' => 1
                    ]
                );

                foreach ($feed->channel->item as $item) {
                    $this->saveFromRss($item, $source);
                }

            } catch (\Exception $e) {
                Log::error("Error RSS {$sourceData['name']}: " . $e->getMessage());
            }
        }
    }

    protected function saveFromRss($item, $source)
    {
        $title = (string) $item->title;
        $description = (string) $item->description;
        $url = (string) $item->link;

        if (Article::where('link', $url)->exists()) {
            return;
        }

        $category = $this->detectCategory($title . ' ' . $description);
        $imageUrl = $this->extractImage($item);

        if ($category->slug == 'internasional') {
            $category = Category::where('slug', 'nasional')->first()
                ?? Category::where('slug', 'umum')->first();
        }

        Article::create([
            'title' => $title,
            'slug' => Str::slug($title) . '-' . Str::random(5),
            'link' => $url,
            'source_url' => $url,
            'summary' => Str::limit(strip_tags($description), 200),
            'content' => strip_tags($description),
            'image_url' => $imageUrl,
            'source_id' => $source->id,
            'category_id' => $category->id,
            'source_name' => $source->name,
            'source_type' => 'nasional',
            'published_at' => now()
        ]);
    }

    protected function fetchFromApiInternasional()
    {
        $apiKey = env('NEWS_API_KEY');

        $response = Http::get('https://newsapi.org/v2/top-headlines', [
            'language' => 'en',
            'apiKey' => $apiKey
        ]);

        if (!$response->successful()) {
            Log::error("NewsAPI Error: " . $response->body());
            return;
        }

        $articles = $response->json()['articles'] ?? [];

        foreach ($articles as $item) {
            if ($item['title'] === '[Removed]' || empty($item['url'])) continue;

            $sourceName = $item['source']['name'] ?? 'Global News';

            $source = Source::firstOrCreate(
                ['name' => $sourceName],
                [
                    'url' => 'https://newsapi.org/source/' . Str::slug($sourceName),
                    'type' => 'api',
                    'is_active' => 1
                ]
            );

            $this->saveFromApi($item, $source);
        }
    }

    protected function saveFromApi($item, $source)
    {
        $url = $item['url'];

        if (Article::where('link', $url)->exists()) {
            return;
        }

        $categoryId = 13;

        Article::create([
            'title' => $item['title'],
            'slug' => Str::slug($item['title']) . '-' . Str::random(5),
            'link' => $url,
            'source_url' => $url,
            'summary' => Str::limit($item['description'] ?? '', 200),
            'content' => $item['content'] ?? '',
            'image_url' => $item['urlToImage'] ?? null,
            'source_id' => $source->id,
            'category_id' => $categoryId,
            'source_name' => $source->name,
            'source_type' => 'internasional',
            'published_at' => $item['publishedAt']
                ? Carbon::parse($item['publishedAt'])
                : now()
        ]);
    }

    protected function detectCategory($text)
    {
        $text = strtolower($text);
        $categoryScores = [];

        $keywords = [
            'teknologi' => ['gadget','hp','aplikasi','software','ai','internet'],
            'olahraga' => ['sepakbola','timnas','liga','olahraga','atlet'],
            'politik' => ['presiden','dpr','pemerintah','politik'],
            'hiburan' => ['film','artis','musik','hiburan'],
            'nasional' => ['polisi','bencana','kriminal','jakarta'],
            'bisnis' => ['saham','ekonomi','bisnis','bank'],
        ];

        foreach ($keywords as $slug => $words) {
            $score = 0;
            foreach ($words as $word) {
                if (str_contains($text, $word)) {
                    $score++;
                }
            }
            $categoryScores[$slug] = $score;
        }

        arsort($categoryScores);
        $bestMatch = key($categoryScores);

        if ($categoryScores[$bestMatch] === 0) {
            return Category::where('slug', 'umum')->first() ?: Category::first();
        }

        return Category::where('slug', $bestMatch)->first();
    }

    protected function extractImage($item)
    {
        if (isset($item->img)) {
            return (string) $item->img;
        }

        if (isset($item->enclosure)) {
            return (string) $item->enclosure['url'];
        }

        $media = $item->children('http://search.yahoo.com/mrss/');
        if (isset($media->content)) {
            return (string) $media->content->attributes()->url;
        }

        return null;
    }
}