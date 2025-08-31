@extends('Admin.Layout.index')
@section('title','Team Member Details')
@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Team Member Details
            </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('teams.index') }}">Team Members</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $team->name }}</li>
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
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <div class="mb-3">
                                        @if($team->file_name)
                                            <img src="{{ asset('storage/' . $team->file_name) }}" 
                                                 alt="{{ $team->name }}" class="img-fluid rounded-circle" 
                                                 style="width: 200px; height: 200px; object-fit: cover;">
                                        @else
                                            <img src="{{ asset('images/default-avatar.jpg') }}" 
                                                 alt="Default Avatar" class="img-fluid rounded-circle" 
                                                 style="width: 200px; height: 200px; object-fit: cover;">
                                        @endif
                                    </div>
                                    <h4 class="mb-2">{{ $team->name }}</h4>
                                    @if($team->position)
                                        <p class="text-muted mb-2">{{ $team->position->title }}</p>
                                    @endif
                                    @if($team->department)
                                        <p class="text-muted mb-3">{{ $team->department->name }}</p>
                                    @endif
                                    
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('teams.edit', $team->id) }}" class="btn btn-primary btn-sm">
                                            <i class="bx bx-edit"></i> Edit
                                        </a>
                                        <a href="{{ route('teams.index') }}" class="btn btn-secondary btn-sm">
                                            <i class="bx bx-arrow-back"></i> Back
                                        </a>
                                    </div>
                                </div>
                                
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Name:</label>
                                                <p class="form-control-plaintext">{{ $team->name }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Status:</label>
                                                <p class="form-control-plaintext">
                                                    @if($team->status)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-danger">Inactive</span>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    @if($team->experience)
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Experience:</label>
                                            <p class="form-control-plaintext">{{ $team->experience }}</p>
                                        </div>
                                    @endif

                                    @if($team->department)
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Department:</label>
                                            <p class="form-control-plaintext">{{ $team->department->name }}</p>
                                        </div>
                                    @endif

                                    @if($team->position)
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Position:</label>
                                            <p class="form-control-plaintext">{{ $team->position->title }}</p>
                                        </div>
                                    @endif

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Created At:</label>
                                                <p class="form-control-plaintext">{{ $team->created_at->format('d/m/Y h:i A') }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Last Updated:</label>
                                                <p class="form-control-plaintext">{{ $team->updated_at->format('d/m/Y h:i A') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
