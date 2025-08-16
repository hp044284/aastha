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
                                    <td>{{ $specialization->id }}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $specialization->title }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if($specialization->status)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ $specialization->created_at ? $specialization->created_at->format('d/m/Y h:i A') : '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
