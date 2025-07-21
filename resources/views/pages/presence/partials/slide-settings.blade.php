{{-- resources/views/pages/presence/partials/slide-settings.blade.php --}}

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .slide-settings-container {
        background: #ffffff;
        border-radius: 16px;
        padding: 32px;
        max-width: 900px;
        margin: 20px auto;
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .slide-settings-header {
        display: flex;
        align-items: center;
        margin-bottom: 32px;
        gap: 16px;
    }

    .slide-settings-icon {
        width: 56px;
        height: 56px;
        background: linear-gradient(135deg, #4285f4, #34a853);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
    }

    .slide-settings-title {
        font-size: 24px;
        font-weight: 600;
        color: #1a1a1a;
        margin: 0;
    }

    .slide-options-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-bottom: 32px;
    }

    .slide-option-card {
        background: white;
        border: 2px solid #e8eaed;
        border-radius: 16px;
        padding: 24px;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        min-height: 140px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .slide-option-card:hover {
        border-color: #4285f4;
        box-shadow: 0 4px 20px rgba(66, 133, 244, 0.15);
        transform: translateY(-2px);
    }

    .slide-option-card.selected {
        border-color: #4285f4;
        background: rgba(66, 133, 244, 0.06);
        box-shadow: 0 4px 20px rgba(66, 133, 244, 0.2);
        transform: translateY(-1px);
    }

    .slide-option-content {
        display: flex;
        align-items: flex-start;
        gap: 16px;
    }

    .slide-option-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    .slide-option-icon.previous {
        background: rgba(66, 133, 244, 0.1);
        color: #4285f4;
    }

    .slide-option-icon.upload {
        background: rgba(156, 39, 176, 0.1);
        color: #9c27b0;
    }

    .slide-option-icon.keep {
        background: rgba(34, 168, 53, 0.1);
        color: #22a835;
    }

    .slide-option-icon.none {
        background: rgba(117, 117, 117, 0.1);
        color: #757575;
    }

    .slide-option-text {
        flex: 1;
    }

    .slide-option-title {
        font-size: 18px;
        font-weight: 600;
        color: #1a1a1a;
        margin: 0 0 6px 0;
    }

    .slide-option-description {
        font-size: 15px;
        color: #70757a;
        margin: 0;
        line-height: 1.4;
    }

    .slide-option-radio {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 24px;
        height: 24px;
        border: 2px solid #dadce0;
        border-radius: 50%;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .slide-option-card.selected .slide-option-radio {
        border-color: #4285f4;
        background: #4285f4;
    }

    .slide-option-card.selected .slide-option-radio::after {
        content: '';
        width: 10px;
        height: 10px;
        background: white;
        border-radius: 50%;
    }

    .slide-option-card input[type="radio"] {
        display: none;
    }

    .slide-option-bottom {
        grid-column: 1 / -1;
    }

    .slide-option-card.bottom {
        min-height: auto;
        padding: 20px 24px;
    }

    .slide-option-card.bottom .slide-option-content {
        align-items: center;
    }

    .slide-content-section {
        background: #f8f9fa;
        border-radius: 16px;
        border: 1px solid #e8eaed;
        padding: 24px;
        display: none;
        margin-top: 16px;
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
        font-size: 18px;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 20px;
    }

    .previous-select {
        width: 100%;
        padding: 16px;
        border: 2px solid #dadce0;
        border-radius: 12px;
        background: white;
        font-size: 15px;
        color: #3c4043;
        transition: all 0.3s ease;
    }

    .previous-select:focus {
        outline: none;
        border-color: #4285f4;
        box-shadow: 0 0 0 4px rgba(66, 133, 244, 0.1);
    }

    .upload-area {
        border: 2px dashed #dadce0;
        border-radius: 16px;
        padding: 40px 32px;
        text-align: center;
        background: white;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .upload-area:hover,
    .upload-area.dragover {
        border-color: #4285f4;
        background: rgba(66, 133, 244, 0.04);
    }

    .upload-icon {
        width: 56px;
        height: 56px;
        margin: 0 auto 20px;
        background: rgba(66, 133, 244, 0.1);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #4285f4;
        font-size: 24px;
    }

    .upload-title {
        font-size: 18px;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 8px;
    }

    .upload-description {
        font-size: 15px;
        color: #70757a;
        margin-bottom: 20px;
        line-height: 1.5;
    }

    .upload-button {
        background: #4285f4;
        color: white;
        border: none;
        padding: 12px 32px;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .upload-button:hover {
        background: #3367d6;
        transform: translateY(-1px);
    }

    .file-input {
        display: none;
    }

    .preview-section {
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #e8eaed;
    }

    .preview-label {
        font-size: 14px;
        color: #70757a;
        margin-bottom: 16px;
        font-weight: 500;
    }

    .preview-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        gap: 16px;
    }

    .preview-item {
        position: relative;
        aspect-ratio: 16/9;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e8eaed;
        background: #f8f9fa;
    }

    .preview-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    @media (max-width: 768px) {
        .slide-options-grid {
            grid-template-columns: 1fr;
        }
        
        .slide-settings-container {
            padding: 20px;
            margin: 10px;
        }
        
        .slide-option-card {
            padding: 20px;
            min-height: 120px;
        }
    }
</style>

<div class="slide-settings-header">
    <div class="slide-settings-icon">
        <i class="fas fa-images"></i>
    </div>
    <h3 class="slide-settings-title">Pengaturan Slide Foto</h3>
</div>

<div class="slide-options-grid">
    @if(isset($isEdit) && $isEdit && isset($presence) && $presence->slides->count() > 0)
    <!-- Option: Keep Current Slides (Only for Edit) -->
    <div class="slide-option-card selected" data-option="keep" id="option-keep">
        <input type="radio" name="slide_option" value="keep" id="slide_keep" checked>
        <div class="slide-option-content">
            <div class="slide-option-icon keep">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="slide-option-text">
                <h4 class="slide-option-title">Pertahankan slide saat ini</h4>
                <p class="slide-option-description">{{ $presence->slides->count() }} foto tersimpan</p>
            </div>
        </div>
        <div class="slide-option-radio"></div>
    </div>
    @endif

    <!-- Option 1: Use Previous Slides -->
    <div class="slide-option-card {{ !isset($isEdit) || !$isEdit ? 'selected' : '' }}" data-option="previous" id="option-previous">
        <input type="radio" name="slide_option" value="previous" id="slide_previous" {{ !isset($isEdit) || !$isEdit ? 'checked' : '' }}>
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
    <div class="slide-option-card" data-option="new" id="option-new">
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
    <div class="slide-option-bottom">
        <div class="slide-option-card bottom" data-option="none" id="option-none">
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
</div>

<!-- Previous Slides Selection -->
<div class="slide-content-section {{ !isset($isEdit) || !$isEdit ? 'active' : '' }}" id="previous-section">
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
    
    <div class="preview-section" id="upload-preview" style="display: none;">
        <div class="preview-label">Preview gambar yang akan diupload:</div>
        <div class="preview-grid" id="upload-preview-grid"></div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const slideOptions = document.querySelectorAll('.slide-option-card');
    const radioInputs = document.querySelectorAll('input[name="slide_option"]');
    const contentSections = document.querySelectorAll('.slide-content-section');
    
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
        
        if (option === 'previous') {
            document.getElementById('previous-section')?.classList.add('active');
        } else if (option === 'new') {
            document.getElementById('upload-section')?.classList.add('active');
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
        
        fileInput.addEventListener('change', e => {
            handleFiles(e.target.files);
        });
    }
    
    function handleFiles(files) {
        if (!files || files.length === 0) {
            uploadPreview.style.display = 'none';
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