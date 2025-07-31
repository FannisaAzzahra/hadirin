{{-- Display Settings Partial --}}
<style>
    /* Display Settings Styles */
    .hadirin-display-settings-container {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin-bottom: 2rem;
    }

    .display-options-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
        margin-bottom: 2.5rem;
    }

    .display-options-grid.create-mode {
        grid-template-areas: "previous manual";
    }
    .display-options-grid.create-mode .display-option-card[data-option="previous"] { grid-area: previous; }
    .display-options-grid.create-mode .display-option-card[data-option="manual"] { grid-area: manual; }

    .display-options-grid.edit-mode {
        grid-template-areas: "keep previous" "manual manual";
    }
    .display-options-grid.edit-mode .display-option-card[data-option="keep"] { grid-area: keep; }
    .display-options-grid.edit-mode .display-option-card[data-option="previous"] { grid-area: previous; }
    .display-options-grid.edit-mode .display-option-card[data-option="manual"] { grid-area: manual; }

    .display-option-card {
        background: white;
        border: 2px solid #a8dadc;
        border-radius: 12px;
        padding: 1rem; /* Disesuaikan agar lebih ringkas */
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        min-height: 90px; /* Disesuaikan agar lebih ringkas */
        display: flex;
        flex-direction: column;
        justify-content: center;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .display-option-card:hover {
        border-color: #00b4d8;
        box-shadow: 0 4px 15px rgba(0, 180, 216, 0.15);
        transform: translateY(-3px);
    }

    .display-option-card.selected {
        border-color: #00b4d8;
        background: rgba(0, 180, 216, 0.08);
        box-shadow: 0 4px 15px rgba(0, 180, 216, 0.25);
        transform: translateY(0);
    }

    .display-option-content {
        display: flex;
        align-items: center; /* Disesuaikan dari flex-start */
        gap: 0.8rem; /* Disesuaikan dari 1rem */
        margin-bottom: 0.8rem;
    }

    .display-option-icon {
        width: 38px; /* Disesuaikan dari 44px */
        height: 38px; /* Disesuaikan dari 44px */
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem; /* Disesuaikan dari 1.1rem */
        flex-shrink: 0;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .display-option-icon.previous {
        background: rgba(0, 180, 216, 0.15);
        color: #00b4d8;
    }

    .display-option-icon.manual {
        background: rgba(156, 39, 176, 0.15);
        color: #9c27b0;
    }

    .display-option-icon.keep {
        background: rgba(34, 168, 53, 0.15);
        color: #22a835;
    }

    .display-option-text {
        flex: 1;
    }

    .display-option-title {
        font-size: 1rem; /* Disesuaikan dari 1.1rem */
        font-weight: 600;
        color: #0077b6;
        margin: 0 0 0.2rem 0; /* Disesuaikan dari 0.3rem */
    }

    .display-option-description {
        font-size: 0.85rem; /* Disesuaikan dari 0.95rem */
        color: #5f6368;
        margin: 0;
        line-height: 1.4;
    }

    .display-option-radio {
        position: absolute;
        top: 0.8rem; /* Disesuaikan dari 1rem */
        right: 0.8rem; /* Disesuaikan dari 1rem */
        width: 18px; /* Disesuaikan */
        height: 18px; /* Disesuaikan */
        border: 2px solid #dadce0;
        border-radius: 50%;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }

    .display-option-card.selected .display-option-radio {
        border-color: #00b4d8;
        background: #00b4d8;
    }

    .display-option-card.selected .display-option-radio::after {
        content: '';
        width: 7px; /* Disesuaikan dari 8px */
        height: 7px; /* Disesuaikan dari 8px */
        background: white;
        border-radius: 50%;
    }

    .display-option-card input[type="radio"] {
        display: none;
    }

    .display-content-section {
        background: #f8f9fa;
        border-radius: 12px;
        border: 1px solid #e8eaed;
        padding: 1.5rem;
        display: none;
        margin-top: 1.5rem;
        box-shadow: inset 0 1px 5px rgba(0, 0, 0, 0.03);
    }

    .display-content-section.active {
        display: block;
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .display-section-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #0077b6;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid rgba(0, 180, 216, 0.1);
    }

    .previous-select {
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

    .previous-select:focus {
        outline: none;
        border-color: #00b4d8;
        box-shadow: 0 0 0 0.2rem rgba(0, 180, 216, 0.18);
    }

    .form-grid {
        display: grid;
        gap: 1.5rem;
    }

    .form-row {
        display: grid;
        gap: 1rem;
    }

    .form-row.single {
        grid-template-columns: 1fr;
    }

    .form-row.triple {
        grid-template-columns: repeat(3, 1fr);
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .file-upload {
        position: relative;
    }

    .file-upload input[type="file"] {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

    .file-upload-label {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.9rem 1.1rem;
        border: 2px dashed #a8dadc;
        border-radius: 12px;
        background: white;
        color: #5f6368;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 1rem;
        font-weight: 500;
    }

    .file-upload-label:hover {
        border-color: #00b4d8;
        color: #00b4d8;
        background: rgba(0, 180, 216, 0.05);
    }

    .form-helper {
        font-size: 0.85rem;
        color: #70757a;
        margin-top: 0.3rem;
    }

    .preview-section {
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid #e8eaed;
        display: none;
    }

    .preview-section.active {
        display: block;
    }

    .preview-label {
        font-size: 0.95rem;
        color: #5f6368;
        margin-bottom: 0.8rem;
        font-weight: 500;
    }

    .preview-content {
        background: white;
        border: 1px solid #e8eaed;
        border-radius: 10px;
        padding: 1.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .preview-item {
        margin-bottom: 1rem;
    }

    .preview-item:last-child {
        margin-bottom: 0;
    }

    .preview-item-label {
        font-size: 0.9rem;
        font-weight: 600;
        color: #0077b6;
        margin-bottom: 0.3rem;
    }

    .preview-item-value {
        font-size: 0.95rem;
        color: #3c4043;
        background: #f8f9fa;
        padding: 0.5rem 0.8rem;
        border-radius: 6px;
        border: 1px solid #e8eaed;
    }

    .preview-logos {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        margin-top: 1rem;
    }

    .preview-logo-item {
        text-align: center;
    }

    .preview-logo-image {
        width: 60px;
        height: 60px;
        object-fit: contain;
        border: 1px solid #e8eaed;
        border-radius: 8px;
        background: white;
        margin-bottom: 0.5rem;
    }

    .preview-logo-label {
        font-size: 0.8rem;
        color: #70757a;
    }

    .hadirin-img-preview {
        width: 60px;
        height: 60px;
        object-fit: contain;
        border: 1px solid #e8eaed;
        border-radius: 8px;
        background: white;
    }

    /* Custom Modal */
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
        .display-options-grid,
        .display-options-grid.create-mode,
        .display-options-grid.edit-mode {
            grid-template-columns: 1fr;
            grid-template-areas: unset;
        }

        .display-options-grid.create-mode .display-option-card[data-option="previous"],
        .display-options-grid.create-mode .display-option-card[data-option="manual"],
        .display-options-grid.edit-mode .display-option-card[data-option="keep"],
        .display-options-grid.edit-mode .display-option-card[data-option="previous"],
        .display-options-grid.edit-mode .display-option-card[data-option="manual"] {
            grid-area: unset;
        }

        .hadirin-display-settings-container {
            padding: 0 15px;
        }

        .display-option-card {
            padding: 0.8rem; /* Disesuaikan agar lebih ringkas di mobile */
            min-height: 80px; /* Disesuaikan agar lebih ringkas di mobile */
        }

        .display-option-icon {
            width: 34px; /* Disesuaikan untuk mobile */
            height: 34px; /* Disesuaikan untuk mobile */
            font-size: 0.9rem; /* Disesuaikan untuk mobile */
        }

        .display-option-title {
            font-size: 0.95rem; /* Disesuaikan untuk mobile */
        }

        .display-option-description {
            font-size: 0.8rem; /* Disesuaikan untuk mobile */
        }

        .display-option-radio {
            top: 0.6rem; /* Disesuaikan untuk mobile */
            right: 0.6rem; /* Disesuaikan untuk mobile */
            width: 16px; /* Disesuaikan untuk mobile */
            height: 16px; /* Disesuaikan untuk mobile */
        }
        .display-option-card.selected .display-option-radio::after {
            width: 6px; /* Disesuaikan untuk mobile */
            height: 6px; /* Disesuaikan untuk mobile */
        }
    }
</style>

<div class="hadirin-display-settings-container">
    <div class="hadirin-section-header">
        <div class="hadirin-section-icon">
            <i class="fas fa-palette"></i>
        </div>
        <h3 class="hadirin-section-title">Pengaturan Tampilan</h3>
    </div>

    @php
        $isEditMode = isset($isEdit) && $isEdit;
        $hasExistingDisplay = $isEditMode && (
            !empty($presence->judul_header_atas) || 
            !empty($presence->judul_header_bawah) || 
            !empty($presence->logo_kiri) || 
            !empty($presence->logo_kanan) || 
            !empty($presence->logo_ig) || 
            !empty($presence->link_ig)
        );

        // Tentukan opsi default
        $currentDisplayOption = null;
        if ($isEditMode) {
            $currentDisplayOption = $presence->display_option_type ?? ($hasExistingDisplay ? 'keep' : 'manual');
        } else {
            $currentDisplayOption = 'manual';
        }

        $gridClass = $isEditMode ? 'edit-mode' : 'create-mode';
    @endphp

    <div class="display-options-grid {{ $gridClass }}">
        @if($isEditMode)
            <div class="display-option-card {{ $currentDisplayOption == 'keep' ? 'selected' : '' }}" data-option="keep" id="display-option-keep">
                <input type="radio" name="display_option" value="keep" id="display_keep" {{ $currentDisplayOption == 'keep' ? 'checked' : '' }}>
                <div class="display-option-content">
                    <div class="display-option-icon keep">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="display-option-text">
                        <h4 class="display-option-title">Tetap gunakan pengaturan saat ini</h4>
                        <p class="display-option-description">Gunakan pengaturan tampilan yang sudah ada</p>
                    </div>
                </div>
                <div class="display-option-radio"></div>

                @if($hasExistingDisplay)
                    <div class="preview-section" id="display-keep-preview-section">
                        <div class="preview-label">Preview pengaturan saat ini:</div>
                        <div class="preview-content">
                            @if($presence->judul_header_atas)
                                <div class="preview-item">
                                    <div class="preview-item-label">Judul Header Atas:</div>
                                    <div class="preview-item-value">{{ $presence->judul_header_atas }}</div>
                                </div>
                            @endif
                            @if($presence->judul_header_bawah)
                                <div class="preview-item">
                                    <div class="preview-item-label">Judul Header Bawah:</div>
                                    <div class="preview-item-value">{{ $presence->judul_header_bawah }}</div>
                                </div>
                            @endif
                            @if($presence->link_ig)
                                <div class="preview-item">
                                    <div class="preview-item-label">Username Instagram:</div>
                                    <div class="preview-item-value">{{ str_replace('https://instagram.com/', '', $presence->link_ig) }}</div>
                                </div>
                            @endif
                            @if($presence->logo_kiri || $presence->logo_kanan || $presence->logo_ig)
                                <div class="preview-logos">
                                    @if($presence->logo_kiri)
                                        <div class="preview-logo-item">
                                            <img src="/uploads/{{ $presence->logo_kiri }}" class="preview-logo-image" alt="Logo Kiri">
                                            <div class="preview-logo-label">Logo Kiri</div>
                                        </div>
                                    @endif
                                    @if($presence->logo_kanan)
                                        <div class="preview-logo-item">
                                            <img src="/uploads/{{ $presence->logo_kanan }}" class="preview-logo-image" alt="Logo Kanan">
                                            <div class="preview-logo-label">Logo Kanan</div>
                                        </div>
                                    @endif
                                    @if($presence->logo_ig)
                                        <div class="preview-logo-item">
                                            <img src="/uploads/{{ $presence->logo_ig }}" class="preview-logo-image" alt="Logo Instagram">
                                            <div class="preview-logo-label">Logo Instagram</div>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        @endif

        <div class="display-option-card {{ $currentDisplayOption == 'previous' ? 'selected' : '' }}" data-option="previous" id="display-option-previous">
            <input type="radio" name="display_option" value="previous" id="display_previous" {{ $currentDisplayOption == 'previous' ? 'checked' : '' }}>
            <div class="display-option-content">
                <div class="display-option-icon previous">
                    <i class="fas fa-history"></i>
                </div>
                <div class="display-option-text">
                    <h4 class="display-option-title">Gunakan pengaturan dari kegiatan lain</h4>
                    <p class="display-option-description">Pilih dari kegiatan sebelumnya</p>
                </div>
            </div>
            <div class="display-option-radio"></div>
        </div>

        <div class="display-option-card {{ $currentDisplayOption == 'manual' ? 'selected' : '' }}" data-option="manual" id="display-option-manual">
            <input type="radio" name="display_option" value="manual" id="display_manual" {{ $currentDisplayOption == 'manual' ? 'checked' : '' }}>
            <div class="display-option-content">
                <div class="display-option-icon manual">
                    <i class="fas fa-edit"></i>
                </div>
                <div class="display-option-text">
                    <h4 class="display-option-title">Atur pengaturan secara manual</h4>
                    <p class="display-option-description">Isi form pengaturan tampilan</p>
                </div>
            </div>
            <div class="display-option-radio"></div>
        </div>
    </div>

    <!-- Previous Settings Section -->
    <div class="display-content-section {{ $currentDisplayOption == 'previous' ? 'active' : '' }}" id="display-previous-section">
        <h4 class="display-section-title">Pilih Kegiatan Sebelumnya</h4>
        <select class="previous-select" name="previous_display_id" id="display_previous_id">
            <option value="">-- Pilih Kegiatan --</option>
            @if(isset($previousSlides))
                @foreach($previousSlides as $prevPresence)
                    <option value="{{ $prevPresence->id }}"
                            data-display='{
                                "judul_header_atas": "{{ $prevPresence->judul_header_atas ?? "" }}",
                                "judul_header_bawah": "{{ $prevPresence->judul_header_bawah ?? "" }}",
                                "logo_kiri": "{{ $prevPresence->logo_kiri ?? "" }}",
                                "logo_kanan": "{{ $prevPresence->logo_kanan ?? "" }}",
                                "logo_ig": "{{ $prevPresence->logo_ig ?? "" }}",
                                "link_ig": "{{ str_replace('https://instagram.com/', '', $prevPresence->link_ig ?? '') }}"
                            }'>
                        {{ $prevPresence->nama_kegiatan }} ({{ date('d/m/Y', strtotime($prevPresence->tgl_kegiatan)) }})
                    </option>
                @endforeach
            @endif
        </select>

        <div class="preview-section" id="display-previous-preview" style="display: none;">
            <div class="preview-label">Preview pengaturan yang akan digunakan:</div>
            <div class="preview-content" id="display-previous-preview-content">
                <!-- Content will be populated by JavaScript -->
            </div>
        </div>
    </div>

    <!-- Manual Settings Section -->
    <div class="display-content-section {{ $currentDisplayOption == 'manual' ? 'active' : '' }}" id="display-manual-section">
        <h4 class="display-section-title">Pengaturan Tampilan Manual</h4>
        
        <div class="form-grid">
            <div class="form-row single">
                <div class="form-group">
                    <label for="judul_header_atas" class="hadirin-label">
                        Judul Header Atas
                    </label>
                    <input type="text"
                        class="hadirin-input"
                        name="judul_header_atas"
                        id="judul_header_atas"
                        value="{{ old('judul_header_atas', isset($presence) ? $presence->judul_header_atas : '') }}"
                        placeholder="Masukkan judul kegiatan (kosongkan untuk default: ABSENSI ONLINE)">
                    <div class="form-helper">Baris pertama judul header yang akan tampil tebal</div>
                </div>
            </div>
           
            <div class="form-row single">
                <div class="form-group">
                    <label for="judul_header_bawah" class="hadirin-label">
                        Judul Header Bawah
                    </label>
                    <input type="text"
                        class="hadirin-input"
                        name="judul_header_bawah"
                        id="judul_header_bawah"
                        value="{{ old('judul_header_bawah', isset($presence) ? $presence->judul_header_bawah : '') }}"
                        placeholder="Masukkan teks tambahan untuk header">
                    <div class="form-helper">Baris kedua judul header yang akan tampil tidak tebal</div>
                </div>
            </div>

            <div class="form-row triple">
                <div class="form-group">
                    <label for="logo_kiri" class="hadirin-label">Logo Kiri</label>
                    <div class="file-upload">
                        <input type="file" name="logo_kiri" id="logo_kiri" accept="image/*">
                        <label for="logo_kiri" class="file-upload-label">
                            <i class="fas fa-cloud-upload-alt"></i>
                            Pilih File
                        </label>
                    </div>
                    <div class="form-helper">Format: JPG, PNG, GIF</div>
                    @if(isset($presence) && $presence->logo_kiri)
                        <div style="margin-top: 0.5rem;">
                            <img src="{{ asset('uploads/' . $presence->logo_kiri) }}" class="hadirin-img-preview">
                            <small style="display: block; color: #70757a; font-size: 0.8rem; margin-top: 0.2rem;">Logo saat ini</small>
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="logo_kanan" class="hadirin-label">Logo Kanan</label>
                    <div class="file-upload">
                        <input type="file" name="logo_kanan" id="logo_kanan" accept="image/*">
                        <label for="logo_kanan" class="file-upload-label">
                            <i class="fas fa-cloud-upload-alt"></i>
                            Pilih File
                        </label>
                    </div>
                    <div class="form-helper">Format: JPG, PNG, GIF</div>
                    @if(isset($presence) && $presence->logo_kanan)
                        <div style="margin-top: 0.5rem;">
                            <img src="{{ asset('uploads/' . $presence->logo_kanan) }}" class="hadirin-img-preview">
                            <small style="display: block; color: #70757a; font-size: 0.8rem; margin-top: 0.2rem;">Logo saat ini</small>
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="logo_ig" class="hadirin-label">Logo Instagram</label>
                    <div class="file-upload">
                        <input type="file" name="logo_ig" id="logo_ig" accept="image/*">
                        <label for="logo_ig" class="file-upload-label">
                            <i class="fas fa-cloud-upload-alt"></i>
                            Pilih File
                        </label>
                    </div>
                    <div class="form-helper">Format: JPG, PNG, GIF</div>
                    @if(isset($presence) && $presence->logo_ig)
                        <div style="margin-top: 0.5rem;">
                            <img src="{{ asset('uploads/' . $presence->logo_ig) }}" class="hadirin-img-preview">
                            <small style="display: block; color: #70757a; font-size: 0.8rem; margin-top: 0.2rem;">Logo saat ini</small>
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-row single">
                <div class="form-group">
                    <label for="link_ig" class="hadirin-label">Username Instagram</label>
                    <input type="text"
                           class="hadirin-input"
                           name="link_ig"
                           id="link_ig"
                           placeholder="misal: eltrafo"
                           value="{{ old('link_ig', isset($presence) ? str_replace('https://instagram.com/', '', $presence->link_ig) : '') }}">
                    <div class="form-helper">Username Instagram tanpa tanda @</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Custom Modal for Alerts --}}
<div class="custom-modal-overlay" id="displayCustomAlertModal">
    <div class="custom-modal-content">
        <h4 id="displayModalTitle">Peringatan!</h4>
        <p id="displayModalMessage"></p>
        <button id="displayModalCloseButton">Oke</button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Only initialize if display settings elements exist
        if (!document.querySelector('.hadirin-display-settings-container')) {
            return;
        }

        const displayOptions = document.querySelectorAll('.display-option-card');
        const radioInputs = document.querySelectorAll('input[name="display_option"]');
        const contentSections = document.querySelectorAll('.display-content-section');
        const keepPreviewSection = document.getElementById('display-keep-preview-section');

        // Custom Alert Modal Elements
        const customAlertModal = document.getElementById('displayCustomAlertModal');
        const modalTitle = document.getElementById('displayModalTitle');
        const modalMessage = document.getElementById('displayModalMessage');
        const modalCloseButton = document.getElementById('displayModalCloseButton');

        // Function to show custom alert
        function showCustomAlert(message, title = 'Peringatan!') {
            if (modalTitle && modalMessage && customAlertModal) {
                modalTitle.textContent = title;
                modalMessage.textContent = message;
                customAlertModal.classList.add('active');
            }
        }

        // Function to hide custom alert
        function hideCustomAlert() {
            if (customAlertModal) {
                customAlertModal.classList.remove('active');
            }
        }

        // Close modal on button click
        if (modalCloseButton) {
            modalCloseButton.addEventListener('click', hideCustomAlert);
        }

        // Close modal on overlay click
        if (customAlertModal) {
            customAlertModal.addEventListener('click', function(event) {
                if (event.target === customAlertModal) {
                    hideCustomAlert();
                }
            });
        }

        // Initialize
        updateSelectedOption();
        showContentSection(getSelectedOption());

        // Handle option card clicks
        displayOptions.forEach(card => {
            card.addEventListener('click', function() {
                const option = this.dataset.option;
                const radio = document.getElementById(`display_${option}`);

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
            const selectedRadio = document.querySelector('input[name="display_option"]:checked');
            return selectedRadio ? selectedRadio.value : 'manual';
        }

        function updateSelectedOption() {
            const selectedValue = getSelectedOption();

            displayOptions.forEach(card => {
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
                const previousSection = document.getElementById('display-previous-section');
                if (previousSection) {
                    previousSection.classList.add('active');
                }
                // Tampilkan preview previous hanya jika ada pilihan di select
                const previousSelect = document.getElementById('display_previous_id');
                const previousPreview = document.getElementById('display-previous-preview');
                if (previousSelect && previousSelect.value && previousPreview) {
                    previousPreview.style.display = 'block';
                }
            } else if (option === 'manual') {
                const manualSection = document.getElementById('display-manual-section');
                if (manualSection) {
                    manualSection.classList.add('active');
                }
            } else if (option === 'keep') {
                if (keepPreviewSection) {
                    keepPreviewSection.style.display = 'block';
                }
            }
        }

        // Previous display selection handling
        const previousSelect = document.getElementById('display_previous_id');
        const previousPreview = document.getElementById('display-previous-preview');
        const previousPreviewContent = document.getElementById('display-previous-preview-content');

        if (previousSelect && previousPreviewContent) {
            previousSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const displayData = selectedOption.getAttribute('data-display');

                previousPreviewContent.innerHTML = '';

                if (displayData && this.value) {
                    try {
                        const display = JSON.parse(displayData);
                        let previewHTML = '';

                        if (display.judul_header_atas) {
                            previewHTML += `
                                <div class="preview-item">
                                    <div class="preview-item-label">Judul Header Atas:</div>
                                    <div class="preview-item-value">${display.judul_header_atas}</div>
                                </div>
                            `;
                        }

                        if (display.judul_header_bawah) {
                            previewHTML += `
                                <div class="preview-item">
                                    <div class="preview-item-label">Judul Header Bawah:</div>
                                    <div class="preview-item-value">${display.judul_header_bawah}</div>
                                </div>
                            `;
                        }

                        if (display.link_ig) {
                            previewHTML += `
                                <div class="preview-item">
                                    <div class="preview-item-label">Username Instagram:</div>
                                    <div class="preview-item-value">${display.link_ig}</div>
                                </div>
                            `;
                        }

                        if (display.logo_kiri || display.logo_kanan || display.logo_ig) {
                            previewHTML += '<div class="preview-logos">';
                            
                            if (display.logo_kiri) {
                                previewHTML += `
                                    <div class="preview-logo-item">
                                        <img src="/uploads/${display.logo_kiri}" class="preview-logo-image" alt="Logo Kiri">
                                        <div class="preview-logo-label">Logo Kiri</div>
                                    </div>
                                `;
                            }

                            if (display.logo_kanan) {
                                previewHTML += `
                                    <div class="preview-logo-item">
                                        <img src="/uploads/${display.logo_kanan}" class="preview-logo-image" alt="Logo Kanan">
                                        <div class="preview-logo-label">Logo Kanan</div>
                                    </div>
                                `;
                            }

                            if (display.logo_ig) {
                                previewHTML += `
                                    <div class="preview-logo-item">
                                        <img src="/uploads/${display.logo_ig}" class="preview-logo-image" alt="Logo Instagram">
                                        <div class="preview-logo-label">Logo Instagram</div>
                                    </div>
                                `;
                            }

                            previewHTML += '</div>';
                        }

                        if (previewHTML) {
                            previousPreviewContent.innerHTML = previewHTML;
                            if (previousPreview) {
                                previousPreview.style.display = 'block';
                            }
                        } else {
                            previousPreviewContent.innerHTML = '<div class="preview-item"><div class="preview-item-value" style="color: #70757a; font-style: italic;">Tidak ada pengaturan tampilan pada kegiatan ini</div></div>';
                            if (previousPreview) {
                                previousPreview.style.display = 'block';
                            }
                        }

                    } catch (error) {
                        console.error('Error parsing display data:', error);
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

        // Initial check for previous display section visibility on page load
        const initialSelectedOption = getSelectedOption();
        if (initialSelectedOption === 'previous' && previousSelect && previousSelect.value) {
            const event = new Event('change');
            previousSelect.dispatchEvent(event);
        }

        // Make validation function available globally for form submission
        window.validateDisplaySettings = function() {
            const selectedOption = document.querySelector('input[name="display_option"]:checked')?.value;

            if (selectedOption === 'previous') {
                const previousSelect = document.getElementById('display_previous_id');
                if (!previousSelect || !previousSelect.value) {
                    showCustomAlert('Silakan pilih kegiatan sebelumnya untuk menggunakan pengaturan yang ada.');
                    return false;
                }
            }

            return true;
        };
    });
</script>
