@extends('Admin.Layout.index')
@section('title', "Edit City")
@section('content')
@push('css')
    <link href="{{ asset('public/select2@4.1.0/dist/css/select2.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('public/Select2-Bootstrap-5-Theme/dist/select2-bootstrap-5-theme.min.css') }}" rel="stylesheet"/>
@endpush
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Edit City</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit City</li>
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
                                <i class="bx bx-user"></i> Edit City
                                <a href="{{ route('city.index') }}" class="btn btn-primary float-end">Back</a>
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <form class="row g-3 needs-validation" id="edit-form" method="post">
                                @csrf
                                <div class="col-md-6">
                                    <label for="Country_Id" class="form-label">Country Name</label>
                                    <select class="form-select" id="Country_Id" data-placeholder="Choose one thing" name="Country_Id">
                                        <option value="0">Select Country</option>
                                        @foreach($countries as $country_key => $country)
                                            <option value="{{ $country_key }}" {{ ($entity->Country_Id == $country_key) ? 'selected' : '' }}>{{ $country }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="State_Id" class="form-label">State Name</label>
                                    <select class="form-select" id="State_Id" data-placeholder="Choose one thing" name="State_Id"></select>
                                </div>
                                <div class="col-md-6">
                                    <label for="Name" class="form-label">Name</label>
                                    <input type="text" name="Name" class="form-control" id="Name" placeholder="Name" value="{{ old('Name', $entity->Name) }}">
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="Status" name="Status" {{ ($entity->Status == true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="Status">Status</label>
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
    <script src="{{ asset('public/select2@4.1.0/dist/js/select2.min.js') }}"></script>
    <script type="text/javascript">

        $(document).ready(function()
        {
            $( '#Country_Id' ).select2({
                theme : "bootstrap-5",
                width : $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
                placeholder : $( this ).data( 'placeholder' ),
            });

            $( '#State_Id' ).select2({
                theme : "bootstrap-5",
                width : $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
                placeholder : $( this ).data( 'placeholder' ),
            });

            $('#Country_Id').trigger('change');
        });

        $('#Country_Id').change(function(e)
        {
            e.preventDefault();
            Country_Id = $(this).val();
            const axios_request = sendAxiosRequest({
                url : "{{ route('city.axios_state') }}",
                data : { Country_Id : Country_Id },
            });

            axios_request.then(function (response)
            {
                if (response.status == 200)
                {
                    var Entity = @json($entity);
                    console.log(response , ' response');
                    const stateSelect = document.getElementById('State_Id');
                    stateSelect.innerHTML = '<option value="0">Select State</option>';
                    for (const [id, stateName] of Object.entries(response.data.entities))
                    {
                        const option = document.createElement('option');
                        option.value = id;
                        option.textContent = stateName;
                        if (Entity.State_Id == id)
                        {
                            option.selected = true;
                        }
                        stateSelect.appendChild(option);
                    }
                }
                else
                {
                    handleAxiosErrorResponse(response);
                }
            }).catch((error) => handleAxiosErrorRequest(error));
        });

        $('#edit-form').submit(function(e)
        {
            e.preventDefault()
            const formData = new FormData(this);
            formData.append('id',"{{ $entity->id }}")
            const data = Object.fromEntries(formData.entries());

            const axios_request = sendAxiosRequest({
                url : "{{ route('city.update') }}",
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