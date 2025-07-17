@extends('layouts.app')

@section('title', 'Buat Pesanan Baru')

@section('content')
<style>
    .order-create-product-card {
        border-radius: 1.2rem;
        box-shadow: 0 4px 16px 0 rgba(0,0,0,0.08);
        border: 1.5px solid #e0e0e0;
        transition: box-shadow .15s;
        background: #fff;
        height: 100%;
    }
    .order-create-product-card:hover {
        box-shadow: 0 8px 32px 0 rgba(0,123,255,0.10);
        border-color: #007bff;
    }
    .order-create-product-img {
        width: 100%; height: 120px; object-fit: contain; background: #f8f9fa; border-radius: 1rem 1rem 0 0;
    }
    .order-create-qty-input {
        width: 70px; border-radius: 0.5rem; border: 1px solid #ddd; text-align: center;
    }
</style>
<div class="card shadow-sm border-0" style="max-width:900px;margin:auto;">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Buat Pesanan Baru</h4>
    </div>
    <div class="card-body bg-white">
        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            <div class="row mb-4">
                <div class="col-md-6 mb-3 mb-md-0">
                    <label for="user_id" class="form-label"><i class="fas fa-user me-1"></i> User</label>
                    <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                        <option value="">-- Pilih User --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->username }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <div class="invalid-feedback">
                            <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="status" class="form-label"><i class="fas fa-toggle-on me-1"></i> Status</label>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ old('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">
                            <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <hr>
            <h5 class="mb-3"><i class="fas fa-box-open me-2"></i>Pilih Produk & Jumlah</h5>
            <div class="row g-4 mb-4" id="product-select-list">
                @forelse ($products as $product)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="order-create-product-card h-100 product-select-card" data-product-id="{{ $product->id }}" style="cursor:pointer;">
                            <input type="checkbox" name="products[]" value="{{ $product->id }}" id="product_checkbox_{{ $product->id }}" class="d-none product-checkbox" autocomplete="off">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($product->name) }}&background=eee&color=555&size=256" class="order-create-product-img" alt="{{ $product->name }}">
                            <div class="p-3">
                                <div class="fw-bold mb-1" style="color:#007bff;">{{ $product->name }}</div>
                                <div class="mb-1" style="font-size:1.1rem;color:#f57224;font-weight:500;">Rp{{ number_format($product->price,0,',','.') }}</div>
                                <div class="mb-1 text-muted" style="font-size:0.95rem;">Stok: <b>{{ $product->stock }}</b></div>
                                <div class="mb-1" style="font-size:0.95rem;">
                                    <i class="fas fa-store me-1"></i> {{ $product->toko->name_toko ?? '-' }}
                                </div>
                                <div class="mb-2" style="font-size:0.95rem;">
                                    <i class="fas fa-truck me-1"></i> {{ $product->supplier->name ?? '-' }}
                                </div>
                                <div class="d-flex align-items-center mt-2 qty-input-wrapper" style="display:none;opacity:0;transition:opacity .3s;">
                                    <label for="qty_{{ $product->id }}" class="me-2 mb-0" style="font-size:0.95rem;">Qty</label>
                                    <input type="number" min="1" max="{{ $product->stock }}" name="qty[{{ $product->id }}]" id="qty_{{ $product->id }}" class="order-create-qty-input" value="{{ old('qty.'.$product->id, 1) }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center py-4">
                            <i class="fas fa-info-circle me-1"></i> Belum ada produk tersedia.
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary me-2" style="font-weight:600;">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary px-4" style="font-weight:600;font-size:1.1rem;">
                    <i class="fas fa-save me-1"></i> Simpan Pesanan
                </button>
            </div>
        </form>
        @push('scripts')
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.product-select-card').forEach(function(card) {
                const checkbox = card.querySelector('.product-checkbox');
                const qtyWrapper = card.querySelector('.qty-input-wrapper');
                const qtyInput = card.querySelector('.order-create-qty-input');
                // Card click toggles checkbox
                card.addEventListener('click', function(e) {
                    // Prevent double toggle if clicking input
                    if (e.target.tagName === 'INPUT') return;
                    checkbox.checked = !checkbox.checked;
                    checkbox.dispatchEvent(new Event('change'));
                });
                // Checkbox change event
                checkbox.addEventListener('change', function() {
                    if (checkbox.checked) {
                        card.style.boxShadow = '0 8px 32px 0 rgba(0,123,255,0.20)';
                        card.style.borderColor = '#0d6efd';
                        qtyWrapper.style.display = 'flex';
                        setTimeout(() => { qtyWrapper.style.opacity = 1; }, 10);
                        qtyInput.disabled = false;
                        qtyInput.focus();
                    } else {
                        card.style.boxShadow = '';
                        card.style.borderColor = '#e0e0e0';
                        qtyWrapper.style.opacity = 0;
                        setTimeout(() => { qtyWrapper.style.display = 'none'; }, 300);
                        qtyInput.disabled = true;
                        qtyInput.value = 1;
                    }
                });
                // If old value exists, show qty
                if (checkbox.checked) {
                    card.style.boxShadow = '0 8px 32px 0 rgba(0,123,255,0.20)';
                    card.style.borderColor = '#0d6efd';
                    qtyWrapper.style.display = 'flex';
                    setTimeout(() => { qtyWrapper.style.opacity = 1; }, 10);
                    qtyInput.disabled = false;
                }
            });
        });
        </script>
        @endpush
    </div>
</div>
@endsection
