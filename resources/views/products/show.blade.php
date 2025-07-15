@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')
<div class="card shadow-sm mb-4">
    <div class="row g-0">
        <div class="col-md-4 d-flex align-items-center justify-content-center p-4">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($product->name) }}&background=eee&color=555&size=256" alt="{{ $product->name }}" class="img-fluid rounded" style="max-height:220px;object-fit:contain;">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h3 class="card-title mb-2" style="font-weight:600; color:#f57224;">{{ $product->name }}</h3>
                <div class="mb-2" style="font-size:1.3rem; color:#03ac0e; font-weight:500;">Rp{{ number_format($product->price,0,',','.') }}</div>
                <div class="mb-2">
                    <span class="badge {{ $product->status === 'active' ? 'bg-success' : 'bg-secondary' }}">{{ ucfirst($product->status) }}</span>
                </div>
                <div class="mb-2 text-muted">Stok: <b>{{ $product->stock }}</b></div>
                <div class="mb-2"><i class="fas fa-store me-1"></i> Toko: <b>{{ $product->toko->name_toko ?? '-' }}</b></div>
                <div class="mb-2"><i class="fas fa-truck me-1"></i> Supplier: <b>{{ $product->supplier->name ?? '-' }}</b></div>
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Produk
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
