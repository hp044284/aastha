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

    <section class="py-5">
                <div class="container-fluid">
                    <div class="department-section">
                        <h2 class="department-title">Leadership Team</h2>
                        <p class="department-description">Our experienced leadership team guides Aastha Hospital with vision and expertise.</p>
                        
                        <div class="row g-4">
                            <div class="col-lg-3 col-md-6">
                                <div class="team-card">
                                    <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=400&h=300&fit=crop&crop=face" alt="Dr. Rajesh Kumar" class="team-image">
                                    <div class="team-info">
                                        <h4 class="team-name">Dr. Rajesh Kumar</h4>
                                        <p class="team-department">Chief Executive Officer</p>
                                        <div class="team-experience">25+ Years Experience</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <div class="team-card">
                                    <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=300&fit=crop&crop=face" alt="Dr. Priya Sharma" class="team-image">
                                    <div class="team-info">
                                        <h4 class="team-name">Dr. Priya Sharma</h4>
                                        <p class="team-department">Chief Medical Officer</p>
                                        <div class="team-experience">20+ Years Experience</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <div class="team-card">
                                    <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=300&fit=crop&crop=face" alt="Ms. Anjali Patel" class="team-image">
                                    <div class="team-info">
                                        <h4 class="team-name">Ms. Anjali Patel</h4>
                                        <p class="team-department">Chief Nursing Officer</p>
                                        <div class="team-experience">18+ Years Experience</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <div class="team-card">
                                    <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=300&fit=crop&crop=face" alt="Dr. Priya Sharma" class="team-image">
                                    <div class="team-info">
                                        <h4 class="team-name">Dr. Priya Sharma</h4>
                                        <p class="team-department">Chief Medical Officer</p>
                                        <div class="team-experience">20+ Years Experience</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

    @if(!empty($positions))
        @foreach($positions as $key => $pos)

            @php 
                $doctorPositions = (isset($doctors[$pos->id]) && !empty($doctors[$pos->id])) ? $doctors[$pos->id] : [];
            @endphp

            @if(!empty($doctorPositions) && count($doctorPositions) > 0)
                <!-- Leadership Team -->
                <section class="py-5">
                    <div class="container-fluid">
                        <div class="department-section">
                            <h2 class="department-title">{{ ucfirst($pos->title ?? '') }}</h2>
                            <p class="department-description">Our experienced leadership team guides Aastha Hospital with vision and expertise.</p>
                            <div class="row g-4">
                                @foreach($doctorPositions as $doctor)
                                    <div class="col-lg-3 col-md-6">
                                        <div class="team-card">
                                            <img 
                                                src="{{ !empty($doctor->image) ? asset('storage/' . $doctor->image) : 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=300&fit=crop&crop=face' }}" 
                                                alt="{{ $doctor->name ?? 'Doctor' }}" 
                                                class="team-image"
                                                onerror="this.onerror=null;this.src='{{ asset('Uploads/image_placeholder.jpg') }}';"
                                            >
                                            <div class="team-info">
                                                <h4 class="team-name">{{ $doctor->name ?? 'N/A' }}</h4>
                                                <p class="team-department">
                                                    {{ ucfirst($doctor->position->title ?? ($pos->title ?? 'N/A')) }}
                                                </p>
                                                <div class="team-experience">
                                                    @if(!empty($doctor->experience))
                                                        {{ $doctor->experience }} Years Experience
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