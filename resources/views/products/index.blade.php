@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-0"><i class="fas fa-box-open me-2"></i>Daftar Produk</h1>
    <a href="{{ route('products.create') }}" class="btn btn-success">
        <i class="fas fa-plus me-1"></i> Tambah Produk
    </a>
</div>
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle me-1"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="row g-4">
    @forelse ($products as $product)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card h-100 shadow-sm border-0 product-card">
                <div class="position-relative">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($product->name) }}&background=eee&color=555&size=256" class="card-img-top p-3" alt="{{ $product->name }}" style="height:180px;object-fit:contain;">
                    @if($product->status === 'active')
                        <span class="badge bg-success position-absolute top-0 end-0 m-2">Aktif</span>
                    @else
                        <span class="badge bg-secondary position-absolute top-0 end-0 m-2">Nonaktif</span>
                    @endif
                </div>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title mb-1" style="font-weight:600; color:#f57224;">{{ $product->name }}</h5>
                    <div class="mb-2" style="font-size:1.1rem; color:#03ac0e; font-weight:500;">Rp{{ number_format($product->price,0,',','.') }}</div>
                    <div class="mb-1 text-muted" style="font-size:0.95rem;">Stok: <b>{{ $product->stock }}</b></div>
                    <div class="mb-1" style="font-size:0.95rem;">
                        <i class="fas fa-store me-1"></i> {{ $product->toko->name_toko ?? '-' }}
                    </div>
                    <div class="mb-2" style="font-size:0.95rem;">
                        <i class="fas fa-truck me-1"></i> {{ $product->supplier->name ?? '-' }}
                    </div>
                    <div class="mt-auto d-flex justify-content-between gap-1">
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-info btn-sm flex-fill" title="Lihat Detail">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-outline-warning btn-sm flex-fill" title="Edit Produk">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline-block flex-fill">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm w-100" onclick="return confirm('Yakin ingin menghapus produk ini?')" title="Hapus Produk">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info text-center py-4">
                <i class="fas fa-info-circle me-1"></i> Belum ada data produk.
            </div>
        </div>
    @endforelse
</div>
@endsection
