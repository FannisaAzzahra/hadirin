<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Slide Foto</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* CSS Anda di sini */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Menyesuaikan lebar kontainer utama */
        .slide-settings-container {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;

        }

        .slide-settings-header {
            display: flex;
            align-items: center;
            margin-bottom: 25px; /* Lebih besar */
            gap: 15px; /* Jarak antar elemen */
            background-color: #e0f2f7;
            border-radius: 12px;
            padding: 15px 20px; /* Padding lebih besar */
        }

        .slide-settings-icon {
            width: 48px; /* Lebih besar */
            height: 48px; /* Lebih besar */
            background: linear-gradient(135deg, #4285f4, #34a853);
            border-radius: 12px; /* Lebih besar */
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 22px; /* Lebih besar */
        }

        .slide-settings-title {
            font-size: 20px; /* Lebih besar */
            font-weight: 600;
            color: #1a1a1a;
            margin: 0;
        }

        .slide-options-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px; /* Lebih besar */
            margin-bottom: 25px; /* Lebih besar */
        }

        .slide-options-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px; /* Lebih besar */
            grid-column: 1 / -1;
        }

        /* Layout for create mode - make "Tanpa slide foto" fill the right column */
        .slide-options-grid.create-mode {
            grid-template-areas:
                "keep previous"
                "upload none";
        }

        .slide-options-grid.create-mode .slide-option-card[data-option="keep"] {
            grid-area: keep;
        }

        .slide-options-grid.create-mode .slide-option-card[data-option="previous"] {
            grid-area: previous;
        }

        .slide-options-grid.create-mode .slide-option-card[data-option="new"] {
            grid-area: upload;
        }

        .slide-options-grid.create-mode .slide-option-card[data-option="none"] {
            grid-area: none;
        }

        /* For edit mode with existing slides */
        .slide-options-grid.edit-mode {
            grid-template-areas:
                "keep previous"
                "upload none";
        }

        .slide-options-grid.edit-mode .slide-option-card[data-option="keep"] {
            grid-area: keep;
        }

        .slide-options-grid.edit-mode .slide-option-card[data-option="previous"] {
            grid-area: previous;
        }

        .slide-options-grid.edit-mode .slide-option-card[data-option="new"] {
            grid-area: upload;
        }

        .slide-options-grid.edit-mode .slide-option-card[data-option="none"] {
            grid-area: none;
        }

        /* For create mode without existing slides - make "none" take the right side */
        .slide-options-grid.create-mode-no-keep {
            grid-template-areas:
                "previous none"
                "upload upload";
        }

        .slide-options-grid.create-mode-no-keep .slide-option-card[data-option="previous"] {
            grid-area: previous;
        }

        .slide-options-grid.create-mode-no-keep .slide-option-card[data-option="new"] {
            grid-area: upload;
        }

        .slide-options-grid.create-mode-no-keep .slide-option-card[data-option="none"] {
            grid-area: none;
        }

        /* NEW: For edit mode without existing slides - same layout as create-mode-no-keep */
        .slide-options-grid.edit-mode-no-keep {
            grid-template-areas:
                "previous none"
                "upload upload";
        }

        .slide-options-grid.edit-mode-no-keep .slide-option-card[data-option="previous"] {
            grid-area: previous;
        }

        .slide-options-grid.edit-mode-no-keep .slide-option-card[data-option="new"] {
            grid-area: upload;
        }

        .slide-options-grid.edit-mode-no-keep .slide-option-card[data-option="none"] {
            grid-area: none;
        }

        .slide-option-card {
            background: white;
            border: 1px solid #e8eaed;
            border-radius: 12px; /* Lebih besar */
            padding: 18px; /* Lebih besar */
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
            min-height: 120px; /* Lebih besar */
            display: flex;
            flex-direction: column; /* Mengubah ini untuk menampung pratinjau */
            justify-content: center;
        }

        .slide-option-card:hover {
            border-color: #4285f4;
            box-shadow: 0 2px 10px rgba(66, 133, 244, 0.1); /* Lebih jelas */
            transform: translateY(-2px); /* Efek hover lebih terasa */
        }

        .slide-option-card.selected {
            border-color: #4285f4;
            background: rgba(66, 133, 244, 0.05); /* Opasitas lebih besar */
            box-shadow: 0 2px 10px rgba(66, 133, 244, 0.15); /* Lebih jelas */
            transform: translateY(0);
        }

        .slide-option-content {
            display: flex;
            align-items: flex-start;
            gap: 15px; /* Lebih besar */
            margin-bottom: 10px; /* Tambahan margin untuk memisahkan dari pratinjau */
        }

        .slide-option-icon {
            width: 44px; /* Lebih besar */
            height: 44px; /* Lebih besar */
            border-radius: 10px; /* Lebih besar */
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px; /* Lebih besar */
            flex-shrink: 0;
        }

        .slide-option-icon.previous {
            background: rgba(66, 133, 244, 0.1); /* Opasitas lebih besar */
            color: #4285f4;
        }

        .slide-option-icon.upload {
            background: rgba(156, 39, 176, 0.1); /* Opasitas lebih besar */
            color: #9c27b0;
        }

        .slide-option-icon.keep {
            background: rgba(34, 168, 53, 0.1); /* Opasitas lebih besar */
            color: #22a835;
        }

        .slide-option-icon.none {
            background: rgba(117, 117, 117, 0.1); /* Opasitas lebih besar */
            color: #757575;
        }

        .slide-option-text {
            flex: 1;
        }

        .slide-option-title {
            font-size: 18px; /* Lebih besar */
            font-weight: 600;
            color: #1a1a1a;
            margin: 0 0 5px 0; /* Lebih besar */
        }

        .slide-option-description {
            font-size: 15px; /* Lebih besar */
            color: #70757a;
            margin: 0;
            line-height: 1.5; /* Ketinggian baris lebih nyaman */
        }

        .slide-option-radio {
            position: absolute;
            top: 18px; /* Lebih besar */
            right: 18px; /* Lebih besar */
            width: 20px; /* Lebih besar */
            height: 20px; /* Lebih besar */
            border: 2px solid #dadce0; /* Ketebalan border */
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .slide-option-card.selected .slide-option-radio {
            border-color: #4285f4;
            background: #4285f4;
        }

        .slide-option-card.selected .slide-option-radio::after {
            content: '';
            width: 8px; /* Lebih besar */
            height: 8px; /* Lebih besar */
            background: white;
            border-radius: 50%;
        }

        .slide-option-card input[type="radio"] {
            display: none;
        }

        /* Compact style for bottom row cards (disesuaikan dengan ukuran font keseluruhan) */
        .slide-option-card.compact {
            min-height: 90px; /* Lebih besar */
            padding: 15px; /* Lebih besar */
        }

        .slide-option-card.compact .slide-option-content {
            align-items: center;
            gap: 12px; /* Lebih besar */
        }

        .slide-option-card.compact .slide-option-icon {
            width: 38px; /* Lebih besar */
            height: 38px; /* Lebih besar */
            font-size: 18px; /* Lebih besar */
        }

        .slide-option-card.compact .slide-option-title {
            font-size: 16px; /* Lebih besar */
            margin-bottom: 3px; /* Lebih besar */
        }

        .slide-option-card.compact .slide-option-description {
            font-size: 14px; /* Lebih besar */
        }

        .slide-content-section {
            background: #f8f9fa;
            border-radius: 12px; /* Lebih besar */
            border: 1px solid #e8eaed;
            padding: 20px; /* Lebih besar */
            display: none;
            margin-top: 15px; /* Lebih besar */
        }

        .slide-content-section.active {
            display: block;
            animation: fadeIn 0.3s ease; /* Transisi sedikit lebih lambat */
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); } /* Efek animasi lebih terasa */
            to { opacity: 1; transform: translateY(0); }
        }

        .section-title {
            font-size: 18px; /* Lebih besar */
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 15px; /* Lebih besar */
        }

        .previous-select {
            width: 100%;
            padding: 12px; /* Lebih besar */
            border: 1px solid #dadce0;
            border-radius: 10px; /* Lebih besar */
            background: white;
            font-size: 14px; /* Lebih besar */
            color: #3c4043;
            transition: all 0.2s ease;
        }

        .previous-select:focus {
            outline: none;
            border-color: #4285f4;
            box-shadow: 0 0 0 3px rgba(66, 133, 244, 0.1); /* Lebih jelas */
        }

        .upload-area {
            border: 2px dashed #dadce0; /* Ketebalan border */
            border-radius: 12px; /* Lebih besar */
            padding: 30px 25px; /* Lebih besar */
            text-align: center;
            background: white;
            transition: all 0.2s ease;
            cursor: pointer;
            margin-bottom: 15px; /* Tambahkan margin di sini */
        }

        .upload-area:hover,
        .upload-area.dragover {
            border-color: #4285f4;
            background: rgba(66, 133, 244, 0.02); /* Opasitas lebih besar */
        }

        .upload-icon {
            width: 48px; /* Lebih besar */
            height: 48px; /* Lebih besar */
            margin: 0 auto 15px; /* Lebih besar */
            background: rgba(66, 133, 244, 0.1); /* Opasitas lebih besar */
            border-radius: 12px; /* Lebih besar */
            display: flex;
            align-items: center;
            justify-content: center;
            color: #4285f4;
            font-size: 22px; /* Lebih besar */
        }

        .upload-title {
            font-size: 16px; /* Lebih besar */
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 8px; /* Lebih besar */
        }

        .upload-description {
            font-size: 13px; /* Lebih besar */
            color: #70757a;
            margin-bottom: 15px; /* Lebih besar */
            line-height: 1.4;
        }

        .upload-button {
            background: #4285f4;
            color: white;
            border: none;
            padding: 10px 25px; /* Lebih besar */
            border-radius: 6px; /* Lebih besar */
            font-size: 14px; /* Lebih besar */
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px; /* Lebih besar */
        }

        .upload-button:hover {
            background: #3367d6;
            transform: translateY(-1px); /* Efek hover lebih terasa */
        }

        .file-input {
            display: none;
        }

        .preview-section {
            margin-top: 15px; /* Lebih besar */
            padding-top: 15px; /* Lebih besar */
            border-top: 1px solid #e8eaed;
            display: none; /* Default hidden */
        }

        .preview-section.active {
            display: block;
        }

        .preview-label {
            font-size: 15px; /* Lebih besar */
            color: #70757a;
            margin-bottom: 12px; /* Lebih besar */
            font-weight: 500;
        }

        .preview-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr)); /* Ukuran preview lebih besar */
            gap: 12px; /* Lebih besar */
        }

        .preview-item {
            position: relative;
            aspect-ratio: 16/9;
            border-radius: 10px; /* Lebih besar */
            overflow: hidden;
            border: 1px solid #e8eaed;
            background: #f8f9fa;
        }

        .preview-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
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


            .slide-settings-container {
                padding: 15px; /* Disesuaikan untuk mobile */
                margin: 10px; /* Disesuaikan untuk mobile */
                margin-left: 0;
                margin-right: 0;
                padding-left: 0;
                padding-right: 0;
                margin-top: 0;    
                margin-bottom: 0;
            }

            .slide-option-card {
                padding: 15px;
                min-height: 100px;
            }

            .slide-option-card.compact {
                min-height: 80px;
            }

            .slide-settings-icon {
                width: 40px;
                height: 40px;
                font-size: 20px;
            }

            .slide-settings-title {
                font-size: 18px;
            }

            .preview-grid {
                grid-template-columns: repeat(auto-fill, minmax(80px, 1fr)); /* Ukuran preview lebih kecil di mobile */
                gap: 8px; /* Jarak antar preview lebih kecil */
            }
        }
    </style>
</head>
<body>
    <div class="slide-settings-container">
        <div class="slide-settings-header">
            <div class="slide-settings-icon">
                <i class="fas fa-images"></i>
            </div>
            <h3 class="slide-settings-title">Pengaturan Slide Foto</h3>
        </div>

        @php
            // Anda perlu mendefinisikan variabel ini di controller atau tempat lain yang relevan
            // Contoh dummy data jika Anda menguji tanpa Laravel:
            // $isEdit = true;
            // $presence = (object)['slides' => collect([ (object)['image_path' => 'slide1.jpg'], (object)['image_path' => 'slide2.jpg'] ])];
            // $previousSlides = collect([ (object)['id' => 1, 'nama_kegiatan' => 'Kegiatan Lama A', 'tgl_kegiatan' => '2023-01-15', 'slides' => collect([(object)['image_path' => 'prev_slide1.jpg']])], (object)['id' => 2, 'nama_kegiatan' => 'Kegiatan Lama B', 'tgl_kegiatan' => '2023-02-20', 'slides' => collect([(object)['image_path' => 'prev_slide3.jpg'], (object)['image_path' => 'prev_slide4.jpg']])], ]);

            $hasExistingSlides = isset($isEdit) && $isEdit && isset($presence) && $presence->slides->count() > 0;
            $isEditMode = isset($isEdit) && $isEdit;

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
    <!-- Option: Keep Current Slides (Only for Edit with existing slides) -->
            <div class="slide-option-card compact selected" data-option="keep" id="option-keep">
                <input type="radio" name="slide_option" value="keep" id="slide_keep" checked>
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

    <!-- Option 1: Use Previous Slides -->
            <div class="slide-option-card compact {{ !$hasExistingSlides ? 'selected' : '' }}" data-option="previous" id="option-previous">
                <input type="radio" name="slide_option" value="previous" id="slide_previous" {{ !$hasExistingSlides ? 'checked' : '' }}>
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

    <!-- Option 2: Upload New Slides -->
            <div class="slide-option-card compact" data-option="new" id="option-new">
                <input type="radio" name="slide_option" value="new" id="slide_new">
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

    <!-- Option 3: No Slides -->
            <div class="slide-option-card compact" data-option="none" id="option-none">
                <input type="radio" name="slide_option" value="none" id="slide_none">
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

<!-- Previous Slides Selection -->
        <div class="slide-content-section {{ !$hasExistingSlides ? 'active' : '' }}" id="previous-section">
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

<!-- New Slides Upload -->
        <div class="slide-content-section" id="upload-section">
            <h4 class="section-title">Upload Slide Foto (Maksimal 5 foto)</h4>
            <div class="upload-area" onclick="document.getElementById('slide_images').click()">
                <div class="upload-icon">
                    <i class="fas fa-cloud-upload-alt"></i>
                </div>
                <div class="upload-title">Upload Slide Foto</div>
                <div class="upload-description">Format: JPG, PNG, GIF. Disarankan rasio landscape 16:9 untuk hasil terbaik.</div>
                <button type="button" class="upload-button">
                    <i class="fas fa-plus"></i>
                    Choose Files
                </button>
            </div>
            <input type="file" class="file-input" name="slide_images[]" id="slide_images" multiple accept="image/*" max="5">

            <div class="preview-section" id="upload-preview">
                <div class="preview-label">Preview gambar yang akan diupload:</div>
                <div class="preview-grid" id="upload-preview-grid"></div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slideOptions = document.querySelectorAll('.slide-option-card');
            const radioInputs = document.querySelectorAll('input[name="slide_option"]');
            const contentSections = document.querySelectorAll('.slide-content-section');
            const keepPreviewSection = document.getElementById('keep-preview-section'); // Ambil elemen pratinjau keep

            // Initialize
            updateSelectedOption();
            showContentSection(getSelectedOption());

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
                    if (document.getElementById('previous_presence_id').value) {
                        document.getElementById('previous-preview').style.display = 'block';
                    }
                } else if (option === 'new') {
                    document.getElementById('upload-section')?.classList.add('active');
                    // Tampilkan preview section untuk upload jika ada file yang dipilih atau jika section baru diaktifkan
                    if (document.getElementById('slide_images').files.length > 0 || !document.getElementById('upload-preview-grid').innerHTML.trim()) {
                         document.getElementById('upload-preview').style.display = 'block';
                    }
                } else if (option === 'keep') { // Tampilkan pratinjau "keep" jika opsi ini dipilih
                    if (keepPreviewSection) {
                        keepPreviewSection.style.display = 'block';
                    }
                }
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
                    document.querySelector('.upload-button').innerHTML = `<i class="fas fa-plus"></i> Choose Files`;
                    return;
                }

                const fileList = Array.from(files).slice(0, 5);
                uploadPreviewGrid.innerHTML = '';

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
            const initialSelectedOption = getSelectedOption();
            if (initialSelectedOption === 'previous' && previousSelect && previousSelect.value) {
                const event = new Event('change');
                previousSelect.dispatchEvent(event);
            } else if (initialSelectedOption === 'keep' && keepPreviewSection) {
                keepPreviewSection.style.display = 'block';
            }
        });

        // Validation function
        function validateSlideSettings() {
            const selectedOption = document.querySelector('input[name="slide_option"]:checked')?.value;

            if (selectedOption === 'previous') {
                const previousSelect = document.getElementById('previous_presence_id');
                if (!previousSelect || !previousSelect.value) {
                    alert('Silakan pilih kegiatan sebelumnya untuk menggunakan slide yang ada.');
                    return false;
                }
            } else if (selectedOption === 'new') {
                const fileInput = document.getElementById('slide_images');
                if (!fileInput || !fileInput.files || fileInput.files.length === 0) {
                    alert('Silakan pilih file gambar untuk slide baru.');
                    return false;
                }
            }

            return true;
        }
    </script>
</body>
</html>