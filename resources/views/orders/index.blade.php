@extends('layouts.app')

@section('title', 'Daftar Pesanan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-0"><i class="fas fa-clipboard-list me-2"></i>Daftar Pesanan</h1>
    <a href="{{ route('orders.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i> Buat Pesanan
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
    .order-status-badge {
        font-size: 0.95rem;
        font-weight: 700;
        border-radius: 1rem;
        padding: 0.4em 1.2em;
        letter-spacing: 1px;
    }
    .order-status-pending { background: #fff3cd; color: #856404; }
    .order-status-processing { background: #cce5ff; color: #004085; }
    .order-status-completed { background: #d4edda; color: #155724; }
    .order-status-cancelled { background: #f8d7da; color: #721c24; }
    .order-table th, .order-table td { vertical-align: middle; }
</style>
<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover order-table mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Jumlah Item</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->username ?? '-' }}</td>
                            <td>
                                <span class="order-status-badge order-status-{{ $order->status }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                            <td>{{ $order->orderedItems->count() }}</td>
                            <td>
                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm me-1" title="Lihat Detail">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-eye" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z"/><circle cx="12" cy="12" r="3"/></svg>
                                </a>
                                <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning btn-sm me-1" title="Edit Pesanan">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-pencil" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                                </a>
                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus pesanan ini?')" title="Hapus Pesanan">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-trash" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M8 6v-2a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="m10 11v6"/><path d="m14 11v6"/></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <i class="fas fa-info-circle me-1"></i> Belum ada data pesanan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
