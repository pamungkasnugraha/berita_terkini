<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NewsHub | Aggregator Berita Terkini</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f8fa; color: #333; }
        .navbar { background: #ffffff; border-bottom: 1px solid #eee; }
        .navbar-brand { font-weight: 700; color: #2d3436; letter-spacing: -1px; }
        .card { border: none; border-radius: 12px; transition: transform 0.3s ease; overflow: hidden; }
        .card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
        .btn-primary { border-radius: 8px; background-color: #0984e3; border: none; padding: 10px 20px; }
        .category-badge { font-size: 0.7rem; text-transform: uppercase; font-weight: 700; padding: 4px 10px; border-radius: 50px; background: #dfe6e9; color: #636e72; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top py-3">
        <div class="container">
            <a class="navbar-brand fs-3" href="/">NEWS<span class="text-primary">HUB</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link fw-semibold" href="/">Terbaru</a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="#">Kategori</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-outline-primary ms-lg-3 px-4" href="/login">Admin</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-5">
        @yield('content')

        @include ('components.footer')
    </main>

    

    <footer class="bg-white py-4 border-top">
        <div class="container text-center text-muted small">
            &copy; 2026 NewsHub Project - Politeknik Negeri Cilacap.
        </div>
    </footer>
</body>
</html>