@extends('layouts.admin')

@section('content')
@php
    // Jika variabel $categories kosong, kita paksa ambil langsung dari database
    if(!isset($categories) || $categories->isEmpty()){
        $categories = \App\Models\Category::with('articles')->get();
    }
@endphp

<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0">Manajemen Berita per Kategori</h3>
        <div class="text-muted">Ditemukan: {{ $categories->count() }} Kategori</div>
    </div>

    @forelse($categories as $category)
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-header bg-white py-3 border-bottom">
            <h5 class="m-0 fw-bold text-primary">
                <i class="fas fa-folder me-2"></i>KATEGORI: {{ strtoupper($category->name) }} 
                <span class="badge bg-light text-dark ms-2">{{ $category->articles->count() }} Berita</span>
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr class="small text-uppercase text-secondary">
                            <th class="ps-4">Judul Berita</th>
                            <th>Sumber</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($category->articles as $article)
                        <tr>
                            <td class="ps-4" style="max-width: 400px;">{{ $article->title }}</td>
                            <td><span class="badge bg-outline-secondary text-dark border">Antara News</span></td>
                            <td class="text-end pe-4">
                                <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Hapus berita ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger fw-bold p-0 text-decoration-none">HAPUS</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-3 text-muted">Tidak ada berita terhubung ke kategori ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @empty
    <div class="alert alert-danger">
        <strong>Data Tidak Ditemukan!</strong> Tabel categories di database mungkin masih kosong.
    </div>
    @endforelse
</div>
@endsection