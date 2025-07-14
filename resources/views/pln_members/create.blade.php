@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Tambah Anggota PLN</h2>
    <form action="{{ route('pln-members.store') }}" method="POST">
        @csrf
        @include('pln_members.form')
        <button class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
