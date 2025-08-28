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
                                    <td>{{ $caseStudy->id }}</td>
                                </tr>
                                <tr>
                                    <th>Title</th>
                                    <td>{{ $caseStudy->title }}</td>
                                </tr>
                                <tr>
                                    <th>Subtitle</th>
                                    <td>{{ $caseStudy->subtitle ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Age</th>
                                    <td>{{ $caseStudy->age ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Gender</th>
                                    <td>
                                        @if($caseStudy->gender)
                                            <span class="badge bg-info">{{ ucfirst($caseStudy->gender) }}</span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>{!! $caseStudy->description ?: '-' !!}</td>
                                </tr>
                                <tr>
                                    <th>Medical History</th>
                                    <td>{{ $caseStudy->medical_history ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Presenting Symptoms</th>
                                    <td>{{ $caseStudy->presenting_symptoms ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Duration of Symptoms</th>
                                    <td>{{ $caseStudy->duration_of_symptoms ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Risk Factor</th>
                                    <td>{{ $caseStudy->risk_factor ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Image</th>
                                    <td>
                                        @if($caseStudy->image)
                                            <img src="{{ asset('storage/' . $caseStudy->image) }}" alt="Case Study Image" class="img-thumbnail" style="max-height: 200px;">
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if($caseStudy->status)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ $caseStudy->created_at ? $caseStudy->created_at->format('d/m/Y h:i A') : '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Updated At</th>
                                    <td>{{ $caseStudy->updated_at ? $caseStudy->updated_at->format('d/m/Y h:i A') : '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
