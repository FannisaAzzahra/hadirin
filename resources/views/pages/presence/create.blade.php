@extends('layouts.main')

@section('content')
    <div class="container my-4">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <h4 class="card-title">
                            Tambah Kegiatan
                        </h4>
                    </div>
                    <div class="col text-end">
                        <a href="{{ route('presence.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>
                    </div>
                </div>         
            </div>
            <div class="card-body">
                <form action="{{ route('presence.store') }}" method="post">
                    {{-- agar bisa mengirim request nya --}}
                    @csrf
                    <div class="mb-3">
                        <label for="nama_kegiatan">Nama Kegiatan</label>
                        <input type="text" class="form-control" name="nama_kegiatan" id="nama_kegiatan" 
                            value="{{ old('nama_kegiatan') }}">
                        @error('nama_kegiatan')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tgl_kegiatan">Tanggal Kegiatan</label>
                        <input type="date" class="form-control" name="tgl_kegiatan" id="tgl_kegiatan" 
                            value="{{ old('tgl_kegiatan') }}">
                        @error('tgl_kegiatan')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="waktu_mulai">Waktu Mulai</label>
                        <input type="time" class="form-control" name="waktu_mulai" id="waktu_mulai" 
                            value="{{ old('waktu_mulai') }}">
                        @error('waktu_mulai')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="lokasi">Nama Lokasi</label>
                        <input type="text" class="form-control" name="lokasi" id="lokasi" 
                            placeholder="Contoh: Zoom, Ruang Rapat" value="{{ old('lokasi') }}">
                        @error('lokasi')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="link_lokasi">Link Lokasi (jika ada)</label>
                        <input type="url" class="form-control" name="link_lokasi" id="link_lokasi" 
                            placeholder="https://..." value="{{ old('link_lokasi') }}">
                        @error('link_lokasi')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="batas_waktu">Batas Waktu Absen (opsional)</label>
                        <input type="datetime-local" class="form-control" name="batas_waktu" id="batas_waktu" value="{{ old('batas_waktu') }}">
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" name="is_active" id="is_active" {{ old('is_active', true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Aktifkan Absen</label>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection