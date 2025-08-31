<x-web.layout>
    <!-- Hero Section -->
    <section id="home" class="bg-gray py-5">
        <div class="container-fluid px-4">
            <!-- Page Title and Description -->
            <div class="row">
                <div class="col-lg-9">
                    <h1 class="display-4 fw-bold mb-3 fs-2 text-primary">Our Medical Team</h1>
                    <p class="lead text-muted mb-4">Meet our dedicated healthcare professionals committed to providing exceptional medical care.</p>
                </div>
                <div class="col-lg-3 text-lg-end text-md-start mt-4 mb-lg-0">
                    <a href="book-an-appointment" class="view-all-btn">
                        <i class="fas fa-calendar-days"></i> Book An Appointment
                    </a>
                </div>
            </div>
        </div>
    </section>

    @if(!empty($departments) && count($departments) > 0)
        @foreach($departments as $department)
            @php
                // $teams is a collection grouped by department_id
                $departmentTeams = (isset($teams[$department->id]) && !empty($teams[$department->id])) ? $teams[$department->id] : collect();
            @endphp

            @if($departmentTeams->count() > 0)
                <section class="py-5">
                    <div class="container-fluid">
                        <div class="department-section">
                            <h2 class="department-title">{{ ucfirst($department->name ?? '') }}</h2>
                            <p class="department-description">
                                Meet our dedicated team from the {{ ucfirst($department->name ?? '') }} department.
                            </p>
                            <div class="row g-4">
                                @foreach($departmentTeams as $team)
                                    <div class="col-lg-3 col-md-6">
                                        <div class="team-card">
                                            <img
                                                src="{{ !empty($team->file_name) ? asset('storage/' . $team->file_name) : 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=300&fit=crop&crop=face' }}"
                                                alt="{{ $team->name ?? 'Team Member' }}"
                                                class="team-image"
                                                onerror="this.onerror=null;this.src='{{ asset('Uploads/image_placeholder.jpg') }}';"
                                            >
                                            <div class="team-info">
                                                <h4 class="team-name">{{ $team->name ?? 'N/A' }}</h4>
                                                <p class="team-department">
                                                    {{ ucfirst($team->position->title ?? 'N/A') }}
                                                </p>
                                                <div class="team-experience">
                                                    @if(!empty($team->experience))
                                                        {{ $team->experience }} Years Experience
                                                    @else
                                                        Experience not specified
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        @endforeach
    @endif
</x-web.layout>