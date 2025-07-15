@extends('layouts.app')

@section('title', 'Edit Kota')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Kota: {{ $city->name }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('cities.update', $city->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label"><i class="fas fa-tag me-1"></i> Nama Kota</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $city->name) }}" required placeholder="Masukkan nama kota...">
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
                        <i class="fas fa-save me-1"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
