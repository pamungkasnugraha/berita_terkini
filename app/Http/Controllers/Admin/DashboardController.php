<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        // =============================
        // Statistik Utama
        // =============================
        $totalBerita = Article::count();
        $published = Article::where('status','published')->count();
        $draft = Article::where('status','draft')->count();
        $totalKategori = Category::count();

        $beritaTerbaru = Article::with('category')
                        ->latest()
                        ->take(5)
                        ->get();

        // =============================
        // Rentang minggu
        // =============================
        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();

        $rangeTanggal = $startOfWeek->format('d M') . ' - ' . $endOfWeek->format('d M Y');

        // =============================
        // Label hari (Chart)
        // =============================
        $hari = [];

        for ($i = 0; $i < 7; $i++) {

            $hari[] = $startOfWeek
                    ->copy()
                    ->addDays($i)
                    ->translatedFormat('D');

        }

        // =============================
        // Data Bar Chart
        // =============================
        $categories = Category::all();

        $datasetsBar = [];

        $colors = [
            '#38bdf8',
            '#2563eb',
            '#60a5fa',
            '#1e40af',
            '#0ea5e9',
            '#3b82f6',
            '#1d4ed8',
            '#93c5fd'
        ];

        foreach ($categories as $index => $cat) {

            $dataPerHari = [];

            for ($i = 0; $i < 7; $i++) {

                $date = $startOfWeek
                        ->copy()
                        ->addDays($i)
                        ->toDateString();

                $count = Article::where('category_id',$cat->id)
                            ->whereDate('created_at',$date)
                            ->count();

                $dataPerHari[] = $count;

            }

            $datasetsBar[] = [

                'label' => $cat->name,
                'data' => $dataPerHari,
                'backgroundColor' => $colors[$index % count($colors)],
                'borderRadius' => 5

            ];

        }

        // =============================
        // Data Donut Chart
        // =============================
        $labelKategori = [];
        $totalPerKategori = [];

        foreach ($categories as $cat) {

            $count = Article::where('category_id',$cat->id)
                    ->whereBetween('created_at',[$startOfWeek,$endOfWeek])
                    ->count();

            if($count > 0){

                $labelKategori[] = $cat->name;
                $totalPerKategori[] = $count;

            }

        }

        // =============================
        // Kirim ke view
        // =============================
        return view('admin.dashboard', compact(

            'totalBerita',
            'published',
            'draft',
            'totalKategori',
            'beritaTerbaru',
            'hari',
            'datasetsBar',
            'rangeTanggal',
            'labelKategori',
            'totalPerKategori'

        ));
    }

}