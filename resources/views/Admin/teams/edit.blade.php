@extends('Admin.Layout.index')
@section('title','Edit Team Member')
@section('content')
@php
    $Auth_User = auth()->user();
    $Is_Edit = $Auth_User->HasPermission('Teams', 'Is_Edit');
@endphp
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Edit Team Member
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
                        <li class="breadcrumb-item active" aria-current="page">Edit {{ $team->name }}</li>
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
                            {!! html()->model($team)->form('POST', route('teams.update', $team->id))->attribute('enctype', 'multipart/form-data')->open() !!}
                                @method('PUT')
                                @include('Admin.teams._form')
                            {!! html()->form()->close() !!}
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
</div>
@endsection
