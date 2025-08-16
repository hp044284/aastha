@extends('Admin.Layout.index')
@section('title', "Create SEO Page")
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
      flex-direction: column;
      align-items: center;
      text-align: center;
      margin-top: 20px;
    }
    #primaryImage {
      max-width: 100%;
      height: auto;
      border-radius: 10px;
      margin-bottom: 10px;
    }
    #buttons {
      display: flex;
      gap: 10px;
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
            <div class="breadcrumb-title pe-3">SEO Pages</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Create SEO Page</li>
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
                                <i class="bx bx-search-alt"></i> Create SEO Page
                                <a href="{{ route('seo_page.index') }}" class="btn btn-primary float-end">Back</a>
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif      
                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif      
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form class="row g-3 needs-validation" id="create-form" method="post" enctype="multipart/form-data" action="{{ route('seo_page.store') }}">
                                @csrf
                                <div class="col-md-6">
                                    <label for="seoable_type" class="form-label">Seoable Type <span class="text-danger">*</span></label>
                                    <select name="seoable_type" class="form-select" id="seoable_type" required>
                                        <option value="">Select Type</option>
                                        <option value="page" >Page</option>  
                                        <option value="service">Service</option>
                                        <option value="product_category">Product Category</option>
                                        <option value="service_category">Service Category</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="seoable_id" class="form-label">Title <span class="text-danger">*</span></label>
                                    <select name="seoable_id" class="form-select" id="seoable_id" required>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" name="title" value="{{ old('title') }}" class="form-control" id="title">
                                </div>
                                <div class="col-md-6">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" name="slug" value="{{ old('slug') }}" class="form-control" id="slug">
                                </div>
                                <div class="col-md-6">
                                    <label for="meta_title" class="form-label">Meta Title</label>
                                    <input type="text" name="meta_title" value="{{ old('meta_title') }}" class="form-control" id="meta_title">
                                </div>
                                <div class="col-md-6">
                                    <label for="meta_description" class="form-label">Meta Description</label>
                                    <textarea name="meta_description" class="form-control" id="meta_description" rows="1">{{ old('meta_description') }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                    <textarea name="meta_keywords" class="form-control" id="meta_keywords" rows="1">{{ old('meta_keywords') }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="og_image" class="form-label">OG Image</label>
                                    <input type="file" name="og_image" class="form-control" id="og_image" accept="image/*">
                                    @if(old('og_image'))
                                        <div class="mt-2">
                                            <img src="{{ old('og_image') }}" alt="OG Image Preview" style="max-width: 100px; max-height: 100px;">
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    <label for="content" class="form-label">Content</label>
                                    <textarea name="content" class="form-control" id="content" rows="5">{{ old('content') }}</textarea>
                                </div>

                                <div class="col-md-6">
                                    <label for="robots_index" class="form-label">Robots Index</label>
                                    <select name="robots_index" id="robots_index" class="form-select">
                                        <option value="index" {{ old('robots_index', 'index') == 'index' ? 'selected' : '' }}>Index</option>
                                        <option value="noindex" {{ old('robots_index') == 'noindex' ? 'selected' : '' }}>Noindex</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="robots_follow" class="form-label">Robots Follow</label>
                                    <select name="robots_follow" id="robots_follow" class="form-select">
                                        <option value="follow" {{ old('robots_follow', 'follow') == 'follow' ? 'selected' : '' }}>Follow</option>
                                        <option value="nofollow" {{ old('robots_follow') == 'nofollow' ? 'selected' : '' }}>Nofollow</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label for="status" class="form-label d-block">Status</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="status" name="status" value="1" {{ old('status', '1') == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status">
                                            {{ old('status', '1') == '1' ? 'Active' : 'Inactive' }}
                                        </label>
                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const statusInput = document.getElementById('status');
                                        const statusLabel = document.querySelector('label[for="status"].form-check-label');
                                        function updateStatusLabel() {
                                            statusLabel.textContent = statusInput.checked ? 'Active' : 'Inactive';
                                        }
                                        statusInput.addEventListener('change', updateStatusLabel);
                                        updateStatusLabel();
                                    });
                                </script>
                                <div class="col-md-12">
                                    <div class="d-md-flex d-grid align-items-center gap-3 mt-4">
                                        <button type="submit" class="btn btn-primary px-4">
                                            <i class="bx bx-save"></i> Create SEO Page
                                        </button>
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
            CKEDITOR.replace( 'content',
            {
                height : 250,
                fullPage : true,
                allowedContent : true,
            });
        });

        $('#create-form').submit(function(e)
        {
            e.preventDefault();

            for (instance in CKEDITOR.instances)
            {
                CKEDITOR.instances[instance].updateElement();
            }

            const formData = new FormData(this);
            const axios_request = sendAxiosRequest({
                url : "{{ route('seo_page.store') }}",
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

        $('#seoable_type').change(function()
        {
            var seoable_type = $(this).val();
            const axios_request = sendAxiosRequest({
                url : "{{ route('seo_page.getType') }}",
                data : {
                    seoable_type : seoable_type
                },
                headers : "multipart/form-data",
            });

            axios_request.then(function (response)
            {
                if (response.status == 200)
                {
                    var message = response.data.message;
                    
                    // Clear the #title select and add new options from response.data.data
                    var options = '<option value="">Select Title</option>';
                    $.each(response.data.data, function(key, value) {
                        options += '<option value="' + value.Id + '">' + value.Title + '</option>';
                    });
                    $('#seoable_id').html(options);
                }
                else
                {
                    handleAxiosErrorResponse(response);
                }
            }).catch((error) => handleAxiosErrorRequest(error));
        });

    $('#seoable_id').change(function() 
    {
        var seoable_id = $(this).val();
        const axios_request = sendAxiosRequest({
            url: "{{ route('seo_page.getSeoableDetails') }}",
            data: {
                seoable_id: seoable_id,
                seoable_type: $('#seoable_type').val()
            },
            headers: "multipart/form-data",
        });

        axios_request.then(function(response) {
            if (response.status == 200) 
            {
                if(response.data.data) 
                {   
                    $('#slug').val(response.data.data.Slug);
                    $('#title').val(response.data.data.Title);
                    $('#meta_title').val(response.data.data.Meta_Title);
                    $('#meta_description').val(response.data.data.Meta_Description);
                    $('#meta_keywords').val(response.data.data.Meta_Keyword);
                    $('#content').val(response.data.data.Description);
                    $('#status').val(response.data.data.Status);
                }
            } 
            else 
            {
                handleAxiosErrorResponse(response);
            }
        }).catch((error) => handleAxiosErrorRequest(error));
    });
    </script>
@endpush
