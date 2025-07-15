@extends('layouts.app')

@section('title', 'Tambah Pengguna Baru')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0"><i class="fas fa-user-plus me-2"></i>Tambah Pengguna Baru</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label"><i class="fas fa-user me-1"></i> Username</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" required placeholder="Masukkan username...">
                @error('username')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label"><i class="fas fa-envelope me-1"></i> Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required placeholder="Masukkan email...">
                @error('email')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label"><i class="fas fa-venus-mars me-1"></i> Gender</label>
                <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                    <option value="">-- Pilih Gender --</option>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('gender')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="city_code" class="form-label"><i class="fas fa-city me-1"></i> Kota</label>
                <select class="form-select @error('city_code') is-invalid @enderror" id="city_code" name="city_code" required>
                    <option value="">-- Pilih Kota --</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}" {{ old('city_code') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                    @endforeach
                </select>
                @error('city_code')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label"><i class="fas fa-lock me-1"></i> Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required placeholder="Masukkan password...">
                @error('password')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label"><i class="fas fa-lock me-1"></i> Konfirmasi Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required placeholder="Ulangi password...">
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('users.index') }}" class="btn btn-secondary me-2">
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
