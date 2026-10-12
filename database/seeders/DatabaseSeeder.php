<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Article;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat 1 User Admin untuk testing login nanti
        User::factory()->create([
            'name' => 'Admin Berita',
            'email' => 'admin@berita.com',
            'password' => bcrypt('password123'),
        ]);

        // 2. Jalankan seeder kategori dan sumber
        $this->call([
            CategorySeeder::class,
            SourceSeeder::class,
        ]);

        // 3. Generate 24 berita palsu secara otomatis!
        Article::factory(24)->create();
    }
}