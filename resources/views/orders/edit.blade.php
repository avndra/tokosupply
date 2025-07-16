@extends('layouts.app')

@section('title', 'Edit Pesanan')

@section('content')
<div class="card shadow-sm border-0" style="max-width:700px;margin:auto;">
    <div class="card-header bg-warning text-dark">
        <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Pesanan #{{ $order->id }}</h4>
    </div>
    <div class="card-body bg-white">
        <form action="{{ route('orders.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-user me-1"></i> User</label>
                <input type="text" class="form-control" value="{{ $order->user->username ?? '-' }} ({{ $order->user->email ?? '-' }})" disabled>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label"><i class="fas fa-toggle-on me-1"></i> Status</label>
                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                    </div>
                @enderror
            </div>
            <hr>
            <h5 class="mb-3"><i class="fas fa-list me-2"></i>Daftar Item Pesanan</h5>
            <div class="table-responsive mb-4">
                <table class="table table-sm table-hover order-items-table mb-0">
                    <thead style="background:#f8f9fa;">
                        <tr>
                            <th>Produk</th>
                            <th>Qty</th>
                            <th>Harga Satuan</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($order->orderedItems as $item)
                            <tr>
                                <td>{{ $item->product->name ?? '-' }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>Rp{{ number_format($item->price_per_item,0,',','.') }}</td>
                                <td>Rp{{ number_format($item->quantity * $item->price_per_item,0,',','.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-3">Belum ada item pesanan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary me-2" style="font-weight:600;">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary px-4" style="font-weight:600;font-size:1.1rem;">
                    <i class="fas fa-save me-1"></i> Update Status
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
