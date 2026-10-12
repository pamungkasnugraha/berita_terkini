<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    // Relasi many-to-many dengan artikel
    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
}