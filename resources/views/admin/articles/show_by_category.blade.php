@extends('layouts.admin')

@section('content')
<div class="container-fluid p-4">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="m-0 fw-bold text-dark">Berita Kategori: <span class="text-primary">{{ $category->name }}</span></h5>
            <a href="{{ route('admin.category.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr class="text-secondary small">
                        <th>JUDUL BERITA</th>
                        <th>SUMBER</th>
                        <th class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($category->articles as $article)
                    <tr>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->source->name ?? 'Antara News' }}</td>
                        <td class="text-center">
                            <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Hapus berita ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link text-danger fw-bold p-0" style="text-decoration:none;">HAPUS</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection