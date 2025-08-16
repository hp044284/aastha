@extends('Admin.Layout.index')
@section('title', "Testimonial")
@section('content')
@push('css')
    <link href="{{ asset('FroalaEditor/css/froala_editor.pkgd.min.css') }}" rel="stylesheet"/>
@endpush

<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Testimonial</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Create Testimonial</li>
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
                                <i class="bx bx-user"></i> Create Testimonial
                                <a href="{{ route('testimonial.index') }}" class="btn btn-primary float-end">Back</a>
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <form class="row g-3 needs-validation" id="create-form" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-6">
                                    <label for="First_Name" class="form-label">First Name</label>
                                    <input type="text" name="First_Name" class="form-control" id="First_Name" placeholder="First Name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="Last_Name" class="form-label">Last Name</label>
                                    <input type="text" name="Last_Name" class="form-control" id="Last_Name" placeholder="Last Name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="Position" class="form-label">Position</label>
                                    <input type="text" name="Position" class="form-control" id="Position" placeholder="Position" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="Primary_File_Name" class="form-label">File Name</label>
                                    <input type="file" name="File_Name" class="form-control" id="Primary_File_Name" accept="image/jpeg, image/png, image/gif, image/bmp, image/webp">
                                    <div id="primary-file-preview" class="file-preview-container" style="display: none; margin-top: 10px;"></div>
                                </div>
                                <div class="col-md-12">
                                    <label for="Description" class="form-label">Description</label>
                                    <textarea name="Message" rows="6" class="form-control" id="Description" placeholder="Description"></textarea>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="Status" name="Status">
                                    <label class="form-check-label" for="Status">Status</label>
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
    <script src="{{ asset('FroalaEditor/js/froala_editor.pkgd.min.js') }}"></script>
    <script type="text/javascript">

        $(document).ready(function(e)
        {
            new FroalaEditor('#Description');
        });

        $('#create-form').submit(function(e)
        {
            e.preventDefault()
            const formData = new FormData(this);
            const axios_request = sendAxiosRequest({
                url : "{{ route('testimonial.store') }}",
                data : formData,
                headers : "multipart/form-data",
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

        document.getElementById('Primary_File_Name').addEventListener('change', function(event)
        {
            Display_File_Preview(event.target);
        });

        function Display_File_Preview(fileInput)
        {
            const file = fileInput.files[0];
            const previewContainer = fileInput.nextElementSibling; // This is the preview container next to the input

            if (file)
            {
                previewContainer.style.display = 'block'; // Show the preview container
                previewContainer.innerHTML = '';

                if (file.type.startsWith('image/'))
                {
                    const img = document.createElement('img');
                    img.src = URL.createObjectURL(file);
                    img.alt = file.name;
                    img.style.maxWidth = '150px';
                    img.style.marginRight = '10px';
                    previewContainer.appendChild(img);
                }
                else
                {
                    const fileName = document.createElement('span');
                    fileName.textContent = file.name;
                    previewContainer.appendChild(fileName);
                }
            }
        }
    </script>
@endpush