<article class="bg-white text-gray-900 rounded-xl shadow-lg hover:shadow-2xl transition duration-300 h-full flex flex-col overflow-hidden">
    <img src="{{ $article->image_url ?? asset('images/default-news.jpg') }}" 
         alt="{{ $article->title }}" 
         class="w-full h-48 object-cover">
    
    <div class="p-4 flex flex-col flex-grow">
        <div class="flex justify-between items-center mb-2 text-sm text-gray-500">
            {{-- BAGIAN INI DIUBAH AGAR FOKUS KE SUMBER --}}
            <span class="font-semibold text-blue-600 uppercase text-xs">
                @if($article->source)
                    {{ $article->source->name }}
                @else
                    <span class="text-sm text-gray-500">
                         {{ $article->source_name ?? 'Sumber tidak diketahui' }}
                    </span>

                @endif
            </span>
            <span class="text-xs">
                {{ $article->published_at ? $article->published_at->diffForHumans() : 'Baru saja' }}
            </span>
        </div>
        
        <h3 class="text-lg font-bold mb-3 leading-tight flex-grow">
            <a href="{{ $article->slug ? url('/article/'.$article->slug) : '#' }}" 
               class="hover:text-blue-600 transition-colors">
                {{ $article->title ?? 'Judul tidak tersedia' }}
            </a>
        </h3>
        
        {{-- Jika ingin tetap menampilkan kategori, taruh di bawah judul atau di tempat lain --}}
        <p class="text-[10px] text-gray-400 italic mb-2">
            Kategori: {{ $article->category?->name ?? 'Umum' }}
        </p>

        <div class="mt-4 flex gap-4 border-t pt-3">
            <button class="flex items-center gap-1 text-gray-500 hover:text-red-500 text-xs font-bold transition">
                <span>❤️</span> Simpan
            </button>
            <button class="flex items-center gap-1 text-gray-500 hover:text-blue-500 text-xs font-bold transition">
                <span>🔗</span> Bagikan
            </button>
        </div>
    </div>
</article>