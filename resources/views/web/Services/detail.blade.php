<x-web.layout>
    <!-- Hero Section with Background Image -->
    <section class="service-detail-hero" style="background-image: url('{{ $service->file_name ? asset('storage/' . $service->file_name) : asset('images/default-service-bg.jpg') }}');">
        <div class="container-fluid h-100">
            <div class="row align-items-center h-100">
                <!-- Content Left Side -->
                <div class="col-lg-7 col-md-8">
                    <div class="hero-content px-4">
                        <h1 class="service-detail-title">{{ $service->title ?? '' }}</h1>
                        <p class="service-detail-subtitle">
                            Expertise that your little one needs to take a breath of relief
                        </p>
                    </div>
                </div>
                
                <!-- Book Appointment Button - Right Side -->
                <div class="col-lg-5 col-md-4">
                    <div class="d-flex justify-content-center justify-content-md-end px-4">
                        <a href="book-an-appointment" class="book-appointment-btn">
                            <i class="fas fa-calendar-check me-2"></i>
                            Book Appointment
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Breadcrumb Section -->
    <section class="breadcrumb-section">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="home"><i class="fas fa-home me-1"></i>Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="/services">{{ $service->serviceCategory->Title ?? '' }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="/services/pediatrics">Service</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $service->title ?? '' }}
                    </li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Content Section -->
    <section class="content-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="mb-5">
                        <h2 class="section-heading">{{ $service->title ?? '' }}</h2>
                        {!! $service->description ?? '' !!}
                    </div>
                </div>

            </div>
        </div>
    </section>

    
    @if($service->faqs && count($service->faqs))
        <!-- FAQ Section -->
        <section class="bg-gray faq-section">
            <div class="container-fluid px-4">
                <div class="faq-category" id="general">
                    <h3 class="category-title">
                        <i class="fas fa-info-circle me-2"></i>Faqs
                    </h3>
                    
                        <div class="accordion" id="generalAccordion">
                            @foreach($service->faqs as $i => $faq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#general{{ $i }}">
                                            {{ $faq['question'] ?? '' }}
                                        </button>
                                    </h2>
                                    <div id="general{{ $i }}" class="accordion-collapse collapse" data-bs-parent="#generalAccordion">
                                        <div class="accordion-body">
                                            {!! $faq['answer'] ?? '' !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                </div>
            </div>
        </section>
    @endif


    @push('css')
    <style>
    .faq-section {
        padding: 60px 0;
    }
    .faq-category {
        margin-bottom: 50px;
    }
    .category-title {
    color: var(--primary-brown);
    font-weight: 600;
    margin-bottom: 25px;
    padding: 15px 20px;
    background: #f8f9fa;
    border-radius: 10px;
    border-left: 5px solid var(--primary-brown);
}
    .accordion-item {
        border: none;
        margin-bottom: 15px;
        border-radius: 10px !important;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .accordion-button {
        background: white;
        border: none;
        padding: 20px 25px;
        font-weight: 600;
        color: #333;
        border-radius: 10px !important;
    }
    
    .accordion-button:not(.collapsed) {
        background: var(--primary-brown);
        color: white;
        box-shadow: none;
    }
    
    .accordion-button:focus {
        box-shadow: none;
        border: none;
    }
    
    .accordion-button::after {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23333'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    }
    
    .accordion-button:not(.collapsed)::after {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23fff'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    }
    
    .accordion-body {
        padding: 25px;
        background: #f8f9fa;
        color: #6c757d;
        line-height: 1.6;
    }
    
    @media (max-width: 768px) {
        .page-header {
            padding: 60px 0;
        }
        
        .faq-section {
            padding: 40px 0;
        }
    }
    .service-detail-hero {
        position: relative;
        height: 60vh;
        min-height: 400px;
        overflow: hidden;
        border-radius: 0 0 30px 30px;
    }
    
    .service-detail-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .service-detail-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0,0,0,0.7));
        color: white;
        padding: 40px;
    }
    
    .service-detail-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 10px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }
    
    .service-detail-subtitle {
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
        .service-detail-title {
            font-size: 2rem;
        }
        
        .service-detail-hero {
            height: 40vh;
            min-height: 300px;
        }
        
        .service-detail-overlay {
            padding: 20px;
        }
    }


    /* Hero image styles */
        .service-detail-hero {
            min-height: 40vh;
            position: relative;
            overflow: hidden;
            background-image: url('https://suryahospitals.com/testimonial/659633bf230c1Nirvaan_1662%20x%20763.webp');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        
        /* Left side blur overlay */
        .service-detail-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 35%;
            height: 100%;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            z-index: 1;
        }
        
        .hero-content {
            padding: 220px 0;
            z-index: 2;
            position: relative;
        }
        
        .service-detail-title {
            font-size: 3.5rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }
        
        .service-detail-subtitle {
            font-size: 1.25rem;
            color: #495057;
            margin-bottom: 0;
            line-height: 1.6;
            font-weight: 500;
        }
        
        .book-appointment-btn {
            background: var(--primary-brown);
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
            z-index: 3;
            position: relative;
        }
        
        .book-appointment-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 123, 255, 0.4);
            color: white;
        }
        
        .breadcrumb-section {
            background: white;
            padding: 20px 0;
            border-bottom: 1px solid #e9ecef;
        }
        
        .breadcrumb {
            background: transparent;
            padding: 0;
            margin: 0;
        }
        
        .breadcrumb-item {
            font-size: 0.95rem;
        }
        
        .breadcrumb-item + .breadcrumb-item::before {
            content: "/";
            color: #6c757d;
            margin: 0 8px;
        }
        
        .breadcrumb-item a {
            color: var(--primary-brown);
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .breadcrumb-item a:hover {
            color: var(--primary-brown);
            text-decoration: underline;
        }
        
        .breadcrumb-item.active {
            color: #6c757d;
            font-weight: 500;
        }
        
        @media (max-width: 768px) {
            .service-detail-hero::before {
                width: 100%;
                background: linear-gradient(to bottom, 
                    rgba(255, 255, 255, 0.9) 0%, 
                    rgba(255, 255, 255, 0.7) 50%, 
                    rgba(255, 255, 255, 0.4) 100%);
            }
            
            .service-detail-title {
                font-size: 2.5rem;
            }
            
            .hero-content {
                padding: 40px 0;
            }
        }
</style>
@endpush
</x-web.layout>