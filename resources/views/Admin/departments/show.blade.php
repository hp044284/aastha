<div class="containerh">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-0 w-100">
                            <tbody>
                                <tr>
                                    <th style="width: 25%;">ID</th>
                                    <td>{{ $department->id }}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $department->name }}</td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ $department->created_at ? $department->created_at->format('d/m/Y h:i A') : '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Updated At</th>
                                    <td>{{ $department->updated_at ? $department->updated_at->format('d/m/Y h:i A') : '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
