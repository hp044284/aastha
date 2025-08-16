@extends('Admin.Layout.index')
@section('title', "Edit Permission")
@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Edit Permission</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Permission</li>
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
                                <i class="bx bx-user"></i> Edit Permission
                                <a href="{{ route('permission.index') }}" class="btn btn-primary float-end">Back</a>
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <form class="row g-3 needs-validation" id="edit-form" method="post">
                                @csrf
                                <div class="col-md-6">
                                    <label for="Name" class="form-label">Name</label>
                                    <input type="text" name="Name" class="form-control" id="Name" placeholder="Name" value="{{ old('Name', $entity->Name) }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="Slug" class="form-label">Slug</label>
                                    <input type="text" name="Slug" class="form-control" id="Slug" placeholder="Slug" value="{{ old('Slug', $entity->Slug) }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="Sort_Order" class="form-label">Sort Order</label>
                                    <input type="text" name="Sort_Order" class="form-control" id="Sort_Order" placeholder="Sort Order" pattern="^\d+$" title="Please enter a valid integer" value="{{ old('Sort_Order', $entity->Sort_Order) }}">
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
                url : "{{ route('permission.update') }}",
                data : formData,
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