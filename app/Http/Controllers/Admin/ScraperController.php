<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\NewsScraperService;
use Illuminate\Http\Request;

class ScraperController extends Controller
{
    protected $scraper;

    public function __construct(NewsScraperService $scraper)
    {
        $this->scraper = $scraper;
    }

    public function trigger()
    {
        try {
            $this->scraper->fetchBeritaTerbaru();
            return back()->with('success', 'Scraping manual berhasil dijalankan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menjalankan scraping: ' . $e->getMessage());
        }
    }
}