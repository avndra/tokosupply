@extends('layouts.app')

@section('title', 'Tambah Produk Baru')

@section('content')
<div class="card shadow-sm border-0" style="max-width:600px;margin:auto;">
    <div class="card-header" style="background:#f44336;color:#fff;">
        <h4 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Tambah Produk Baru</h4>
    </div>
    <div class="card-body bg-white">
        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="form-floating mb-3">
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required placeholder="Nama Produk">
                <label for="name"><i class="fas fa-tag me-1"></i> Nama Produk</label>
                @error('name')
                    <div class="invalid-feedback" style="color:#f44336;">
                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" required min="0" placeholder="Harga">
                <label for="price"><i class="fas fa-money-bill-wave me-1"></i> Harga</label>
                @error('price')
                    <div class="invalid-feedback" style="color:#f44336;">
                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock') }}" required min="0" placeholder="Stok">
                <label for="stock"><i class="fas fa-boxes me-1"></i> Stok</label>
                @error('stock')
                    <div class="invalid-feedback" style="color:#f44336;">
                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                </select>
                <label for="status"><i class="fas fa-toggle-on me-1"></i> Status</label>
                @error('status')
                    <div class="invalid-feedback" style="color:#f44336;">
                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <select class="form-select @error('toko_id') is-invalid @enderror" id="toko_id" name="toko_id" required>
                    <option value="">-- Pilih Toko --</option>
                    @foreach ($tokos as $toko)
                        <option value="{{ $toko->id }}" {{ old('toko_id') == $toko->id ? 'selected' : '' }}>{{ $toko->name_toko }}</option>
                    @endforeach
                </select>
                <label for="toko_id"><i class="fas fa-store me-1"></i> Toko</label>
                @error('toko_id')
                    <div class="invalid-feedback" style="color:#f44336;">
                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-floating mb-4">
                <select class="form-select @error('supplier_id') is-invalid @enderror" id="supplier_id" name="supplier_id" required>
                    <option value="">-- Pilih Supplier --</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                    @endforeach
                </select>
                <label for="supplier_id"><i class="fas fa-truck me-1"></i> Supplier</label>
                @error('supplier_id')
                    <div class="invalid-feedback" style="color:#f44336;">
                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary me-2" style="font-weight:600;">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
                <button type="submit" class="btn" style="background:#f44336;color:#fff;font-weight:600;font-size:1.1rem;padding:.6rem 2.2rem;border-radius:.5rem;">
                    <i class="fas fa-save me-1"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
