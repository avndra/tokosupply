@extends('layouts.app')

@section('title', 'Detail Toko')

@section('content')
<div class="card shadow-sm mb-4">
    <div class="row g-0">
        <div class="col-md-4 d-flex align-items-center justify-content-center p-4">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($toko->name_toko) }}&background=03ac0e&color=fff&size=256" alt="{{ $toko->name_toko }}" class="img-fluid rounded-circle" style="max-height:180px;object-fit:cover;">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h3 class="card-title mb-2" style="font-weight:600; color:#03ac0e;">{{ $toko->name_toko }}</h3>
                <div class="mb-2"><i class="fas fa-user me-1"></i> Pemilik: <b>{{ $toko->owner->username ?? '-' }}</b></div>
                <div class="mb-2"><i class="fas fa-city me-1"></i> Kota: <b>{{ $toko->city->name ?? '-' }}</b></div>
                <div class="mb-2">
                    <div class="card shadow-sm border-0 bg-primary text-white" style="background:linear-gradient(90deg,#1877f2 60%,#60aaff 100%);border-radius:1rem;max-width:320px;">
                        <div class="card-body py-2 px-3 d-flex align-items-center">
                            <i class="fas fa-wallet fa-lg me-2"></i>
                            <div>
                                <div style="font-size:0.95rem;opacity:0.8;">Saldo Toko</div>
                                <div style="font-size:1.3rem;font-weight:600;letter-spacing:1px;">Rp{{ number_format($toko->balance ?? 0,0,',','.') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('tokos.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Toko
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
