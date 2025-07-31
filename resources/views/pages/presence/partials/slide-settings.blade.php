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

        /* Main Container */
        .hadirin-slide-settings-container {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin-bottom: 2rem;
        }

        /* Grid Opsi Slide */
        .slide-options-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }

        /* Grid Area Definitions - Disesuaikan untuk mode create/edit */
        .slide-options-grid.create-mode {
            grid-template-areas:
                "previous new"
                "none none"; /* 'keep' tidak ada di create mode */
        }
        .slide-options-grid.create-mode .slide-option-card[data-option="previous"] { grid-area: previous; }
        .slide-options-grid.create-mode .slide-option-card[data-option="new"] { grid-area: new; }
        .slide-options-grid.create-mode .slide-option-card[data-option="none"] { grid-area: none; }

        .slide-options-grid.edit-mode {
            grid-template-areas:
                "keep previous"
                "new none";
        }
        .slide-options-grid.edit-mode .slide-option-card[data-option="keep"] { grid-area: keep; }
        .slide-options-grid.edit-mode .slide-option-card[data-option="previous"] { grid-area: previous; }
        .slide-options-grid.edit-mode .slide-option-card[data-option="new"] { grid-area: new; }
        .slide-options-grid.edit-mode .slide-option-card[data-option="none"] { grid-area: none; }

        .slide-option-card {
            background: white;
            border: 2px solid #a8dadc;
            border-radius: 12px;
            padding: 1.2rem;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            min-height: 120px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .slide-option-card:hover {
            border-color: #00b4d8;
            box-shadow: 0 4px 15px rgba(0, 180, 216, 0.15);
            transform: translateY(-3px);
        }

        .slide-option-card.selected {
            border-color: #00b4d8;
            background: rgba(0, 180, 216, 0.08);
            box-shadow: 0 4px 15px rgba(0, 180, 216, 0.25);
            transform: translateY(0);
        }

        .slide-option-content {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            margin-bottom: 0.8rem;
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
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .slide-option-icon.previous {
            background: rgba(0, 180, 216, 0.15);
            color: #00b4d8;
        }

        .slide-option-icon.upload {
            background: rgba(156, 39, 176, 0.15);
            color: #9c27b0;
        }

        .slide-option-icon.keep {
            background: rgba(34, 168, 53, 0.15);
            color: #22a835;
        }

        .slide-option-icon.none {
            background: rgba(117, 117, 117, 0.15);
            color: #757575;
        }

        .slide-option-text {
            flex: 1;
        }

        .slide-option-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #0077b6;
            margin: 0 0 0.3rem 0;
        }

        .slide-option-description {
            font-size: 0.95rem;
            color: #5f6368;
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
            border-color: #00b4d8;
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

        /* Compact style for bottom row cards */
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
            background: #f8f9fa;
            border-radius: 12px;
            border: 1px solid #e8eaed;
            padding: 1.5rem;
            display: none;
            margin-top: 1.5rem;
            box-shadow: inset 0 1px 5px rgba(0, 0, 0, 0.03);
        }

        .slide-content-section.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .section-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #0077b6;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid rgba(0, 180, 216, 0.1);
        }

        .slide-previous-select {
            width: 100%;
            padding: 0.9rem 1.1rem;
            border: 2px solid #a8dadc;
            border-radius: 12px;
            background: white;
            font-size: 1rem;
            color: #3c4043;
            transition: all 0.3s ease;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%230077b6'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.8rem center;
            background-size: 1.2rem;
        }

        .slide-previous-select:focus {
            outline: none;
            border-color: #00b4d8;
            box-shadow: 0 0 0 0.2rem rgba(0, 180, 216, 0.18);
        }

        .upload-area {
            border: 2px dashed #a8dadc;
            border-radius: 12px;
            padding: 2rem 1.5rem;
            text-align: center;
            background: white;
            transition: all 0.3s ease;
            cursor: pointer;
            margin-bottom: 1.5rem;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.03);
        }

        .upload-area:hover,
        .upload-area.dragover {
            border-color: #00b4d8;
            background: rgba(0, 180, 216, 0.05);
        }

        .upload-icon {
            width: 48px;
            height: 48px;
            margin: 0 auto 1rem;
            background: rgba(0, 180, 216, 0.15);
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
            color: #3c4043;
            margin-bottom: 0.5rem;
        }

        .upload-description {
            font-size: 0.85rem;
            color: #70757a;
            margin-bottom: 1rem;
            line-height: 1.4;
        }

        .upload-button {
            background: linear-gradient(135deg, #00b4d8 0%, #0077b6 100%);
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 10px;
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
            background: linear-gradient(135deg, #0096c7 0%, #005577 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 180, 216, 0.3);
        }

        .file-input {
            display: none;
        }

        .slide-preview-section {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e8eaed;
            display: none; /* Default hidden, shown by JS */
        }

        .slide-preview-section.active {
            display: block;
        }

        .slide-preview-label {
            font-size: 0.95rem;
            color: #5f6368;
            margin-bottom: 0.8rem;
            font-weight: 500;
        }

        .slide-preview-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            gap: 0.8rem;
        }

        .slide-preview-item {
            position: relative;
            aspect-ratio: 16/9;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #e8eaed;
            background: #f8f9fa;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .slide-preview-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Modal Styling */
        .slide-custom-modal-overlay {
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

        .slide-custom-modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .slide-custom-modal-content {
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

        .slide-custom-modal-overlay.active .slide-custom-modal-content {
            transform: translateY(0);
            opacity: 1;
        }

        .slide-custom-modal-content h4 {
            font-size: 1.5rem;
            color: #0077b6;
            margin-bottom: 1rem;
        }

        .slide-custom-modal-content p {
            font-size: 1rem;
            color: #3c4043;
            margin-bottom: 1.5rem;
        }

        .slide-custom-modal-content button {
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

        .slide-custom-modal-content button:hover {
            background: linear-gradient(135deg, #0096c7 0%, #005577 100%);
            transform: translateY(-2px);
        }

        /* Media queries for responsiveness */
        @media (max-width: 768px) {
            .slide-options-grid,
            .slide-options-grid.create-mode,
            .slide-options-grid.edit-mode {
                grid-template-columns: 1fr;
                grid-template-areas: unset; /* Reset grid areas for mobile */
            }

            /* Reset specific grid areas for mobile */
            .slide-options-grid.create-mode .slide-option-card[data-option="previous"],
            .slide-options-grid.create-mode .slide-option-card[data-option="new"],
            .slide-options-grid.create-mode .slide-option-card[data-option="none"],
            .slide-options-grid.edit-mode .slide-option-card[data-option="keep"],
            .slide-options-grid.edit-mode .slide-option-card[data-option="previous"],
            .slide-options-grid.edit-mode .slide-option-card[data-option="new"],
            .slide-options-grid.edit-mode .slide-option-card[data-option="none"] {
                grid-area: unset;
            }

            .hadirin-slide-settings-container {
                padding: 0 15px;
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

            .slide-previous-select {
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

            .slide-preview-grid {
                grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
                gap: 0.6rem;
            }
        }
    </style>
</head>
<body>
    <div class="hadirin-slide-settings-container">
        <div class="hadirin-section-header">
            <div class="hadirin-section-icon">
                <i class="fas fa-images"></i>
            </div>
            <h3 class="hadirin-section-title">Pengaturan Slide Foto</h3>
        </div>

        @php
            $hasExistingSlides = isset($isEdit) && $isEdit && isset($presence) && $presence->slides->count() > 0;
            $isEditMode = isset($isEdit) && $isEdit; // Deteksi mode edit dari PHP

            // Penentuan currentSlideOption yang diperbaiki
            $currentSlideOption = null;

            if ($isEditMode) {
                $currentSlideOption = $presence->slide_option_type ?? null;
                if (!$currentSlideOption && $hasExistingSlides) {
                    $currentSlideOption = 'keep';
                } elseif (!$currentSlideOption && !$hasExistingSlides) {
                    $currentSlideOption = 'none'; // Default jika edit tapi tidak ada slide
                }
            } else {
                // Mode create - default ke 'new'
                $currentSlideOption = 'new';
            }

            // Tentukan kelas grid berdasarkan mode
            $gridClass = $isEditMode ? 'edit-mode' : 'create-mode';
        @endphp

        <div class="slide-options-grid {{ $gridClass }}">
            @if($isEditMode) {{-- Opsi 'keep' hanya muncul di mode edit --}}
                <div class="slide-option-card compact {{ $currentSlideOption == 'keep' ? 'selected' : '' }}" data-option="keep" id="slide-option-keep">
                    <input type="radio" name="slide_option" value="keep" id="slide_keep" {{ $currentSlideOption == 'keep' ? 'checked' : '' }}>
                    <div class="slide-option-content">
                        <div class="slide-option-icon keep">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="slide-option-text">
                            <h4 class="slide-option-title">Tetap gunakan slide saat ini</h4>
                            <p class="slide-option-description">{{ $hasExistingSlides ? $presence->slides->count() . ' foto akan tetap digunakan' : 'Tidak ada slide saat ini' }}</p>
                        </div>
                    </div>
                    <div class="slide-option-radio"></div>

                    {{-- Preview untuk opsi 'keep' --}}
                    @if($hasExistingSlides)
                        <div class="slide-preview-section" id="slide-keep-preview-section">
                            <div class="slide-preview-label">Preview slide saat ini:</div>
                            <div class="slide-preview-grid" id="slide-keep-preview-grid">
                                @foreach($presence->slides as $slide)
                                    <div class="slide-preview-item">
                                        <img src="{{ asset('uploads/' . $slide->image_path) }}" class="slide-preview-image" alt="Current slide preview">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @endif

            <div class="slide-option-card compact {{ $currentSlideOption == 'previous' ? 'selected' : '' }}" data-option="previous" id="slide-option-previous">
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

            <div class="slide-option-card compact {{ $currentSlideOption == 'new' ? 'selected' : '' }}" data-option="new" id="slide-option-new">
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

            <div class="slide-option-card compact {{ $currentSlideOption == 'none' ? 'selected' : '' }}" data-option="none" id="slide-option-none">
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

        {{-- Section untuk opsi 'previous' --}}
        <div class="slide-content-section {{ $currentSlideOption == 'previous' ? 'active' : '' }}" id="slide-previous-section">
            <h4 class="section-title">Pilih Kegiatan Sebelumnya</h4>
            <select class="slide-previous-select" name="previous_presence_id" id="slide_previous_presence_id">
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

            <div class="slide-preview-section" id="slide-previous-preview" style="display: none;">
                <div class="slide-preview-label">Preview slide yang akan digunakan:</div>
                <div class="slide-preview-grid" id="slide-previous-preview-grid"></div>
            </div>
        </div>

        {{-- Section untuk opsi 'new' (upload baru) --}}
        <div class="slide-content-section {{ $currentSlideOption == 'new' ? 'active' : '' }}" id="slide-upload-section">
            <h4 class="section-title">Upload Slide Foto (Maksimal 5 foto)</h4>

            <!-- Upload Area -->
            <div class="upload-area" id="upload-area">
                <div class="upload-icon">
                    <i class="fas fa-cloud-upload-alt"></i>
                </div>
                <div class="upload-title">Upload Slide Foto</div>
                <div class="upload-description">
                    Format: JPG, PNG, GIF. Disarankan rasio landscape 16:9 untuk hasil terbaik.<br>
                    Klik atau drag & drop file di sini.
                </div>
                <button type="button" class="upload-button" id="upload-trigger-button">
                    <i class="fas fa-plus"></i>
                    Pilih File
                </button>
            </div>

            <!-- Hidden File Input -->
            <input type="file"
                class="file-input"
                name="slide_images[]"
                id="slide_images"
                multiple
                accept="image/jpeg,image/jpg,image/png,image/gif,image/webp"
                max="5"
                style="display: none;">

            <!-- Preview Section (akan disembunyikan di mode create oleh JS) -->
            <div class="slide-preview-section" id="slide-upload-preview">
                <div class="slide-preview-label">Preview gambar yang akan diupload:</div>
                <div class="slide-preview-grid" id="slide-upload-preview-grid"></div>

                <!-- File Info -->
                <div id="file-info" style="margin-top: 1rem; font-size: 0.9rem; color: #666;">
                    <!-- File information will be displayed here -->
                </div>

                <!-- Clear Files Button -->
                <button type="button" id="clear-files-btn" class="upload-button" style="background: #dc3545; margin-top: 1rem; display: none;">
                    <i class="fas fa-trash"></i>
                    Hapus Semua File
                </button>
            </div>

        </div>
    </div>

    {{-- Custom Modal for Alerts (Pastikan ini ada di satu tempat saja, misal di layout utama atau di display-settings) --}}
    {{-- Jika Anda sudah memiliki modal ini di display-settings.blade.php, Anda bisa menghapusnya dari sini. --}}
    <div class="slide-custom-modal-overlay" id="slideCustomAlertModal">
        <div class="slide-custom-modal-content">
            <h4 id="slideModalTitle">Peringatan!</h4>
            <p id="slideModalMessage"></p>
            <button id="slideModalCloseButton">Oke</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- Elemen DOM Umum ---
            const slideOptions = document.querySelectorAll('.slide-option-card');
            const radioInputs = document.querySelectorAll('input[name="slide_option"]');
            const contentSections = document.querySelectorAll('.slide-content-section');
            const keepPreviewSection = document.getElementById('slide-keep-preview-section');

            // --- Elemen Modal Alert Kustom ---
            const customAlertModal = document.getElementById('slideCustomAlertModal');
            const modalTitle = document.getElementById('slideModalTitle');
            const modalMessage = document.getElementById('slideModalMessage');
            const modalCloseButton = document.getElementById('slideModalCloseButton');

            // Fungsi untuk menampilkan alert kustom
            function showCustomAlert(message, title = 'Peringatan!') {
                if (modalTitle && modalMessage && customAlertModal) {
                    modalTitle.textContent = title;
                    modalMessage.textContent = message;
                    customAlertModal.classList.add('active');
                }
            }

            // Fungsi untuk menyembunyikan alert kustom
            function hideCustomAlert() {
                if (customAlertModal) {
                    customAlertModal.classList.remove('active');
                }
            }

            // Event listener untuk tombol tutup modal
            if (modalCloseButton) {
                modalCloseButton.addEventListener('click', hideCustomAlert);
            }

            // Event listener untuk klik di luar modal (overlay)
            if (customAlertModal) {
                customAlertModal.addEventListener('click', function(event) {
                    if (event.target === customAlertModal) {
                        hideCustomAlert();
                    }
                });
            }

            // --- Inisialisasi Pilihan Slide ---
            updateSelectedOption();
            showContentSection(getSelectedOption());

            // Event listener untuk klik pada kartu opsi slide
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

            // Event listener untuk perubahan pada radio button (jika diklik langsung)
            radioInputs.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.checked) {
                        updateSelectedOption();
                        showContentSection(this.value);
                    }
                });
            });

            // Mendapatkan opsi slide yang sedang dipilih
            function getSelectedOption() {
                return document.querySelector('input[name="slide_option"]:checked')?.value || 'none';
            }

            // Memperbarui kelas 'selected' pada kartu opsi
            function updateSelectedOption() {
                const selectedValue = getSelectedOption();
                slideOptions.forEach(card => {
                    card.classList.toggle('selected', card.dataset.option === selectedValue);
                });
            }

            // Menampilkan atau menyembunyikan bagian konten slide yang relevan
            function showContentSection(option) {
                contentSections.forEach(section => {
                    section.classList.remove('active');
                });

                // Sembunyikan semua slide-preview-section secara default
                document.querySelectorAll('.slide-preview-section').forEach(section => {
                    section.style.display = 'none';
                });

                if (option === 'previous') {
                    document.getElementById('slide-previous-section')?.classList.add('active');
                    // Tampilkan preview previous hanya jika ada pilihan di select
                    const previousSelect = document.getElementById('slide_previous_presence_id');
                    if (previousSelect && previousSelect.value) {
                        document.getElementById('slide-previous-preview').style.display = 'block';
                    }
                } else if (option === 'new') {
                    document.getElementById('slide-upload-section')?.classList.add('active');
                    // Di mode 'new', preview hanya akan muncul di mode edit
                    // Logika tampilan preview di handleFiles() dan updatePreview()
                    const fileInput = document.getElementById('slide_images');
                    const uploadPreview = document.getElementById('slide-upload-preview');
                    const modeContainer = document.querySelector('.slide-options-grid');
                    const isEditMode = modeContainer ? modeContainer.classList.contains('edit-mode') : false;

                    if (isEditMode && fileInput && fileInput.files.length > 0 && uploadPreview) {
                        uploadPreview.style.display = 'block';
                    } else if (uploadPreview) {
                        uploadPreview.style.display = 'none'; // Sembunyikan di mode create
                    }

                } else if (option === 'keep') {
                    if (keepPreviewSection) {
                        keepPreviewSection.style.display = 'block';
                    }
                }
            }

            // --- Penanganan Upload File (Inti Perbaikan) ---
            const fileInput = document.getElementById('slide_images');
            const uploadArea = document.getElementById('upload-area');
            const uploadButton = document.getElementById('upload-trigger-button');
            const uploadPreview = document.getElementById('slide-upload-preview');
            const uploadPreviewGrid = document.getElementById('slide-upload-preview-grid');
            const fileInfo = document.getElementById('file-info');
            const clearFilesBtn = document.getElementById('clear-files-btn');

            // Deteksi mode edit/create dari kelas CSS pada kontainer utama
            const modeContainer = document.querySelector('.slide-options-grid');
            // Pastikan elemen ditemukan sebelum mengakses classList
            const isEditMode = modeContainer ? modeContainer.classList.contains('edit-mode') : false;

            // Variabel untuk melacak file yang dipilih
            let selectedFiles = [];

            // Fungsi untuk mengosongkan semua file yang dipilih dan mereset UI
            function clearAllFiles() {
                selectedFiles = [];
                fileInput.value = ''; // Mengosongkan input file

                if (uploadPreviewGrid) {
                    uploadPreviewGrid.innerHTML = ''; // Hapus semua pratinjau
                }

                if (uploadPreview) {
                    uploadPreview.style.display = 'none'; // Sembunyikan bagian pratinjau
                }

                if (clearFilesBtn) {
                    clearFilesBtn.style.display = 'none'; // Sembunyikan tombol hapus semua
                }

                if (uploadButton) {
                    uploadButton.innerHTML = `<i class="fas fa-plus"></i> Pilih File`; // Reset teks tombol
                }

                if (fileInfo) {
                    fileInfo.innerHTML = ''; // Kosongkan info file
                }

                console.log('All files cleared');
            }

            // Memperbarui tampilan informasi file (jumlah & total ukuran)
            function updateFileInfo() {
                if (!fileInfo) return;

                if (selectedFiles.length === 0) {
                    fileInfo.innerHTML = '';
                    return;
                }

                const totalSize = selectedFiles.reduce((sum, file) => sum + file.size, 0);
                const sizeText = formatFileSize(totalSize);

                fileInfo.innerHTML = `
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span><strong>${selectedFiles.length}</strong> file(s) dipilih - Total: <strong>${sizeText}</strong></span>
                    </div>
                `;
            }

            // Fungsi pembantu untuk memformat ukuran file
            function formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }

            // Fungsi untuk memvalidasi satu file
            function validateFile(file) {
                const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
                const maxSize = 2 * 1024 * 1024; // 2MB

                if (!allowedTypes.includes(file.type)) {
                    return `File ${file.name} bukan format gambar yang didukung.`;
                }

                if (file.size > maxSize) {
                    return `File ${file.name} terlalu besar. Maksimal 2MB.`;
                }

                return null; // File valid
            }

            // Fungsi utama untuk menangani file yang dipilih (baik dari input atau drag & drop)
            function handleFiles(files) {
                console.log('Handling files:', files.length);

                if (!files || files.length === 0) {
                    clearAllFiles();
                    return;
                }

                // Kosongkan file sebelumnya saat ada file baru yang dipilih
                selectedFiles = [];

                // Validasi dan tambahkan file (maksimal 5)
                const filesToProcess = Array.from(files).slice(0, 5);
                const validFiles = [];
                const errors = [];

                filesToProcess.forEach(file => {
                    const error = validateFile(file);
                    if (error) {
                        errors.push(error);
                    } else {
                        validFiles.push(file);
                    }
                });

                // Tampilkan error jika ada
                if (errors.length > 0) {
                    showCustomAlert(errors.join('\n'));
                }

                if (validFiles.length === 0) {
                    clearAllFiles();
                    return;
                }

                selectedFiles = validFiles;

                // Perbarui input file menggunakan DataTransfer agar file yang valid saja yang terkirim
                const dt = new DataTransfer();
                validFiles.forEach(file => dt.items.add(file));
                fileInput.files = dt.files;

                // Perbarui UI
                updateFileInfo(); // Selalu perbarui info file
                updatePreview(); // Perbarui pratinjau berdasarkan mode

                if (uploadButton) {
                    uploadButton.innerHTML = `<i class="fas fa-check"></i> ${validFiles.length} file${validFiles.length > 1 ? 's' : ''} dipilih`;
                }

                if (clearFilesBtn) {
                    clearFilesBtn.style.display = 'inline-flex'; // Tampilkan tombol hapus semua
                }

                console.log('Files processed:', validFiles.length);
            }

            // Fungsi untuk memperbarui tampilan pratinjau gambar
            function updatePreview() {
                if (!uploadPreviewGrid) return;

                uploadPreviewGrid.innerHTML = ''; // Kosongkan pratinjau yang ada

                if (selectedFiles.length === 0) {
                    if (uploadPreview) {
                        uploadPreview.style.display = 'none';
                    }
                    return;
                }

                // Logika tampilan pratinjau berdasarkan mode (create/edit)
                if (!isEditMode) {
                    // Jika di mode CREATE, JANGAN tampilkan pratinjau
                    if (uploadPreview) {
                        uploadPreview.style.display = 'none';
                    }
                    return; // Hentikan eksekusi fungsi
                }

                // Jika di mode EDIT, tampilkan pratinjau (TANPA tombol 'x')
                selectedFiles.forEach((file) => {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const previewItem = document.createElement('div');
                        previewItem.className = 'slide-preview-item';
                        previewItem.style.position = 'relative'; // Diperlukan untuk positioning jika ada elemen lain

                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'slide-preview-image';
                        img.alt = file.name;

                        previewItem.appendChild(img);
                        uploadPreviewGrid.appendChild(previewItem);
                    };

                    reader.onerror = function() {
                        console.error('Failed to read file:', file.name);
                    };

                    reader.readAsDataURL(file);
                });

                // Tampilkan kontainer pratinjau jika ada file di mode edit
                if (uploadPreview) {
                    uploadPreview.style.display = 'block';
                }
            }

            // --- Event Listeners ---

            // Event listener untuk perubahan pada input file
            fileInput.addEventListener('change', (e) => {
                handleFiles(e.target.files);
            });

            // Event listener untuk klik pada tombol "Pilih File"
            if (uploadButton) {
                uploadButton.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation(); // Mencegah event bubbling ke uploadArea
                    fileInput.click(); // Memicu klik pada input file tersembunyi
                });
            }

            // Event listener untuk klik pada area upload (selain tombol)
            uploadArea.addEventListener('click', (e) => {
                // Hanya picu klik input file jika yang diklik bukan tombol upload atau tombol clear
                if (!e.target.closest('.upload-button') && !e.target.closest('#clear-files-btn')) {
                    fileInput.click();
                }
            });

            // Event listener untuk tombol "Hapus Semua File"
            if (clearFilesBtn) {
                clearFilesBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    clearAllFiles();
                });
            }

            // --- Drag and Drop Event Listeners ---
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                uploadArea.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                });
            });

            ['dragenter', 'dragover'].forEach(eventName => {
                uploadArea.addEventListener(eventName, () => {
                    uploadArea.classList.add('dragover');
                });
            });

            ['dragleave', 'drop'].forEach(eventName => {
                uploadArea.addEventListener(eventName, () => {
                    uploadArea.classList.remove('dragover');
                });
            });

            uploadArea.addEventListener('drop', (e) => {
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    handleFiles(files);
                }
            });

            console.log('File upload initialized');

            // --- Penanganan Pratinjau Slide dari Kegiatan Sebelumnya ---
            const previousSelect = document.getElementById('slide_previous_presence_id');
            const previousPreview = document.getElementById('slide-previous-preview');
            const previousPreviewGrid = document.getElementById('slide-previous-preview-grid');

            if (previousSelect) {
                previousSelect.addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    const slidesData = selectedOption.getAttribute('data-slides');

                    if (previousPreviewGrid) {
                        previousPreviewGrid.innerHTML = ''; // Kosongkan pratinjau yang ada
                    }

                    if (slidesData && slidesData !== '[]' && this.value) {
                        try {
                            const slides = JSON.parse(slidesData);

                            slides.forEach((slide) => {
                                const previewItem = document.createElement('div');
                                previewItem.className = 'slide-preview-item';

                                const img = document.createElement('img');
                                img.src = `/uploads/${slide.image_path}`; // Pastikan path benar
                                img.className = 'slide-preview-image';
                                img.alt = 'Slide preview';

                                previewItem.appendChild(img);
                                if (previousPreviewGrid) {
                                    previousPreviewGrid.appendChild(previewItem);
                                }
                            });

                            if (previousPreview) {
                                previousPreview.style.display = 'block';
                            }
                        } catch (error) {
                            console.error('Error parsing slides data:', error);
                            if (previousPreview) {
                                previousPreview.style.display = 'none';
                            }
                        }
                    } else {
                        if (previousPreview) {
                            previousPreview.style.display = 'none';
                        }
                    }
                });
            }

            // Pemicu perubahan awal untuk pratinjau slide sebelumnya jika sudah dipilih
            const initialSelectedOption = getSelectedOption();
            if (initialSelectedOption === 'previous' && previousSelect && previousSelect.value) {
                const event = new Event('change');
                previousSelect.dispatchEvent(event);
            }

            // --- Fungsi Validasi Global (untuk form submission) ---
            window.validateSlideSettings = function() {
                const selectedOption = document.querySelector('input[name="slide_option"]:checked')?.value;
                console.log('Validating slide option:', selectedOption);

                if (selectedOption === 'previous') {
                    const previousSelect = document.getElementById('slide_previous_presence_id');
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

                    // Validasi setiap file yang dipilih
                    const files = Array.from(fileInput.files);
                    for (let file of files) {
                        const error = validateFile(file); // Gunakan fungsi validateFile yang sudah ada
                        if (error) {
                            showCustomAlert(error);
                            return false;
                        }
                    }
                    console.log('Valid files found:', files.length);
                }
                return true;
            };

            // --- Debugging Helper (Opsional, bisa dihapus di produksi) ---
            window.debugSlideSettings = function() {
                const selectedOption = getSelectedOption();
                const fileInput = document.getElementById('slide_images');

                console.log('=== SLIDE SETTINGS DEBUG ===');
                console.log('Selected option:', selectedOption);
                console.log('File input element:', fileInput);
                console.log('Files in input:', fileInput?.files?.length || 0);
                console.log('Upload preview visible:', uploadPreview?.style.display !== 'none');
                console.log('Preview grid children:', uploadPreviewGrid?.children?.length || 0);

                if (fileInput && fileInput.files) {
                    Array.from(fileInput.files).forEach((file, index) => {
                        console.log(`File ${index}:`, file.name, file.type, file.size);
                    });
                }
                console.log('=== END DEBUG ===');
            };

            // Panggil inisialisasi upload file setelah DOM dimuat
            // Ini akan menangani tampilan awal jika ada file yang sudah ada (misal di mode edit)
            if (fileInput && uploadArea) {
                // Simulasikan event change jika ada file yang sudah ada saat halaman dimuat (misal dari backend di mode edit)
                // Ini penting agar preview tampil jika ada existing files
                if (fileInput.files && fileInput.files.length > 0) {
                    handleFiles(fileInput.files);
                } else {
                    // Pastikan preview tersembunyi jika tidak ada file saat inisialisasi
                    if (uploadPreview) {
                        uploadPreview.style.display = 'none';
                    }
                }
            }
        });
    </script>
</body>
</html>
