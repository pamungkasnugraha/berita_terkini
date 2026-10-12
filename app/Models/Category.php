<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Mendefinisikan nama tabel (Opsional sebenarnya, tapi bagus untuk kejelasan)
    protected $table = 'categories';

    // 👇 INI KUNCI RAHASIANYA 👇
    // Melindungi kolom 'id' saja, dan mengizinkan kolom lain (name, slug) diisi dari form
    protected $guarded = ['id'];

    public function articles()
    {
        // Pastikan 'category_id' adalah nama kolom di tabel articles Anda
        return $this->hasMany(Article::class, 'category_id');
    }
}