@extends('layouts.app')

@section('title', 'Detail Supplier')

@section('content')
<style>
    .supplier-show-card {
        border-radius: 2rem;
        box-shadow: 0 8px 32px 0 rgba(106,17,203,0.18), 0 1.5px 8px 0 rgba(37,117,252,0.10);
        background: linear-gradient(135deg,#6a11cb 0%,#2575fc 100%);
        color: #fff;
        margin-top: 60px;
        position: relative;
        overflow: visible;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }
    .supplier-show-avatar {
        width: 100px; height: 100px; object-fit: cover;
        border-radius: 50%; border: 5px solid #fff;
        position: absolute; top: -50px; left: 50%; transform: translateX(-50%);
        box-shadow: 0 4px 16px 0 rgba(106,17,203,0.18);
        background: #fff;
    }
</style>
<div class="card supplier-show-card mb-4">
    <img src="https://ui-avatars.com/api/?name={{ urlencode($supplier->name) }}&background=6a11cb&color=fff&size=128" class="supplier-show-avatar" alt="{{ $supplier->name }}">
    <div class="card-body text-center" style="padding-top:60px;">
        <h3 class="mb-1" style="font-weight:700;letter-spacing:0.5px;">{{ $supplier->name }}</h3>
        <div style="font-size:1.1rem;opacity:0.85;">{{ $supplier->email }}</div>
        <div class="mb-2 mt-3" style="font-size:0.97rem;opacity:0.7;">
            <i class="fas fa-phone me-1"></i> {{ $supplier->phone_number }}
        </div>
        <div class="mb-3" style="font-size:0.97rem;opacity:0.7;">
            <i class="fas fa-map-marker-alt me-1"></i> {{ $supplier->address }}
        </div>
        <div class="d-flex justify-content-center mt-4">
            <a href="{{ route('suppliers.index') }}" class="btn btn-outline-light px-4" style="font-weight:600;border-radius:1.2rem;">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Supplier
            </a>
        </div>
    </div>
</div>
@endsection
