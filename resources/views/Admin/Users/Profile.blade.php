@extends('Admin.Layout.index')
@section('title', "Profile")
@section('content')
@php
    $User_Data = Get_User($AuthUser->id ?? 0);
@endphp
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">User Profile</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">User Profile</li>
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
                            <h5 class="mb-0">Profile update</h5>
                        </div>
                        <div class="card-body p-4">
                            <form class="row g-3 needs-validation" id="user-profile" enctype="multipart/form-data">
                                <div class="col-md-6">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First Name" value="{{ old('first_name', $User_Data->first_name) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="last_name" value="{{ old('last_name', $User_Data->last_name) }}" id="last_name" placeholder="Last Name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="mobile" class="form-label">Mobile</label>
                                    <input type="text" class="form-control" id="mobile" value="{{ old('mobile', $User_Data->mobile) }}" placeholder="mobile" name="mobile" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" value="{{ old('email', $User_Data->email) }}" name="email" placeholder="Email" required>
                                </div>
                                <div class="file-upload-wrapper">
                                    <img src="{{ asset('Uploads/users/' . $User_Data->File_Name) }}" class="img-preview" style="width: 120px; height: 120px; object-fit: cover;">
                                    <input type="file" name="File_Name" class="d-none" accept="image/*">
                                    <div class="action-buttons mt-2 d-flex gap-2">
                                        <button type="button" class="btn btn-sm btn-secondary change-btn">Change</button>
                                        <button type="button" class="btn btn-sm btn-danger remove-btn">Remove</button>
                                    </div>
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
<script src="{{ asset('assets/js/global-file-input-manager.js') }}"></script>

<script type="text/javascript">

        $('#user-profile').submit(function(e)
        {
            e.preventDefault();
            const formData = new FormData(this);

            axios({
                method: 'post',
                url: "{{ route('user.update_profile') }}",
                data: formData,
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            .then(function (response)
            {
                console.log(response);
                if (response.status == 200)
                {
                    var message = response.data.message;
                    axiosToast('success', message);
                    setTimeout(function()
                    {
                        // window.location.reload();
                    }, 1000);
                }
                else
                {
                    handleAxiosErrorResponse(response);
                }
            })
            .catch((error) => handleAxiosErrorRequest(error));
        });

        document.addEventListener("DOMContentLoaded", () => {
            new FileInputManager({
                selector: '.file-upload-wrapper',
                placeholder: '{{ asset('Uploads/image_placeholder.jpg') }}'
            });
        });
    </script>
@endpush