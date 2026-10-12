<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class BersihkanSampah extends Command
{
    protected $signature = 'app:bersihkan-sampah';

    protected $description = 'Membersihkan log, cache, dan file sampah di project BERITA_TERKINI';

    public function handle()
    {
        $this->info('Memulai pembersihan berkala...');

        // // 1. Membersihkan Cache Aplikasi & Config
        // Artisan::call('cache:clear');
        // Artisan::call('config:clear');
        // $this->line(' Cache dan Konfigurasi telah dibersihkan.');

        // // 2. Membersihkan View (tampilan blade) yang tersimpan
        // Artisan::call('view:clear');
        // $this->line(' View yang ter-compile telah dihapus.');

        // // 3. Menghapus file log lama di folder storage/logs
        // $logPath = storage_path('logs');
        // if (File::exists($logPath)) {
        //     // Kita hapus semua file .log
        //     exec('rm ' . $logPath . '/*.log');
        //     $this->line(' File log lama telah dimusnahkan.');
        // }
        // Menghapus berita yang usianya lebih dari 7 hari
        \App\Models\Article::where('created_at', '<', now()->subDays(7))->delete();
        $this->line(' Berita lama (lebih dari 7 hari) telah dihapus.');

        $this->info('Pembersihan selesai! Project kembali fresh.');
    }
}