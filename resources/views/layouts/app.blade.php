<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="TechStore - Toko Elektronik Premium. Temukan produk elektronik terbaik dengan harga terjangkau.">
    <title>@yield('title', 'TechStore') — Toko Elektronik Premium</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg-base:      #0a0e1a;
            --bg-surface:   #111827;
            --bg-card:      #1a2235;
            --bg-card-hover:#1e2840;
            --border:       rgba(99,117,255,0.15);
            --border-hover: rgba(99,117,255,0.4);
            --accent:       #6375ff;
            --accent-light: #818cf8;
            --accent-glow:  rgba(99,117,255,0.25);
            --success:      #10b981;
            --danger:       #ef4444;
            --warning:      #f59e0b;
            --text-primary: #f1f5f9;
            --text-secondary:#94a3b8;
            --text-muted:   #64748b;
            --radius-sm:    8px;
            --radius-md:    14px;
            --radius-lg:    20px;
            --shadow-card:  0 4px 24px rgba(0,0,0,0.4);
            --shadow-glow:  0 0 40px rgba(99,117,255,0.12);
            --transition:   all 0.25s cubic-bezier(0.4,0,0.2,1);
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-base);
            color: var(--text-primary);
            min-height: 100vh;
            line-height: 1.6;
            background-image:
                radial-gradient(ellipse 80% 50% at 50% -20%, rgba(99,117,255,0.08) 0%, transparent 70%),
                radial-gradient(ellipse 40% 30% at 80% 80%, rgba(129,140,248,0.05) 0%, transparent 60%);
        }

        /* ──── NAVBAR ──── */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: rgba(10,14,26,0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
        }
        .navbar-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
            height: 68px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }
        .brand-icon {
            width: 38px; height: 38px;
            background: linear-gradient(135deg, var(--accent), #a855f7);
            border-radius: var(--radius-sm);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem;
            box-shadow: 0 0 16px var(--accent-glow);
        }
        .brand-name {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--text-primary);
            letter-spacing: -0.5px;
        }
        .brand-name span { color: var(--accent-light); }

        .navbar-actions { display: flex; align-items: center; gap: 0.75rem; }

        /* ──── BTN ──── */
        .btn {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 0.55rem 1.2rem;
            font-size: 0.875rem; font-weight: 600;
            border-radius: var(--radius-sm);
            border: none; cursor: pointer;
            text-decoration: none;
            transition: var(--transition);
            white-space: nowrap;
            font-family: inherit;
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--accent), #818cf8);
            color: #fff;
            box-shadow: 0 4px 14px rgba(99,117,255,0.4);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99,117,255,0.55);
        }
        .btn-secondary {
            background: var(--bg-card);
            color: var(--text-secondary);
            border: 1px solid var(--border);
        }
        .btn-secondary:hover {
            background: var(--bg-card-hover);
            color: var(--text-primary);
            border-color: var(--border-hover);
        }
        .btn-danger {
            background: rgba(239,68,68,0.12);
            color: var(--danger);
            border: 1px solid rgba(239,68,68,0.25);
        }
        .btn-danger:hover {
            background: rgba(239,68,68,0.22);
            border-color: rgba(239,68,68,0.5);
        }
        .btn-success {
            background: rgba(16,185,129,0.12);
            color: var(--success);
            border: 1px solid rgba(16,185,129,0.25);
        }
        .btn-success:hover {
            background: rgba(16,185,129,0.22);
        }
        .btn-sm { padding: 0.4rem 0.85rem; font-size: 0.8rem; }
        .btn-lg { padding: 0.75rem 1.6rem; font-size: 0.95rem; }

        /* ──── MAIN WRAPPER ──── */
        .main { max-width: 1200px; margin: 0 auto; padding: 2rem 1.5rem; }

        /* ──── FLASH ALERTS ──── */
        .alert {
            display: flex; align-items: center; gap: 10px;
            padding: 1rem 1.25rem;
            border-radius: var(--radius-md);
            margin-bottom: 1.5rem;
            font-size: 0.9rem; font-weight: 500;
            animation: slideDown 0.4s ease;
        }
        .alert-success {
            background: rgba(16,185,129,0.1);
            border: 1px solid rgba(16,185,129,0.3);
            color: #34d399;
        }
        .alert-danger {
            background: rgba(239,68,68,0.1);
            border: 1px solid rgba(239,68,68,0.3);
            color: #f87171;
        }
        .alert-close {
            margin-left: auto; background: none; border: none;
            color: inherit; cursor: pointer; font-size: 1.1rem; opacity: 0.6;
        }
        .alert-close:hover { opacity: 1; }

        /* ──── CARD ──── */
        .card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-card);
            overflow: hidden;
        }
        .card-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
        }
        .card-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.05rem; font-weight: 700;
            color: var(--text-primary);
        }
        .card-body { padding: 1.5rem; }

        /* ──── FORM ELEMENTS ──── */
        .form-group { margin-bottom: 1.25rem; }
        .form-label {
            display: block;
            font-size: 0.82rem; font-weight: 600;
            color: var(--text-secondary);
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }
        .form-control {
            width: 100%;
            background: var(--bg-surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            color: var(--text-primary);
            padding: 0.7rem 1rem;
            font-size: 0.9rem;
            font-family: inherit;
            transition: var(--transition);
            outline: none;
        }
        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-glow);
        }
        .form-control::placeholder { color: var(--text-muted); }
        textarea.form-control { resize: vertical; min-height: 110px; }
        .form-control.is-invalid { border-color: var(--danger); }
        .invalid-feedback {
            font-size: 0.78rem; color: #f87171; margin-top: 0.35rem;
        }

        /* ──── TABLE ──── */
        .table-wrapper { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        thead th {
            padding: 0.9rem 1.25rem;
            font-size: 0.75rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.8px;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border);
            background: rgba(99,117,255,0.04);
            white-space: nowrap;
        }
        tbody tr {
            border-bottom: 1px solid rgba(99,117,255,0.06);
            transition: var(--transition);
        }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: rgba(99,117,255,0.04); }
        td { padding: 1rem 1.25rem; font-size: 0.875rem; vertical-align: middle; }

        /* ──── BADGES ──── */
        .badge {
            display: inline-flex; align-items: center;
            padding: 0.25rem 0.65rem;
            border-radius: 100px;
            font-size: 0.72rem; font-weight: 600;
        }
        .badge-blue { background: rgba(99,117,255,0.15); color: var(--accent-light); }
        .badge-green { background: rgba(16,185,129,0.15); color: #34d399; }
        .badge-red { background: rgba(239,68,68,0.15); color: #f87171; }
        .badge-yellow { background: rgba(245,158,11,0.15); color: #fbbf24; }

        /* ──── PAGE HEADER ──── */
        .page-header {
            display: flex; align-items: flex-start;
            justify-content: space-between; flex-wrap: wrap;
            gap: 1rem; margin-bottom: 2rem;
        }
        .page-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2rem; font-weight: 700;
            letter-spacing: -0.5px;
            line-height: 1.2;
        }
        .page-subtitle { color: var(--text-secondary); font-size: 0.9rem; margin-top: 0.25rem; }

        /* ──── ANIMATIONS ──── */
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-in { animation: fadeIn 0.5s ease both; }

        /* ──── FOOTER ──── */
        .footer {
            text-align: center;
            padding: 2rem 1.5rem;
            color: var(--text-muted);
            font-size: 0.8rem;
            border-top: 1px solid var(--border);
            margin-top: 4rem;
        }

        /* ──── RESPONSIVE ──── */
        @media (max-width: 640px) {
            .page-title { font-size: 1.5rem; }
            .page-header { flex-direction: column; }
            td, thead th { padding: 0.75rem 0.9rem; }
        }
    </style>
    @yield('styles')
</head>
<body>

<nav class="navbar">
    <div class="navbar-inner">
        <a href="{{ route('products.index') }}" class="navbar-brand" id="navbar-brand">
            <div class="brand-icon">⚡</div>
            <span class="brand-name">Tech<span>Store</span></span>
        </a>
        <div class="navbar-actions">
            <a href="{{ route('products.index') }}" class="btn btn-secondary btn-sm" id="nav-products">
                🗂 Produk
            </a>
            <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm" id="nav-add-product">
                ＋ Tambah
            </a>
        </div>
    </div>
</nav>

<main class="main">
    @if(session('success'))
        <div class="alert alert-success fade-in" id="alert-success">
            <span>✅</span>
            <span>{{ session('success') }}</span>
            <button class="alert-close" onclick="this.parentElement.remove()" aria-label="Tutup">✕</button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger fade-in" id="alert-error">
            <span>❌</span>
            <span>{{ session('error') }}</span>
            <button class="alert-close" onclick="this.parentElement.remove()" aria-label="Tutup">✕</button>
        </div>
    @endif

    @yield('content')
</main>

<footer class="footer">
    <p>© {{ date('Y') }} <strong>TechStore</strong> — Toko Elektronik Premium</p>
</footer>

<script>
    // Auto-dismiss alerts after 5s
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(el => {
            el.style.transition = 'opacity 0.4s';
            el.style.opacity = '0';
            setTimeout(() => el.remove(), 400);
        });
    }, 5000);
</script>
@yield('scripts')
</body>
</html>
