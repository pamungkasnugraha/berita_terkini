@extends('layouts.main')

@section('content')
<div class="relative min-h-screen py-10 bg-contain bg-center bg-fixed bg-no-repeat"
    style="background-image: url('{{ asset('assets/img/logo_polda_siber.png') }}');">

    <div class="absolute inset-0 bg-[#0f172a]/80"></div>

    <div class="relative container mx-auto px-4 lg:px-8">
        
        <div class="mb-12 text-center">
            <h1 class="text-3xl font-extrabold text-white uppercase tracking-widest">
                Kanal <span class="text-blue-400">{{ $category->name }}</span>
            </h1>
            <div class="w-20 h-1.5 bg-blue-500 mx-auto mt-3 rounded-full shadow-lg shadow-blue-500/50"></div>
        </div>

        <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 p-6 md:p-10 transition-all inline-block w-full">
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 items-start">
                @forelse($allInternasionalNews as $news)
                    <div class="transform transition-transform duration-300 hover:-translate-y-2">
                        @include('partials.article-card', ['news' => $news])
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center">
                        <p class="text-gray-400 italic">Belum ada berita internasional tersedia saat ini...</p>
                    </div>
                @endforelse
            </div>

            @if($allInternasionalNews->hasPages())
                <div class="mt-12 pt-8 border-t border-gray-100">
                    {{ $allInternasionalNews->links() }}
                </div>
            @endif
        </div>
        
    </div>
</div>
@endsection