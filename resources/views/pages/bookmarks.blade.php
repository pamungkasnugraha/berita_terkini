@extends('layouts.main')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-extrabold text-gray-900 border-b-4 border-red-500 inline-block pb-2">Berita Simpanan Saya</h1>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
    @forelse($bookmarks as $bookmark)
        @include('components.news-card', ['article' => $bookmark->article])
    @empty
        <div class="col-span-full text-center py-20 bg-white rounded-xl shadow-sm">
            <p class="text-gray-500 text-lg">Anda belum menyimpan berita apapun.</p>
            <a href="/" class="text-blue-600 hover:underline mt-2 inline-block">Cari berita menarik sekarang</a>
        </div>
    @endforelse
</div>

<div class="mt-8">
    {{ $bookmarks->links() }}
</div>
@endsection