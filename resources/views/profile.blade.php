@extends('layouts.main')

@section('content')
<div class="container my-5">
    <div class="card">
        <div class="card-header">
            Profil Pengguna
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $user->name }}</h5>
            <p class="card-text">Email: {{ $user->email }}</p>
            {{-- Tambahkan informasi lain yang Anda inginkan --}}
            {{-- <p class="card-text">Role: {{ $user->role }}</p> --}}
        </div>
    </div>
</div>
@endsection