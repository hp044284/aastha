@extends('Admin.Layout.index')
@section('title', "Featured Services")
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
            <div class="breadcrumb-title pe-3">Featured Services</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Create Featured Services</li>
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
                                <i class="bx bx-user"></i> Create Featured Services
                                <a href="{{ route('featured-services.index') }}" class="btn btn-primary float-end">Back</a>
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <form class="row g-3 needs-validation" id="create-form" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-6">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" name="title" class="form-control" id="title" placeholder="Title" required>
                                    @if ($errors->has('title'))
                                        <div class="alert alert-danger mt-2">
                                            {{ $errors->first('title') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label for="sub_title" class="form-label">Sub Title</label>
                                    <input type="text" name="sub_title" class="form-control" id="sub_title" placeholder="Sub Title" required>
                                    @if ($errors->has('sub_title'))
                                        <div class="alert alert-danger mt-2">
                                            {{ $errors->first('sub_title') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label for="short_description" class="form-label">Short Description</label>
                                    <textarea name="short_description" class="form-control" id="short_description" placeholder="Short Description" required></textarea>
                                    @if ($errors->has('short_description'))
                                        <div class="alert alert-danger mt-2">
                                            {{ $errors->first('short_description') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label for="url" class="form-label">Url</label>
                                    <input type="url" name="url" class="form-control" id="url" placeholder="Url" required>
                                    @if ($errors->has('url'))
                                        <div class="alert alert-danger mt-2">
                                            {{ $errors->first('url') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Extra Inputs <span class="text-muted">(max 10)</span></label>
                                    <div class="row" id="extra-inputs-list">
                                        <div class="col-md-6 extra-input-col">
                                            <div class="input-group mb-2 extra-input-row">
                                                <input type="text" name="extra_inputs[]" class="form-control" placeholder="Enter value">
                                            </div>
                                        </div>
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
                                                    <img id="previewImage" src="{{ asset('Uploads/image_placeholder.jpg') }}" alt="Select an image">
                                                </label>
                                                <input type="file" name="file_name" id="fileInput" accept="image/*" style="display: none;">
                                                <div id="buttons" class="float-start mt-3" style="display: none;">
                                                    <button id="changeButton" class="btn btn-primary" type="button">Change</button>
                                                    <button id="removeButton" class="btn btn-danger" type="button">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="status" name="status">
                                    <label class="form-check-label" for="status">Status</label>
                                    @if ($errors->has('status'))
                                        <div class="alert alert-danger mt-2">
                                            {{ $errors->first('status') }}
                                        </div>
                                    @endif
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
    <script type="text/javascript">
        $('#create-form').submit(function(e)
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
            const axios_request = sendAxiosRequest({
                url : "{{ route('featured-services.store') }}",
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
    <script>
        (function() {
            'use strict';

            document.addEventListener('DOMContentLoaded', function() {
                new ExtraInputsManager({
                    maxInputs: 10,
                    addBtnId: 'add-extra-input',
                    warningId: 'extra-inputs-warning',
                    listId: 'extra-inputs-list'
                });
            });
        })();
    </script>
@endpush