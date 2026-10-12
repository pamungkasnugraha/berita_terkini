<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $fillable = ['user_id', 'article_id'];

    // Menghubungkan kembali ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Menghubungkan kembali ke Artikel
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}