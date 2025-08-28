@extends('Admin.Layout.index')
@section('title', "Create Case Study")
@section('content')

<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Case Studies</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('case-studies.index') }}">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Create Case Study</li>
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
                                <i class="bx bx-book-content"></i> Create Case Study
                                <a href="{{ route('case-studies.index') }}" class="btn btn-primary float-end">Back</a>
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            @include('Admin.case-studies._form')
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
</div>
@endsection