<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
  </head>
  <body>
    
    <div class="container my-5">
        <div class="card mb-4">
            <div class="card-body">
                {{-- <h4 class="text-center">{{ env('APP_NAME') }}</h4> --}}
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <img src="{{ $presence->logo_kiri ? asset('uploads/' . $presence->logo_kiri) : asset('default-logo-kiri.png') }}" height="120">
                    <h4 class="text-center mb-0">{{ $presence->judul_header ?? env('APP_NAME') }}</h4>
                    <img src="{{ $presence->logo_kanan ? asset('uploads/' . $presence->logo_kanan) : asset('default-logo-kanan.png') }}" height="120">
                </div>
                <table class="table table-borderless">
                    <tr>
                        <td width="150">Nama Kegiatan</td>
                        <td width="20">:</td>
                        <td>{{ $presence->nama_kegiatan }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Kegiatan</td>
                        <td>:</td>
                        <td>{{ date('d F Y', strtotime($presence->tgl_kegiatan)) }}</td>
                    </tr>
                    <tr>
                        <td>Waktu Mulai</td>
                        <td>:</td>
                        <td>{{ date('H:i', strtotime($presence->tgl_kegiatan)) }}</td>
                    </tr>
                    <tr>
                        <td>Lokasi</td>
                        <td>:</td>
                        <td>{{ $presence->lokasi }}</td>
                    </tr>
                    <tr>
                        <td>Link Lokasi</td>
                        <td>:</td>
                        <td>
                            @if ($presence->link_lokasi)
                                <a href="{{ $presence->link_lokasi }}" target="_blank" class="text-primary text-decoration-underline">
                                    Klik di sini
                                </a>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Form Absensi</h5>
                    </div>
                    <div class="card-body">
                        <form id="form-absen" action="{{ route('absen.save', $presence->id) }}" method="post">
                            @csrf
                                                         <div class="mb-3">
                                <label for="unit" class="form-label">Unit/Nama Perusahaan</label>
                                <select name="unit" id="unit" class="form-select" required>
                                    <option value="">-- Pilih Kategori Peserta --</option>
                                    <option value="PLN">PLN</option>
                                    <option value="PLN Group">PLN Group</option>
                                    <option value="Non PLN">Non PLN</option>
                                </select>
                                @error('unit')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3" id="nama-field">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama">
                                <select class="form-select d-none" id="nama-pln" name="nama" disabled>
                                    <option value="">-- Pilih Anggota PLN --</option>
                                    @foreach($plnMembers as $member)
                                        <option 
                                            value="{{ $member->nama }}"
                                            data-nip="{{ $member->nip }}"
                                            data-email="{{ $member->email }}">
                                            {{ $member->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                <small id="nama-helper" class="text-muted d-none">Pilih nama anggota PLN</small>
                                @error('nama')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nip" class="form-label">NIP</label>
                                <input type="text" class="form-control" id="nip" name="nip">
                                <small id="nip-helper" class="text-muted d-none">Tidak perlu diisi untuk Non PLN</small>
                                @error('nip')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                                <small id="email-helper" class="text-muted d-none">Tidak perlu diisi untuk Non PLN</small>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- <div class="mb-3">
                                <label for="jabatan">Jabatan</label>
                                <input type="text" class="form-control" id="jabatan" name="jabatan">
                                @error('jabatan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div> --}}
                            <div class="mb-3">
                                <label for="jabatan">Jabatan</label>
                                <input type="text" class="form-control" id="jabatan" name="jabatan">
                                <small id="jabatan-helper" class="text-muted d-none">Tidak perlu diisi untuk Non PLN</small>
                                @error('jabatan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="no_hp" class="form-label">No HP</label>
                                <input type="text" class="form-control" id="no_hp" name="no_hp">
                                @error('no_hp')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="signature64">Tanda Tangan</label>
                                <div class="d-block form-control mb-2">
                                    <canvas id="signature-pad" class="signature-pad"></canvas>
                                </div>
                                <textarea name="signature" id="signature64" class="d-none"></textarea>
                                @error('signature')
                                    <div class="text-danger">{{ $message }}</div>                                    
                                @enderror
                                <button type="button" id="clear" class="btn btn-sm btn-secondary">
                                    Clear
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                                    </svg>
                                </button>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </form>
                    </div>
                </div> 
            </div>
            <div class="col-md">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Daftar Kehadiran</h5>
                    </div>
                    <div class="card-body">
                        {{-- <table class="table table-striped">
                            <thead>
                                <tr>
                                <th>No.</th>
                                <th>Tanggal</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Unit</th>
                                <th>Tanda Tangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($presenceDetails->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endif
                                @foreach ($presenceDetails as $detail )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ date('d/m/Y H:i', strtotime($presence->created_at)) }}
                                        </td>
                                        <td>{{ $detail->nama }}</td>
                                        <td>{{ $detail->jabatan }}</td>
                                        <td>{{ $detail->unit }}</td>
                                        <td>
                                            @if ($detail->signature)
                                                <img src="{{ asset('uploads/' . $detail->signature) }}" alt="Tanda Tangan" width="100">
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table> --}}
                        {{ $dataTable->table() }}
                    </div>
                </div> 
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{ asset('js/signature.min.js') }}"></script>

    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>

    <script>
        $(function() {
            // set signature pad width
            let sig = $("#signature-pad").parent().width();
            $('#signature-pad').attr('width', sig);

            // set canvas color
            let signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
                backgroundColor: 'rgb(255, 255, 255, 0)',
                penColor: 'rgb(0, 0, 0)',
            });

            // fill signature to textarea
            $('canvas').on('mouseup touchend', function() {
                $('#signature64').val(signaturePad.toDataURL());
            });

            // clear signature
            $('#clear').on('click', function(e) {
                e.preventDefault();
                signaturePad.clear();
                $('#signature64').val('');
            });

            // submit form
            $('#form-absen').on('submit', function() {
                $(this).find('button[type="submit"]').attr('disabled', 'disabled');
            });
            
            // --- Unit Change Logic (PLN vs Non PLN) ---
            function toggleNonPlnFields() {
                let unit = $('#unit').val();
                if (unit === 'Non PLN') {
                    $('#nip').val('').prop('disabled', true);
                    $('#email').val('').prop('disabled', true);
                    $('#jabatan').val('').prop('disabled', true);

                    $('#nip-helper').removeClass('d-none');
                    $('#email-helper').removeClass('d-none');
                    $('#jabatan-helper').removeClass('d-none');
                } else {
                    $('#nip').prop('disabled', false);
                    $('#email').prop('disabled', false);
                    $('#jabatan').prop('disabled', false);

                    $('#nip-helper').addClass('d-none');
                    $('#email-helper').addClass('d-none');
                    $('#jabatan-helper').addClass('d-none');
                }
            }

            function toggleNamaField() {
                let unit = $('#unit').val();
                if (unit === 'PLN') {
                    $('#nama').addClass('d-none').prop('disabled', true);
                    $('#nama-pln').removeClass('d-none').prop('disabled', false);
                    $('#nama-helper').removeClass('d-none');
                } else {
                    $('#nama').removeClass('d-none').prop('disabled', false);
                    $('#nama-pln').addClass('d-none').prop('disabled', true);
                    $('#nama-helper').addClass('d-none');
                }
            }

            toggleNonPlnFields();
            toggleNamaField();

            $('#unit').on('change', function() {
                toggleNonPlnFields();
                toggleNamaField();
            });

            // Autofill NIP dan Email saat pilih nama anggota PLN
            $('#nama-pln').on('change', function() {
                let nip = $(this).find(':selected').data('nip') || '';
                let email = $(this).find(':selected').data('email') || '';

                $('#nip').val(nip);
                $('#email').val(email);
            });
        });

    </script>

    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

  </body>
</html>