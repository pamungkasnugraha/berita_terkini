<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\NewsScraperService;

class ScrapeNewsCommand extends Command
{
    protected $signature = 'scrape:news';
    protected $description = 'Menjalankan otomatis penarikan berita dari berbagai sumber';

    public function handle(NewsScraperService $scraper)
    {
        $this->info('Memulai penarikan berita terbaru...');
        $scraper->fetchBeritaTerbaru();
        $this->info('Proses penarikan berita selesai dan berhasil masuk ke database MySQL!');
    }
}