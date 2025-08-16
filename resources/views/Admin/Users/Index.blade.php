@extends('Admin.Layout.index')
@section('title','Users')
@section('content')
@include('Admin.Elements.datatable-css')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Users</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Users List</li>
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
                                <table id="datatable" class="table table-striped table-bordered" data-table="datatable" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Gender</th>
                                            <th>Domain Name</th>
                                            <th>Register Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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
@include('Admin.Elements.datatable-js')
@push('js')
    <script type="text/javascript">
        $(document).ready(function()
        {
            $.ajaxSetup({
                headers : {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#datatable').DataTable({
                info : false,
                ajax : "{{route('user.axios_record')}}",
                order : [[ 0, "DESC" ]],
                bPaginate : true,
                processing : true,
                pageLength : 20,
                serverSide : true,
                responsive : true,
                lengthChange : false,
                serverMethod : 'post',
                initComplete : function(settings,json)
                {
                },
                columns : [
                    { data : 'id', name : 'id' },
                    { data : 'first_name', name : 'first_name' },
                    { data : 'last_name', name : 'last_name' },
                    { data : 'email', name : 'email' },
                    { data : 'mobile', name : 'mobile' },
                    { data : 'gender', name : 'gender' },
                    { data : 'domain_name', name : 'domain_name' },
                    { data : 'created_at', name : 'created_at' },
                    { data : 'action', name : 'action', orderable : false, searchable : false }
                ],
            });
        });
    </script>
@endpush