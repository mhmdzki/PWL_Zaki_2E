@extends('layouts.template')

@section('content')

@php
    $user = Auth::user();
@endphp

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title mb-0">Halo, {{ $user->nama }} ({{ $user->level->level_nama }})</h3>
    </div>

    <div class="card-body">
        Selamat datang {{ $user->nama }}, ini adalah halaman utama dari aplikasi ini.
    </div>
</div>
@endsection
