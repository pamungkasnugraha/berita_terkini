<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow duration-300">
    {{-- 1. Image dengan Null-safe --}}
    <img src="{{ $news->image_url ?? 'https://via.placeholder.com/400x200?text=Berita' }}" 
         class="w-full h-40 object-cover" 
         onerror="this.src='https://via.placeholder.com/400x200?text=No+Image'">
    
    <div class="p-4">
        <h3 class="font-bold text-gray-900 leading-tight mb-2 h-10 overflow-hidden text-sm">
            {{-- 2. Link Slug dengan Null-safe --}}
            <a href="{{ $news->slug ? route('article.show', $news->slug) : '#' }}" class="hover:text-blue-600">
                {{ $news->title ?? 'Judul tidak tersedia' }}
            </a>
        </h3>
        <div class="flex justify-between items-center mt-4 text-[10px] text-gray-500">
            <span>{{ $news->published_at ? $news->published_at->diffForHumans() : 'Baru saja' }}</span>
            
            {{-- 3. PERBAIKAN SUMBER: Memanggil relasi source --}}
            <span class="font-bold text-blue-600 uppercase">
                @if($news->source)
                    {{ $news->source->name }}
                @else
                    {{-- Debug: Jika ini muncul, berarti ID di database tidak sinkron --}}
                    ID: {{ $news->source_id ?? 'Kosong' }}
                @endif
            </span>
        </div>
    </div>
</div>