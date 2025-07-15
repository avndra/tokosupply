@extends('layouts.app')

@section('title', 'Daftar Supplier')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-0"><i class="fas fa-truck me-2"></i>Daftar Supplier</h1>
    <a href="{{ route('suppliers.create') }}" class="btn btn-success">
        <i class="fas fa-plus me-1"></i> Tambah Supplier
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
<style>
    .supplier-card {
        border-radius: 2rem;
        box-shadow: 0 8px 32px 0 rgba(106,17,203,0.18), 0 1.5px 8px 0 rgba(37,117,252,0.10);
        background: linear-gradient(135deg,#6a11cb 0%,#2575fc 100%);
        color: #fff;
        margin-top: 40px;
        position: relative;
        overflow: visible;
        transition: transform .15s;
    }
    .supplier-card:hover {
        transform: translateY(-6px) scale(1.03);
        box-shadow: 0 16px 40px 0 rgba(106,17,203,0.22), 0 2px 12px 0 rgba(37,117,252,0.13);
    }
    .supplier-avatar {
        width: 80px; height: 80px; object-fit: cover;
        border-radius: 50%; border: 4px solid #fff;
        position: absolute; top: -40px; left: 50%; transform: translateX(-50%);
        box-shadow: 0 4px 16px 0 rgba(106,17,203,0.18);
        background: #fff;
    }
    .supplier-card-body { padding-top: 48px; }
    .supplier-action .btn { font-weight: 600; border-radius: 1.2rem; }
    .supplier-action .btn-outline-light { background: #fff; color: #6a11cb; border: none; }
    .supplier-action .btn-outline-warning { background: #fceabb; color: #6a11cb; border: none; }
    .supplier-action .btn-outline-danger { background: #fbc2eb; color: #6a11cb; border: none; }
</style>
<div class="row g-5">
    @forelse ($suppliers as $supplier)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card supplier-card h-100 border-0">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($supplier->name) }}&background=6a11cb&color=fff&size=128" class="supplier-avatar" alt="{{ $supplier->name }}">
                <div class="card-body supplier-card-body text-center">
                    <h5 class="mb-1" style="font-weight:700;letter-spacing:0.5px;">{{ $supplier->name }}</h5>
                    <div style="font-size:0.97rem;opacity:0.8;">{{ $supplier->email }}</div>
                    <div class="mt-2 mb-1" style="font-size:0.93rem;opacity:0.7;">
                        <i class="fas fa-phone me-1"></i> {{ $supplier->phone_number }}
                    </div>
                    <div class="mb-2" style="font-size:0.93rem;opacity:0.7;">
                        <i class="fas fa-map-marker-alt me-1"></i> {{ $supplier->address }}
                    </div>
                    <div class="supplier-action d-flex justify-content-center gap-2 mt-3">
                        <a href="{{ route('suppliers.show', $supplier->id) }}" class="btn btn-outline-light btn-sm" title="Lihat Detail">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-outline-warning btn-sm" title="Edit Supplier">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Yakin ingin menghapus supplier ini?')" title="Hapus Supplier">
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
                <i class="fas fa-info-circle me-1"></i> Belum ada data supplier.
            </div>
        </div>
    @endforelse
</div>
@endsection
