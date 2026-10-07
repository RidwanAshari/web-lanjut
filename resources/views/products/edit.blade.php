@extends('layouts.app')

@section('title', 'Edit: ' . $product->name)

@section('styles')
<style>
    .form-card {
        max-width: 720px;
        margin: 0 auto;
    }
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.25rem;
    }
    .form-grid .full { grid-column: 1 / -1; }
    @media (max-width: 640px) {
        .form-grid { grid-template-columns: 1fr; }
        .form-grid .full { grid-column: 1; }
    }
    .input-prefix-wrapper {
        position: relative; display: flex; align-items: stretch;
    }
    .input-prefix {
        display: flex; align-items: center; padding: 0 0.9rem;
        background: rgba(99,117,255,0.1);
        border: 1px solid var(--border); border-right: none;
        border-radius: var(--radius-sm) 0 0 var(--radius-sm);
        color: var(--text-secondary); font-size: 0.875rem; font-weight: 600;
        white-space: nowrap;
    }
    .input-prefix + .form-control {
        border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
    }
    .form-actions {
        display: flex; gap: 0.75rem; justify-content: flex-end;
        padding-top: 1.25rem;
        border-top: 1px solid var(--border);
        margin-top: 0.5rem;
    }
    .edit-meta {
        display: flex; align-items: center; gap: 1rem;
        padding: 0.85rem 1.25rem;
        background: rgba(99,117,255,0.05);
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        margin-bottom: 1.5rem;
        font-size: 0.82rem; color: var(--text-secondary);
    }
    .category-pills {
        display: flex; flex-wrap: wrap; gap: 0.5rem; margin-top: 0.5rem;
    }
    .category-pill {
        padding: 0.3rem 0.8rem;
        background: var(--bg-surface);
        border: 1px solid var(--border);
        border-radius: 100px;
        font-size: 0.78rem; font-weight: 600;
        color: var(--text-secondary);
        cursor: pointer; transition: var(--transition);
    }
    .category-pill:hover {
        background: rgba(99,117,255,0.1);
        border-color: var(--accent);
        color: var(--accent-light);
    }
</style>
@endsection

@section('content')
    {{-- Breadcrumb --}}
    <div class="page-header fade-in" style="margin-bottom:1.5rem">
        <div>
            <div style="font-size:0.82rem; color:var(--text-muted); margin-bottom:0.5rem">
                <a href="{{ route('products.index') }}" style="color:var(--text-muted);text-decoration:none">Produk</a>
                <span style="margin:0 0.4rem">›</span>
                <a href="{{ route('products.show', $product) }}" style="color:var(--text-muted);text-decoration:none">{{ $product->name }}</a>
                <span style="margin:0 0.4rem">›</span>
                <span style="color:var(--accent-light)">Edit</span>
            </div>
            <h1 class="page-title">✏️ Edit Produk</h1>
            <p class="page-subtitle">Perbarui informasi produk</p>
        </div>
        <a href="{{ route('products.show', $product) }}" class="btn btn-secondary" id="btn-view-detail">👁 Lihat Detail</a>
    </div>

    <div class="form-card fade-in">
        {{-- Edit Meta --}}
        <div class="edit-meta">
            <span>🆔 ID: <strong style="color:var(--text-primary)">#{{ $product->id }}</strong></span>
            <span>📅 Dibuat: <strong style="color:var(--text-primary)">{{ $product->created_at->format('d M Y') }}</strong></span>
            <span>🔄 Diperbarui: <strong style="color:var(--text-primary)">{{ $product->updated_at->diffForHumans() }}</strong></span>
        </div>

        <div class="card">
            <div class="card-header">
                <span class="card-title">📝 Form Edit — {{ $product->name }}</span>
            </div>
            <div class="card-body">
                <form action="{{ route('products.update', $product) }}" method="POST" id="form-edit-product">
                    @csrf
                    @method('PUT')
                    <div class="form-grid">
                        {{-- Name --}}
                        <div class="form-group full">
                            <label for="input-name" class="form-label">Nama Produk *</label>
                            <input
                                type="text"
                                name="name"
                                id="input-name"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Nama produk"
                                value="{{ old('name', $product->name) }}"
                                required
                                autofocus
                            >
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Price --}}
                        <div class="form-group">
                            <label for="input-price" class="form-label">Harga *</label>
                            <div class="input-prefix-wrapper">
                                <span class="input-prefix">Rp</span>
                                <input
                                    type="number"
                                    name="price"
                                    id="input-price"
                                    class="form-control @error('price') is-invalid @enderror"
                                    placeholder="0"
                                    value="{{ old('price', $product->price) }}"
                                    min="0" step="1000"
                                    required
                                >
                            </div>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Stock --}}
                        <div class="form-group">
                            <label for="input-stock" class="form-label">Stok *</label>
                            <input
                                type="number"
                                name="stock"
                                id="input-stock"
                                class="form-control @error('stock') is-invalid @enderror"
                                placeholder="0"
                                value="{{ old('stock', $product->stock) }}"
                                min="0"
                                required
                            >
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Category --}}
                        <div class="form-group full">
                            <label for="input-category" class="form-label">Kategori</label>
                            <input
                                type="text"
                                name="category"
                                id="input-category"
                                class="form-control @error('category') is-invalid @enderror"
                                placeholder="Contoh: Smartphone, Laptop..."
                                value="{{ old('category', $product->category) }}"
                                list="category-suggestions"
                            >
                            <datalist id="category-suggestions">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}">
                                @endforeach
                                <option value="Smartphone">
                                <option value="Laptop">
                                <option value="Tablet">
                                <option value="Aksesoris">
                                <option value="Audio">
                                <option value="Kamera">
                                <option value="Gaming">
                                <option value="Smart Home">
                            </datalist>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="category-pills">
                                @foreach(['Smartphone', 'Laptop', 'Tablet', 'Aksesoris', 'Audio', 'Gaming'] as $preset)
                                    <span class="category-pill" onclick="document.getElementById('input-category').value='{{ $preset }}'">{{ $preset }}</span>
                                @endforeach
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="form-group full">
                            <label for="input-description" class="form-label">Deskripsi</label>
                            <textarea
                                name="description"
                                id="input-description"
                                class="form-control @error('description') is-invalid @enderror"
                                placeholder="Spesifikasi dan fitur produk..."
                                rows="4"
                            >{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('products.index') }}" class="btn btn-secondary" id="btn-cancel-edit">← Batal</a>
                        <button type="submit" class="btn btn-primary" id="btn-submit-edit">✓ Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
