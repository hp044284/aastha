@extends('Admin.Layout.index')
@section('title','Specializations')
@section('content')
@include('Admin.Elements.datatable-css')
@php
    $Auth_User = auth()->user();
    $Is_Add = $Auth_User->HasPermission('Specializations', 'Is_Add');
@endphp
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Specializations
            </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Specializations List</li>
                        <li class="breadcrumb-item active" aria-current="page">
                        </li>
                    </ol>
                </nav>
            </div>
            @if($Is_Add)
                <div class="ms-auto">
                    <a href="{{ route('specializations.create') }}" class="btn btn-primary">Add</a>
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
                                {!! $dataTable->table(['class' => 'table table-striped table-bordered', 'style' => 'width:100%']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
</div>
<!-- Offcanvas Right Modal for Specializations -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="specializationOffcanvas" aria-labelledby="specializationOffcanvasLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="specializationOffcanvasLabel">Specialization Details</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <!-- Content will be loaded dynamically via JS -->
        <div id="specializationOffcanvasContent">
            <div class="text-center py-5">
                <div class="spinner-border text-primary" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    // Example: Open offcanvas and load specialization details via AJAX
    const showSpecializationOffcanvas = (specializationId) => {
        showDynamicComponent(
            'specializationOffcanvas', // offcanvas ID
            'specializationOffcanvasContent', // content container ID
            `{{ route('specializations.show', ':id') }}`.replace(':id', specializationId),
            'offcanvas'
        );
    };
</script>
@endpush

@endsection
@include('Admin.Elements.datatable-js')
@push('js')
    {!! $dataTable->scripts() !!}
@endpush