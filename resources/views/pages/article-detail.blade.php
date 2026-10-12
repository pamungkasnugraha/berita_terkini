@extends('layouts.main')

@section('content')
    <div class="max-w-4xl mx-auto bg-white p-6 md:p-10 rounded-lg shadow-sm mt-6">

        <div class="flex justify-between items-center mb-6">
            <span class="bg-blue-100 text-blue-800 text-sm font-semibold px-3 py-1 rounded">
                {{ $article->category->name ?? 'Umum' }}
            </span>

            <form action="{{ route('bookmark.toggle', $article->id) }}" method="POST">
                @csrf
                <button type="submit"
                    class="flex items-center gap-2 px-4 py-2 border rounded-full hover:bg-gray-50 transition">
                    @if($isBookmarked)
                        <span class="text-red-500">❤️ Disimpan</span>
                    @else
                        <span class="text-gray-500">🤍 Simpan Berita</span>
                    @endif
                </button>
            </form>
        </div>

        <h1 class="text-3xl md:text-5xl font-extrabold text-gray-900 mb-4 leading-tight">
            {{ $article->title }}
        </h1>

        <div class="flex items-center gap-4 text-gray-500 text-sm mb-8 border-b pb-4">
            {{-- PERBAIKAN DI SINI: Menggunakan ?-> dan ?? --}}
            <p>Sumber: <span class="font-bold text-gray-700">{{ $article->source_name ?? 'Sumber Tidak Diketahui' }}</span></p>
            <p>•</p>
            <p>{{ $article->published_at->format('d M Y, H:i') }}</p>
        </div>

        @if($article->image_url)
            <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="w-full h-auto rounded-xl mb-8 object-cover">
        @endif

        <div class="prose prose-lg max-w-none text-gray-800 leading-relaxed">
            {!! nl2br(e(strip_tags($article->content))) !!}
        </div>

        <div class="mt-10 pt-6 border-t flex justify-center">
            {{-- PERBAIKAN DI SINI: Menggunakan ?-> dan ?? --}}
            <a href="{{ $article->source_url }}" target="_blank"
                class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition shadow-md">
                Baca Selengkapnya di {{ $article->source_name ?? 'Sumber Asli' }}
            </a>
        </div>
    </div>
@endsection