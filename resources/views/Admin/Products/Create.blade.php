@extends('Admin.Layout.index')
@section('title', "Add Product")
@section('content')
@push('css')
    <link href="{{ asset('assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css') }}" rel="stylesheet"/>
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
            <div class="breadcrumb-title pe-3">Product</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add Product</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">
                    Add New Product
                    <a href="{{ route('product.index') }}" class="btn btn-primary float-end">Back</a>
                </h5>
                <hr />
                <div class="form-body mt-4">
                    <form id="create-form">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="border border-3 p-4 rounded">
                                    <div class="mb-3">
                                        <label for="Product_Name" class="form-label">Product Title</label>
                                        <input type="text" name="Product_Name" class="form-control" id="Product_Name" placeholder="Enter product title" required />
                                    </div>
                                    <div class="mb-3">
                                        <label for="Short_Description" class="form-label">Short Description</label>
                                        <textarea class="form-control" id="Short_Description" rows="3" name="Short_Description" placeholder="Enter Short Description"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Description" class="form-label">Description</label>
                                        <textarea class="form-control" name="Description" id="Description" rows="3" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Aditional_Description" class="form-label">Aditional Description</label>
                                        <textarea class="form-control" name="Aditional_Description" id="Aditional_Description" rows="3"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="Primary Image" class="form-label">Primary Image</label>
                                                <div class="image-container">
                                                    <label for="fileInput" class="image-preview">
                                                        <img id="previewImage" src="{{ asset('Uploads/image_placeholder.jpg') }}" alt="Select an image">
                                                    </label>
                                                    <input type="file" name="File_Name" id="fileInput" accept="image/*" style="display: none;" required>
                                                    <div id="buttons" class="float-start mt-3" style="display: none;">
                                                        <button id="changeButton">Change</button>
                                                        <button id="removeButton">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 ">
                                        <div class="row" id="imageUploadContainer">
                                            <div class="col-md-6 image-template" >
                                                <label for="Secondary Image" class="form-label">Secondary Images</label>
                                                <!-- Dynamic image upload sections will be appended here -->
                                                <div class="image-container">
                                                    <label for="fileInput1" class="image-preview">
                                                        <img id="previewImage1" src="{{ asset('Uploads/image_placeholder.jpg') }}" alt="Select an image">
                                                    </label>
                                                    <input type="file" name="Secondary_File[]" id="fileInput1" accept="image/*" style="display: none;">
                                                    <div id="buttons1" class="float-start mt-3" style="display: none;">
                                                        <button class="changeButton">Change</button>
                                                        <button class="removeButton">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" id="addImageButton" class="btn btn-primary mt-3">Add Another Image</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="border border-3 p-4 rounded">
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <label for="Price" class="form-label">Price</label>
                                            <input type="text" name="Price" class="form-control" id="Price" placeholder="00.00" />
                                        </div>
                                        <div class="col-md-12">
                                            <label for="Old_Price" class="form-label">Old Price</label>
                                            <input type="text" name="Old_Price" class="form-control" id="Old_Price" placeholder="00.00" required />
                                        </div>
                                        <div class="col-md-12">
                                            <label for="Quntity" class="form-label">Quntity</label>
                                            <input type="number" name="Quntity" class="form-control" id="Quntity" placeholder="1" />
                                        </div>
                                        <div class="col-md-12">
                                            <label for="Sku" class="form-label">Sku</label>
                                            <input type="text" name="Sku" class="form-control" id="Sku" placeholder="PR12345678" />
                                        </div>
                                        <div class="col-md-12">
                                            <label for="Meta_Title" class="form-label">Meta Title</label>
                                            <input type="text" name="Meta_Title" class="form-control" id="Meta_Title" placeholder="Meta Title" />
                                        </div>
                                        <div class="col-12">
                                            <label for="Product_Category_Id" class="form-label">Product Category</label>
                                            <select class="form-select" id="Product_Category_Id" name="Product_Category_Id">
                                                <option value="">Select Product</option>
                                                @if(!empty($product_categories))
                                                    @foreach($product_categories as $product_key => $product_cat)
                                                        <option value="{{$product_key}}">{{ $product_cat }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label for="Product_Sub_Category_Id" class="form-label">Product Sub Category</label>
                                            <select class="form-select" id="Product_Sub_Category_Id" name="Product_Sub_Category_Id">

                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label for="Tags" class="form-label">Product Tags</label>
                                            <textarea class="form-control" id="Tags" rows="3" name="Tags" placeholder="Enter Product Tags"></textarea>
                                        </div>
                                        <div class="col-12">
                                            <label for="Meta_Description" class="form-label">Meta Description</label>
                                            <textarea class="form-control" id="Meta_Description" rows="3" name="Meta_Description" placeholder="Enter Meta Description"></textarea>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="Status" name="Status">
                                            <label class="form-check-label" for="Status">Status</label>
                                        </div>

                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary">Save Product</button>
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

            CKEDITOR.replace( 'Aditional_Description',
            {
                height : 250,
                fullPage : true,
                allowedContent : true,
            });
        });

        $('#create-form').submit(function(e)
        {
            e.preventDefault()

            for (instance in CKEDITOR.instances)
            {
                CKEDITOR.instances[instance].updateElement();
            }

            const formData = new FormData(this);

            const axios_request = sendAxiosRequest({
                url : "{{ route('product.store') }}",
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

        $('#Product_Category_Id').change(function(e)
        {
            let Product_Cat_Id = $(this).val();

            const axios_request = sendAxiosRequest({
                url : "{{ route('product_category.axios_product_sub_category') }}",
                data : { Product_Cat_Id : Product_Cat_Id},
                headers : "multipart/form-data",
            });

            const selectElement = document.getElementById('Product_Sub_Category_Id');
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

        document.addEventListener("DOMContentLoaded", function ()
        {
            let imageCount = 1; // Counter for dynamically added image sections

            // Function to handle file input change
            const handleFileChange = (fileInputId, previewId, buttonsId) =>
            {
                const buttons = document.getElementById(buttonsId);
                const fileInput = document.getElementById(fileInputId);
                const previewImage = document.getElementById(previewId);

                const file = fileInput.files[0];
                if (file)
                {
                    const reader = new FileReader();
                    reader.onload = function (e)
                    {
                        previewImage.src = e.target.result; // Set preview image
                        buttons.style.display = "flex"; // Show buttons
                    };
                    reader.readAsDataURL(file);
                }
            };

            // Function to handle the change button click
            const handleChangeButtonClick = (fileInputId) =>
            {
                document.getElementById(fileInputId).click(); // Trigger file input click
            };

            // Function to handle the remove button click
            const handleRemoveButtonClick = (buttonsId, containerId) =>
            {
                const buttons = document.getElementById(buttonsId);
                const container = document.getElementById(containerId);
                const imageContainer = buttons.closest(".col-md-6");
                container.removeChild(imageContainer); // Remove the image section
            };

            // Function to add a new image upload section
            const addImageSection = (containerId) =>
            {
                imageCount++; // Increment the counter
                const container = document.getElementById(containerId);

                // Create the new image section dynamically
                const newImageSection = `
                    <div class="col-md-6">
                        <label for="fileInput${imageCount}" class="form-label">Secondary Images</label>
                        <div class="image-container">
                            <label for="fileInput${imageCount}" class="image-preview">
                                <img id="previewImage${imageCount}" src="{{ asset('Uploads/image_placeholder.jpg') }}" alt="Select an image">
                            </label>
                            <input type="file" name="Secondary_File[]" id="fileInput${imageCount}" accept="image/*" style="display: none;">
                            <div id="buttons${imageCount}" class="float-start mt-3" style="display: none;">
                                <button type="button" class="changeButton">Change</button>
                                <button type="button" class="removeButton">Remove</button>
                            </div>
                        </div>
                    </div>
                `;

                // Append the new section to the container
                container.insertAdjacentHTML("beforeend", newImageSection);

                // Add event listeners to the new section
                document.getElementById(`fileInput${imageCount}`).addEventListener("change", function ()
                {
                    handleFileChange(`fileInput${imageCount}`, `previewImage${imageCount}`, `buttons${imageCount}`);
                });

                document.getElementById(`buttons${imageCount}`).querySelector(".changeButton").addEventListener("click", function ()
                {
                    handleChangeButtonClick(`fileInput${imageCount}`);
                });

                document.getElementById(`buttons${imageCount}`).querySelector(".removeButton").addEventListener("click", function ()
                {
                    handleRemoveButtonClick(`buttons${imageCount}`, containerId);
                });
            };

            // Add initial event listeners for the first image section
            document.getElementById("fileInput1").addEventListener("change", function ()
            {
                handleFileChange("fileInput1", "previewImage1", "buttons1");
            });

            document.getElementById("buttons1").querySelector(".changeButton").addEventListener("click", function ()
            {
                handleChangeButtonClick("fileInput1");
            });

            document.getElementById("buttons1").querySelector(".removeButton").addEventListener("click", function ()
            {
                handleRemoveButtonClick("buttons1", "imageUploadContainer");
            });

            // Add event listener for the "Add Image" button
            document.getElementById("addImageButton").addEventListener("click", function ()
            {
                addImageSection("imageUploadContainer");
            });
        });

    </script>
@endpush