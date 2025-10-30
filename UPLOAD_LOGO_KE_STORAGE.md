# Cara Upload Logo ke Storage di Hostinger

## Masalah
Logo rusak di hosting karena file logo masih di `public/images` yang tidak ada di hosting.

## Solusi
Upload logo-logo berikut ke storage Laravel di hosting:

### File yang perlu diupload:
1. `public/images/header.png` → storage/app/public/logos/header.png
2. `public/images/logo_pln.png` → storage/app/public/logos/logo_pln.png
3. `public/images/logo_smk3.png` → storage/app/public/logos/logo_smk3.png
4. `public/images/logo_iso.png` → storage/app/public/logos/logo_iso.png

### Langkah-langkah:

#### Opsi 1: Via FTP/File Manager Hostinger (Mudah)
1. Login ke File Manager Hostinger
2. Buat folder: `storage/app/public/logos/`
3. Upload semua file logo dari `public/images` ke folder `storage/app/public/logos/`
4. Pastikan path lengkapnya: `/home/u630801650/domains/fzrahub.icu/public_html/storage/app/public/logos/`

#### Opsi 2: Via Artisan Command (Otomatis)
Jalankan command ini di terminal hosting:
```bash
php artisan storage:link
```

Lalu copy manual file-file logo atau jalankan script PHP berikut via SSH:

```bash
cd /home/u630801650/domains/fzrahub.icu/public_html

# Buat folder logos di storage
mkdir -p storage/app/public/logos

# Copy file logo (jika ada di public/images)
cp public/images/header.png storage/app/public/logos/header.png
cp public/images/logo_pln.png storage/app/public/logos/logo_pln.png
cp public/images/logo_smk3.png storage/app/public/logos/logo_smk3.png
cp public/images/logo_iso.png storage/app/public/logos/logo_iso.png

# Set permission
chmod -R 755 storage/app/public/logos
```

### Setelah Upload
1. Pastikan file ada di: `storage/app/public/logos/`
2. Test export PDF dan Word lagi
3. Logo akan muncul dengan sempurna

---

## Status Saat Ini
✅ Export Word/PDF sudah diperbaiki dengan conditional check (tidak crash lagi)
⚠️ Logo akan tampil jika file ada di storage, jika tidak ada akan tampil placeholder text

## Catatan
- Saat ini template sudah aman (tidak crash meskipun logo tidak ada)
- Untuk tampilan sempurna, upload logo ke storage seperti langkah di atas
