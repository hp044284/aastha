@extends('Admin.Layout.index')
@section('title', "Settings")
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
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Settings</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Settings</li>
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
                                <i class="bx bx-wrench"></i> Settings
                                <a href="{{ route('setting.index') }}" class="btn btn-primary float-end">Back</a>
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <form class="row g-3 needs-validation" id="create-form" method="post" enctype="multipart/form-data">
                                @csrf

                                @foreach($entities as $entity_key => $entity)
                                    <div class="col-md-6">
                                        <label for="{{ $entity->Name }}" class="form-label">{{ str_replace('_', ' ', ucwords($entity->Name, '_')) }}</label>
                                        @switch($entity->Type)
                                            @case('text')
                                                <input type="{{ $entity->Type  }}" name="{{ $entity->Name }}" class="form-control" id="{{ $entity->Name }}" placeholder="{{ str_replace('_', ' ', ucwords($entity->Name, '_')) }}" value="{{ $entity->Value ?? '' }}">
                                            @break

                                            @case('textarea')
                                                <textarea name="{{ $entity->Name }}" class="form-control" id="{{ $entity->Name }}" placeholder="{{ str_replace('_', ' ', ucwords($entity->Name, '_')) }}">{{ $entity->Value ?? '' }}</textarea>
                                            @break

                                            @case('file')
                                                @php
                                                    $inputId = 'fileInput_' . $entity_key;
                                                    $previewId = 'previewImage_' . $entity_key;
                                                    $buttonsId = 'buttons_' . $entity_key;
                                                @endphp
                                                <div class="mb-3">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label class="form-label">Primary Image</label>
                                                            <div class="image-container">
                                                                <label for="{{ $inputId }}" class="image-preview">
                                                                    <img id="{{ $previewId }}"
                                                                        src="{{ !empty($entity->Value) && File::exists(public_path('/Uploads/Settings/' . $entity->Value)) ? asset('Uploads/Settings/' . $entity->Value) : asset('Uploads/image_placeholder.jpg') }}"
                                                                        alt="Select an image">
                                                                </label>
                                                                <input
                                                                    type="file"
                                                                    name="{{ $entity->Name }}"
                                                                    id="{{ $inputId }}"
                                                                    class="form-control file-input"
                                                                    data-preview="{{ $previewId }}"
                                                                    data-buttons="{{ $buttonsId }}"
                                                                    data-placeholder="{{ asset('Uploads/image_placeholder.jpg') }}"
                                                                    accept="image/*">

                                                                <div id="{{ $buttonsId }}" class="float-start mt-3 file-buttons" style="display: none;">
                                                                    <button type="button" class="btn btn-sm btn-secondary change-btn" data-input="{{ $inputId }}">Change</button>
                                                                    <button type="button" class="btn btn-sm btn-danger remove-btn"
                                                                            data-input="{{ $inputId }}"
                                                                            data-preview="{{ $previewId }}"
                                                                            data-buttons="{{ $buttonsId }}"
                                                                            data-placeholder="{{ asset('Uploads/image_placeholder.jpg') }}">
                                                                        Remove
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @break

                                            @default
                                                <input type="{{ $entity->Type  }}" name="{{ $entity->Name }}" class="form-control" id="{{ $entity->Name }}" placeholder="{{ str_replace('_', ' ', ucwords($entity->Name, '_')) }}" value="{{ $entity->Value ?? '' }}">
                                        @endswitch
                                    </div>
                                @endforeach
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
    <script src="{{ asset('assets/js/file-input-manager.js') }}"></script>

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
                url : "{{ route('setting.update') }}",
                data : formData,
                headers : "multipart/form-data",
            });

            axios_request.then(function (response)
            {
                if (response.status == 200)
                {
                    var message = response.data.message;
                    setTimeout(function()
                    {
                        location.reload();
                    }, 100);
                    axiosToast('success', message);
                }
                else
                {
                    handleAxiosErrorResponse(response);
                }
            }).catch((error) => handleAxiosErrorRequest(error));
        });
        document.addEventListener('DOMContentLoaded', function () {
            new DynamicFileInputManager();
        }); 
    </script>
@endpush