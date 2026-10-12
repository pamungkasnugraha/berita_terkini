<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            // link dan content sudah ada, jangan ditambah lagi
            
            // Tambahkan kolom baru jika belum ada
            if (!Schema::hasColumn('articles', 'image')) {
                $table->string('image')->nullable()->after('content');
            }

            if (!Schema::hasColumn('articles', 'source')) {
                $table->string('source')->nullable()->after('image');
            }
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            // Hanya drop kolom baru
            if (Schema::hasColumn('articles', 'image')) {
                $table->dropColumn('image');
            }

            if (Schema::hasColumn('articles', 'source')) {
                $table->dropColumn('source');
            }
        });
    }
};