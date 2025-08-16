@extends('Admin.Layout.index')
@section('title', "Edit Service")
@section('content')
@push('css')
    <link href="{{ asset('FroalaEditor/css/froala_editor.pkgd.min.css') }}" rel="stylesheet"/>
@endpush
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
                                <a href="{{ route('service.index',['Random_Id' => $Hotel_Random_Id]) }}" class="btn btn-primary float-end">Back</a>
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <form class="row g-3 needs-validation" id="edit-form" method="post">
                                @csrf
                                <div class="col-md-6">
                                    <label for="Service_Name" class="form-label">Name</label>
                                    <input type="text" name="Service_Name" class="form-control" id="Service_Name" placeholder="Service Name" value="{{ old('Service_Name', $entity->Service_Name) }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="Price" class="form-label">Price</label>
                                    <input type="text" name="Price" class="form-control" id="Price" placeholder="Price" pattern="^\d+(\.\d{1,2})?$" title="Please enter a valid number (e.g., 10 or 10.2)" value="{{ old('Price', $entity->Price) }}">
                                </div>
                                <div class="col-md-6">
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
    <script src="{{ asset('FroalaEditor/js/froala_editor.pkgd.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(e)
        {
            new FroalaEditor('#Description');
        });

        $('#edit-form').submit(function(e)
        {
            e.preventDefault()
            const formData = new FormData(this);
            formData.append('id',"{{ $entity->id }}")
            const data = Object.fromEntries(formData.entries());

            const axios_request = sendAxiosRequest({
                url : "{{ route('service.update') }}",
                data : data,
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
    </script>
@endpush