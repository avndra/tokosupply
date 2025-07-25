@extends('layouts.app')

@section('title', 'Daftar Toko')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-0"><i class="fas fa-store me-2"></i>Daftar Toko</h1>
    <a href="{{ route('tokos.create') }}" class="btn btn-success">
        <i class="fas fa-plus me-1"></i> Tambah Toko
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
<div class="row g-4">
    @forelse ($tokos as $toko)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card h-100 shadow-sm border-0 toko-card">
                <div class="d-flex align-items-center p-3 pb-0">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($toko->name_toko) }}&background=03ac0e&color=fff&size=128" class="rounded-circle me-3" alt="{{ $toko->name_toko }}" style="width:56px;height:56px;object-fit:cover;">
                    <div>
                        <h5 class="mb-0" style="font-weight:600; color:#03ac0e;">{{ $toko->name_toko }}</h5>
                        <div class="text-muted" style="font-size:0.95rem;">{{ $toko->city->name ?? '-' }}</div>
                    </div>
                </div>
                <div class="px-3 pt-2">
                    <div class="mb-2" style="font-size:0.98rem;">
                        <i class="fas fa-user me-1"></i> Pemilik: <b>{{ $toko->owner->username ?? '-' }}</b>
                    </div>
                    <div class="mb-2">
                        <div class="card shadow-sm border-0 bg-primary text-white" style="background:linear-gradient(90deg,#1877f2 60%,#60aaff 100%);border-radius:1rem;">
                            <div class="card-body py-2 px-3 d-flex align-items-center">
                                <i class="fas fa-wallet fa-lg me-2"></i>
                                <div>
                                    <div style="font-size:0.95rem;opacity:0.8;">Saldo Toko</div>
                                    <div style="font-size:1.3rem;font-weight:600;letter-spacing:1px;">Rp{{ number_format($toko->balance ?? 0,0,',','.') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body d-flex flex-column pt-0">
                    <div class="mt-auto d-flex justify-content-between gap-1">
                        <a href="{{ route('tokos.show', $toko->id) }}" class="btn btn-outline-info btn-sm flex-fill" title="Lihat Detail">
                            <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-eye" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z"/><circle cx="12" cy="12" r="3"/></svg>
                        </a>
                        <a href="{{ route('tokos.edit', $toko->id) }}" class="btn btn-outline-warning btn-sm flex-fill" title="Edit Toko">
                            <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-pencil" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                        </a>
                        <form action="{{ route('tokos.destroy', $toko->id) }}" method="POST" class="d-inline-block flex-fill">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm w-100" onclick="return confirm('Yakin ingin menghapus toko ini?')" title="Hapus Toko">
                                <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-trash" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M8 6v-2a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="m10 11v6"/><path d="m14 11v6"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info text-center py-4">
                <i class="fas fa-info-circle me-1"></i> Belum ada data toko.
            </div>
        </div>
    @endforelse
</div>
@endsection
