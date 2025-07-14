@extends('layouts.main')

@section('content')
    <div class="container my-4">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <h4 class="card-title">
                            Tambah Anggota PLN
                        </h4>
                    </div>
                    <div class="col text-end">
                        <a href="{{ route('pln-members.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>
                    </div>
                </div>         
            </div>
            <div class="card-body">
                <form action="{{ route('pln-members.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" value="{{ old('nama') }}">
                        @error('nama')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nip">NIP</label>
                        <input type="text" class="form-control" name="nip" id="nip" value="{{ old('nip') }}">
                        @error('nip')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                        @error('email')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jabatan">Jabatan</label>
                        <input type="text" class="form-control" name="jabatan" id="jabatan" value="{{ old('jabatan') }}">
                        @error('jabatan')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="no_hp">No HP</label>
                        <input type="text" class="form-control" name="no_hp" id="no_hp" value="{{ old('no_hp') }}">
                        @error('no_hp')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
