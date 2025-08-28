@extends('Admin.Layout.index')
@section('title','Pages')
@section('content')
@include('Admin.Elements.datatable-css')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Pages
            </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Pages List</li>
                        <li class="breadcrumb-item active" aria-current="page">
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <a href="{{ route('page.create') }}" class="btn btn-primary">Add</a>
            </div>
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
                                            <th>Title</th>
                                            <th>Menu Display</th>
                                            <th>Status</th>
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
                ajax : {
                    url : "{{ route('page.axios_record') }}",
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
                    { data : 'Title', name : 'Title' },
                    { data : 'Menu_Display', name : 'Menu_Display' },
                    { data : 'Status', name : 'Status' },
                    { data : 'action', name : 'action', orderable : false, searchable : false }
                ],
            });

            $(document).on('click', '.status-button', function(e)
            {
                var button = $(this);
                var id = button.data('id');
                var CurrentStatus = button.data('status');
                var NewStatus = (CurrentStatus === 'active') ? 'inactive' : 'active';

                var CurrentText = button.text();
                var CurrentClass = button.attr('class');

                e.preventDefault()
                const formData = {
                    id : id,
                    Status : (NewStatus === 'active') ? 1 : 0,
                };

                const axios_request = sendAxiosRequest({
                    url : "{{ route('page.status') }}",
                    data : formData,
                });

                axios_request.then(function (response)
                {
                    if (response.status == 200)
                    {
                        button.text(NewStatus.charAt(0).toUpperCase() + NewStatus.slice(1));
                        button.removeClass('btn-success btn-danger').addClass(NewStatus === 'active' ? 'btn-success' : 'btn-danger');
                        button.data('status', NewStatus);
                        var message = response.data.message;
                        axiosToast('success', message);
                    }
                    else
                    {
                        button.text(CurrentText);
                        button.attr('class', CurrentClass);
                        button.data('status', CurrentStatus);
                        handleAxiosErrorResponse(response);
                    }
                }).catch((error) => handleAxiosErrorRequest(error));
            });
        });
    </script>
@endpush