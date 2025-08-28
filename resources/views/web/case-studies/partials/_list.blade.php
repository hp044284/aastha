@if($entities->isNotEmpty())
    @foreach($entities as $caseStudy)
        <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
            <div class="case-study-card">
                <div class="case-study-image-container">
                    <img 
                        src="{{ $caseStudy->image ? asset('storage/' . $caseStudy->image) : asset('images/default-case-study.jpg') }}" 
                        alt="{{ $caseStudy->title ?? 'Case Study Image' }}" 
                        class="case-study-image" 
                    />
                </div>
                <div class="case-study-content">
                    <h3 class="case-study-title">{{ $caseStudy->title ?? 'Untitled Case Study' }}</h3>
                    <p class="case-study-subtitle">
                        {{ $caseStudy->subtitle ?? $caseStudy->subtitle }}
                    </p>
                    <a href="{{ route('web.case-studies.show', $caseStudy->slug ?? $caseStudy->id) }}" class="learn-more-btn">
                        <i class="fas fa-arrow-right me-2"></i>Learn More
                    </a>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="col-12">
        <div class="alert alert-info text-center">
            No case studies found at this time.
        </div>
    </div>
@endif

@include('web.case-studies.pagination', ['blogs' => $entities])