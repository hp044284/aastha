@extends('Admin.Layout.index')
@section('title','Permissions')
@section('content')
@push('css')
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css">
@endpush
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Permissions
            </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Permissions List</li>
                        <li class="breadcrumb-item active" aria-current="page">
                        </li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('permission.create') }}" class="btn btn-primary float-end">Add</a>
        </div>
        <!--end breadcrumb-->
        <div class="main-body">
            <div class="row">
                <div class="col-xl-12 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-striped table-bordered" data-table="datatable" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Sort Order</th>
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
@push('js')
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js"></script>
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
                ajax : {
                    url : "{{ route('permission.axios_record') }}",
                    method : 'POST',
                    data : function(d)
                    {
                        d.Random_Id = 0;
                    }
                },
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
                    { data : 'Name', name : 'Name' },
                    { data : 'Slug', name : 'Slug' },
                    { data : 'Sort_Order', name : 'Sort_Order' },
                    { data : 'action', name : 'action', orderable : false, searchable : false }
                ],
            });
        });

        function Delete_Entity(id)
        {
           $.confirm({
                title : 'Confirm!',
                content : 'Are sure you want to delete',
                buttons : {
                    cancel : function ()
                    {

                    },
                    confirm : function ()
                    {
                        const axios_request = sendAxiosRequest({
                            url : "{{ route('permission.delete') }}",
                            data : { id : id },
                        });

                        axios_request.then(function (response)
                        {
                            if (response.status == 200)
                            {
                                var message = response.data.message;
                                axiosToast('success', message);
                                $('#datatable').DataTable().ajax.reload();
                            }
                            else
                            {
                                handleAxiosErrorResponse(response);
                            }
                        }).catch((error) => handleAxiosErrorRequest(error));
                    },
                }
           });

        }
    </script>
@endpush