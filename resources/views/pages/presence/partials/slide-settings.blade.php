<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Slide Foto</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Reset and Box Sizing */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Main Container (pembungkus luar, Hadirin style) */
        .hadirin-slide-settings-container { /* Mengubah slide-settings-container */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin-bottom: 2rem; /* Menambahkan margin bawah agar tidak terlalu mepet dengan tombol utama */
        }

        /* Header Bagian (mirip dengan hadirin-section-header) */
        .hadirin-slide-settings-header { /* Mengubah slide-settings-header */
            display: flex;
            align-items: center;
            margin-bottom: 2rem; /* Lebih besar */
            gap: 1rem; /* Jarak antar elemen */
            background-color: #e0f2f7; /* Latar belakang terang biru Hadirin */
            border-radius: 12px;
            padding: 1.2rem 1.5rem; /* Padding lebih besar */
            box-shadow: 0 4px 10px rgba(0, 180, 216, 0.1); /* Bayangan lembut */
        }

        .hadirin-slide-settings-icon { /* Mengubah slide-settings-icon */
            width: 42px; /* Ukuran ikon sedikit lebih besar */
            height: 42px;
            background: linear-gradient(135deg, #00b4d8, #0077b6); /* Gradien biru Hadirin */
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 19px; /* Ukuran font ikon */
            box-shadow: 0 4px 10px rgba(0, 116, 182, 0.2); /* Bayangan untuk ikon */
        }

        .hadirin-slide-settings-title { /* Mengubah slide-settings-title */
            font-size: 1.7rem; /* Ukuran font lebih besar */
            font-weight: 700;
            color: #0077b6; /* Warna biru gelap Hadirin */
            margin: 0;
        }

        /* Grid Opsi Slide */
        .slide-options-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem; /* Jarak antar kartu opsi */
            margin-bottom: 2.5rem; /* Jarak bawah */
        }

        /* Grid Area Definitions (tetap sama untuk fungsionalitas) */
        .slide-options-grid.create-mode {
            grid-template-areas:
                "keep previous"
                "upload none";
        }
        .slide-options-grid.create-mode .slide-option-card[data-option="keep"] { grid-area: keep; }
        .slide-options-grid.create-mode .slide-option-card[data-option="previous"] { grid-area: previous; }
        .slide-options-grid.create-mode .slide-option-card[data-option="new"] { grid-area: upload; }
        .slide-options-grid.create-mode .slide-option-card[data-option="none"] { grid-area: none; }

        .slide-options-grid.edit-mode {
            grid-template-areas:
                "keep previous"
                "upload none";
        }
        .slide-options-grid.edit-mode .slide-option-card[data-option="keep"] { grid-area: keep; }
        .slide-options-grid.edit-mode .slide-option-card[data-option="previous"] { grid-area: previous; }
        .slide-options-grid.edit-mode .slide-option-card[data-option="new"] { grid-area: upload; }
        .slide-options-grid.edit-mode .slide-option-card[data-option="none"] { grid-area: none; }

        .slide-options-grid.create-mode-no-keep {
            grid-template-areas:
                "previous none"
                "upload upload";
        }
        .slide-options-grid.create-mode-no-keep .slide-option-card[data-option="previous"] { grid-area: previous; }
        .slide-options-grid.create-mode-no-keep .slide-option-card[data-option="new"] { grid-area: upload; }
        .slide-options-grid.create-mode-no-keep .slide-option-card[data-option="none"] { grid-area: none; }

        .slide-options-grid.edit-mode-no-keep {
            grid-template-areas:
                "previous none"
                "upload upload";
        }
        .slide-options-grid.edit-mode-no-keep .slide-option-card[data-option="previous"] { grid-area: previous; }
        .slide-options-grid.edit-mode-no-keep .slide-option-card[data-option="new"] { grid-area: upload; }
        .slide-options-grid.edit-mode-no-keep .slide-option-card[data-option="none"] { grid-area: none; }


        .slide-option-card {
            background: white;
            border: 2px solid #a8dadc; /* Border Hadirin */
            border-radius: 12px;
            padding: 1.2rem; /* Padding yang disesuaikan */
            cursor: pointer;
            transition: all 0.3s ease; /* Transisi lebih halus */
            position: relative;
            min-height: 120px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05); /* Bayangan lembut */
        }

        .slide-option-card:hover {
            border-color: #00b4d8; /* Warna biru Hadirin saat hover */
            box-shadow: 0 4px 15px rgba(0, 180, 216, 0.15); /* Bayangan lebih jelas */
            transform: translateY(-3px); /* Efek hover lebih terasa */
        }

        .slide-option-card.selected {
            border-color: #00b4d8; /* Warna biru Hadirin saat terpilih */
            background: rgba(0, 180, 216, 0.08); /* Latar belakang biru Hadirin semi-transparan */
            box-shadow: 0 4px 15px rgba(0, 180, 216, 0.25); /* Bayangan lebih jelas */
            transform: translateY(0);
        }

        .slide-option-content {
            display: flex;
            align-items: flex-start;
            gap: 1rem; /* Jarak antar elemen */
            margin-bottom: 0.8rem; /* Margin bawah untuk memisahkan dari pratinjau */
        }

        .slide-option-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Bayangan ikon */
        }

        .slide-option-icon.previous {
            background: rgba(0, 180, 216, 0.15); /* Warna biru Hadirin */
            color: #00b4d8;
        }

        .slide-option-icon.upload {
            background: rgba(156, 39, 176, 0.15); /* Warna ungu (tetap untuk upload) */
            color: #9c27b0;
        }

        .slide-option-icon.keep {
            background: rgba(34, 168, 53, 0.15); /* Warna hijau (tetap untuk keep) */
            color: #22a835;
        }

        .slide-option-icon.none {
            background: rgba(117, 117, 117, 0.15); /* Warna abu-abu (tetap untuk none) */
            color: #757575;
        }

        .slide-option-text {
            flex: 1;
        }

        .slide-option-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #0077b6; /* Warna biru gelap Hadirin */
            margin: 0 0 0.3rem 0;
        }

        .slide-option-description {
            font-size: 0.95rem;
            color: #5f6368; /* Warna teks Hadirin */
            margin: 0;
            line-height: 1.4;
        }

        .slide-option-radio {
            position: absolute;
            top: 1rem;
            right: 1rem;
            width: 20px;
            height: 20px;
            border: 2px solid #dadce0;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .slide-option-card.selected .slide-option-radio {
            border-color: #00b4d8; /* Warna biru Hadirin */
            background: #00b4d8;
        }

        .slide-option-card.selected .slide-option-radio::after {
            content: '';
            width: 8px;
            height: 8px;
            background: white;
            border-radius: 50%;
        }

        .slide-option-card input[type="radio"] {
            display: none;
        }

        /* Compact style for bottom row cards (disesuaikan dengan ukuran font keseluruhan) */
        .slide-option-card.compact {
            min-height: 90px;
            padding: 1rem;
        }

        .slide-option-card.compact .slide-option-content {
            align-items: center;
            gap: 0.8rem;
        }

        .slide-option-card.compact .slide-option-icon {
            width: 38px;
            height: 38px;
            font-size: 1rem;
        }

        .slide-option-card.compact .slide-option-title {
            font-size: 1rem;
            margin-bottom: 0.2rem;
        }

        .slide-option-card.compact .slide-option-description {
            font-size: 0.85rem;
        }

        .slide-content-section {
            background: #f8f9fa; /* Latar belakang terang Hadirin */
            border-radius: 12px;
            border: 1px solid #e8eaed;
            padding: 1.5rem; /* Padding lebih besar */
            display: none;
            margin-top: 1.5rem; /* Margin atas */
            box-shadow: inset 0 1px 5px rgba(0, 0, 0, 0.03); /* Inset shadow lembut */
        }

        .slide-content-section.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .section-title { /* Menggunakan gaya section-title Hadirin */
            font-size: 1.2rem;
            font-weight: 700;
            color: #0077b6; /* Warna biru gelap Hadirin */
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid rgba(0, 180, 216, 0.1);
        }

        .previous-select {
            width: 100%;
            padding: 0.9rem 1.1rem; /* Padding Hadirin input */
            border: 2px solid #a8dadc; /* Border Hadirin input */
            border-radius: 12px; /* Radius Hadirin input */
            background: white;
            font-size: 1rem;
            color: #3c4043;
            transition: all 0.3s ease;
            appearance: none; /* Menghilangkan gaya default select */
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%230077b6'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E"); /* Custom arrow */
            background-repeat: no-repeat;
            background-position: right 0.8rem center;
            background-size: 1.2rem;
        }

        .previous-select:focus {
            outline: none;
            border-color: #00b4d8; /* Warna biru Hadirin saat fokus */
            box-shadow: 0 0 0 0.2rem rgba(0, 180, 216, 0.18); /* Bayangan fokus lebih solid */
        }

        .upload-area {
            border: 2px dashed #a8dadc; /* Border dashed Hadirin */
            border-radius: 12px;
            padding: 2rem 1.5rem; /* Padding lebih besar */
            text-align: center;
            background: white;
            transition: all 0.3s ease;
            cursor: pointer;
            margin-bottom: 1.5rem;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.03);
        }

        .upload-area:hover,
        .upload-area.dragover {
            border-color: #00b4d8; /* Warna biru Hadirin */
            background: rgba(0, 180, 216, 0.05); /* Latar belakang biru Hadirin semi-transparan */
        }

        .upload-icon {
            width: 48px;
            height: 48px;
            margin: 0 auto 1rem;
            background: rgba(0, 180, 216, 0.15); /* Warna biru Hadirin */
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #00b4d8;
            font-size: 1.4rem;
        }

        .upload-title {
            font-size: 1rem;
            font-weight: 600;
            color: #3c4043; /* Warna teks Hadirin */
            margin-bottom: 0.5rem;
        }

        .upload-description {
            font-size: 0.85rem;
            color: #70757a;
            margin-bottom: 1rem;
            line-height: 1.4;
        }

        .upload-button {
            background: linear-gradient(135deg, #00b4d8 0%, #0077b6 100%); /* Gradien biru Hadirin */
            color: white;
            border: none;
            padding: 0.8rem 1.5rem; /* Padding yang disesuaikan */
            border-radius: 10px; /* Radius yang disesuaikan */
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            box-shadow: 0 4px 10px rgba(0, 180, 216, 0.2);
        }

        .upload-button:hover {
            background: linear-gradient(135deg, #0096c7 0%, #005577 100%); /* Warna sedikit lebih gelap saat hover */
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 180, 216, 0.3);
        }

        .file-input {
            display: none;
        }

        .preview-section {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e8eaed;
            display: none; /* Default hidden */
        }

        .preview-section.active {
            display: block;
        }

        .preview-label {
            font-size: 0.95rem;
            color: #5f6368; /* Warna teks Hadirin */
            margin-bottom: 0.8rem;
            font-weight: 500;
        }

        .preview-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            gap: 0.8rem;
        }

        .preview-item {
            position: relative;
            aspect-ratio: 16/9;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #e8eaed;
            background: #f8f9fa;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .preview-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Modal Styling (for alerts) */
        .custom-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .custom-modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .custom-modal-content {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 400px;
            width: 90%;
            transform: translateY(-20px);
            opacity: 0;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .custom-modal-overlay.active .custom-modal-content {
            transform: translateY(0);
            opacity: 1;
        }

        .custom-modal-content h4 {
            font-size: 1.5rem;
            color: #0077b6;
            margin-bottom: 1rem;
        }

        .custom-modal-content p {
            font-size: 1rem;
            color: #3c4043;
            margin-bottom: 1.5rem;
        }

        .custom-modal-content button {
            background: linear-gradient(135deg, #00b4d8 0%, #0077b6 100%);
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .custom-modal-content button:hover {
            background: linear-gradient(135deg, #0096c7 0%, #005577 100%);
            transform: translateY(-2px);
        }


        /* Media queries for responsiveness */
        @media (max-width: 768px) {
            .slide-options-grid,
            .slide-options-grid.create-mode,
            .slide-options-grid.edit-mode,
            .slide-options-grid.create-mode-no-keep,
            .slide-options-grid.edit-mode-no-keep {
                grid-template-columns: 1fr; /* Kolom tunggal untuk perangkat kecil */
                grid-template-areas: unset; /* Reset grid areas */
            }

            /* Hapus penataan grid area spesifik untuk mobile */
            .slide-options-grid.create-mode .slide-option-card[data-option="keep"],
            .slide-options-grid.create-mode .slide-option-card[data-option="previous"],
            .slide-options-grid.create-mode .slide-option-card[data-option="new"],
            .slide-options-grid.create-mode .slide-option-card[data-option="none"],
            .slide-options-grid.edit-mode .slide-option-card[data-option="keep"],
            .slide-options-grid.edit-mode .slide-option-card[data-option="previous"],
            .slide-options-grid.edit-mode .slide-option-card[data-option="new"],
            .slide-options-grid.edit-mode .slide-option-card[data-option="none"],
            .slide-options-grid.create-mode-no-keep .slide-option-card[data-option="previous"],
            .slide-options-grid.create-mode-no-keep .slide-option-card[data-option="new"],
            .slide-options-grid.create-mode-no-keep .slide-option-card[data-option="none"],
            .slide-options-grid.edit-mode-no-keep .slide-option-card[data-option="previous"],
            .slide-options-grid.edit-mode-no-keep .slide-option-card[data-option="new"],
            .slide-options-grid.edit-mode-no-keep .slide-option-card[data-option="none"] {
                grid-area: unset; /* Pastikan tidak ada grid area spesifik */
            }


            .hadirin-slide-settings-container {
                padding: 0 15px; /* Disesuaikan untuk mobile */
            }

            .hadirin-slide-settings-header {
                flex-direction: column;
                align-items: flex-start;
                padding: 1rem;
                margin-bottom: 1.5rem;
            }

            .hadirin-slide-settings-icon {
                width: 38px;
                height: 38px;
                font-size: 18px;
            }

            .hadirin-slide-settings-title {
                font-size: 1.4rem;
            }

            .slide-option-card {
                padding: 1rem;
                min-height: 100px;
            }

            .slide-option-card.compact {
                min-height: 80px;
                padding: 0.8rem;
            }

            .slide-option-title {
                font-size: 1rem;
            }

            .slide-option-description {
                font-size: 0.85rem;
            }

            .slide-content-section {
                padding: 1rem;
            }

            .section-title {
                font-size: 1.1rem;
            }

            .previous-select {
                padding: 0.8rem 1rem;
                font-size: 0.9rem;
            }

            .upload-area {
                padding: 1.5rem 1rem;
            }

            .upload-title {
                font-size: 0.95rem;
            }

            .upload-description {
                font-size: 0.8rem;
            }

            .upload-button {
                padding: 0.7rem 1.2rem;
                font-size: 0.9rem;
            }

            .preview-grid {
                grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
                gap: 0.6rem;
            }
        }
    </style>
</head>
<body>
    <div class="hadirin-slide-settings-container">
        {{-- <div class="hadirin-slide-settings-header">
            <div class="hadirin-slide-settings-icon">
                <i class="fas fa-images"></i>
            </div>
            <h3 class="hadirin-slide-settings-title">Pengaturan Slide Foto</h3>
        </div> --}}

        <div class="hadirin-section-header">
            <div class="hadirin-section-icon">
                <i class="fas fa-images"></i>
            </div>
            <h3 class="hadirin-section-title">Pengaturan Slide Foto</h3>
        </div>

        @php
            // Anda perlu mendefinisikan variabel ini di controller atau tempat lain yang relevan
            // Contoh dummy data jika Anda menguji tanpa Laravel:
            // $isEdit = true;
            // $presence = (object)['slides' => collect([ (object)['image_path' => 'slide1.jpg'], (object)['image_path' => 'slide2.jpg'] ])];
            // $previousSlides = collect([ (object)['id' => 1, 'nama_kegiatan' => 'Kegiatan Lama A', 'tgl_kegiatan' => '2023-01-15', 'slides' => collect([(object)['image_path' => 'prev_slide1.jpg']])], (object)['id' => 2, 'nama_kegiatan' => 'Kegiatan Lama B', 'tgl_kegiatan' => '2023-02-20', 'slides' => collect([(object)['image_path' => 'prev_slide3.jpg'], (object)['image_path' => 'prev_slide4.jpg']])], ]);

            $hasExistingSlides = isset($isEdit) && $isEdit && isset($presence) && $presence->slides->count() > 0;
            $isEditMode = isset($isEdit) && $isEdit;

            // --- Bagian yang Diperbaiki (Penentuan currentSlideOption) ---
            $currentSlideOption = null;

            if ($isEditMode) {
                // Jika dalam mode edit, coba ambil dari $presence->slide_option_type
                $currentSlideOption = $presence->slide_option_type ?? null;
                // Jika tidak ada slide_option_type yang tersimpan dan ada slide existing, default ke 'keep'
                if (!$currentSlideOption && $hasExistingSlides) {
                    $currentSlideOption = 'keep';
                }
                // Jika tidak ada slide_option_type yang tersimpan dan tidak ada slide existing (misal: sebelumnya 'none'), default ke 'none'
                elseif (!$currentSlideOption && !$hasExistingSlides) {
                    $currentSlideOption = 'none';
                }
            } else {
                // Jika dalam mode create (isEditMode == false), default ke 'new' atau 'none'
                $currentSlideOption = 'new'; // Atau 'none', tergantung preferensi default Anda
            }
            // --- Akhir Bagian yang Diperbaiki ---


            if ($hasExistingSlides) {
                $gridClass = 'edit-mode';
            } elseif ($isEditMode) {
                $gridClass = 'edit-mode-no-keep';
            } else {
                $gridClass = 'create-mode-no-keep';
            }
        @endphp

        <div class="slide-options-grid {{ $gridClass }}">
            @if($hasExistingSlides)
    <div class="slide-option-card compact {{ $currentSlideOption == 'keep' ? 'selected' : '' }}" data-option="keep" id="option-keep">
                <input type="radio" name="slide_option" value="keep" id="slide_keep" {{ $currentSlideOption == 'keep' ? 'checked' : '' }}>
                <div class="slide-option-content">
                    <div class="slide-option-icon keep">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="slide-option-text">
                        <h4 class="slide-option-title">Tetap gunakan slide saat ini</h4>
                        <p class="slide-option-description">{{ $presence->slides->count() }} foto akan tetap digunakan</p>
                    </div>
                </div>
                <div class="slide-option-radio"></div>

                {{-- START: Tambahkan bagian ini untuk pratinjau --}}
                <div class="preview-section" id="keep-preview-section">
                    <div class="preview-label">Preview slide saat ini:</div>
                    <div class="preview-grid" id="keep-preview-grid">
                        @foreach($presence->slides as $slide)
                            <div class="preview-item">
                                <img src="/uploads/{{ $slide->image_path }}" class="preview-image" alt="Current slide preview">
                            </div>
                        @endforeach
                    </div>
                </div>
                {{-- END: Tambahkan bagian ini untuk pratinjau --}}
            </div>
            @endif

    <div class="slide-option-card compact {{ $currentSlideOption == 'previous' ? 'selected' : '' }}" data-option="previous" id="option-previous">
                <input type="radio" name="slide_option" value="previous" id="slide_previous" {{ $currentSlideOption == 'previous' ? 'checked' : '' }}>
                <div class="slide-option-content">
                    <div class="slide-option-icon previous">
                        <i class="fas fa-history"></i>
                    </div>
                    <div class="slide-option-text">
                        <h4 class="slide-option-title">Gunakan slide dari kegiatan lain</h4>
                        <p class="slide-option-description">Pilih dari kegiatan sebelumnya</p>
                    </div>
                </div>
                <div class="slide-option-radio"></div>
            </div>

    <div class="slide-option-card compact {{ $currentSlideOption == 'new' ? 'selected' : '' }}" data-option="new" id="option-new">
                <input type="radio" name="slide_option" value="new" id="slide_new" {{ $currentSlideOption == 'new' ? 'checked' : '' }}>
                <div class="slide-option-content">
                    <div class="slide-option-icon upload">
                        <i class="fas fa-upload"></i>
                    </div>
                    <div class="slide-option-text">
                        <h4 class="slide-option-title">Upload slide baru</h4>
                        <p class="slide-option-description">Upload maksimal 5 foto</p>
                    </div>
                </div>
                <div class="slide-option-radio"></div>
            </div>

    <div class="slide-option-card compact {{ $currentSlideOption == 'none' ? 'selected' : '' }}" data-option="none" id="option-none">
                <input type="radio" name="slide_option" value="none" id="slide_none" {{ $currentSlideOption == 'none' ? 'checked' : '' }}>
                <div class="slide-option-content">
                    <div class="slide-option-icon none">
                        <i class="fas fa-ban"></i>
                    </div>
                    <div class="slide-option-text">
                        <h4 class="slide-option-title">Tanpa slide foto</h4>
                        <p class="slide-option-description">Tidak menggunakan slide</p>
                    </div>
                </div>
                <div class="slide-option-radio"></div>
            </div>
        </div>

<div class="slide-content-section {{ $currentSlideOption == 'previous' ? 'active' : '' }}" id="previous-section">
            <h4 class="section-title">Pilih Kegiatan Sebelumnya</h4>
            <select class="previous-select" name="previous_presence_id" id="previous_presence_id">
                <option value="">-- Pilih Kegiatan --</option>
                @if(isset($previousSlides))
                    @foreach($previousSlides as $prevSlide)
                        <option value="{{ $prevSlide->id }}"
                                        data-slides='@json($prevSlide->slides->map(fn($slide) => ["image_path" => $slide->image_path]))'>
                            {{ $prevSlide->nama_kegiatan }} ({{ date('d/m/Y', strtotime($prevSlide->tgl_kegiatan)) }}) - {{ $prevSlide->slides->count() }} foto
                        </option>
                    @endforeach
                @endif
            </select>

    <div class="preview-section" id="previous-preview" style="display: none;">
                <div class="preview-label">Preview slide yang akan digunakan:</div>
                <div class="preview-grid" id="previous-preview-grid"></div>
            </div>
        </div>

<div class="slide-content-section {{ $currentSlideOption == 'new' ? 'active' : '' }}" id="upload-section">
            <h4 class="section-title">Upload Slide Foto (Maksimal 5 foto)</h4>
            <div class="upload-area" onclick="document.getElementById('slide_images').click()">
                <div class="upload-icon">
                    <i class="fas fa-cloud-upload-alt"></i>
                </div>
                <div class="upload-title">Upload Slide Foto</div>
                <div class="upload-description">Format: JPG, PNG, GIF. Disarankan rasio landscape 16:9 untuk hasil terbaik.</div>
                <button type="button" class="upload-button">
                    <i class="fas fa-plus"></i>
                    Pilih File
                </button>
            </div>
            <input type="file" class="file-input" name="slide_images[]" id="slide_images" multiple accept="image/*" max="5">

            <div class="preview-section" id="upload-preview">
                <div class="preview-label">Preview gambar yang akan diupload:</div>
                <div class="preview-grid" id="upload-preview-grid"></div>
            </div>
        </div>
    </div>

    {{-- Custom Modal for Alerts --}}
    <div class="custom-modal-overlay" id="customAlertModal">
        <div class="custom-modal-content">
            <h4 id="modalTitle">Peringatan!</h4>
            <p id="modalMessage"></p>
            <button id="modalCloseButton">Oke</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slideOptions = document.querySelectorAll('.slide-option-card');
            const radioInputs = document.querySelectorAll('input[name="slide_option"]');
            const contentSections = document.querySelectorAll('.slide-content-section');
            const keepPreviewSection = document.getElementById('keep-preview-section');

            // Custom Alert Modal Elements
            const customAlertModal = document.getElementById('customAlertModal');
            const modalTitle = document.getElementById('modalTitle');
            const modalMessage = document.getElementById('modalMessage');
            const modalCloseButton = document.getElementById('modalCloseButton');

            // Function to show custom alert
            function showCustomAlert(message, title = 'Peringatan!') {
                modalTitle.textContent = title;
                modalMessage.textContent = message;
                customAlertModal.classList.add('active');
            }

            // Function to hide custom alert
            function hideCustomAlert() {
                customAlertModal.classList.remove('active');
            }

            // Close modal on button click
            modalCloseButton.addEventListener('click', hideCustomAlert);
            // Close modal on overlay click
            customAlertModal.addEventListener('click', function(event) {
                if (event.target === customAlertModal) {
                    hideCustomAlert();
                }
            });


            // Initialize
            updateSelectedOption();
            // --- Bagian yang Diperbaiki (Inisialisasi Tampilan Section) ---
            showContentSection(getSelectedOption());
            // --- Akhir Bagian yang Diperbaiki ---

            // Handle option card clicks
            slideOptions.forEach(card => {
                card.addEventListener('click', function() {
                    const option = this.dataset.option;
                    const radio = document.getElementById(`slide_${option}`);

                    if (radio) {
                        radio.checked = true;
                        updateSelectedOption();
                        showContentSection(option);
                    }
                });
            });

            // Handle radio button changes
            radioInputs.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.checked) {
                        updateSelectedOption();
                        showContentSection(this.value);
                    }
                });
            });

            function getSelectedOption() {
                return document.querySelector('input[name="slide_option"]:checked')?.value || 'none';
            }

            function updateSelectedOption() {
                const selectedValue = getSelectedOption();

                slideOptions.forEach(card => {
                    card.classList.toggle('selected', card.dataset.option === selectedValue);
                });
            }

            function showContentSection(option) {
                contentSections.forEach(section => {
                    section.classList.remove('active');
                });

                // Sembunyikan semua preview-section secara default
                document.querySelectorAll('.preview-section').forEach(section => {
                    section.style.display = 'none';
                });

                if (option === 'previous') {
                    document.getElementById('previous-section')?.classList.add('active');
                    // Tampilkan preview previous hanya jika ada pilihan di select
                    if (document.getElementById('previous_presence_id').value) {
                        document.getElementById('previous-preview').style.display = 'block';
                    }
                } else if (option === 'new') {
                    document.getElementById('upload-section')?.classList.add('active');
                    // Tampilkan preview section untuk upload jika ada file yang dipilih atau jika section baru diaktifkan
                    if (document.getElementById('slide_images').files.length > 0 || document.getElementById('upload-preview-grid').innerHTML.trim()) {
                         document.getElementById('upload-preview').style.display = 'block';
                    }
                } else if (option === 'keep') { // Tampilkan pratinjau "keep" jika opsi ini dipilih
                    if (keepPreviewSection) {
                        keepPreviewSection.style.display = 'block';
                    }
                }
                // Jika 'none' dipilih, tidak ada section konten yang perlu diaktifkan
            }

            // File upload handling
            const fileInput = document.getElementById('slide_images');
            const uploadArea = document.querySelector('.upload-area');
            const uploadPreview = document.getElementById('upload-preview');
            const uploadPreviewGrid = document.getElementById('upload-preview-grid');

            if (fileInput && uploadArea) {
                // Drag and drop events
                ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                    uploadArea.addEventListener(eventName, e => { e.preventDefault(); e.stopPropagation(); }, false);
                });

                ['dragenter', 'dragover'].forEach(eventName => {
                    uploadArea.addEventListener(eventName, () => uploadArea.classList.add('dragover'), false);
                });

                ['dragleave', 'drop'].forEach(eventName => {
                    uploadArea.addEventListener(eventName, () => uploadArea.classList.remove('dragover'), false);
                });

                uploadArea.addEventListener('drop', e => {
                    const files = e.dataTransfer.files;
                    handleFiles(files);
                }, false);

                uploadArea.addEventListener('click', () => { // Ensure click also triggers file input
                    fileInput.click();
                });

                fileInput.addEventListener('change', e => {
                    handleFiles(e.target.files);
                });
            }

            function handleFiles(files) {
                if (!files || files.length === 0) {
                    uploadPreview.style.display = 'none';
                    document.querySelector('.upload-button').innerHTML = `<i class="fas fa-plus"></i> Pilih File`;
                    return;
                }

                const fileList = Array.from(files).slice(0, 5); // Batasi hingga 5 file
                // Untuk mencegah duplikasi saat memilih file berulang kali
                fileInput.files = new DataTransfer().files; // Clear existing FileList
                for (let i = 0; i < fileList.length; i++) {
                    // Re-add selected files to fileInput.files using DataTransfer
                    // This is a workaround for FileList being read-only
                    const dataTransfer = new DataTransfer();
                    // First add existing files if any
                    Array.from(fileInput.files).forEach(file => dataTransfer.items.add(file));
                    // Then add the new files
                    dataTransfer.items.add(fileList[i]);
                    fileInput.files = dataTransfer.files;
                }

                uploadPreviewGrid.innerHTML = ''; // Kosongkan preview lama

                const uploadButton = document.querySelector('.upload-button');
                if (uploadButton) {
                    uploadButton.innerHTML = `<i class="fas fa-check"></i>${fileList.length} file${fileList.length > 1 ? 's' : ''} dipilih`;
                }

                fileList.forEach(file => {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const previewItem = document.createElement('div');
                            previewItem.className = 'preview-item';

                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = 'preview-image';
                            img.alt = file.name;

                            previewItem.appendChild(img);
                            uploadPreviewGrid.appendChild(previewItem);
                        };
                        reader.readAsDataURL(file);
                    }
                });

                uploadPreview.style.display = 'block';
            }

            // Previous slides selection handling
            const previousSelect = document.getElementById('previous_presence_id');
            const previousPreview = document.getElementById('previous-preview');
            const previousPreviewGrid = document.getElementById('previous-preview-grid');

            if (previousSelect) {
                previousSelect.addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    const slidesData = selectedOption.getAttribute('data-slides');

                    previousPreviewGrid.innerHTML = '';

                    if (slidesData && slidesData !== '[]' && this.value) {
                        try {
                            const slides = JSON.parse(slidesData);

                            slides.forEach((slide, index) => {
                                const previewItem = document.createElement('div');
                                previewItem.className = 'preview-item';

                                const img = document.createElement('img');
                                // Use actual image path from uploads directory
                                img.src = `/uploads/${slide.image_path}`;
                                img.className = 'preview-image';
                                img.alt = 'Slide preview';

                                previewItem.appendChild(img);
                                previousPreviewGrid.appendChild(previewItem);
                            });

                            previousPreview.style.display = 'block';
                        } catch (error) {
                            console.error('Error parsing slides data:', error);
                            previousPreview.style.display = 'none';
                        }
                    } else {
                        previousPreview.style.display = 'none';
                    }
                });
            }

            // Initial check for previous slides section visibility on page load if 'previous' is selected
            // --- Bagian yang Diperbaiki (Inisialisasi Preview Previous) ---
            const initialSelectedOption = getSelectedOption();
            if (initialSelectedOption === 'previous' && previousSelect && previousSelect.value) {
                // Trigger change event programmatically to load preview for previously selected item
                const event = new Event('change');
                previousSelect.dispatchEvent(event);
            }
            // --- Akhir Bagian yang Diperbaiki ---
        });

        // Validation function
        function validateSlideSettings() {
            const selectedOption = document.querySelector('input[name="slide_option"]:checked')?.value;

            if (selectedOption === 'previous') {
                const previousSelect = document.getElementById('previous_presence_id');
                if (!previousSelect || !previousSelect.value) {
                    showCustomAlert('Silakan pilih kegiatan sebelumnya untuk menggunakan slide yang ada.');
                    return false;
                }
            } else if (selectedOption === 'new') {
                const fileInput = document.getElementById('slide_images');
                if (!fileInput || !fileInput.files || fileInput.files.length === 0) {
                    showCustomAlert('Silakan pilih file gambar untuk slide baru.');
                    return false;
                }
            }

            return true;
        }
    </script>
</body>
</html>