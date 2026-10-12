<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Source;

class SourceSeeder extends Seeder
{
    public function run(): void
    {
        $sources = [
            [
                'name'      => 'CNN Indonesia',
                'type'      => 'api',
                'api_url'   => 'https://berita-indo-api.vercel.app/v1/cnn-news',
                'rss_url'   => null,
                'is_active' => true,
            ],
            [
                'name'      => 'CNBC Indonesia',
                'type'      => 'api',
                'api_url'   => 'https://berita-indo-api.vercel.app/v1/cnbc-news',
                'rss_url'   => null,
                'is_active' => true,
            ],
            [
                'name'      => 'Republika',
                'type'      => 'api',
                'api_url'   => 'https://berita-indo-api.vercel.app/v1/republika-news',
                'rss_url'   => null,
                'is_active' => true,
            ],
            [
                'name'      => 'Tempo',
                'type'      => 'api',
                'api_url'   => 'https://berita-indo-api.vercel.app/v1/tempo-news',
                'rss_url'   => null,
                'is_active' => true,
            ],
        ];

        foreach ($sources as $src) {
            Source::firstOrCreate(
                ['name' => $src['name']],
                $src
            );
        }
    }
}