<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('q');
        $date = $request->input('date');
        $sourceName = $request->input('source');

        $articles = Article::with(['source', 'category'])
           
            ->when($keyword, function ($query) use ($keyword) {
             return $query->whereRaw("title LIKE '%$keyword%' OR content LIKE '%$keyword%'");
            })


            // ->when($keyword, function ($query) use ($keyword) {
            //     return $query->where(function ($q) use ($keyword) {
            //         $q->where('title', 'like', "%{$keyword}%")
            //           ->orWhere('content', 'like', "%{$keyword}%");
            //     });
            // })
            
            ->when($date, function ($query) use ($date) {
                return $query->whereDate('published_at', $date);
            })
            
            ->when($sourceName, function ($query) use ($sourceName) {
                return $query->whereHas('source', function($q) use ($sourceName) {
                    $q->where('name', $sourceName);
                });
            })
            ->latest('published_at')
            ->paginate(12)
            ->withQueryString();

        return view('pages.search', compact('articles', 'keyword', 'date', 'sourceName'));
    }
}