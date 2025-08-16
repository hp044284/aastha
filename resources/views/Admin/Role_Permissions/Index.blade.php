@extends('Admin.Layout.index')
@section('title','Role Permission')
@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Role Permission
            </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Role Permission</li>
                        <li class="breadcrumb-item active" aria-current="page">
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="main-body">
            <div class="row">
                <div class="col-xl-12 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered"style="width:100%">
                                    <thead>
                                        <tr>
                                            <td>Permission</td>
                                            <td>Read</td>
                                            <td>Add</td>
                                            <td>Edit</td>
                                            <td>Delete</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($Role_Permission_Count > 0)
                                            <tr>
                                                <td colspan="1">&nbsp;</td>
                                                <td>

                                                    <a href="{{ route('role_permission.update_all_permission', ['Status' => 'Is_Read', 'Role_Id' => $role_id]) }}" class="btn btn-primary">
                                                        All Status
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('role_permission.update_all_permission', ['Status' => 'Is_Add', 'Role_Id' => $role_id]) }}" class="btn btn-primary">
                                                        All Status
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('role_permission.update_all_permission', ['Status' => 'Is_Edit', 'Role_Id' => $role_id]) }}" class="btn btn-primary">
                                                        All Status
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('role_permission.update_all_permission', ['Status' => 'Is_Delete', 'Role_Id' => $role_id]) }}" class="btn btn-primary">
                                                        All Status
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endif
                                        @forelse($Role_Permissions as $Role_Permission_Key => $Role_Permission)
                                            @php
                                                $Permission_Name = $Role_Permission->Permission->Slug ?? '';
                                                $Can_Add = ($Role_Permission->Is_Add == 1) ? 1 : 0;
                                                $Can_Read = ($Role_Permission->Is_Read == 1) ? 1 : 0;
                                                $Can_Edit = ($Role_Permission->Is_Edit == 1) ? 1 : 0;
                                                $Can_Delete = ($Role_Permission->Is_Delete == 1) ? 1 : 0;
                                                $Permission_Id = $Role_Permission->id ?? 0;
                                            @endphp
                                            <tr>
                                                <td>
                                                    <span>
                                                        {{$Permission_Name}}
                                                    </span>
                                                </td>
                                                <td class="is_read site_permission_status_1_{{ $Permission_Id}}">
                                                    <a href="javascript:void(0)" onclick="Update_Permissions({{$role_id}},{{$Permission_Id}}, 1, {{$Can_Read}});">
                                                        <span class="btn btn-sm btn-{{ ($Role_Permission->Is_Read == 1) ? 'success' : 'danger' }}">
                                                            {{ ($Role_Permission->Is_Read == 1) ? 'Yes' : 'No' }}
                                                        </span>
                                                    </a>
                                                </td>
                                                <td class="is_add site_permission_status_2_{{ $Permission_Id}}">
                                                    <a href="javascript:void(0)" onclick="return Update_Permissions({{$role_id}},{{$Permission_Id}}, 2, {{$Can_Add}});">
                                                        <span class="btn btn-sm btn-{{ ($Role_Permission->Is_Add == 1) ? 'success' : 'danger' }}">
                                                            {{ ($Role_Permission->Is_Add == 1) ? 'Yes' : 'No' }}
                                                        </span>
                                                    </a>
                                                </td>
                                                <td class="is_edit site_permission_status_3_{{ $Permission_Id}}">
                                                    <a href="javascript:void(0)" onclick="return Update_Permissions({{$role_id}},{{$Permission_Id}}, 3, {{$Can_Edit}});">
                                                        <span class="btn btn-sm btn-{{ ($Role_Permission->Is_Edit == 1) ? 'success' : 'danger' }}">
                                                            {{ ($Role_Permission->Is_Edit == 1) ? 'Yes' : 'No' }}
                                                        </span>
                                                    </a>
                                                </td>
                                                <td class="is_delete site_permission_status_4_{{ $Permission_Id}}">
                                                    <a href="javascript:void(0)" onclick="return Update_Permissions({{$role_id}},{{$Permission_Id}}, 4, {{$Can_Delete}});">
                                                        <span class="btn btn-sm btn-{{ ($Role_Permission->Is_Delete == 1) ? 'success' : 'danger' }}">
                                                            {{ ($Role_Permission->Is_Delete == 1) ? 'Yes' : 'No' }}
                                                        </span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No record found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
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
        $(document).ready(function()
        {
            $.ajaxSetup({
                headers : {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        const Update_Permissions = (Role_Id,Permission_Id,Status,Current_Status) =>
        {
            const formData = {
                Status : Status,
                Role_Id : Role_Id,
                Permission_Id : Permission_Id,
                Current_Status : Current_Status
            };
            const axios_request = sendAxiosRequest({
                url : "{{ route('role_permission.update_status') }}",
                data : formData,
            });

            axios_request.then(function (response)
            {
                if (response.status == 200)
                {
                    $(".site_permission_status_"+Status+"_"+Permission_Id).html(response.data.Is_Html);
                }
                else
                {
                    handleAxiosErrorResponse(response);
                }
            }).catch((error) => handleAxiosErrorRequest(error));
        };
    </script>
@endpush