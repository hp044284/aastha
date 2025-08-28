@extends('Admin.Layout.index')
@section('title','Create News')
@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">News</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('news.index') }}">News</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Create News</li>
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
                            <h5 class="card-title">Create News</h5>
                            @include('Admin.news._form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
