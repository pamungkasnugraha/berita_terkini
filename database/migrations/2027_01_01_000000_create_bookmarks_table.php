<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookmarks', function (Blueprint $table) {
            $table->id();
            // Jika user dihapus, bookmarknya ikut terhapus (cascade)
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            // Jika artikel dihapus, bookmark user ikut terhapus
            $table->foreignId('article_id')->constrained()->cascadeOnDelete();
            $table->timestamps();

            // Mencegah user menyimpan artikel yang sama berkali-kali
            $table->unique(['user_id', 'article_id']); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookmarks');
    }
};