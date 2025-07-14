@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Edit Anggota PLN</h2>
    <form action="{{ route('pln-members.update', $plnMember) }}" method="POST">
        @csrf
        @method('PUT')
        @include('pln_members.form')
        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
