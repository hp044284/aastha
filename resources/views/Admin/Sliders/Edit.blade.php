@extends('Admin.Layout.index')
@section('title', "Edit Slider")
@section('content')
@push('css')
    <style type="text/css">
        .image-container {
          text-align: center;
        }

        .image-preview {
          display: block;
          width: 200px;
          height: 150px;
          border: 2px dashed #ccc;
          border-radius: 8px;
          overflow: hidden;
          cursor: pointer;
        }

        .image-preview img {
          width: 100%;
          height: 100%;
          object-fit: cover;
        }

        #image-container {
          display: flex;
          flex-direction: column; /* Stack image and buttons vertically */
          align-items: center; /* Center-align content */
          text-align: center; /* Center text and buttons */
          margin-top: 20px;
        }

        #primaryImage {
          max-width: 100%;
          height: auto;
          border-radius: 10px; /* Optional styling for the image */
          margin-bottom: 10px; /* Space between image and buttons */
        }

        #buttons {
          display: flex;
          gap: 10px; /* Space between buttons */
        }

        #buttons button {
          padding: 10px 20px;
          border: none;
          border-radius: 5px;
          cursor: pointer;
        }

        #changeButton {
          background-color: #007bff;
          color: white;
        }

        #removeButton {
          background-color: #dc3545;
          color: white;
        }

        .image-container {
          margin-bottom: 20px;
          text-align: center;
        }

        .float-start {
          display: flex;
          gap: 10px;
        }

        .changeButton, .removeButton {
          padding: 5px 10px;
          border: none;
          border-radius: 3px;
          cursor: pointer;
        }

        .changeButton {
          background-color: #007bff;
          color: white;
        }

        .removeButton {
          background-color: #dc3545;
          color: white;
        }
    </style>
@endpush
@php
    $is_primary_required = false;
@endphp
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Edit Slider</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Slider</li>
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
                                <i class="bx bx-slider"></i> Edit Slider
                                <a href="{{ route('slider.index') }}" class="btn btn-primary float-end">Back</a>
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <form class="row g-3 needs-validation" id="edit-form" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-6">
                                    <label for="Title" class="form-label">Title</label>
                                    <input type="text" name="Title" class="form-control" id="Title" placeholder="Title" value="{{ old('Title', $entity->Title) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="Sub_Title" class="form-label">Sub Title</label>
                                    <input type="text" name="Sub_Title" class="form-control" id="Sub_Title" placeholder="Meta Title" value="{{ old('Sub_Title', $entity->Sub_Title) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="Slider_Url" class="form-label">Slider Url</label>
                                    <input type="url" name="Slider_Url" class="form-control" id="Slider_Url" placeholder="Slider Url" value="{{ old('Slider_Url', $entity->Slider_Url) }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="Short_Description" class="form-label">Short Description</label>
                                    <textarea name="Short_Description" class="form-control" id="Short_Description" required>{{ old('Short_Description', $entity->Short_Description) }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="Primary Image" class="form-label">Primary Image</label>
                                            <div class="image-container">
                                                <label for="fileInput" class="image-preview">
                                                    @if(!empty($entity->File_Name) && (File::exists(public_path('/Uploads/Sliders/'.$entity->File_Name))))
                                                        @php
                                                            $is_primary_required = true;
                                                        @endphp
                                                        <img id="previewImage" src="{{ asset('Uploads/Sliders/'.$entity->File_Name) }}" alt="Select an image">
                                                    @else
                                                        <img id="previewImage" src="{{ asset('Uploads/image_placeholder.jpg') }}" alt="Select an image">
                                                    @endif
                                                </label>
                                                <input type="file" name="File_Name" id="fileInput" accept="image/*" style="display: none;" {{ ($is_primary_required == false) ? 'required' : ''}}>
                                                <div id="buttons" class="float-start mt-3" style="display: none;">
                                                    <button id="changeButton" type="button">Change</button>
                                                    <button id="removeButton" type="button">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="Status" name="Status" {{ ($entity->Status == true) ? 'checked' : '' }}>
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
    <script type="text/javascript">
        $('#edit-form').submit(function(e)
        {
            e.preventDefault()
            const formData = new FormData(this);
            formData.append('id',"{{ $entity->id }}")

            const axios_request = sendAxiosRequest({
                url : "{{ route('slider.update') }}",
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

        // Function to handle file input change
        function handleFileInputChange(fileInputId, previewImageId, buttonsId, placeholder)
        {
            const buttons = document.getElementById(buttonsId);
            const fileInput = document.getElementById(fileInputId);
            const previewImage = document.getElementById(previewImageId);

            const file = fileInput.files[0];
            if (file)
            {
                const reader = new FileReader();
                reader.onload = function (e)
                {
                    previewImage.src = e.target.result; // Set preview image
                    buttons.style.display = "block"; // Show buttons
                };
                reader.readAsDataURL(file);
            }
        }

        // Function to handle "Change" button click
        function handleChangeButtonClick(fileInputId)
        {
            document.getElementById(fileInputId).click(); // Trigger file input click
        }

        // Function to handle "Remove" button click
        function handleRemoveButtonClick(fileInputId, previewImageId, buttonsId, placeholder)
        {
            const buttons = document.getElementById(buttonsId);
            const fileInput = document.getElementById(fileInputId);
            const previewImage = document.getElementById(previewImageId);

            previewImage.src = placeholder; // Reset to placeholder image
            fileInput.value = ""; // Clear the file input
            buttons.style.display = "none"; // Hide buttons
        }

        // Add event listeners
        document.getElementById("fileInput").addEventListener("change", function ()
        {
            handleFileInputChange("fileInput", "previewImage", "buttons", "{{ asset('Uploads/image_placeholder.jpg') }}");
        });

        document.getElementById("changeButton").addEventListener("click", function ()
        {
            handleChangeButtonClick("fileInput");
        });

        document.getElementById("removeButton").addEventListener("click", function ()
        {
            handleRemoveButtonClick("fileInput", "previewImage", "buttons", "{{ asset('Uploads/image_placeholder.jpg') }}");
        });
    </script>
@endpush