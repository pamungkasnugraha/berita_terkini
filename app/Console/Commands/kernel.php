<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Daftar command yang tersedia untuk artisan
     *
     * @var array<int, class-string>
     */
    protected $commands = [
        // Daftarkan command custom
        \App\Console\Commands\Fetcharticles::class,
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // // Jalankan command scrape:news setiap 1 jam
        // $schedule->command('scrape:news')->everyMinute();
    }
    

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        // Akan mencari semua file command di folder Commands
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}