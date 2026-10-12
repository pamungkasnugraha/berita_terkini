@extends('layouts.main')

@section('content')
    <div class="relative min-h-screen py-10 bg-contain bg-center bg-fixed bg-no-repeat"
        style="background-image: url('{{ asset('assets/img/logo_polda_siber.png') }}');">

        <div class="absolute inset-0 bg-[#0f172a]/80"></div>

        <div class="relative container mx-auto px-4 lg:px-6">

            <div class="mb-12 text-center">
                <h1 class="text-3xl font-extrabold text-white uppercase tracking-widest">
                    Kanal Berita <span class="text-blue-400">{{ $category->name ?? 'Terbaru' }}</span>
                </h1>
                <div class="w-20 h-1.5 bg-blue-500 mx-auto mt-3 rounded-full shadow-lg shadow-blue-500/50"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">

                <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 p-6 transition-all hover:scale-[1.02] duration-300 flex flex-col min-h-[400px]">
                    <h2 class="text-xl font-bold text-red-600 border-b-2 border-red-600 mb-6 pb-3 uppercase tracking-wider flex items-center">
                        <span class="w-1.5 h-6 bg-red-600 mr-3 rounded-full"></span>
                        CNN Indonesia
                    </h2>

                    <div class="space-y-6 flex-grow">
                        @forelse($cnnNews as $news)
                            <div class="group border-b border-gray-100 pb-5 last:border-0">
                                <div class="overflow-hidden rounded-2xl mb-3 shadow-sm">
                                    <img src="{{ $news->image_url ?? 'https://via.placeholder.com/400x200?text=CNN+Indonesia' }}"
                                        class="w-full h-36 object-cover group-hover:scale-110 transition-transform duration-700">
                                </div>
                                <h3 class="font-extrabold text-gray-950 leading-snug text-sm h-10 overflow-hidden group-hover:text-red-600 transition-colors">
                                    <a href="{{ route('article.show', $news->slug) }}">{{ $news->title }}</a>
                                </h3>
                                <div class="flex justify-between items-center mt-4 text-[11px] text-gray-400">
                                    <span><i class="far fa-clock mr-1"></i>{{ $news->published_at->diffForHumans() }}</span>
                                    <span class="font-bold text-red-600 uppercase">CNN</span>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-400 italic text-center text-sm py-10">Belum ada berita...</p>
                        @endforelse
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-50">
                        <a href="{{ route('search', ['q' => '', 'source' => 'CNN Indonesia']) }}" 
                           class="block w-full py-3 text-center text-sm font-bold text-red-600 bg-red-50 rounded-xl hover:bg-red-600 hover:text-white transition-all duration-300">
                            Lihat Berita CNN Lainnya
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 p-6 transition-all hover:scale-[1.02] duration-300 flex flex-col min-h-[400px]">
                    <h2 class="text-xl font-bold text-blue-900 border-b-2 border-blue-900 mb-6 pb-3 uppercase tracking-wider flex items-center">
                        <span class="w-1.5 h-6 bg-blue-900 mr-3 rounded-full"></span>
                        Antara News
                    </h2>

                    <div class="space-y-6 flex-grow">
                        @forelse($antaraNews as $news)
                            <div class="group border-b border-gray-100 pb-5 last:border-0">
                                <div class="overflow-hidden rounded-2xl mb-3 shadow-sm">
                                    <img src="{{ $news->image_url ?? 'https://via.placeholder.com/400x200?text=Antara+News' }}"
                                        class="w-full h-36 object-cover group-hover:scale-110 transition-transform duration-700">
                                </div>
                                <h3 class="font-extrabold text-gray-950 leading-snug text-sm h-10 overflow-hidden group-hover:text-blue-900 transition-colors">
                                    <a href="{{ route('article.show', $news->slug) }}">{{ $news->title }}</a>
                                </h3>
                                <div class="flex justify-between items-center mt-4 text-[11px] text-gray-400">
                                    <span><i class="far fa-clock mr-1"></i>{{ $news->published_at->diffForHumans() }}</span>
                                    <span class="font-bold text-blue-900 uppercase">Antara</span>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-400 italic text-center text-sm py-10">Belum ada berita...</p>
                        @endforelse
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-50">
                        <a href="{{ route('search', ['q' => '', 'source' => 'Antara News']) }}" 
                           class="block w-full py-3 text-center text-sm font-bold text-blue-900 bg-blue-50 rounded-xl hover:bg-blue-900 hover:text-white transition-all duration-300">
                            Lihat Berita Antara Lainnya
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 p-6 transition-all hover:scale-[1.02] duration-300 flex flex-col min-h-[400px]">
                    <h2 class="text-xl font-bold text-gray-950 border-b-2 border-gray-950 mb-6 pb-3 uppercase tracking-wider flex items-center">
                        <span class="w-1.5 h-6 bg-gray-950 mr-3 rounded-full"></span>
                        Tempo News
                    </h2>

                    <div class="space-y-6 flex-grow">
                        @forelse($tempoNews as $news)
                            <div class="group border-b border-gray-100 pb-5 last:border-0">
                                <div class="overflow-hidden rounded-2xl mb-3 shadow-sm">
                                    <img src="{{ !empty($news->image_url) ? $news->image_url : 'https://via.placeholder.com/400x200?text=Tempo+News' }}"
                                        class="w-full h-36 object-cover group-hover:scale-110 transition-transform duration-700"
                                        onerror="this.onerror=null;this.src='https://via.placeholder.com/400x200?text=No+Image';">
                                </div>
                                <h3 class="font-extrabold text-gray-950 leading-snug text-sm h-10 overflow-hidden group-hover:text-gray-600 transition-colors">
                                    <a href="{{ route('article.show', $news->slug) }}">{{ $news->title }}</a>
                                </h3>
                                <div class="flex justify-between items-center mt-4 text-[11px] text-gray-400">
                                    <span><i class="far fa-clock mr-1"></i>{{ $news->published_at->diffForHumans() }}</span>
                                    <span class="font-bold text-gray-950 uppercase">Tempo</span>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-400 italic text-center text-sm py-10">Belum ada berita...</p>
                        @endforelse
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-50">
                        <a href="{{ route('search', ['q' => '', 'source' => 'Tempo News']) }}" 
                           class="block w-full py-3 text-center text-sm font-bold text-gray-900 bg-gray-50 rounded-xl hover:bg-gray-900 hover:text-white transition-all duration-300">
                            Lihat Berita Tempo Lainnya
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection