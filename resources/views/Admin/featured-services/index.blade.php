@extends('Admin.Layout.index')
@section('title','Featured Services')
@section('content')
@include('Admin.Elements.datatable-css')
@php
    $Auth_User = auth()->user();
    $Is_Add = $Auth_User->HasPermission('Featured_Services', 'Is_Add');
@endphp
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Featured Services</div>
            <div class="ps-3 flex-grow-1">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Featured Services List</li>
                    </ol>
                </nav>
            </div>
            @if($Is_Add)
                <div class="ms-auto">
                    <a href="{{ route('featured-services.create') }}" class="btn btn-primary">Add</a>
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
                                <table id="datatable" class="table table-striped table-bordered" data-table="datatable" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Title</th>
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
                    url : "{{ route('featured-services.axios_record') }}",
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
                    { data : 'title', name : 'title' },
                    { data : 'status', name : 'status' },
                    { data : 'action', name : 'action', orderable : false, searchable : false }
                ],
            });

            /**
             * Handle status toggle for featured services in a professional and robust manner.
             */
            $(document).on('click', '.status-button', function (e) 
            {
                e.preventDefault();

                const $button = $(this);
                const id = $button.data('id');
                const currentStatus = $button.data('status');
                const newStatus = (currentStatus === 'active') ? 'inactive' : 'active';

                // Preserve current UI state in case of error
                const originalText = $button.text();
                const originalClass = $button.attr('class');

                // Prepare request payload
                const payload = {
                    id: id,
                    status: (newStatus === 'active') ? 1 : 0,
                };

                // Send status update request
                sendAxiosRequest({
                    url: "{{ route('featured-services.status') }}",
                    data: payload,
                })
                .then(function (response) {
                    if (response.status === 200) {
                        // Update button UI to reflect new status
                        $button
                            .text(newStatus.charAt(0).toUpperCase() + newStatus.slice(1))
                            .removeClass('btn-success btn-danger')
                            .addClass(newStatus === 'active' ? 'btn-success' : 'btn-danger')
                            .data('status', newStatus);

                        axiosToast('success', response.data.message || 'Status updated successfully.');
                    } else {
                        // Revert UI on unexpected response
                        $button.text(originalText).attr('class', originalClass).data('status', currentStatus);
                        handleAxiosErrorResponse(response);
                    }
                })
                .catch(function (error) {
                    // Revert UI on error
                    $button.text(originalText).attr('class', originalClass).data('status', currentStatus);
                    handleAxiosErrorRequest(error);
                });
            });
        });

        /**
         * Prompt the user for confirmation and handle the deletion of a featured service entity.
         * Uses a modal dialog for confirmation and provides user feedback on success or error.
         * @param {number} id - The ID of the entity to delete.
         */
        function Delete_Entity(id) {
            $.confirm({
                title: 'Delete Confirmation',
                content: 'Are you sure you want to delete this featured service? This action cannot be undone.',
                type: 'red',
                icon: 'fa fa-exclamation-triangle',
                buttons: {
                    cancel: {
                        text: 'Cancel',
                        btnClass: 'btn-secondary',
                        action: function () {
                            // No action needed on cancel
                        }
                    },
                    confirm: {
                        text: 'Delete',
                        btnClass: 'btn-danger',
                        action: function () {
                            sendAxiosRequest({
                                url: "{{ route('featured-services.delete') }}",
                                data: { id: id },
                            })
                            .then(function (response) {
                                if (response.status === 200) {
                                    axiosToast('success', response.data.message || 'Featured service deleted successfully.');
                                    $('#datatable').DataTable().ajax.reload(null, false);
                                } else {
                                    handleAxiosErrorResponse(response);
                                }
                            })
                            .catch(function (error) {
                                handleAxiosErrorRequest(error);
                            });
                        }
                    }
                }
            });
        }
    </script>
@endpush