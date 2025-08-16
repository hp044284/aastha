@extends('Admin.Layout.index')
@section('title','Reviews')
@section('content')
@include('Admin.Elements.datatable-css')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Reviews
            </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Reviews List</li>
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
                                <table id="datatable" class="table table-striped table-bordered" data-table="datatable" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Review Type</th>
                                            <th>Review Status</th>
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
                    url : "{{ route('review.axios_record') }}",
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
                    { data : 'Email', name : 'Email' },
                    { data : 'Status', name : 'Status' },
                    { data : 'Review_Type', name : 'Review_Type' },
                    { data : 'Review_Status', name : 'Review_Status' },
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
                    url : "{{ route('review.status') }}",
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
                            url : "{{ route('review.delete') }}",
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

        function Approve_Or_Reject(id , type , review_type = 'Blog')
        {
            $.confirm({
                title : 'Confirm!',
                content : 'Are sure you want to ' +type,
                buttons : {
                    cancel : function ()
                    {

                    },
                    confirm : function ()
                    {
                        const axios_request = sendAxiosRequest({
                            url : "{{ route('review.axios_approve_reject') }}",
                            data : { id : id , Review_Status : type , Review_Type : review_type},
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

        function Reply_Review(id)
        {
            $.confirm({
                title : 'Confirm!',
                content : 'Are you sure you want to reply to this review?',
                buttons : {
                    cancel : function ()
                    {
                        // No action needed for cancel
                    },
                    confirm : function ()
                    {
                        var self = this; // Reference the modal instance

                        // Change the modal content dynamically
                        self.setContent(`
                            <label for="message" class="mb-3">Please provide additional information :</label>
                            <textarea class="form-control" id="message" rows="4" cols="50"></textarea>
                        `);

                        // Modify the confirm button action dynamically
                        self.buttons.confirm.setText('Submit'); // Change button text to "Submit"
                        self.buttons.confirm.action = function ()
                        {
                            var message = $('#message').val(); // Get the value from the textarea

                            if (!message.trim())
                            {
                                axiosToast('error', 'Message is required!');
                                return false; // Prevent closing the dialog
                            }

                            // Make an Axios request with the additional input
                            const axios_request = sendAxiosRequest({
                                url : "{{ route('review.reply_review') }}",
                                data : {
                                    id : id,
                                    Message : message,
                                },
                            });

                            axios_request
                            .then(function (response)
                            {
                                if (response.status == 200)
                                {
                                    axiosToast('success', response.data.message);
                                    $('#datatable').DataTable().ajax.reload();
                                    self.close(); // Close the dialog on success
                                }
                                else
                                {
                                    handleAxiosErrorResponse(response);
                                }
                            })
                            .catch((error) => handleAxiosErrorRequest(error));
                        };
                        return false;
                    },
                },
            });
        }
    </script>
@endpush