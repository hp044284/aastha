<div class="mb-3 image-upload-wrapper" data-multiple="{{ $multiple ? 'true' : 'false' }}">
    <div class="d-flex gap-3 mb-2">
        <label class="form-label mb-0" style="min-width: 120px;">{{ $label ?? 'Upload Image' }}</label>
    </div>
    <input type="file"
           name="{{ $name ?? 'File_Name' }}{{ $multiple ? '[]' : '' }}"
           class="image-input"
           accept="image/*"
           style="display:none"
           {{ $multiple ? 'multiple' : '' }}>

    <div class="image-preview-container mt-2 mb-2 d-flex gap-2 flex-wrap justify-content-start">
        {{-- If editing & old images exist --}}
        @if(!empty($value))
            @foreach((array) $value as $img)
                @php
                    $imgSrc = $is_store ? asset('storage/' . $img) : asset($img);
                @endphp
                <div class="image-item">
                    <img 
                        src="{{ $imgSrc }}" 
                        alt="preview"
                        
                    >
                    <button type="button" class="remove-btn">&times;</button>
                </div>
            @endforeach
        @else
            <div class="image-item">
                <img src="{{ asset('/Uploads/image_placeholder.jpg') }}" alt="no image">
            </div>
        @endif
    </div>
    <div class="d-flex gap-3 mb-2 justify-content-start">
        <button type="button" class="btn btn-outline-primary select-btn px-2 py-1" style="font-weight: 500; font-size: 1.2rem;" title="Select Image">
            <svg xmlns="http://www.w3.org/2000/svg" style="vertical-align: middle;" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path d="M4 4h16v16H4z" fill="currentColor" opacity="0.2"/>
                <path d="M8 16l2.5-3 2.5 3 3.5-4.5L20 18H4l4-5z" fill="currentColor"/>
                <rect x="4" y="4" width="16" height="16" rx="2" stroke="currentColor" stroke-width="2"/>
            </svg>
            <span style="vertical-align: middle; margin-left: 6px;"></span>
        </button>
    </div>
</div>
@push('css')
    <style>
        .image-upload-wrapper {
        text-align: center;
        }

        .image-preview-container {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        justify-content: center;
        margin-bottom: 10px;
        }

        .image-item {
        position: relative;
        width: 120px;
        height: 100px;
        border: 2px dashed #ccc;
        border-radius: 8px;
        overflow: hidden;
        }

        .image-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        }

        .remove-btn {
        position: absolute;
        top: 2px;
        right: 2px;
        background: rgba(220,53,69,0.9);
        color: white;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        font-size: 14px;
        line-height: 1;
        padding: 2px 6px;
        }

    </style>
@endpush
