<x-web.layout>
<!-- Doctor Header -->
<section class="doctor-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 text-center mb-4 mb-md-0">
                <img 
                    src="{{ asset('storage/' . $doctor->image) }}" 
                    alt="{{ $doctor->name }}" 
                    class="doctor-image"
                    onerror="this.onerror=null;this.src='https://ui-avatars.com/api/?name={{ urlencode($doctor->name) }}&background=eee&color=555&size=200';"
                >
            </div>
            <div class="col-lg-9 col-md-8">
                <div class="doctor-info">
                    <h1>{{ $doctor->name }}</h1>
                    <p class="department">
                        {{ $doctor->position->title ?? $doctor->designation ?? $doctor->department ?? '' }}
                    </p>
                    <p class="hospital-name">
                        <i class="fas fa-hospital me-2"></i>
                        {{ $doctor->affiliation ?? 'Aastha Hospital' }}
                    </p>
                    <div class="info-badges">
                        <span class="info-badge">
                            <i class="fas fa-clock me-2"></i>
                            {{ $doctor->availability ?? 'By Appointment' }}
                        </span>
                        @if(!empty($doctor->experience))
                        <span class="info-badge">
                            <i class="fas fa-user-md me-2"></i>
                            {{ $doctor->experience }} Years Experience
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="py-5 bg-light-gray">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                @if(!empty($doctor->about_us))
                    <!-- About Section -->
                    <div class="profile-section-card">
                        <h3 class="profile-section-title">
                            <i class="fas fa-user"></i> About Dr. {{ $doctor->name }}
                        </h3>
                        @if(!empty($doctor->about_us))
                            <p class="about-text">
                                {!! $doctor->about_us !!}
                            </p>
                        @else
                            <p class="about-text text-muted">
                                Information about Dr. {{ $doctor->name }} is not available at the moment.
                            </p>
                        @endif
                    </div>
                @endif

                @if($doctor->education && $doctor->education->count())
                    <!-- Education Section -->
                    <div class="profile-section-card">
                        <h3 class="profile-section-title"><i class="fas fa-graduation-cap"> </i> Education</h3>
                        @if($doctor->education && $doctor->education->count())
                            @foreach($doctor->education as $edu)
                                <div class="education-item">
                                    <h5>{{ $edu->degree }}</h5>
                                    <p class="institution">{{ $edu->institution }}</p>
                                    <p class="year">
                                        @if($edu->start_year && $edu->end_year)
                                            {{ $edu->start_year }} - {{ $edu->end_year }}
                                        @elseif($edu->start_year)
                                            {{ $edu->start_year }}
                                        @elseif($edu->end_year)
                                            {{ $edu->end_year }}
                                        @else
                                            &nbsp;
                                        @endif
                                    </p>
                                </div>
                            @endforeach
                        @else
                            <p class="text-muted">No education information available.</p>
                        @endif
                    </div>
                @endif

                @if($doctor->positions && $doctor->positions->count())
                    <!-- Titles and Positions Section -->
                    <div class="profile-section-card">
                        <h3 class="profile-section-title"><i class="fas fa-award"> </i> Titles and Positions</h3>
                        @foreach($doctor->positions as $position)
                            <div class="position-item">
                                <h5>{{ $position->position_title ?? '' }}</h5>
                                <p class="organization">{{ $position->organization ?? '' }}</p>
                                <p class="duration">
                                    @if($position->start_year && $position->end_year)
                                        {{ $position->start_year }} - {{ $position->end_year }}
                                    @elseif($position->start_year)
                                        {{ $position->start_year }}
                                    @elseif($position->end_year)
                                        {{ $position->end_year }}
                                    @else
                                        &nbsp;
                                    @endif
                                </p>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Hospital Affiliations Section -->
                @if($doctor->affiliations && $doctor->affiliations->count())
                    <div class="profile-section-card">
                        <h3 class="profile-section-title"><i class="fas fa-hospital"> </i> Hospital Affiliations</h3>
                        @foreach($doctor->affiliations as $affiliation)
                            <div class="affiliation-item">
                                <h5>{{ $affiliation->organization ?? '' }}</h5>
                                <p class="hospital">{{ $affiliation->affiliation_type ?? '' }}</p>
                                <p class="role">{{ $affiliation->role_title ?? '' }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif

                @if($doctor->specializations && $doctor->specializations->count())
                    <!-- Specialization Section -->
                    <div class="profile-section-card">
                        <h3 class="profile-section-title">
                            <i class="fas fa-stethoscope"> </i> Specialization
                        </h3>
                        <div class="specialization-tags">
                            @foreach($doctor->specializations as $specialization)
                                <span class="specialization-tag">{{ $specialization->title ?? '' }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif
                
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Appointment Card -->
                <div class="appointment-card">
                    <h4><i class="fas fa-calendar-check me-2"></i>Book Appointment</h4>
                    <p class="mb-3">Schedule your consultation with Dr. Nitin Busar</p>
                    <a class="btn btn-lg w-100 mb-3" target="_blank" href="book-an-appointment"> <i class="fas fa-calendar-plus me-2"></i>Book An Appointment </a>
                    <div class="contact-info">
                        <p class="mb-2"><i class="fas fa-phone me-2"></i>+91 98765 43210</p>
                        <p class="mb-0"><i class="fas fa-envelope me-2"></i>info@aasthamultispecialityhospital.in</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
  
</x-web.layout>