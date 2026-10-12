<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ArticleController;
use App\Http\Controllers\Front\BookmarkController;
use App\Http\Controllers\Front\CategoryController;
use App\Http\Controllers\Front\SearchController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ManageArticleController;
use App\Http\Controllers\Admin\ScraperController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/article/{slug}', [ArticleController::class, 'show'])->name('article.show');
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/kategori/{slug}', [CategoryController::class, 'show'])->name('kategori');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/login', [LoginController::class, 'login'])->middleware('throttle:login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/bookmark/{article_id}', [BookmarkController::class, 'toggleBookmark'])->name('bookmark.toggle');
Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmark.index');

Route::prefix('admin')
    ->middleware(['auth', 'is_admin'])
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/articles', [ManageArticleController::class, 'index'])->name('articles.index');

        Route::delete('/articles/{id}', [ManageArticleController::class, 'destroy'])
            ->where('id', '[0-9]+')
            ->name('articles.destroy');

        Route::patch('/articles/{id}/toggle-status', [ManageArticleController::class, 'toggleStatus'])
            ->where('id', '[0-9]+')
            ->name('articles.toggleStatus');

        Route::get('/articles/{any}', function () {
            abort(404);
        })->where('any', '.*');

        Route::get('/categories', [\App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('categories.index');

        Route::post('/categories', [\App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('categories.store');

        Route::delete('/categories/{id}', [\App\Http\Controllers\Admin\CategoryController::class, 'destroy'])
            ->where('id', '[0-9]+')
            ->name('categories.destroy');

        Route::post('/scraper/trigger', [ScraperController::class, 'trigger'])->name('scraper.trigger');
    });

Route::fallback(function () {
    abort(404);
});
