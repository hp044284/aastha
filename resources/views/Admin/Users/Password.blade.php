@extends('Admin.Layout.index')
@section('title', "Password")
@section('content')
@php
    $User_Data = Get_User($AuthUser->id ?? 0);
@endphp
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Change password</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Change password</li>
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
                            <h5 class="mb-0">Change Password</h5>
                        </div>
                        <div class="card-body p-4">
                            <form class="row g-3 needs-validation" id="user-password">
                                <div class="col-md-6">
                                    <label for="old_password" class="form-label">Old Password</label>
                                    <input type="text" name="old_password" class="form-control" id="old_password" placeholder="Enter old password" minlength="8" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="new_password" class="form-label">New Password</label>
                                    <input type="text" class="form-control" name="new_password" id="new_password" placeholder="Enter new password" minlength="8" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="confirm_password" class="form-label">Confirm password</label>
                                    <input type="text" class="form-control" id="confirm_password" placeholder="Enter confirm password" name="new_password_confirmation" minlength="8" required>
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

        $('#user-password').submit(function(e)
        {
            e.preventDefault()
            const newPassword = $('#new_password').val();
            const confirmPassword = $('#confirm_password').val();

            if (newPassword.length < 8)
            {
                axiosToast('error', 'New Password must be at least 8 characters long.');
                return
            }

            if (confirmPassword.length < 8)
            {
                axiosToast('error', 'Confirm Password must be at least 8 characters long.');
                return
            }

            if (newPassword !== confirmPassword)
            {
                axiosToast('warning', 'New Password and Confirm Password do not match!');
                return;
            }

            const formData = new FormData(this);
            const data = Object.fromEntries(formData.entries());

            const axios_request = sendAxiosRequest({
                url : "{{ route('user.update_password') }}",
                data : data,
            });

            axios_request.then(function (response)
            {
                console.log(response);
                if (response.status == 200)
                {
                    var message = response.data.message;
                    axiosToast('success', message);
                    setTimeout(function()
                    {
                        window.location.replace(response.data.redirect);
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