@forelse($doctors as $doctor)
    <div class="doctor-item" 
            data-department="{{ $doctor->department ? Str::slug($doctor->department) : '' }}" 
            data-experience="{{ $doctor->experience ?? '' }}" 
            data-name="{{ $doctor->name }}">
        <div class="doctor-card p-4">
            <!-- Desktop Layout -->
            <div class="row mobile-doctor-top align-items-center d-none d-md-flex">
                <div class="col-md-2">
                <img 
                    src="{{ asset('storage/' . $doctor->image) }}" 
                    alt="{{ $doctor->name }}" 
                    class="doctor-image"
                    onerror="this.onerror=null;this.src='https://ui-avatars.com/api/?name={{ urlencode($doctor->name) }}&background=eee&color=555&size=200';"
                >
                </div>
                <div class="col-md-7">
                    <h5 class="doctor-name">{{ $doctor->name }}</h5>
                    <p class="doctor-department">{{ $doctor->position->title ?? '' }}</p>
                    <p class="doctor-qualification">{{ implode(',',$doctor->education->pluck('degree')->toArray())  }}</p>
                    <p class="doctor-hospital">
                        <i class="bi bi-hospital me-1"></i>
                        {{ $doctor->hospital ?? 'Aastha Hospital' }}
                    </p>
                </div>
                <div class="col-md-3 text-end">
                    <a href="{{ route('web.doctors.show', $doctor->slug) }}" class="btn btn-view-profile mb-2 w-100">
                        <i class="bi bi-person-lines-fill me-1"></i>View Profile
                    </a>
                    <a href="{{ url('book-an-appointment') }}" class="btn btn-book-appointment w-100">
                        <i class="bi bi-calendar-plus me-1"></i>Book Appointment
                    </a>
                </div>
            </div>

            <!-- Mobile Layout -->
            <div class="mobile-doctor-layout d-md-none">
                <div class="mobile-doctor-top">
                    <div class="mobile-doctor-image">
                        <img 
                            src="{{ asset('storage/' . $doctor->image) }}" 
                            alt="{{ $doctor->name }}" 
                            class="doctor-image"
                            onerror="this.onerror=null;this.src='https://ui-avatars.com/api/?name={{ urlencode($doctor->name) }}&background=eee&color=555&size=200';"
                        >
                    </div>
                    <div class="mobile-doctor-info">
                        <h5 class="doctor-name">{{ $doctor->name }}</h5>
                        <p class="doctor-department">{{ $doctor->designation ?? $doctor->department }}</p>
                        <p class="doctor-qualification">{{ $doctor->qualification }}</p>
                        <p class="doctor-hospital">
                            <i class="bi bi-hospital me-1"></i>
                            {{ $doctor->hospital ?? 'Aastha Hospital' }}
                        </p>
                    </div>
                </div>
                <div class="col-md-3 text-end">
                    <a href="{{ route('web.doctors.show', $doctor->slug) }}" class="btn btn-view-profile mb-2 w-100">
                        <i class="bi bi-person-lines-fill me-1"></i>View Profile
                    </a>
                    <a href="{{ url('book-an-appointment') }}" class="btn btn-book-appointment w-100">
                        <i class="bi bi-calendar-plus me-1"></i>Book Appointment
                    </a>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="alert alert-warning text-center">No doctors found.</div>
    @endforelse
    