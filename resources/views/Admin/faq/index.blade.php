@extends('Admin.Layout.index')
@section('title','FAQs')
@section('content')
@include('Admin.Elements.datatable-css')

@php
    $Auth_User = auth()->user();
    $Is_Add = $Auth_User->HasPermission('Faqs', 'Is_Add');
@endphp

<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">FAQs</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">FAQ List</li>
                    </ol>
                </nav>
            </div>
            @if($Is_Add)
                <div class="ms-auto">
                    <a href="{{ route('faqs.create') }}" class="btn btn-primary">Add</a>
                </div>
            @endif
        </div>
        <!--end breadcrumb-->
        <div class="main-body">
            <div class="row">
                <div class="col-xl-12 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Category</th>
                                            <th>Question</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
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
    $(document).ready(function() {
        $.ajaxSetup({
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#datatable').DataTable({
            info: false,
            ajax: "{{ route('faqs.axios_record') }}",
            order: [[ 0, "DESC" ]],
            bPaginate: true,
            processing: true,
            pageLength: 20,
            serverSide: true,
            responsive: true,
            lengthChange: false,
            serverMethod: 'post',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'category_id', name: 'category_id' },
                { data: 'question', name: 'question' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
        });

        $(document).on('click', '.status-button', function(e) {
            e.preventDefault();
            var button = $(this);
            var id = button.data('id');
            var currentStatus = button.data('status');
            var newStatus = (currentStatus === 'active') ? 'inactive' : 'active';

            const formData = {
                id: id,
                Status: (newStatus === 'active') ? 1 : 0,
            };

            const axios_request = sendAxiosRequest({
                url: "{{ route('faqs.status') }}",
                data: formData,
            });

            axios_request.then(function(response) {
                if (response.status == 200) {
                    button.text(newStatus.charAt(0).toUpperCase() + newStatus.slice(1));
                    button.removeClass('btn-success btn-danger').addClass(newStatus === 'active' ? 'btn-success' : 'btn-danger');
                    button.data('status', newStatus);
                    axiosToast('success', response.data.message);
                } else {
                    handleAxiosErrorResponse(response);
                }
            }).catch((error) => handleAxiosErrorRequest(error));
        });
    });
</script>
@endpush
