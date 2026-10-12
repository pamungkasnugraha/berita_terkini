@extends('layouts.admin')

@section('admin_content')
<div class="mb-8">
    <h2 class="text-3xl font-black text-gray-800">📂 MANAJEMEN KATEGORI</h2>
    <p class="text-gray-500">Kelola dan tambahkan kategori berita baru untuk website kamu.</p>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6">
        <strong class="font-bold">Berhasil!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-6">
        <strong class="font-bold">Gagal!</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    
    <div class="md:col-span-1">
        <div class="bg-white rounded-2xl shadow-sm p-6">
            <h3 class="font-black text-xl text-gray-800 uppercase tracking-tighter mb-6">Tambah Kategori</h3>
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-xs font-bold uppercase tracking-wider mb-2" for="name">
                        Nama Kategori Baru
                    </label>
                    <input type="text" name="name" id="name" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white transition" placeholder="Contoh: Otomotif" required>
                    @error('name')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl shadow-md transition duration-200">
                    + Simpan Kategori
                </button>
            </form>
        </div>
    </div>

    <div class="md:col-span-2">
        <div class="bg-white rounded-2xl shadow-sm p-6">
            <h3 class="font-black text-xl text-gray-800 uppercase tracking-tighter mb-6">Daftar Kategori</h3>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b text-gray-400 text-[10px] font-black uppercase tracking-widest">
                            <th class="py-3 px-2">Nama Kategori</th>
                            <th class="py-3 px-2">Slug URL</th>
                            <th class="py-3 px-2 text-center">Jumlah Berita</th>
                            <th class="py-3 px-2 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @forelse($categories as $category)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="py-4 px-2 font-bold text-gray-800">{{ $category->name }}</td>
                            <td class="py-4 px-2 text-gray-400 italic text-xs">/kategori/{{ $category->slug }}</td>
                            <td class="py-4 px-2 text-center">
                                <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-[10px] font-black uppercase">
                                    {{ $category->articles_count ?? 0 }} Berita
                                </span>
                            </td>
                            <td class="py-4 px-2 text-right">
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori {{ $category->name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-white hover:bg-red-500 px-3 py-1.5 rounded-lg font-bold text-xs uppercase transition">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-10 text-center text-gray-400 italic">Belum ada kategori terdaftar.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</div>
@endsection