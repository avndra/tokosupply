@extends('layouts.app')

@section('title', 'Detail Pengguna')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-info text-white">
        <h4 class="mb-0"><i class="fas fa-info-circle me-2"></i>Detail Pengguna</h4>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-3 text-md-end"><strong>ID:</strong></div>
            <div class="col-md-9">{{ $user->id }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3 text-md-end"><strong>Username:</strong></div>
            <div class="col-md-9">{{ $user->username }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3 text-md-end"><strong>Email:</strong></div>
            <div class="col-md-9">{{ $user->email }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3 text-md-end"><strong>Gender:</strong></div>
            <div class="col-md-9">{{ ucfirst($user->gender) }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3 text-md-end"><strong>Kota:</strong></div>
            <div class="col-md-9">{{ $user->city->name ?? '-' }}</div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3 text-md-end"><strong>Dibuat Pada:</strong></div>
            <div class="col-md-9">{{ $user->created_at->format('d M Y, H:i:s') }}</div>
        </div>
        <hr>
        <h5 class="mt-4"><i class="fas fa-shop me-2"></i>Toko yang Dimiliki:</h5>
        @if ($user->tokos->count() > 0)
            <ul class="list-group mb-3">
                @foreach ($user->tokos as $toko)
                    <li class="list-group-item">{{ $toko->name_toko }} (Kota: {{ $toko->city->name ?? '-' }})</li>
                @endforeach
            </ul>
        @else
            <p class="text-muted">Pengguna ini belum memiliki toko.</p>
        @endif
        <div class="d-flex justify-content-end mt-4">
            <a href="{{ route('users.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Pengguna
            </a>
        </div>
    </div>
</div>
@endsection
