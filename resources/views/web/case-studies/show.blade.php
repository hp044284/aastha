<x-web.layout>
<!-- Hero Image Section -->
    <section class="case-detail-hero">
        <!-- 600x1200 -->
        <img 
            src="{{ $caseStudy->image ? asset('storage/' . $caseStudy->image) : asset('images/default-case-study.jpg') }}" 
            width="100%" 
            alt="{{ $caseStudy->title ?? 'Case Study Image' }}" 
            class="case-detail-image"
        >
        <div class="case-detail-overlay">
            <div class="wrapper">
                <h1 class="case-detail-title">{{ $caseStudy->title ?? 'Untitled Case Study' }}</h1>
                @if(!empty($caseStudy->subtitle))
                    <p class="case-detail-subtitle">{{ $caseStudy->subtitle }}</p>
                @endif
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="content-section">
        <div class="container">
            <!-- Back Button -->
            <a href="{{ route('web.case-studies.index') }}" class="back-btn">
                <i class="fas fa-arrow-left me-2"></i>Back to Case Studies
            </a>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <!-- Case Overview -->
                    <div class="mb-5">
                        <h2 class="section-heading">Case Overview</h2>
                        {!! $caseStudy->description ?? '' !!}
                    </div>

                    <!-- Patient Information -->
                    <div class="mb-5">
                        <h2 class="section-heading">Patient Information</h2>
                        <div class="info-card">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="info-label">Age</div>
                                    <div class="info-value">{{ $caseStudy->age ?? 'N/A' }}</div>
                                    
                                    <div class="info-label">Gender</div>
                                    <div class="info-value">{{ $caseStudy->gender ?? 'N/A' }}</div>
                                    
                                    <div class="info-label">Medical History</div>
                                    <div class="info-value">{{ $caseStudy->medical_history ?? 'N/A' }}</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-label">Presenting Symptoms</div>
                                    <div class="info-value">{{ $caseStudy->presenting_symptoms ?? 'N/A' }}</div>
                                    
                                    <div class="info-label">Duration of Symptoms</div>
                                    <div class="info-value">{{ $caseStudy->duration_of_symptoms ?? 'N/A' }}</div>
                                    
                                    <div class="info-label">Risk Factors</div>
                                    <div class="info-value">{{ $caseStudy->risk_factor ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Outcome -->
                    <div class="outcome-highlight">
                        <h3>
                            <i class="fas fa-check-circle me-2"></i>
                            Successful Outcome
                        </h3>
                        <p class="mb-0">
                            {{ $caseStudy->outcome ?? 'Outcome details not available.' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@push('css')
<style>
    .case-detail-hero {
        position: relative;
        height: 60vh;
        min-height: 400px;
        overflow: hidden;
        border-radius: 0 0 30px 30px;
    }
    
    .case-detail-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .case-detail-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0,0,0,0.7));
        color: white;
        padding: 40px;
    }
    
    .case-detail-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 10px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }
    
    .case-detail-subtitle {
        font-size: 1.2rem;
        opacity: 0.9;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
    }
    
    .content-section {
        padding: 60px 0;
    }
    
    .section-heading {
        color: var(--primary-brown);
        font-weight: 700;
        margin-bottom: 30px;
        border-bottom: 3px solid #8b4513;
        padding-bottom: 10px;
    }
    
    .info-card {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 30px;
        margin-bottom: 30px;
        border-left: 5px solid #8b4513;
    }
    
    .info-label {
        font-weight: 600;
        color: var(--primary-brown);
        margin-bottom: 5px;
    }
    
    .info-value {
        color: #6c757d;
        margin-bottom: 15px;
    }
    
    .timeline-item {
        position: relative;
        padding-left: 40px;
        margin-bottom: 30px;
    }
    
    .timeline-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 5px;
        width: 15px;
        height: 15px;
        background: var(--primary-brown);
        border-radius: 50%;
    }
    
    .timeline-item::after {
        content: '';
        position: absolute;
        left: 7px;
        top: 20px;
        width: 2px;
        height: calc(100% + 10px);
        background: #dee2e6;
    }
    
    .timeline-item:last-child::after {
        display: none;
    }
    
    .timeline-date {
        font-weight: 600;
        color: var(--primary-brown);
        margin-bottom: 5px;
    }
    
    .timeline-content {
        color: #6c757d;
    }
    
    .outcome-highlight {
        background: linear-gradient(135deg, #28a745, #20c997);
        color: white;
        padding: 30px;
        border-radius: 15px;
        text-align: center;
        margin: 40px 0;
    }
    
    .outcome-highlight h3 {
        margin-bottom: 15px;
    }
    
    .back-btn {
        background: #6c757d;
        border: none;
        color: white;
        padding: 10px 20px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        margin-bottom: 30px;
    }
    
    .back-btn:hover {
        background: #5a6268;
        color: white;
        transform: translateY(-2px);
    }
    
    .doctor-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        text-align: center;
    }
    
    .doctor-image {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 15px;
    }
    
    .doctor-name {
        font-weight: 700;
        color: var(--primary-brown);
        margin-bottom: 5px;
    }
    
    .doctor-specialty {
        color: #6c757d;
        font-size: 0.9rem;
    }
    
    @media (max-width: 768px) {
        .case-detail-title {
            font-size: 2rem;
        }
        
        .case-detail-hero {
            height: 40vh;
            min-height: 300px;
        }
        
        .case-detail-overlay {
            padding: 20px;
        }
    }
</style>
@endpush
  
</x-web.layout>