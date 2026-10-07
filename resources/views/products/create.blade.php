@extends('layouts.app')

@section('title', 'Tambah Produk')

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
                <span style="color:var(--accent-light)">Tambah Produk</span>
            </div>
            <h1 class="page-title">➕ Tambah Produk Baru</h1>
            <p class="page-subtitle">Isi detail produk elektronik yang akan dijual</p>
        </div>
    </div>

    <div class="form-card fade-in">
        <div class="card">
            <div class="card-header">
                <span class="card-title">📋 Form Produk</span>
            </div>
            <div class="card-body">
                <form action="{{ route('products.store') }}" method="POST" id="form-create-product">
                    @csrf
                    <div class="form-grid">
                        {{-- Name --}}
                        <div class="form-group full">
                            <label for="input-name" class="form-label">Nama Produk *</label>
                            <input
                                type="text"
                                name="name"
                                id="input-name"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Contoh: Samsung Galaxy S25 Ultra"
                                value="{{ old('name') }}"
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
                                    value="{{ old('price') }}"
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
                                value="{{ old('stock', 0) }}"
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
                                placeholder="Contoh: Smartphone, Laptop, Aksesoris..."
                                value="{{ old('category') }}"
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
                                placeholder="Deskripsikan spesifikasi dan fitur produk..."
                                rows="4"
                            >{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('products.index') }}" class="btn btn-secondary" id="btn-cancel-create">← Batal</a>
                        <button type="submit" class="btn btn-primary" id="btn-submit-create">✓ Simpan Produk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
