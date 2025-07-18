@extends('layouts.app')
@section('title', 'User Dashboard')

@section('content')
    <div class="alert alert-success">
        Selamat datang, {{ auth()->user()->username }}! 👋
    </div>

    <p>Ini adalah halaman dashboard khusus untuk pengguna dengan role <strong>user</strong>.</p>
@endsection
