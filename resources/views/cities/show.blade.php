@extends('layouts.app')

@section('title', 'Detail Kota')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0"><i class="fas fa-info-circle me-2"></i>Detail Kota</h4>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3 text-md-end"><strong>ID:</strong></div>
                <div class="col-md-9">{{ $city->id }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 text-md-end"><strong>Nama Kota:</strong></div>
                <div class="col-md-9">{{ $city->name }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 text-md-end"><strong>Dibuat Pada:</strong></div>
                <div class="col-md-9">{{ $city->created_at->format('d M Y, H:i:s') }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 text-md-end"><strong>Diupdate Pada:</strong></div>
                <div class="col-md-9">{{ $city->updated_at->format('d M Y, H:i:s') }}</div>
            </div>

            <hr>

            <h5 class="mt-4"><i class="fas fa-users me-2"></i>Pengguna Terkait:</h5>
            @if ($city->users->count() > 0)
                <ul class="list-group mb-3">
                    @foreach ($city->users as $user)
                        <li class="list-group-item">{{ $user->username }} ({{ $user->email }})</li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted">Tidak ada pengguna yang terkait dengan kota ini.</p>
            @endif

            <h5 class="mt-4"><i class="fas fa-shop me-2"></i>Toko Terkait:</h5>
            @if ($city->tokos->count() > 0)
                <ul class="list-group">
                    @foreach ($city->tokos as $toko)
                        <li class="list-group-item">{{ $toko->name_toko }} (Pemilik: {{ $toko->owner->username ?? 'N/A' }})</li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted">Tidak ada toko yang terkait dengan kota ini.</p>
            @endif

            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('cities.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Kota
                </a>
            </div>
        </div>
    </div>
@endsection
