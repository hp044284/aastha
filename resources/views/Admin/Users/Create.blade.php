@extends('Admin.Layout.index')
@section('title', "Create User")
@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">User</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Create User</li>
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
                                <i class="bx bx-user"></i> Create User
                                <a href="{{ route('user.index') }}" class="btn btn-primary float-end">Back</a>
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <form class="row g-3 needs-validation" id="create-form" method="post">
                                @csrf
                                <div class="col-md-6">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First Name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="mobile" class="form-label">Mobile</label>
                                    <input type="text" class="form-control" id="mobile" placeholder="mobile" name="mobile" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                                <div class="col-md-6">
                                    <label for="confirm_password" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                                </div>
                                <div class="col-md-6">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select id="gender" class="form-select" required name="gender">
                                        <option disabled="" value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="domain_name" class="form-label">Domain Name</label>
                                    <input type="text" class="form-control" id="domain_name" placeholder="domain name" name="domain_name">
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="status" name="status">
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

        $('#create-form').submit(function(e)
        {
            e.preventDefault()
            const formData = new FormData(this);
            const data = Object.fromEntries(formData.entries());

            const axios_request = sendAxiosRequest({
                url : "{{ route('user.store') }}",
                data : data,
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
    </script>
@endpush