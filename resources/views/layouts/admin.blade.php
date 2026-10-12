<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Berita Terkini</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans flex">

    <aside class="w-64 bg-gray-900 text-white min-h-screen p-4 fixed">
        <div class="text-2xl font-black mb-8 text-center text-yellow-400 border-b border-gray-700 pb-4 tracking-tighter">
            ADMIN<span class="text-white">PANEL</span>
        </div>
        
        <nav class="space-y-2">
            <a href="{{ route('admin.dashboard') }}" 
               class="block py-2.5 px-4 rounded transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600' : 'hover:bg-gray-700' }}">
               📊 Dashboard
            </a>
            
            <a href="{{ route('admin.articles.index') }}" 
               class="block py-2.5 px-4 rounded transition {{ request()->is('admin/articles*') ? 'bg-blue-600' : 'hover:bg-gray-700' }}">
               📰 Kelola Berita
            </a>

            <a href="{{ route('admin.categories.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">📂 Kategori</a>
            

                <form action="{{ route('logout') }}" method="POST" class="mt-2">
                    @csrf
                    <button type="submit" class="w-full text-left py-2.5 px-4 rounded transition hover:bg-red-600 text-red-400 hover:text-white font-bold">
                        🚪 Keluar
                    </button>
                </form>
            </div>
        </nav>
    </aside>

    <main class="flex-1 ml-64 p-8">
        @yield('admin_content') 
    </main>

</body>
</html>