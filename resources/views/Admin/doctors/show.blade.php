<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-0 w-100">
                            <tbody>
                                <tr>
                                    <th style="width: 25%;">ID</th>
                                    <td>{{ $doctor->id }}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $doctor->name }}</td>
                                </tr>
                                <tr>
                                    <th>Position</th>
                                    <td>{{ $doctor->position->title ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Affiliation</th>
                                    <td>{{ $doctor->affiliation ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if($doctor->status)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ $doctor->created_at ? $doctor->created_at->format('d/m/Y h:i A') : '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Profile Image</th>
                                    <td>
                                        @if($doctor->image)
                                            <img src="{{ asset('storage/' . $doctor->image) }}" alt="{{ $doctor->name }}" style="max-width: 120px; max-height: 120px;">
                                        @else
                                            <span class="text-muted">No image</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>About</th>
                                    <td>{!! $doctor->about_us ?? '<span class="text-muted">-</span>' !!}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
