@extends('layouts.app')

@section('title', 'Tambah Supplier Baru')

@section('content')
<div class="card shadow-sm border-0" style="max-width:600px;margin:auto;">
    <div class="card-header" style="background:linear-gradient(90deg,#6a11cb 60%,#2575fc 100%);color:#fff;">
        <h4 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Tambah Supplier Baru</h4>
    </div>
    <div class="card-body bg-white">
        <form action="{{ route('suppliers.store') }}" method="POST">
            @csrf
            <div class="form-floating mb-3">
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required placeholder="Nama Supplier">
                <label for="name"><i class="fas fa-user me-1"></i> Nama Supplier</label>
                @error('name')
                    <div class="invalid-feedback" style="color:#6a11cb;">
                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required placeholder="Email">
                <label for="email"><i class="fas fa-envelope me-1"></i> Email</label>
                @error('email')
                    <div class="invalid-feedback" style="color:#6a11cb;">
                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required placeholder="No. Telepon">
                <label for="phone_number"><i class="fas fa-phone me-1"></i> No. Telepon</label>
                @error('phone_number')
                    <div class="invalid-feedback" style="color:#6a11cb;">
                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-floating mb-4">
                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}" required placeholder="Alamat">
                <label for="address"><i class="fas fa-map-marker-alt me-1"></i> Alamat</label>
                @error('address')
                    <div class="invalid-feedback" style="color:#6a11cb;">
                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('suppliers.index') }}" class="btn btn-outline-secondary me-2" style="font-weight:600;">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
                <button type="submit" class="btn" style="background:#6a11cb;color:#fff;font-weight:600;font-size:1.1rem;padding:.6rem 2.2rem;border-radius:.5rem;">
                    <i class="fas fa-save me-1"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
