<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Direktorat Siber Polda Jawa Tengah</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-slate-100">

  <!-- Navbar -->
  <header class="bg-slate-800 border-b border-slate-700 shadow-md">
      @include('components.navbar')
  </header>

  <!-- Content -->
  <main class="container mx-auto px-4 py-8">
      @yield('content')
  </main>

  <!-- Footer -->
  <footer class="bg-slate-800 border-t border-slate-700 mt-10">
      @include('components.footer')
  </footer>

</body>
</html>