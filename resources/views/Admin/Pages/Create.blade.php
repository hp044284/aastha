@extends('Admin.Layout.index')
@section('title', "Page")
@section('content')
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('select2@4.1.0/dist/css/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('Select2-Bootstrap-5-Theme/dist/select2-bootstrap-5-theme.min.css') }}">
@endpush
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Page</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Create Page</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="main-body">
            <div class="row">
                <div class="col-xl-12 mx-auto">
                    <div class="card">
                        <div class="card-header px-4 py-3">
                            <h5 class="mb-0">
                                <i class="bx bx-user"></i> Create Page
                                <a href="{{ route('page.index') }}" class="btn btn-primary float-end">Back</a>
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <form class="row g-3 needs-validation" id="create-form" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-6">
                                    <label for="Icons_Name" class="form-label">Icons Name</label>
                                    <input type="text" name="Icons_Name" class="form-control" id="Icons_Name" placeholder="Icons Name">
                                </div>
                                <div class="col-md-6">
                                    <label for="Title" class="form-label">Title</label>
                                    <input type="text" name="Title" class="form-control" id="Title" placeholder="Title" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="Canonical_Url" class="form-label">Canonical Url</label>
                                    <input type="url" name="Canonical_Url" class="form-control" id="Canonical_Url" placeholder="Canonical Url" >
                                </div>

                                <div class="col-md-12">
                                    
                                    <label for="File_Name" class="form-label">File Name</label>
                                    <div class="file-upload-wrapper">
                                        <img src="{{ asset('Uploads/image_placeholder.jpg') }}" class="img-preview" style="width: 120px; height: 120px; object-fit: cover;">
                                        <input type="file" name="File_Name" class="d-none" accept="image/*">
                                        <div class="action-buttons mt-2 d-flex gap-2">
                                            <button type="button" class="btn btn-sm btn-secondary change-btn">Change</button>
                                            <button type="button" class="btn btn-sm btn-danger remove-btn">Remove</button>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const dropArea = document.getElementById('image-drop-area');
                                        const fileInput = document.getElementById('File_Name');
                                        const preview = document.getElementById('image-preview');
                                        const previewImg = preview.querySelector('img');
                                        const removeBtn = document.getElementById('remove-image');
                                        const dropText = document.getElementById('image-drop-text');

                                        // Click to open file dialog
                                        dropArea.addEventListener('click', function(e) {
                                            if (e.target !== removeBtn) {
                                                fileInput.click();
                                            }
                                        });

                                        // Drag over
                                        dropArea.addEventListener('dragover', function(e) {
                                            e.preventDefault();
                                            dropArea.classList.add('bg-light');
                                        });

                                        dropArea.addEventListener('dragleave', function(e) {
                                            e.preventDefault();
                                            dropArea.classList.remove('bg-light');
                                        });

                                        // Drop
                                        dropArea.addEventListener('drop', function(e) {
                                            e.preventDefault();
                                            dropArea.classList.remove('bg-light');
                                            if (e.dataTransfer.files && e.dataTransfer.files[0]) {
                                                fileInput.files = e.dataTransfer.files;
                                                showPreview(e.dataTransfer.files[0]);
                                            }
                                        });

                                        // File input change
                                        fileInput.addEventListener('change', function(e) {
                                            if (fileInput.files && fileInput.files[0]) {
                                                showPreview(fileInput.files[0]);
                                            }
                                        });

                                        // Remove image
                                        removeBtn.addEventListener('click', function(e) {
                                            fileInput.value = '';
                                            preview.style.display = 'none';
                                            dropText.style.display = '';
                                        });

                                        function showPreview(file) {
                                            if (!file.type.startsWith('image/')) return;
                                            const reader = new FileReader();
                                            reader.onload = function(e) {
                                                previewImg.src = e.target.result;
                                                preview.style.display = '';
                                                dropText.style.display = 'none';
                                            }
                                            reader.readAsDataURL(file);
                                        }
                                    });
                                </script>
                                <div class="col-md-12">
                                    <label for="Description" class="form-label">Description</label>
                                    <textarea name="Description" rows="6" class="form-control" id="Description" placeholder="Description"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="Meta_Title" class="form-label">Meta Title</label>
                                    <input type="text" name="Meta_Title" class="form-control" id="Meta_Title" placeholder="Meta Title" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="Meta_Keyword" class="form-label">Meta Keyword</label>
                                    <input type="text" name="Meta_Keyword" class="form-control" id="Meta_Keyword" placeholder="Meta Keyword" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="Meta_Description" class="form-label">Meta Description</label>
                                    <textarea name="Meta_Description" class="form-control" id="Meta_Description" required></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="Menu_Display" class="form-label">Menu Display</label>
                                    <select name="Menu_Display[]" id="Menu_Display" class="form-control" multiple>
                                        <option value="Header" selected>Header</option>
                                        <option value="Footer">Footer</option>
                                        <option value="Both">Both</option>
                                    </select>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="Status" name="Status">
                                    <label class="form-check-label" for="Status">Status</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="Is_Footer_Link" name="Is_Footer_Link">
                                    <label class="form-check-label" for="Is_Footer_Link">Is Footer Link</label>
                                </div>
                                <div class="col-md-12">
                                    <div class="d-md-flex d-grid align-items-center gap-3">
                                        <button type="submit" class="btn btn-primary px-4">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
</div>
@endsection
@push('js')
    <script src="{{ asset('assets/js/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('select2@4.1.0/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/global-file-input-manager.js') }}"></script>
    <script type="text/javascript">
        $(function()
        {
            CKEDITOR.replace( 'Description',
            {
                height : 400,
                fullPage : true,
                allowedContent : true,
            });

            $( '#Menu_Display' ).select2( {
                theme: "bootstrap-5",
                width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
                placeholder: $( this ).data( 'placeholder' ),
                closeOnSelect: false,
            } );
        });

        $('#create-form').submit(function(e)
        {
            e.preventDefault();

            // Ensure CKEditor data is updated in textarea before sending
            if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances['Description']) {
                CKEDITOR.instances['Description'].updateElement();
            }

            const form = this;
            const formData = new FormData(form);

            // Ensure File_Name is appended if file is selected
            var fileInput = document.getElementById('File_Name');
            if (fileInput && fileInput.files.length > 0) {
                formData.set('File_Name', fileInput.files[0]);
            }

            // Ensure Icons_Name is appended (in case of any JS override)
            var iconsInput = document.getElementById('Icons_Name');
            if (iconsInput) {
                formData.set('Icons_Name', iconsInput.value);
            }

            const axios_request = sendAxiosRequest({
                url : "{{ route('page.store') }}",
                data : formData,
                headers : { 'Content-Type': 'multipart/form-data' },
            });

            axios_request.then(function (response)
            {
                if (response.status == 200)
                {
                    var message = response.data.message;
                    axiosToast('success', message);
                    setTimeout(function()
                    {
                        window.location.href = response.data.redirect;
                    }, 1000);
                }
                else
                {
                    handleAxiosErrorResponse(response);
                }
            }).catch((error) => handleAxiosErrorRequest(error));
        });

        document.addEventListener("DOMContentLoaded", () => {
            new FileInputManager({
                selector: '.file-upload-wrapper',
                placeholder: '{{ asset('Uploads/image_placeholder.jpg') }}'
            });
        });
    </script>
@endpush