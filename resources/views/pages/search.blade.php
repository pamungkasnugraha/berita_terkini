@extends('layouts.main')

@section('content')
<div class="bg-[#0f172a] min-h-screen py-10">
    <div class="container mx-auto px-4 lg:px-8">
        
        <div class="mb-8 border-b border-gray-700 pb-4">
            <h1 class="text-xl font-medium text-gray-400">
                @if(request('source'))
                    Arsip Berita: <span class="text-white font-bold">{{ request('source') }}</span>
                @elseif(request('date'))
                    Berita Tanggal: <span class="text-white font-bold">{{ \Carbon\Carbon::parse(request('date'))->translatedFormat('d F Y') }}</span>
                @else
                    Hasil pencarian untuk: <span class="text-blue-400 font-bold">"{{ $keyword ?? 'Semua Berita' }}"</span>
                @endif
            </h1>
        </div>

        {{-- Grid Berita --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($articles as $article)
                @include('components.news-card', ['article' => $article])
            @empty
                <div class="col-span-full text-center py-20 bg-white/5 rounded-2xl border border-dashed border-gray-700">
                    <div class="mb-4 text-5xl text-gray-600">
                        <i class="fas fa-search"></i>
                    </div>
                    <p class="text-xl text-gray-400 mb-6">Maaf, berita yang Anda cari tidak ditemukan.</p>
                    <a href="/" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-bold transition-all">
                        Kembali ke Beranda
                    </a>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-12 flex justify-center">
            <div class="bg-white/5 p-2 rounded-xl border border-gray-800">
                {{ $articles->links() }}
            </div>
        </div>

    </div>
</div>
@endsection