<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // <-- Tambahkan baris ini
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Bookmark;

class User extends Authenticatable
{
    use HasFactory, Notifiable; // <-- Tambahkan HasFactory di sini

    protected $fillable = ['name', 'email', 'password'];

    // Relasi ke Bookmark: Satu user bisa punya banyak bookmark
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }
}