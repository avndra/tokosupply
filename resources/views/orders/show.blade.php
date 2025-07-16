@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
<style>
    .order-show-card {
        border-radius: 1.5rem;
        box-shadow: 0 8px 32px 0 rgba(0,0,0,0.12), 0 1.5px 8px 0 rgba(0,0,0,0.10);
        background: #23272f;
        color: #fff;
        max-width: 700px;
        margin: 40px auto 0 auto;
        overflow: hidden;
    }
    .order-header {
        background: linear-gradient(90deg,#23272f 60%,#007bff 100%);
        padding: 2rem 2rem 1rem 2rem;
        border-bottom: 2px solid #007bff;
    }
    .order-status-badge {
        font-size: 1.1rem;
        font-weight: 700;
        border-radius: 1rem;
        padding: 0.5em 1.5em;
        letter-spacing: 1px;
        margin-left: 1rem;
    }
    .order-status-pending { background: #fff3cd; color: #856404; }
    .order-status-processing { background: #cce5ff; color: #004085; }
    .order-status-completed { background: #d4edda; color: #155724; }
    .order-status-cancelled { background: #f8d7da; color: #721c24; }
    .order-items-table th, .order-items-table td { vertical-align: middle; }
</style>
<div class="order-show-card">
    <div class="order-header d-flex flex-column flex-md-row align-items-md-center justify-content-between">
        <div>
            <h3 class="mb-1" style="font-weight:700;">Pesanan #{{ $order->id }}</h3>
            <div class="mb-1">User: <b>{{ $order->user->username ?? '-' }}</b></div>
            <div class="mb-1">Tanggal: {{ $order->created_at->format('d M Y, H:i') }}</div>
        </div>
        <div class="mt-3 mt-md-0">
            <span class="order-status-badge order-status-{{ $order->status }}">
                {{ ucfirst($order->status) }}
            </span>
        </div>
    </div>
    <div class="p-4">
        <h5 class="mb-3"><i class="fas fa-list me-2"></i>Daftar Item Pesanan</h5>
        <div class="table-responsive">
            <table class="table table-sm table-hover order-items-table mb-0 text-white">
                <thead style="background:#343a40;">
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
        <div class="d-flex justify-content-end mt-4">
            <a href="{{ route('orders.index') }}" class="btn btn-outline-light px-4" style="font-weight:600;border-radius:1.2rem;">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Pesanan
            </a>
        </div>
    </div>
</div>
@endsection
