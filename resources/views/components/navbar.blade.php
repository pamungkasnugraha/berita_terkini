<nav class="bg-blue-800 shadow-lg sticky top-0 z-50 w-full">
    {{-- 1. Container: Diubah menjadi max-w-full agar memenuhi layar --}}
    <div class="max-w-full mx-auto px-4 sm:px-8 lg:px-12">

        {{-- 2. Flex Wrapper: Mengatur alur horizontal --}}
        <div class="flex justify-between py-2 lg:py-3 items-center gap-4">

            {{-- AREA LOGO (Kiri) --}}
            <div class="flex items-center space-x-3">
                <img src="{{ asset('assets/img/logo_siber_polda.png') }}" alt="Logo Polda Jateng" class="h-20 w-auto">

                <h1 class="text-white font-bold leading-tight">
                    DIREKTORAT SIBER <span class="text-yellow-400">POLDA</span><br>
                    <span class="text-yellow-400">JATENG</span>
                </h1>
            </div>

            {{-- AREA MENU KATEGORI (Tengah - Dinamis) --}}
            {{-- flex-1 membuat area ini elastis, justify-center menaruh isi foreach di tengah --}}
            <div class="hidden lg:flex flex-1 justify-center items-center space-x-2">
                <a href="/"
                    class="text-white hover:bg-blue-700 hover:text-yellow-300 px-3 py-2 rounded-md text-sm font-medium transition {{ request()->routeIs('home') ? 'bg-blue-900 text-yellow-300' : '' }}">
                    Beranda
                </a>

                {{-- Perulangan Kategori dari Database --}}
                @foreach($categories as $category)
                    <a href="{{ route('kategori', $category->slug ?: '#') }}"
                        class="text-gray-100 hover:bg-blue-700 hover:text-yellow-300 px-3 py-2 rounded-md text-sm font-medium transition whitespace-nowrap {{ request()->segment(2) == $category->slug ? 'text-yellow-300 font-bold' : '' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>

            {{-- AREA SEARCH & LOGIN (Kanan) --}}
            {{-- ml-auto memastikan area ini tetap terkunci di sisi kanan --}}
            <div class="flex items-center gap-3 ml-auto">
                {{-- Form Pencarian --}}
                <form action="{{ route('search') }}" method="GET" class="relative hidden sm:flex items-center">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari berita..."
                        class="px-4 py-1.5 rounded-full text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-yellow-400 w-32 md:w-40 lg:w-48 transition-all border-none">
                    <button type="submit" class="absolute right-3 text-gray-400 hover:text-blue-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>

                {{-- Tombol Login --}}
                <a href="/login"
                    class="bg-yellow-400 text-blue-900 px-6 py-1.5 rounded-full text-sm font-bold hover:bg-yellow-300 transition shadow-md whitespace-nowrap">
                    Login
                </a>
            </div>

        </div>
    </div>
</nav>
