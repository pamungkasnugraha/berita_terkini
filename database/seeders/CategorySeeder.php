<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Teknologi', 'slug' => 'teknologi'],
            ['name' => 'Olahraga', 'slug' => 'olahraga'],
            ['name' => 'Politik', 'slug' => 'politik'],
            ['name' => 'Hiburan', 'slug' => 'hiburan'],
            ['name' => 'Nasional', 'slug' => 'nasional'],
            ['name' => 'Bisnis', 'slug' => 'bisnis'],
            ['name' => 'Internasional', 'slug' => 'internasional'],
            ['name' => 'Umum', 'slug' => 'umum'],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate($cat);
        }
    }
}