<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    // Mengizinkan mass assignment saat scraper menyimpan data
    protected $guarded = ['id']; 
    
    // Memastikan format tanggal benar
    protected $casts = [
        'published_at' => 'datetime',
    ];

    // Relasi ke tabel sumber berita (misal: Kompas, Detik)
    public function category()
    {
    return $this->belongsTo(Category::class);
    }

    public function source()
    {
    return $this->belongsTo(Source::class);
    }
}