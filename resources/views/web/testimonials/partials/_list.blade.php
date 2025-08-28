@if($entities->isNotEmpty())
    @foreach($entities as $testimonial)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="testimonial-card">
                <div class="d-flex align-items-center mb-3">
                    <img 
                        src="{{ $testimonial->image ? asset('storage/'.$testimonial->image) : asset('images/default-avatar.png') }}" 
                        alt="{{ $testimonial->name ?? 'Patient' }}" 
                        class="patient-avatar me-3" 
                        style="width: 60px; height: 60px;" 
                    />
                    <div>
                        <h5 class="fw-bold mb-1">{{ $testimonial->name ?? 'Anonymous' }}</h5>
                        <p class="text-muted mb-0">{{ $testimonial->city ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="rating-stars mb-3">
                    @php
                        $stars = $testimonial->ratting ?? 5;
                    @endphp
                    @for($i = 0; $i < $stars; $i++)
                        <i class="fas fa-star"></i>
                    @endfor
                    @for($i = $stars; $i < 5; $i++)
                        <i class="far fa-star"></i>
                    @endfor
                </div>
                <p class="mb-3">
                    "{!! $testimonial->message ?? 'No testimonial provided.' !!}"
                </p>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="treatment-badge">
                        {{ $testimonial->treatment ?? 'General' }}
                    </span>
                    <small class="text-muted">
                        {{ $testimonial->treatment_date ? \Carbon\Carbon::parse($testimonial->treatment_date)->format('M Y') : ($testimonial->created_at ? $testimonial->created_at->format('M Y') : '') }}
                    </small>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="col-12">
        <div class="alert alert-info text-center">
            No testimonials found at this time.
        </div>
    </div>
@endif

@include('web.testimonials.pagination', ['blogs' => $entities])