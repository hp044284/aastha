@extends('Admin.Layout.index')
@section('title','SEO Pages')
@section('content')
@include('Admin.Elements.datatable-css')
@php
    $Auth_User = auth()->user();
    // You can add permission checks here if needed, e.g. $Is_Add = $Auth_User->HasPermission('SEO_Pages', 'Is_Add');
@endphp
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">SEO Pages</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">SEO Pages List</li>
                        <li class="breadcrumb-item active" aria-current="page"></li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('seo_page.create') }}" class="btn btn-primary float-end">
                <i class="bx bx-plus"></i> Add New SEO Page
            </a>
        </div>
        <!--end breadcrumb-->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif  
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif  
        <div class="main-body">
            <div class="row">
                <div class="col-xl-12 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-striped table-bordered" data-table="datatable" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Random Id</th>       
                                            <th>Seoable Type</th>
                                            <th>Seoable Id</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Updated At</th> 
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($seoPages as $seoPage)
                                            <tr>
                                                <td>{{ $seoPage->random_id }}</td>
                                                <td>{{ $seoPage->seoable_type }}</td>
                                                <td>{{ $seoPage->seoable_id }}</td>
                                                <td>{{ $seoPage->status ? 'Active' : 'Inactive' }}</td>
                                                <td>{{ $seoPage->created_at->format('d-m-Y H:i:s') }}</td>
                                                <td>{{ $seoPage->updated_at->format('d-m-Y H:i:s') }}</td>
                                                <td>
                                                    <a href="{{ route('seo_page.edit', $seoPage->id) }}" class="btn btn-primary">Edit</a>
                                                    <a href="{{ route('seo_page.destroy', $seoPage->id) }}" class="btn btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
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

