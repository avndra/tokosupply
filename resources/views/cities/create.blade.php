@extends('layouts.app')

@section('title', 'Tambah Kota Baru')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Tambah Kota Baru</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('cities.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label"><i class="fas fa-tag me-1"></i> Nama Kota</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required placeholder="Masukkan nama kota...">
                    @error('name')
                        <div class="invalid-feedback">
                            <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('cities.index') }}" class="btn btn-secondary me-2">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
