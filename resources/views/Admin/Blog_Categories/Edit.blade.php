@extends('Admin.Layout.index')
@section('title', "Edit Blog Categories")
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
            <div class="breadcrumb-title pe-3">Edit Blog Categories</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Blog Categories</li>
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
                                <i class="bx bx-user"></i> Edit Blog Categories
                                <a href="{{ route('product_category.index') }}" class="btn btn-primary float-end">Back</a>
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
                                    <label for="Meta_Title" class="form-label">Meta Title</label>
                                    <input type="text" name="Meta_Title" class="form-control" id="Meta_Title" placeholder="Meta Title" value="{{ old('Meta_Title', $entity->Meta_Title) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="Canonical_Url" class="form-label">Canonical Url</label>
                                    <input type="url" name="Canonical_Url" class="form-control" id="Canonical_Url" placeholder="Canonical Url" value="{{ old('Canonical_Url', $entity->Canonical_Url) }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="Meta_Keyword" class="form-label">Meta Keyword</label>
                                    <input type="text" name="Meta_Keyword" class="form-control" id="Meta_Keyword" placeholder="Meta Keyword" value="{{ old('Meta_Keyword', $entity->Meta_Keyword) }}" required>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="Primary Image" class="form-label">Primary Image</label>
                                            <div class="image-container">
                                                <label for="fileInput" class="image-preview">
                                                    @if(!empty($entity->File_Name) && (File::exists(public_path('/Uploads/Blog_Categories/'.$entity->File_Name))))
                                                        @php
                                                            $is_primary_required = true;
                                                        @endphp
                                                        <img id="previewImage" src="{{ asset('Uploads/Blog_Categories/'.$entity->File_Name) }}" alt="Select an image">
                                                    @else
                                                        <img id="previewImage" src="{{ asset('Uploads/image_placeholder.jpg') }}" alt="Select an image">
                                                    @endif
                                                </label>
                                                <input type="file" name="File_Name" id="fileInput" accept="image/*" style="display: none;">
                                                <div id="buttons" class="float-start mt-3" style="display: none;">
                                                    <button id="changeButton">Change</button>
                                                    <button id="removeButton">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="Meta_Description" class="form-label">Meta Description</label>
                                    <textarea name="Meta_Description" class="form-control" id="Meta_Description" required>{{ old('Meta_Description', $entity->Meta_Description) }}</textarea>
                                </div>
                                <div class="col-md-12">
                                    <label for="Description" class="form-label">Description</label>
                                    <textarea name="Description" rows="6" class="form-control" id="Description" placeholder="Description">{{ old('Description', $entity->Description) }}</textarea>
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
    <script src="{{ asset('assets/js/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript">
        $(function()
        {
            CKEDITOR.replace( 'Description',
            {
                height : 250,
                fullPage : true,
                allowedContent : true,
            });
        });

        $('#edit-form').submit(function(e)
        {
            e.preventDefault()
            const fileInput = document.getElementById('fileInput');
            var isPrimaryRequired = @json($is_primary_required);
            if (fileInput.files.length === 0 && isPrimaryRequired === false)
            {
                axiosToast('error', 'Primary image is required. Please upload an image.');
                return false;
            }

            for (instance in CKEDITOR.instances)
            {
                CKEDITOR.instances[instance].updateElement();
            }

            const formData = new FormData(this);
            formData.append('id',"{{ $entity->id }}")

            const axios_request = sendAxiosRequest({
                url : "{{ route('blog_category.update') }}",
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

        // Add event listeners
        document.addEventListener("DOMContentLoaded", () =>
        {
            const config = {
                buttonsId: "buttons",
                placeholder: "{{ asset('Uploads/image_placeholder.jpg') }}",
                fileInputId: "fileInput",
                previewImageId: "previewImage",
            };

            document.getElementById("fileInput").addEventListener("change", () =>
            {
                handleFileAction("preview", config);
            });

            document.getElementById("changeButton").addEventListener("click", () =>
            {
                handleFileAction("change", config);
            });

            document.getElementById("removeButton").addEventListener("click", () =>
            {
                handleFileAction("remove", config);
            });
        });
    </script>
@endpush