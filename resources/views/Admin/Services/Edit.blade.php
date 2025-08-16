@extends('Admin.Layout.index')
@section('title', "Edit Service")
@section('content')
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css">
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
            <div class="breadcrumb-title pe-3">Edit Service</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Service</li>
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
                                <i class="bx bx-user"></i> Edit Service
                                <a href="{{ route('service.index') }}" class="btn btn-primary float-end">Back</a>
                            </h5>
                        </div>
                        <div class="form-body mt-4">
                            <form id="edit-form">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="border border-3 p-4 rounded">
                                            <div class="mb-3">
                                                <label for="Title" class="form-label">Title</label>
                                                <input type="text" name="Title" value="{{ old('Title', $entity->Title) }}" class="form-control" id="Title" placeholder="Enter product title" required />
                                            </div>
                                            <div class="mb-3">
                                                <label for="Short_Description" class="form-label">Short Description</label>
                                                <textarea class="form-control" id="Short_Description" rows="3" name="Short_Description" placeholder="Enter Short Description">{{ old('Short_Description', $entity->Short_Description) }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="Description" class="form-label">Description</label>
                                                <textarea class="form-control" name="Description" id="Description" rows="3" required>{{ old('Description', $entity->Description) }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="Aditional_Description" class="form-label">Aditional Description</label>
                                                <textarea class="form-control" name="Aditional_Description" id="Aditional_Description" rows="3">{{ old('Aditional_Description', $entity->Aditional_Description) }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="Primary Image" class="form-label">Primary Image</label>
                                                        <div class="image-container">
                                                            <label for="fileInput" class="image-preview">
                                                                @if(!empty($entity->File_Name) && (File::exists(public_path('/Uploads/Services/'.$entity->File_Name))))
                                                                    @php
                                                                        $is_primary_required = true;
                                                                    @endphp
                                                                    <img id="previewImage" src="{{ asset('Uploads/Services/'.$entity->File_Name) }}" alt="Select an image">
                                                                @else
                                                                    <img id="previewImage" src="{{ asset('Uploads/image_placeholder.jpg') }}" alt="Select an image">
                                                                @endif
                                                            </label>
                                                            <input type="file" name="File_Name" id="fileInput" accept="image/*" style="display: none;" {{ ($is_primary_required == false) ? 'required' : ''}}>
                                                            <div id="buttons" class="float-start mt-3" style="display: none;">
                                                                <button id="changeButton">Change</button>
                                                                <button id="removeButton">Remove</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="border border-3 p-4 rounded">
                                            <div class="row g-3">
                                                <div class="col-md-12">
                                                    <label for="Meta_Title" class="form-label">Meta Title</label>
                                                    <input type="text" name="Meta_Title" value="{{ old('Meta_Title', $entity->Meta_Title) }}" class="form-control" id="Meta_Title" placeholder="Meta Title" />
                                                </div>
                                                <div class="col-12">
                                                    <label for="Category_Id" class="form-label">Service Category</label>
                                                    <select class="form-select" id="Category_Id" name="Category_Id">
                                                        <option value="">Select Service</option>
                                                        @if(!empty($sub_categories))
                                                            @foreach($sub_categories as $service_key => $service_cat)
                                                                <option value="{{$service_key}}" {{ ($service_key == $entity->Category_Id) ? 'selected' : '' }}>{{ $service_cat }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="col-12">
                                                    <label for="Sub_Category_Id" class="form-label">Sub Category</label>
                                                    <select class="form-select" id="Sub_Category_Id" name="Sub_Category_Id">

                                                    </select>
                                                </div>
                                                <div class="col-12">
                                                    <label for="Tags" class="form-label">Service Tags</label>
                                                    <textarea class="form-control" id="Tags" rows="3" name="Tags" placeholder="Enter Service Tags">{{ old('Tags', $entity->Tags) }}</textarea>
                                                </div>
                                                <div class="col-12">
                                                    <label for="Meta_Description" class="form-label">Meta Description</label>
                                                    <textarea class="form-control" id="Meta_Description" rows="3" name="Meta_Description" placeholder="Enter Meta Description">{{ old('Meta_Description', $entity->Meta_Description) }}</textarea>
                                                </div>

                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button type="submit" class="btn btn-primary">Save Service</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!--end row-->
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function()
        {
            $('#Category_Id').trigger('change');
        });

        $(function()
        {
            CKEDITOR.replace( 'Description',
            {
                height : 250,
                fullPage : true,
                allowedContent : true,
            });

            CKEDITOR.replace( 'Aditional_Description',
            {
                height : 250,
                fullPage : true,
                allowedContent : true,
            });
        });

        $('#edit-form').submit(function(e)
        {
            e.preventDefault()
            for (instance in CKEDITOR.instances)
            {
                CKEDITOR.instances[instance].updateElement();
            }

            const formData = new FormData(this);
            formData.append('id',"{{ $entity->id }}")

            const axios_request = sendAxiosRequest({
                url : "{{ route('service.update') }}",
                data : formData,
                headers : "multipart/form-data",
            });

            axios_request.then(function (response)
            {
                console.log(response, '  response');
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

        $('#Category_Id').change(function(e)
        {
            let Product_Cat_Id = $(this).val();

            const axios_request = sendAxiosRequest({
                url : "{{ route('service_category.axios_service_sub_category') }}",
                data : { Product_Cat_Id : Product_Cat_Id},
                headers : "multipart/form-data",
            });

            const selectElement = document.getElementById('Sub_Category_Id');
            axios_request.then(function (response)
            {
                console.log(response);
                if (response.status == 200)
                {
                    if (response.data.status === "success" && response.data.entities)
                    {
                        selectElement.innerHTML = "";
                        const defaultOption = document.createElement('option');
                        defaultOption.value = "";
                        defaultOption.textContent = "Select Sub Category";
                        defaultOption.disabled = true;
                        defaultOption.selected = true;
                        selectElement.appendChild(defaultOption);
                        Object.entries(response.data.entities).forEach(([key, value]) =>
                        {
                            const option = document.createElement('option');
                            option.value = key;
                            option.selected = (key == {{ $entity->Sub_Category_Id ?? 0 }}) ? true : false;
                            option.textContent = value;
                            selectElement.appendChild(option);
                        });
                    }
                }
                else
                {
                    selectElement.innerHTML = "";
                    const defaultOption = document.createElement('option');
                    defaultOption.value = "";
                    defaultOption.textContent = "Select Sub Category";
                    defaultOption.disabled = true;
                    defaultOption.selected = true;
                    selectElement.appendChild(defaultOption);
                    handleAxiosErrorResponse(response);
                }
            }).catch((error) => handleAxiosErrorRequest(error));
        });

        function Delete_File_Entity(id , remove_div_id , actionType)
        {
           $.confirm({
                title : 'Confirm!',
                content : 'Are sure you want to delete',
                buttons : {
                    cancel : function ()
                    {

                    },
                    confirm : function ()
                    {
                        const axios_request = sendAxiosRequest({
                            url : "{{ route('service.index') }}",
                            data : { id : id },
                        });

                        axios_request.then(function (response)
                        {
                            if (response.status == 200)
                            {
                                var message = response.data.message;
                                axiosToast('success', message);
                                if (actionType === 0)
                                {
                                    $('#file-preview-container-'+id).remove();
                                }
                                else
                                {
                                    $('#'+remove_div_id).remove();
                                }
                            }
                            else
                            {
                                handleAxiosErrorResponse(response);
                            }
                        }).catch((error) => handleAxiosErrorRequest(error));
                    },
                }
           });
        }

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