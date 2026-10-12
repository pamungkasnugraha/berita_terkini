<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\Source;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    public function definition(): array
    {
        $title = $this->faker->sentence(mt_rand(5, 10)); // Judul acak 5-10 kata
        
        return [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . Str::random(5),
            'summary' => $this->faker->paragraph(),
            'content' => $this->faker->paragraphs(5, true), // 5 paragraf isi berita
            // Mengambil gambar acak dari internet
            'image_url' => 'https://picsum.photos/seed/' . $this->faker->word . '/800/600',
            'source_url' => $this->faker->unique()->url(),
            // Mengambil ID kategori dan sumber secara acak dari database
            'source_id' => Source::inRandomOrder()->first()->id ?? 1,
            'category_id' => Category::inRandomOrder()->first()->id ?? 1,
            'published_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}