@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
<style>
    body {
        background: #232b3a !important;
        color: #fff !important;
    }
    .product-list-bg {
        background: #232b3a;
        min-height: 100vh;
        padding: 0;
    }
    .product-toolbar {
        background: #232b3a;
        padding: 1.5rem 1rem 1rem 1rem;
        border-radius: 1.2rem 1.2rem 0 0;
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        align-items: center;
    }
    .product-search {
        background: #2d3748;
        border: none;
        color: #bfc9da;
        border-radius: 0.7rem;
        padding: 0.6rem 1.2rem 0.6rem 2.2rem;
        min-width: 220px;
        font-size: 1rem;
        outline: none;
        position: relative;
    }
    .product-search:focus { background: #374151; color: #fff; }
    .product-toolbar .btn-primary {
        background: #2563eb;
        border: none;
        border-radius: 0.7rem;
        font-weight: 600;
        font-size: 1rem;
        padding: 0.6rem 1.5rem;
    }
    .product-toolbar .btn-primary:hover { background: #1d4ed8; }
    .product-toolbar .btn-outline-secondary {
        border-radius: 0.7rem;
        font-weight: 600;
        color: #bfc9da;
        border: 1.5px solid #374151;
        background: #2d3748;
        padding: 0.6rem 1.2rem;
    }
    .product-toolbar .btn-outline-secondary:hover { background: #374151; color: #fff; }
    .product-card-list {
        background: #232b3a;
        border: none;
        border-radius: 1.2rem;
        margin-bottom: 1.2rem;
        box-shadow: 0 2px 8px 0 rgba(0,0,0,0.08);
        display: flex;
        align-items: center;
        padding: 1.2rem 1.5rem;
        gap: 1.5rem;
        position: relative;
    }
    .product-card-list .product-img {
        width: 80px; height: 80px; object-fit: contain; border-radius: 1rem; background: #fff; box-shadow: 0 2px 8px 0 rgba(0,0,0,0.04);
    }
    .product-card-list .product-info {
        flex: 1;
        min-width: 0;
    }
    .product-card-list .product-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #fff;
        margin-bottom: 0.2rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .product-card-list .product-category {
        color: #bfc9da;
        font-size: 1rem;
        margin-bottom: 0.2rem;
    }
    .product-card-list .product-meta {
        display: flex;
        gap: 2.5rem;
        margin-top: 0.5rem;
        font-size: 1.05rem;
    }
    .product-card-list .product-meta span {
        color: #fff;
        font-weight: 600;
    }
    .product-card-list .product-meta-label {
        color: #bfc9da;
        font-size: 0.97rem;
        font-weight: 400;
        margin-right: 0.3rem;
    }
    .product-card-list .product-crud-menu {
        position: absolute;
        right: 1.5rem;
        top: 1.5rem;
    }
    .product-card-list .dropdown-menu {
        min-width: 140px;
        border-radius: 0.7rem;
        background: #2d3748;
        color: #fff;
        border: none;
        box-shadow: 0 4px 16px 0 rgba(0,0,0,0.12);
        padding: 0.5rem 0;
    }
    .product-card-list .dropdown-item {
        color: #bfc9da;
        font-weight: 500;
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        border-radius: 0.5rem;
        padding: 0.5rem 1.2rem;
        transition: background .15s, color .15s;
    }
    .product-card-list .dropdown-item:hover {
        background: #374151;
        color: #fff;
    }
    .alert-info {
        background: #2d3748;
        color: #bfc9da;
        border: none;
    }
</style>
<div class="product-list-bg">
    <form method="GET" action="{{ route('products.index') }}" class="product-toolbar mb-3" style="width:100%;">
        <div class="position-relative">
            <input type="text" name="search" value="{{ request('search') }}" class="product-search" placeholder="Search product name...">
            <svg xmlns="http://www.w3.org/2000/svg" style="position:absolute;left:10px;top:50%;transform:translateY(-50%);color:#bfc9da;" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
        </div>
        <a href="{{ route('products.create') }}" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" class="me-1" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 5v14m7-7H5"/></svg>
            Add product
        </a>
    </form>
    <div class="container-fluid px-0">
        @forelse ($products as $product)
            <div class="product-card-list mb-3">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($product->name) }}&background=eee&color=555&size=256" class="product-img" alt="{{ $product->name }}">
                <div class="product-info">
                    <div class="d-flex align-items-center mb-1">
                        <div class="product-title me-2">{{ $product->name }}</div>
                        @if($product->status === 'active')
                            <span class="badge bg-success" style="font-size:0.95rem;">Active</span>
                        @else
                            <span class="badge bg-secondary" style="font-size:0.95rem;">Inactive</span>
                        @endif
                    </div>
                    <div class="product-category">Category<br><span class="fw-bold">{{ $product->toko->name_toko ?? '-' }}</span></div>
                    <div class="product-meta">
                        <div><span class="product-meta-label">Price</span> <span>${{ number_format($product->price,0) }}</span></div>
                        <div><span class="product-meta-label">Stock</span> <span>{{ $product->stock }}</span></div>
                    </div>
                </div>
                <div class="product-crud-menu dropdown">
                    <button class="btn btn-link text-white p-0" type="button" id="dropdownMenuButton{{ $product->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="5" cy="12" r="1.5"/><circle cx="12" cy="12" r="1.5"/><circle cx="19" cy="12" r="1.5"/></svg>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton{{ $product->id }}">
                        <li>
                            <a class="dropdown-item" href="{{ route('products.show', $product->id) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-eye" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z"/><circle cx="12" cy="12" r="3"/></svg>
                                Preview
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('products.edit', $product->id) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-pencil" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                                Edit
                            </a>
                        </li>
                        <li>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item text-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-trash" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M8 6v-2a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="m10 11v6"/><path d="m14 11v6"/></svg>
                                    Delete
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        @empty
            <div class="alert alert-info text-center py-4">
                <i class="fas fa-info-circle me-1"></i> Belum ada data produk.
            </div>
        @endforelse
    </div>
</div>
@endsection
