@extends('Admin.Layout.index')
@section('title', 'Create FAQ')
@section('content')

<div class="page-wrapper">
    <div class="page-content">
        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">FAQs</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="#"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create FAQ</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('faqs.index') }}" class="btn btn-primary ms-auto">Back</a>
        </div>

        <!-- Form Card -->
        <div class="card">
            <div class="card-header">Create FAQ</div>
            <div class="card-body">
                {!! html()->form('POST', route('faqs.store'))
                    ->attribute('id', 'create-form')
                    ->class('row g-3 needs-validation')
                    ->open() !!}

                    <div class="col-md-6">
                        {!! html()->label('Question')->for('question')->class('form-label') !!}
                        {!! html()->text('question')
                            ->id('question')
                            ->class('form-control')
                            ->placeholder('Enter your question')
                            ->required() !!}
                    </div>

                    <div class="col-md-6">
                        {!! html()->label('Answer')->for('answer')->class('form-label') !!}
                        {!! html()->textarea('answer')
                            ->id('answer')
                            ->class('form-control')
                            ->placeholder('Enter your answer')
                            ->required() !!}
                    </div>

                    <div class="form-check form-switch ms-3">
                        {!! html()->checkbox('status', true)
                            ->id('status')
                            ->class('form-check-input') !!}
                        {!! html()->label('Status')->for('status')->class('form-check-label') !!}
                    </div>

                    <div class="col-md-12">
                        {!! html()->button('Submit')
                            ->type('submit')
                            ->class('btn btn-primary px-4') !!}
                    </div>

                {!! html()->form()->close() !!}
            </div>
        </div>
    </div>
</div>

@endsection


@push('js')
<script type="text/javascript">
    $('#create-form').submit(function(e) {
        e.preventDefault()
        const formData = new FormData(this);
        const axios_request = sendAxiosRequest({
            url: "{{ route('faqs.store') }}",
            data: formData,
        });

        axios_request.then(function(response) {
            if (response.status == 200) {
                axiosToast('success', response.data.message);
                setTimeout(() => window.location.href = "{{ route('faqs.index') }}", 1000);
            } else {
                handleAxiosErrorResponse(response);
            }
        }).catch((error) => handleAxiosErrorRequest(error));
    });
</script>
@endpush
