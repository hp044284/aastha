@extends('Admin.Layout.index')
@section('title', "Edit User")
@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Edit User</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit User</li>
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
                                <i class="bx bx-user"></i> Edit User
                                <a href="{{ route('user.index') }}" class="btn btn-primary float-end">Back</a>
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <form class="row g-3 needs-validation" id="edit-form" method="post">
                                @csrf
                                <div class="col-md-6">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First Name" value="{{ old('first_name', $entity->first_name) }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="last_name" value="{{ old('last_name', $entity->last_name) }}" id="last_name" placeholder="Last Name">
                                </div>
                                <div class="col-md-6">
                                    <label for="mobile" class="form-label">Mobile</label>
                                    <input type="text" class="form-control" id="mobile" value="{{ old('mobile', $entity->mobile) }}" placeholder="mobile" name="mobile" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" value="{{ old('email', $entity->email) }}" name="email" placeholder="Email" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select id="gender" class="form-select" required name="gender">
                                        <option disabled="" value="">Select Gender</option>
                                        <option value="Male" {{ ($entity->gender == 'Male') ? 'selected' : '' }} >Male</option>
                                        <option value="Female" {{ ($entity->gender == 'Female') ? 'selected' : '' }}>Female</option>
                                        <option value="Other" {{ ($entity->gender == 'Other') ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="domain_name" class="form-label">Domain Name</label>
                                    <input type="text" class="form-control" id="domain_name" placeholder="domain name" name="domain_name">
                                </div>
                                <div class="col-md-6">
                                    <label for="new_password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="new_password" placeholder="Password" name="new_password" autocomplete="new_password">
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
    <script type="text/javascript">

        $('#edit-form').submit(function(e)
        {
            e.preventDefault()
            const formData = new FormData(this);
            formData.append('id',"{{ $entity->id }}")
            const data = Object.fromEntries(formData.entries());

            const axios_request = sendAxiosRequest({
                url : "{{ route('user.update') }}",
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
                        window.location.reload();
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