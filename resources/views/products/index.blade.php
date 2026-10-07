@extends('layouts.app')

@section('title', 'Katalog Produk')

@section('styles')
<style>
    /* ──── STATS STRIP ──── */
    .stats-strip {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }
    .stat-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        padding: 1.25rem 1.5rem;
        display: flex; align-items: center; gap: 1rem;
        transition: var(--transition);
    }
    .stat-card:hover {
        border-color: var(--border-hover);
        transform: translateY(-2px);
        box-shadow: var(--shadow-glow);
    }
    .stat-icon {
        font-size: 1.6rem;
        width: 48px; height: 48px;
        display: flex; align-items: center; justify-content: center;
        border-radius: var(--radius-sm);
    }
    .stat-icon.blue  { background: rgba(99,117,255,0.12); }
    .stat-icon.green { background: rgba(16,185,129,0.12); }
    .stat-icon.yellow{ background: rgba(245,158,11,0.12); }
    .stat-icon.red   { background: rgba(239,68,68,0.12);  }
    .stat-info {}
    .stat-value {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.5rem; font-weight: 700;
        line-height: 1.1;
    }
    .stat-label {
        font-size: 0.78rem; color: var(--text-muted);
        font-weight: 500; text-transform: uppercase; letter-spacing: 0.4px;
        margin-top: 2px;
    }

    /* ──── FILTER BAR ──── */
    .filter-bar {
        display: flex; align-items: center; gap: 0.75rem;
        flex-wrap: wrap;
        margin-bottom: 1.5rem;
    }
    .search-wrapper {
        position: relative; flex: 1; min-width: 220px;
    }
    .search-icon {
        position: absolute; left: 12px; top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted); font-size: 1rem; pointer-events: none;
    }
    .search-wrapper .form-control { padding-left: 2.5rem; }
    .filter-select {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        color: var(--text-primary);
        padding: 0.6rem 1rem;
        font-size: 0.875rem;
        font-family: inherit;
        outline: none;
        cursor: pointer;
        transition: var(--transition);
    }
    .filter-select:focus { border-color: var(--accent); box-shadow: 0 0 0 3px var(--accent-glow); }

    /* ──── PRODUCT GRID ──── */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.25rem;
        margin-bottom: 2rem;
    }
    .product-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        overflow: hidden;
        transition: var(--transition);
        display: flex; flex-direction: column;
        animation: fadeIn 0.4s ease both;
    }
    .product-card:hover {
        transform: translateY(-4px);
        border-color: var(--border-hover);
        box-shadow: var(--shadow-card), 0 0 30px var(--accent-glow);
    }
    .product-card-banner {
        height: 6px;
        background: linear-gradient(90deg, var(--accent), #a855f7);
    }
    .product-card-body { padding: 1.25rem; flex: 1; display: flex; flex-direction: column; }
    .product-category {
        font-size: 0.7rem; font-weight: 700;
        text-transform: uppercase; letter-spacing: 1px;
        color: var(--accent-light); margin-bottom: 0.5rem;
    }
    .product-name {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.05rem; font-weight: 700;
        color: var(--text-primary); margin-bottom: 0.4rem;
        line-height: 1.3;
    }
    .product-desc {
        font-size: 0.82rem; color: var(--text-secondary);
        flex: 1; margin-bottom: 1rem;
        display: -webkit-box; -webkit-line-clamp: 2;
        -webkit-box-orient: vertical; overflow: hidden;
    }
    .product-meta {
        display: flex; align-items: center; justify-content: space-between;
        padding-top: 1rem;
        border-top: 1px solid var(--border);
    }
    .product-price {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.15rem; font-weight: 700;
        color: var(--accent-light);
    }
    .product-stock {
        font-size: 0.78rem; font-weight: 600;
    }
    .product-actions {
        display: flex; gap: 0.5rem;
        padding: 0.75rem 1.25rem;
        border-top: 1px solid var(--border);
        background: rgba(0,0,0,0.15);
    }
    .product-actions a, .product-actions button { flex: 1; justify-content: center; }

    /* ──── EMPTY STATE ──── */
    .empty-state {
        text-align: center; padding: 5rem 2rem;
        color: var(--text-secondary);
    }
    .empty-icon { font-size: 4rem; margin-bottom: 1rem; opacity: 0.4; }
    .empty-title {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.3rem; font-weight: 700;
        color: var(--text-primary); margin-bottom: 0.5rem;
    }
    .empty-text { font-size: 0.875rem; margin-bottom: 1.5rem; }

    /* ──── PAGINATION ──── */
    .pagination-wrapper {
        display: flex; justify-content: center; align-items: center;
        gap: 0.4rem; margin-top: 1rem;
    }
    .pagination-wrapper .page-link,
    .pagination-wrapper span {
        display: inline-flex; align-items: center; justify-content: center;
        min-width: 36px; height: 36px; padding: 0 0.5rem;
        border-radius: var(--radius-sm);
        font-size: 0.85rem; font-weight: 600;
        text-decoration: none;
        transition: var(--transition);
    }
    .pagination-wrapper a.page-link {
        background: var(--bg-card); border: 1px solid var(--border);
        color: var(--text-secondary);
    }
    .pagination-wrapper a.page-link:hover {
        background: var(--bg-card-hover); border-color: var(--border-hover);
        color: var(--text-primary);
    }
    .pagination-wrapper span.current {
        background: linear-gradient(135deg, var(--accent), #818cf8);
        color: #fff; border: none;
    }
    .pagination-wrapper span.disabled {
        color: var(--text-muted); cursor: default;
        background: transparent;
    }
</style>
@endsection

@section('content')
    {{-- Page Header --}}
    <div class="page-header fade-in">
        <div>
            <h1 class="page-title">🖥 Katalog Produk</h1>
            <p class="page-subtitle">Kelola inventaris elektronik Anda dengan mudah</p>
        </div>
        <a href="{{ route('products.create') }}" class="btn btn-primary btn-lg" id="btn-add-product">
            ＋ Tambah Produk
        </a>
    </div>

    {{-- Stats --}}
    <div class="stats-strip fade-in">
        <div class="stat-card">
            <div class="stat-icon blue">📦</div>
            <div class="stat-info">
                <div class="stat-value">{{ $products->total() }}</div>
                <div class="stat-label">Total Produk</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green">💰</div>
            <div class="stat-info">
                <div class="stat-value">Rp {{ number_format($products->sum('price') / max($products->count(),1), 0, ',', '.') }}</div>
                <div class="stat-label">Rata-rata Harga</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon yellow">🏷</div>
            <div class="stat-info">
                <div class="stat-value">{{ $categories->count() }}</div>
                <div class="stat-label">Kategori</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon red">📊</div>
            <div class="stat-info">
                <div class="stat-value">{{ $products->sum('stock') }}</div>
                <div class="stat-label">Total Stok</div>
            </div>
        </div>
    </div>

    {{-- Filter Bar --}}
    <form method="GET" action="{{ route('products.index') }}" class="filter-bar" id="filter-form">
        <div class="search-wrapper">
            <span class="search-icon">🔍</span>
            <input
                type="text"
                name="search"
                id="input-search"
                class="form-control"
                placeholder="Cari produk atau kategori..."
                value="{{ request('search') }}"
            >
        </div>
        <select name="category" id="select-category" class="filter-select" onchange="this.form.submit()">
            <option value="">Semua Kategori</option>
            @foreach($categories as $cat)
                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary" id="btn-search">Cari</button>
        @if(request('search') || request('category'))
            <a href="{{ route('products.index') }}" class="btn btn-secondary" id="btn-reset">Reset</a>
        @endif
    </form>

    {{-- Product Grid --}}
    @if($products->isEmpty())
        <div class="empty-state fade-in">
            <div class="empty-icon">📭</div>
            <div class="empty-title">Tidak ada produk ditemukan</div>
            <p class="empty-text">
                @if(request('search') || request('category'))
                    Coba ubah kata kunci pencarian Anda.
                @else
                    Mulai dengan menambahkan produk pertama Anda!
                @endif
            </p>
            <a href="{{ route('products.create') }}" class="btn btn-primary" id="btn-add-first-product">＋ Tambah Produk Pertama</a>
        </div>
    @else
        <div class="product-grid">
            @foreach($products as $product)
                <div class="product-card" style="animation-delay: {{ $loop->index * 0.05 }}s">
                    <div class="product-card-banner"></div>
                    <div class="product-card-body">
                        <div class="product-category">{{ $product->category ?: 'Umum' }}</div>
                        <div class="product-name">{{ $product->name }}</div>
                        <div class="product-desc">{{ $product->description ?: 'Tidak ada deskripsi.' }}</div>
                        <div class="product-meta">
                            <div class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                            @if($product->stock > 10)
                                <span class="badge badge-green" title="Stok tersedia">✓ Stok: {{ $product->stock }}</span>
                            @elseif($product->stock > 0)
                                <span class="badge badge-yellow" title="Stok hampir habis">⚠ Stok: {{ $product->stock }}</span>
                            @else
                                <span class="badge badge-red" title="Stok habis">✕ Habis</span>
                            @endif
                        </div>
                    </div>
                    <div class="product-actions">
                        <a href="{{ route('products.show', $product) }}" class="btn btn-secondary btn-sm" id="btn-show-{{ $product->id }}" title="Detail">👁 Detail</a>
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-success btn-sm" id="btn-edit-{{ $product->id }}" title="Edit">✏ Edit</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" style="flex:1; display:contents">
                            @csrf @method('DELETE')
                            <button type="submit"
                                id="btn-delete-{{ $product->id }}"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Hapus produk \'{{ addslashes($product->name) }}\'? Tindakan ini tidak dapat dibatalkan.')"
                                title="Hapus">🗑 Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($products->hasPages())
            <div class="pagination-wrapper" id="pagination">
                {{-- Prev --}}
                @if($products->onFirstPage())
                    <span class="disabled">‹ Prev</span>
                @else
                    <a href="{{ $products->previousPageUrl() }}&{{ http_build_query(request()->except('page')) }}" class="page-link">‹ Prev</a>
                @endif

                @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                    @if($page == $products->currentPage())
                        <span class="current">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}&{{ http_build_query(request()->except('page')) }}" class="page-link">{{ $page }}</a>
                    @endif
                @endforeach

                {{-- Next --}}
                @if($products->hasMorePages())
                    <a href="{{ $products->nextPageUrl() }}&{{ http_build_query(request()->except('page')) }}" class="page-link">Next ›</a>
                @else
                    <span class="disabled">Next ›</span>
                @endif
            </div>
        @endif
    @endif
@endsection
