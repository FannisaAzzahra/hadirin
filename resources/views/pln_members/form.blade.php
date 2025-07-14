<div class="mb-3">
    <label>Nama</label>
    <input type="text" name="nama" class="form-control" value="{{ old('nama', $plnMember->nama ?? '') }}" required>
</div>
<div class="mb-3">
    <label>NIP</label>
    <input type="text" name="nip" class="form-control" value="{{ old('nip', $plnMember->nip ?? '') }}">
</div>
<div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', $plnMember->email ?? '') }}">
</div>
<div class="mb-3">
    <label>Jabatan</label>
    <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan', $plnMember->jabatan ?? '') }}">
</div>
<div class="mb-3">
    <label>No HP</label>
    <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $plnMember->no_hp ?? '') }}">
</div>
