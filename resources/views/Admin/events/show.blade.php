@extends('Admin.Layout.index')
@section('title', "Event Details")
@section('content')

<div class="row">
    <div class="col-xl-12 mx-auto">
        <div class="card">
            <div class="card-header px-4 py-3">
                <h5 class="mb-0">
                    <i class="bx bx-calendar-event"></i> Event Details
                    <a href="{{ route('events.index') }}" class="btn btn-primary float-end">Back</a>
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Event Title</h6>
                        <p class="text-muted">{{ $event->title }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6>Status</h6>
                        <p class="text-muted">
                            @if($event->status)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </p>
                    </div>
                    <div class="col-md-6">
                        <h6>Created At</h6>
                        <p class="text-muted">{{ $event->created_at->format('d/m/Y h:i A') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
