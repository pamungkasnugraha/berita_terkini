<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    use HasFactory;

    // Mengizinkan Seeder mengisi kolom name dan url
    protected $guarded = ['id'];

    // Relasi: Satu sumber (misal Detik) punya banyak berita
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}