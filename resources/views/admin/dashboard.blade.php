@extends('layouts.admin')

@section('admin_content')
{{-- Menambahkan Style Khusus untuk Watermark --}}
<style>
    .watermark-container {
        position: relative;
        background-color: #ffffff; /* Background dasar putih */
        min-height: 100vh;
        overflow: hidden;
    }

    .watermark-container::before {
        content: "";
        position: fixed; /* Agar logo tetap di tengah saat scroll */
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 600px; /* Ukuran lebar logo */
        height: 600px; /* Ukuran tinggi logo */
        
        /* Ganti path/ke/logo-siber.png dengan lokasi file logo Anda di folder public */
        background-image: url('{{ asset("images/logo-siber-polri.png") }}'); 
        background-repeat: no-repeat;
        background-position: center;
        background-size: contain;
        
        /* Opacity rendah agar tidak jomplang dengan navbar dan tetap elegan */
        opacity: 0.05; 
        z-index: 0; 
        pointer-events: none; /* Agar tidak menghalangi klik pada tombol/grafik */
    }

    /* Memastikan konten tetap di atas logo */
    .content-relative {
        position: relative;
        z-index: 1;
    }
</style>

<div class="watermark-container p-8">
    <div class="content-relative">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Ringkasan Data</h1>
            <p class="text-gray-500">Pantau statistik berita terbaru</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="bg-blue-600 p-6 rounded-2xl text-white shadow-md">
                <p class="text-xs font-semibold opacity-80 uppercase tracking-wider">Total Berita</p>
                <h2 class="text-4xl font-bold mt-2">{{ $totalBerita }}</h2>
            </div>

            <div class="bg-emerald-500 p-6 rounded-2xl text-white shadow-md">
                <p class="text-xs font-semibold opacity-80 uppercase tracking-wider">Published</p>
                <h2 class="text-4xl font-bold mt-2">{{ $published }}</h2>
            </div>

            <div class="bg-orange-400 p-6 rounded-2xl text-white shadow-md">
                <p class="text-xs font-semibold opacity-80 uppercase tracking-wider">Draft</p>
                <h2 class="text-4xl font-bold mt-2">{{ $draft }}</h2>
            </div>

            <div class="bg-purple-500 p-6 rounded-2xl text-white shadow-md">
                <p class="text-xs font-semibold opacity-80 uppercase tracking-wider">Total Kategori</p>
                <h2 class="text-4xl font-bold mt-2">{{ $totalKategori }}</h2>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-10">
            <div class="bg-[#1e293b] p-6 rounded-[2rem] shadow-2xl border border-slate-700/50"> 
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-white text-lg font-bold">Statistik Kategori</h3>
                    <span class="text-slate-400 text-xs">{{ $rangeTanggal }}</span>
                </div>
                <div class="relative h-[300px]"> 
                    <canvas id="barChart"></canvas>
                </div>
            </div>

            <div class="bg-[#1e293b] p-6 rounded-[2rem] shadow-2xl border border-slate-700/50"> 
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-white text-lg font-bold">Distribusi Kategori</h3>
                    <span class="text-slate-400 text-xs">Minggu Ini</span>
                </div>
                <div class="relative h-[300px]"> 
                    <canvas id="donutChart"></canvas>
                </div>
            </div>
        </div>

        <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6">
                <h3 class="text-lg font-bold text-gray-800">Berita Terakhir Masuk</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-800 text-white text-xs uppercase tracking-widest">
                            <th class="px-6 py-4">Judul</th>
                            <th class="px-6 py-4 text-center">Kategori</th>
                            <th class="px-6 py-4 text-center">Tanggal</th>
                            <th class="px-6 py-4 text-center">Jam</th>
                            <th class="px-6 py-4">Sumber</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($beritaTerbaru as $item)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-5 font-medium text-gray-700">{{ $item->title }}</td>
                            <td class="px-6 py-5 text-center">
                                <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-lg text-xs font-bold uppercase">
                                    {{ $item->category->name }}
                                </span>
                            </td>
                            <td class="px-6 py-5 text-center text-gray-500 text-sm">
                                {{ $item->created_at->format('d F Y') }}
                            </td>
                            <td class="px-6 py-5 text-center text-gray-500 text-sm italic">
                                {{ $item->created_at->format('H:i') }} WIB
                            </td>
                            <td class="px-6 py-5 text-sm text-gray-600">
                                {{ Str::limit($item->source_url, 40) ?? 'Tanpa Sumber' }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // 1. Stacked Bar Chart
    const ctxBar = document.getElementById('barChart').getContext('2d');
    new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: @json($hari),
            datasets: @json($datasetsBar)
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: { 
                    display: true, 
                    position: 'bottom',
                    labels: { boxWidth: 10, padding: 20, color: '#94a3b8' }
                }
            },
            scales: {
                x: { stacked: true, grid: { display: false }, ticks: { color: '#94a3b8' } },
                y: { stacked: true, grid: { color: 'rgba(255, 255, 255, 0.05)' }, ticks: { color: '#94a3b8' } }
            }
        }
    });

    // 2. Donut Chart
    new Chart(document.getElementById('donutChart'), {
        type: 'doughnut',
        data: {
            labels: @json($labelKategori),
            datasets: [{
                data: @json($totalPerKategori),
                backgroundColor: ['#38bdf8', '#2563eb', '#60a5fa', '#1e40af', '#0ea5e9'],
                borderWidth: 0
            }]
        },
        options: {
            maintainAspectRatio: false,
            cutout: '75%',
            plugins: { 
                legend: { 
                    position: 'bottom',
                    labels: { color: '#94a3b8' }
                } 
            }
        }
    });
</script>
@endsection