@extends('layouts.app')

@section('title', $product->name)

@section('styles')
<style>
    .detail-wrapper {
        max-width: 820px;
        margin: 0 auto;
    }
    .detail-hero {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        overflow: hidden;
        margin-bottom: 1.5rem;
        box-shadow: var(--shadow-card);
    }
    .detail-hero-banner {
        height: 8px;
        background: linear-gradient(90deg, var(--accent), #a855f7, #ec4899);
    }
    .detail-hero-body {
        padding: 2rem;
    }
    .detail-category {
        font-size: 0.72rem; font-weight: 700;
        text-transform: uppercase; letter-spacing: 1.2px;
        color: var(--accent-light); margin-bottom: 0.6rem;
        display: inline-flex; align-items: center; gap: 4px;
    }
    .detail-name {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.9rem; font-weight: 800;
        letter-spacing: -0.5px; line-height: 1.2;
        margin-bottom: 1rem;
    }
    .detail-price-block {
        display: inline-flex; align-items: baseline; gap: 0.4rem;
        background: rgba(99,117,255,0.08);
        border: 1px solid rgba(99,117,255,0.2);
        border-radius: var(--radius-md);
        padding: 0.6rem 1.2rem;
        margin-bottom: 1.5rem;
    }
    .price-label { font-size: 0.8rem; color: var(--text-muted); font-weight: 600; }
    .price-value {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.8rem; font-weight: 800;
        color: var(--accent-light);
    }
    .detail-desc {
        color: var(--text-secondary); font-size: 0.9rem; line-height: 1.75;
        padding: 1.25rem;
        background: var(--bg-surface);
        border-radius: var(--radius-md);
        border: 1px solid var(--border);
        margin-bottom: 1.5rem;
    }
    .detail-meta-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }
    .detail-meta-item {
        background: var(--bg-surface);
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        padding: 1rem 1.25rem;
        transition: var(--transition);
    }
    .detail-meta-item:hover { border-color: var(--border-hover); }
    .meta-icon { font-size: 1.3rem; margin-bottom: 0.4rem; }
    .meta-label {
        font-size: 0.72rem; font-weight: 700;
        text-transform: uppercase; letter-spacing: 0.5px;
        color: var(--text-muted); margin-bottom: 0.25rem;
    }
    .meta-value {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 0.95rem; font-weight: 700;
        color: var(--text-primary);
    }
    .detail-actions {
        display: flex; gap: 0.75rem; flex-wrap: wrap;
    }
    .danger-zone {
        background: rgba(239,68,68,0.05);
        border: 1px solid rgba(239,68,68,0.2);
        border-radius: var(--radius-md);
        padding: 1.25rem;
        margin-top: 1.5rem;
    }
    .danger-zone-title {
        font-size: 0.82rem; font-weight: 700;
        color: var(--danger); text-transform: uppercase; letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }
    .danger-zone-text {
        font-size: 0.82rem; color: var(--text-muted); margin-bottom: 1rem;
    }
</style>
@endsection

@section('content')
    {{-- Breadcrumb --}}
    <div style="font-size:0.82rem; color:var(--text-muted); margin-bottom:1.5rem" class="fade-in">
        <a href="{{ route('products.index') }}" style="color:var(--text-muted);text-decoration:none;transition:color 0.2s" onmouseover="this.style.color='var(--accent-light)'" onmouseout="this.style.color='var(--text-muted)'">Produk</a>
        <span style="margin:0 0.4rem">›</span>
        <span style="color:var(--accent-light)">{{ $product->name }}</span>
    </div>

    <div class="detail-wrapper fade-in">
        <div class="detail-hero">
            <div class="detail-hero-banner"></div>
            <div class="detail-hero-body">
                <div class="detail-category">
                    🏷 {{ $product->category ?: 'Umum' }}
                </div>
                <h1 class="detail-name">{{ $product->name }}</h1>

                <div class="detail-price-block">
                    <span class="price-label">Harga</span>
                    <span class="price-value">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                </div>

                @if($product->description)
                    <div class="detail-desc">
                        {{ $product->description }}
                    </div>
                @else
                    <div class="detail-desc" style="font-style:italic;color:var(--text-muted)">
                        Tidak ada deskripsi tersedia untuk produk ini.
                    </div>
                @endif

                {{-- Meta Grid --}}
                <div class="detail-meta-grid">
                    <div class="detail-meta-item">
                        <div class="meta-icon">🆔</div>
                        <div class="meta-label">ID Produk</div>
                        <div class="meta-value">#{{ $product->id }}</div>
                    </div>
                    <div class="detail-meta-item">
                        <div class="meta-icon">📦</div>
                        <div class="meta-label">Stok</div>
                        <div class="meta-value">
                            {{ $product->stock }} unit
                            @if($product->stock == 0)
                                <span class="badge badge-red" style="margin-left:4px">Habis</span>
                            @elseif($product->stock <= 10)
                                <span class="badge badge-yellow" style="margin-left:4px">Menipis</span>
                            @else
                                <span class="badge badge-green" style="margin-left:4px">Tersedia</span>
                            @endif
                        </div>
                    </div>
                    <div class="detail-meta-item">
                        <div class="meta-icon">📅</div>
                        <div class="meta-label">Ditambahkan</div>
                        <div class="meta-value">{{ $product->created_at->format('d M Y') }}</div>
                    </div>
                    <div class="detail-meta-item">
                        <div class="meta-icon">🔄</div>
                        <div class="meta-label">Diperbarui</div>
                        <div class="meta-value">{{ $product->updated_at->diffForHumans() }}</div>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="detail-actions">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary" id="btn-back-to-list">← Kembali</a>
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-primary" id="btn-edit-product">✏ Edit Produk</a>
                </div>

                {{-- Danger Zone --}}
                <div class="danger-zone">
                    <div class="danger-zone-title">⚠ Zona Berbahaya</div>
                    <div class="danger-zone-text">Setelah dihapus, produk tidak dapat dikembalikan. Pastikan Anda yakin sebelum melanjutkan.</div>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button
                            type="submit"
                            id="btn-delete-product"
                            class="btn btn-danger"
                            onclick="return confirm('Yakin ingin menghapus produk \'{{ addslashes($product->name) }}\'?\nTindakan ini tidak dapat dibatalkan!')"
                        >
                            🗑 Hapus Produk Ini
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
