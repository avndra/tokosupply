@extends('layouts.app')

@section('title', 'Edit Pengguna')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-warning text-dark">
        <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Pengguna: {{ $user->username }}</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="username" class="form-label"><i class="fas fa-user me-1"></i> Username</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $user->username) }}" required placeholder="Masukkan username...">
                @error('username')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label"><i class="fas fa-envelope me-1"></i> Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required placeholder="Masukkan email...">
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
                    <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Perempuan</option>
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
                        <option value="{{ $city->id }}" {{ old('city_code', $user->city_code) == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                    @endforeach
                </select>
                @error('city_code')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label"><i class="fas fa-lock me-1"></i> Password (Kosongkan jika tidak ingin diubah)</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Masukkan password baru...">
                @error('password')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label"><i class="fas fa-lock me-1"></i> Konfirmasi Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password baru...">
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('users.index') }}" class="btn btn-secondary me-2">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
