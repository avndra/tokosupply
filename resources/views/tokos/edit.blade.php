@extends('layouts.app')

@section('title', 'Edit Toko')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-warning text-dark">
        <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Toko: {{ $toko->name_toko }}</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('tokos.update', $toko->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name_toko" class="form-label"><i class="fas fa-store me-1"></i> Nama Toko</label>
                <input type="text" class="form-control @error('name_toko') is-invalid @enderror" id="name_toko" name="name_toko" value="{{ old('name_toko', $toko->name_toko) }}" required placeholder="Masukkan nama toko...">
                @error('name_toko')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="owner_id" class="form-label"><i class="fas fa-user me-1"></i> Pemilik</label>
                <select class="form-select @error('owner_id') is-invalid @enderror" id="owner_id" name="owner_id" required>
                    <option value="">-- Pilih Pemilik --</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('owner_id', $toko->owner_id) == $user->id ? 'selected' : '' }}>{{ $user->username }}</option>
                    @endforeach
                </select>
                @error('owner_id')
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
                        <option value="{{ $city->id }}" {{ old('city_code', $toko->city_code) == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                    @endforeach
                </select>
                @error('city_code')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('tokos.index') }}" class="btn btn-secondary me-2">
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
