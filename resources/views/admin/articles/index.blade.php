@extends('layouts.admin')

@section('admin_content')

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6">
        <strong class="font-bold">Berhasil!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

<div class="bg-white rounded-2xl shadow-sm p-6">
    <div class="flex justify-between items-center mb-6 border-b pb-4">
        <h2 class="text-2xl font-black text-gray-800 tracking-tighter">Manajemen Berita Masuk</h2>
        <span class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full">Total: {{ $articles->total() }}</span>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b-2 border-gray-100 text-gray-400 text-xs uppercase tracking-wider">
                    <th class="py-3 px-4">Judul Berita</th>
                    <th class="py-3 px-4">Sumber</th>
                    <th class="py-3 px-4">Kategori</th>
                    <th class="py-3 px-4 text-center">Status</th>
                    <th class="py-3 px-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse($articles as $article)
                <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                    <td class="py-4 px-4 font-bold text-blue-900 leading-tight">
                        <a href="{{ route('article.show', $article->slug) }}" target="_blank" class="hover:underline">
                            {{ Str::limit($article->title, 60) }}
                        </a>
                    </td>
                    <td class="py-4 px-4 text-gray-600">{{ $article->source->name ?? '-' }}</td>
                    <td class="py-4 px-4">
                        <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-[10px] font-bold uppercase">
                            {{ $article->category->name ?? '-' }}
                        </span>
                    </td>
                    
                    <td class="py-4 px-4 text-center">
                        <form action="{{ route('admin.articles.toggleStatus', $article->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" title="Klik untuk mengubah status" class="px-3 py-1.5 rounded text-[10px] font-bold uppercase transition hover:scale-105 shadow-sm 
                                {{ $article->status === 'published' ? 'bg-green-100 text-green-700 hover:bg-green-200 border border-green-200' : 'bg-yellow-100 text-yellow-700 hover:bg-yellow-200 border border-yellow-200' }}">
                                {{ $article->status === 'published' ? 'Published' : 'Draft' }}
                            </button>
                        </form>
                    </td>
                    <td class="py-4 px-4 text-center">
                        <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini secara permanen?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-white hover:bg-red-500 px-3 py-1 rounded font-bold text-xs uppercase transition">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-10 text-center text-gray-400 italic">Belum ada berita yang ditarik oleh scraper.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $articles->links() }}
    </div>
</div>
@endsection