@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-warning text-dark">
        <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Produk: {{ $product->name }}</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label"><i class="fas fa-tag me-1"></i> Nama Produk</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $product->name) }}" required placeholder="Masukkan nama produk...">
                @error('name')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="price" class="form-label"><i class="fas fa-money-bill-wave me-1"></i> Harga</label>
                <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $product->price) }}" required min="0" placeholder="Masukkan harga produk...">
                @error('price')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label"><i class="fas fa-boxes me-1"></i> Stok</label>
                <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" required min="0" placeholder="Masukkan stok produk...">
                @error('stock')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="status" class="form-label"><i class="fas fa-toggle-on me-1"></i> Status</label>
                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="active" {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="toko_id" class="form-label"><i class="fas fa-store me-1"></i> Toko</label>
                <select class="form-select @error('toko_id') is-invalid @enderror" id="toko_id" name="toko_id" required>
                    <option value="">-- Pilih Toko --</option>
                    @foreach ($tokos as $toko)
                        <option value="{{ $toko->id }}" {{ old('toko_id', $product->toko_id) == $toko->id ? 'selected' : '' }}>{{ $toko->name_toko }}</option>
                    @endforeach
                </select>
                @error('toko_id')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="supplier_id" class="form-label"><i class="fas fa-truck me-1"></i> Supplier</label>
                <select class="form-select @error('supplier_id') is-invalid @enderror" id="supplier_id" name="supplier_id" required>
                    <option value="">-- Pilih Supplier --</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ old('supplier_id', $product->supplier_id) == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                    @endforeach
                </select>
                @error('supplier_id')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('products.index') }}" class="btn btn-secondary me-2">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
