@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Daftar Anggota PLN</h2>
    <a href="{{ route('pln-members.create') }}" class="btn btn-primary mb-3">Tambah Anggota</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>NIP</th>
                <th>Email</th>
                <th>Jabatan</th>
                <th>No HP</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $member)
            <tr>
                <td>{{ $member->nama }}</td>
                <td>{{ $member->nip }}</td>
                <td>{{ $member->email }}</td>
                <td>{{ $member->jabatan }}</td>
                <td>{{ $member->no_hp }}</td>
                <td>
                    <a href="{{ route('pln-members.edit', $member) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('pln-members.destroy', $member) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin hapus?')" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
