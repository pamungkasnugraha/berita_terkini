@extends('layouts.main')

@section('content')
<div class="relative min-h-screen py-10 bg-contain bg-center bg-fixed bg-no-repeat"
    style="background-image: url('{{ asset('assets/img/logo_polda_siber.png') }}');">

    <div class="absolute inset-0 bg-[#0f172a]/80"></div>

    <div class="relative container mx-auto px-4">
        
        <div class="mb-12 text-center">
            <h1 class="text-3xl font-extrabold text-white uppercase tracking-widest">
                Kanal Berita <span class="text-blue-400">{{ $category->name ?? 'Terbaru' }}</span>
            </h1>
            <div class="w-20 h-1.5 bg-blue-500 mx-auto mt-3 rounded-full shadow-lg shadow-blue-500/50"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
            
            <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 p-6 transition-all hover:scale-[1.02] duration-300">
                <h2 class="text-xl font-bold text-red-600 border-b-2 border-red-600 mb-6 pb-3 uppercase tracking-wider flex items-center">
                    <span class="w-1.5 h-6 bg-red-600 mr-3 rounded-full"></span>
                    CNN Indonesia
                </h2>
                <div class="space-y-6">
                    @forelse($cnnNews as $news)
                        @include('partials.article-card', ['news' => $news])
                    @empty
                        <p class="text-gray-400 italic text-sm text-center py-6">Belum ada berita CNN.</p>
                    @endforelse
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 p-6 transition-all hover:scale-[1.02] duration-300">
                <h2 class="text-xl font-bold text-blue-900 border-b-2 border-blue-900 mb-6 pb-3 uppercase tracking-wider flex items-center">
                    <span class="w-1.5 h-6 bg-blue-900 mr-3 rounded-full"></span>
                    Antara News
                </h2>
                <div class="space-y-6">
                    @forelse($antaraNews as $news)
                        @include('partials.article-card', ['news' => $news])
                    @empty
                        <p class="text-gray-400 italic text-sm text-center py-6">Belum ada berita Antara.</p>
                    @endforelse
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 p-6 transition-all hover:scale-[1.02] duration-300">
                <h2 class="text-xl font-bold text-gray-950 border-b-2 border-gray-950 mb-6 pb-3 uppercase tracking-wider flex items-center">
                    <span class="w-1.5 h-6 bg-gray-950 mr-3 rounded-full"></span>
                    Tempo News
                </h2>
                <div class="space-y-6">
                    @forelse($tempoNews as $news)
                        @include('partials.article-card', ['news' => $news])
                    @empty
                        <p class="text-gray-400 italic text-sm text-center py-6">Belum ada berita Tempo.</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</div>
@endsection