@extends('Admin.Layout.index')
@section('title', "Edit Service")
@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Service</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Service</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">
                    Edit Service
                    <a href="{{ route('services.index') }}" class="btn btn-primary float-end">Back</a>
                </h5>
                <hr />
                <div class="form-body mt-4">
                    @include('Admin.services._form')
                    <!--end row-->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection