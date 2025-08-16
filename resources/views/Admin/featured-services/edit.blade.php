@extends('Admin.Layout.index')
@section('title', "Edit Featured Services")
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
            <div class="breadcrumb-title pe-3">Edit Featured Services</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Featured Services</li>
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
                                <i class="bx bx-user"></i> Edit Featured Services
                                <a href="{{ route('featured-services.index') }}" class="btn btn-primary float-end">Back</a>
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <form class="row g-3 needs-validation" id="edit-form" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-6">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" name="title" class="form-control" id="title" placeholder="Title" value="{{ old('title', $entity->title) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="sub_title" class="form-label">Sub Title</label>
                                    <input type="text" name="sub_title" class="form-control" id="sub_title" placeholder="Sub Title" value="{{ old('sub_title', $entity->sub_title) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="short_description" class="form-label">Short Description</label>
                                    <input type="text" name="short_description" class="form-control" id="short_description" placeholder="Short Description" value="{{ old('short_description', $entity->short_description) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="url" class="form-label">Url</label>
                                    <input type="url" name="url" class="form-control" id="url" placeholder="Url" value="{{ old('url', $entity->url) }}" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Extra Inputs <span class="text-muted">(max 10)</span></label>
                                    <div class="row" id="extra-inputs-list">
                                        @php
                                            $extraInputs = old('extra_inputs');
                                            if (is_null($extraInputs)) {
                                                $extraInputs = $entity->featuredServiceTitles()->pluck('title', 'id')->toArray();
                                            }
                                            // Always show at least one input field
                                            if (empty($extraInputs) || !is_array($extraInputs) || count($extraInputs) == 0) {
                                                $extraInputs = [''];
                                            }
                                        @endphp
                                        @foreach($extraInputs as $index => $input)
                                            <div class="col-md-6 extra-input-col">
                                                <div class="input-group mb-2 extra-input-row">
                                                    <input type="text" name="extra_inputs[]" class="form-control" placeholder="Enter value" value="{{ $input }}">
                                                    <button type="button" class="btn btn-danger btn-sm ms-2 delete-extra-input" @if(count($extraInputs) == 1) style="display:none;" @endif data-id="{{ $index }}">
                                                        <i class="bx bx-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-success mt-2" id="add-extra-input">Add</button>
                                    <div id="extra-inputs-warning" class="text-danger mt-2" style="display:none;">Maximum 10 extra inputs allowed.</div>
                                </div>
                                
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="file_name" class="form-label">Primary Image</label>
                                            <div class="image-container">
                                                <label for="fileInput" class="image-preview">
                                                    @if(!empty($entity->file_name) && (File::exists(public_path('/Uploads/featured-services/'.$entity->file_name))))
                                                        @php
                                                            $is_primary_required = true;
                                                        @endphp
                                                        <img id="previewImage" src="{{ asset('Uploads/featured-services/'.$entity->file_name) }}" alt="Select an image">
                                                    @else
                                                        <img id="previewImage" src="{{ asset('Uploads/image_placeholder.jpg') }}" alt="Select an image">
                                                    @endif
                                                </label>
                                                <input type="file" name="file_name" id="fileInput" accept="image/*" style="display: none;">
                                                <div id="buttons" class="float-start mt-3" style="display: none;">
                                                    <button id="changeButton">Change</button>
                                                    <button id="removeButton">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="status" name="status" {{ ($entity->status == true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status">Status</label>
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
    <script src="{{ asset('assets/js/extra-inputs-manager.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new ExtraInputsManager({
                maxInputs: 10,
                addBtnId: 'add-extra-input',
                warningId: 'extra-inputs-warning',
                listId: 'extra-inputs-list'
            });
        });
    </script>
    <script type="text/javascript">

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

            const formData = new FormData(this);
            formData.append('id',"{{ $entity->id }}")

            const axios_request = sendAxiosRequest({
                url : "{{ route('featured-services.update') }}",
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


        // Handle delete action using axios in a professional way
        document.addEventListener("DOMContentLoaded", () => {
            const deleteButtons = document.querySelectorAll('.delete-extra-input');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function (e) {
                    console.log('delete');
                    e.preventDefault();
                    const deleteUrl = "{{ route('featured-services.delete-extra-input') }}";
                    if (!deleteUrl) return;

                    if (confirm('Are you sure you want to delete this featured service?')) {
                        axios({
                            method: 'post',
                            url: deleteUrl,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            data: {
                                id: button.getAttribute('data-id')
                            }
                        })
                        .then(function (response) {
                            if (response.status === 200) {
                                axiosToast('success', response.data.message || 'Deleted successfully');
                                setTimeout(function () {
                                    window.location.href = response.data.redirect || window.location.href;
                                }, 1000);
                            } else {
                                handleAxiosErrorResponse(response);
                            }
                        })
                        .catch(function (error) {
                            handleAxiosErrorRequest(error);
                        });
                    }
                });
            });
        });
       
    </script>
    

@endpush