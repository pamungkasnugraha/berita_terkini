<?php

use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Artisan;

// Ambil berita setiap 1 jam sekali (jauh lebih aman untuk server)
Schedule::command('scrape:news')->hourly();

// Bersihkan sampah sehari sekali
Schedule::command('app:bersihkan-sampah')->daily();