<x-web.layout>

    <!-- Hero Section -->
    <section id="home" class="bg-gray py-5">
        <div class="container-fluid px-4">
            <!-- Page Title and Description -->
            <div class="row">
                <div class="col-lg-9">
                    <h1 class="display-4 fw-bold mb-3 fs-2 text-primary">Frequently Asked Questions</h1>
                    <p class="lead text-muted mb-4">Find answers to common questions about our services, appointments, and patient care at Aastha Hospital.</p>
                </div>
                <div class="col-lg-3 text-lg-end text-md-start mt-4 mb-lg-0">
                    <a href="book-an-appointment" class="view-all-btn">
                        <i class="fas fa-calendar-days"></i> Book An Appointment
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- Quick Links -->
    <section class="quick-links">
        <div class="container-fluid px-4">
            <div class="row">
                @php
                    // Define FAQ categories and their display properties
                    $faqCategories = [
                        'appointments' => [
                            'label' => 'Appointments',
                            'icon' => 'fas fa-calendar-alt',
                        ],
                        'medical_services' => [
                            'label' => 'Medical Services',
                            'icon' => 'fas fa-stethoscope',
                        ],
                        'insurance_billing' => [
                            'label' => 'Insurance & Billing',
                            'icon' => 'fas fa-file-invoice-dollar',
                        ],
                        'emergency_services' => [
                            'label' => 'Emergency Care',
                            'icon' => 'fas fa-ambulance',
                        ],
                        'patient_care' => [
                            'label' => 'Patient Care',
                            'icon' => 'fas fa-user-nurse',
                        ],
                        'general_information' => [
                            'label' => 'General Information',
                            'icon' => 'fas fa-info-circle',
                        ],
                    ];
                @endphp
                @foreach($faqCategories as $key => $cat)
                    @if(!empty($faqs[$key]))
                        <div class="col-lg-2 col-md-3">
                            <a href="#{{ $key }}" class="quick-link-item d-block">
                                <div class="quick-link-icon">
                                    <i class="{{ $cat['icon'] }}"></i>
                                </div>
                                <h6>{{ $cat['label'] }}</h6>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="container-fluid px-4">
            @php
                // For dynamic rendering, define accordion id and icon for each category
                $faqCategoryDetails = [
                    'general_information' => [
                        'title' => 'General Information',
                        'icon' => 'fas fa-info-circle',
                        'accordion' => 'generalAccordion',
                        'button_prefix' => 'general',
                    ],
                    'appointments' => [
                        'title' => 'Appointments & Scheduling',
                        'icon' => 'fas fa-calendar-alt',
                        'accordion' => 'appointmentsAccordion',
                        'button_prefix' => 'appointment',
                    ],
                    'medical_services' => [
                        'title' => 'Medical Services',
                        'icon' => 'fas fa-stethoscope',
                        'accordion' => 'servicesAccordion',
                        'button_prefix' => 'service',
                    ],
                    'insurance_billing' => [
                        'title' => 'Insurance & Billing',
                        'icon' => 'fas fa-file-invoice-dollar',
                        'accordion' => 'insuranceAccordion',
                        'button_prefix' => 'insurance',
                    ],
                    'emergency_services' => [
                        'title' => 'Emergency Services',
                        'icon' => 'fas fa-ambulance',
                        'accordion' => 'emergencyAccordion',
                        'button_prefix' => 'emergency',
                    ],
                    'patient_care' => [
                        'title' => 'Patient Care',
                        'icon' => 'fas fa-user-md',
                        'accordion' => 'patientCareAccordion',
                        'button_prefix' => 'care',
                    ],
                ];
            @endphp

            @foreach($faqCategories as $key => $cat)
                @if(!empty($faqs[$key]))
                    <div class="faq-category" id="{{ $key }}">
                        <h3 class="category-title">
                            <i class="{{ $faqCategoryDetails[$key]['icon'] }} me-2"></i>{{ $faqCategoryDetails[$key]['title'] }}
                        </h3>
                        <div class="accordion" id="{{ $faqCategoryDetails[$key]['accordion'] }}">
                            @php $index = 1; @endphp
                            @foreach($faqs[$key] as $faq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $faqCategoryDetails[$key]['button_prefix'] }}{{ $index }}">
                                            {{ $faq['question'] }}
                                        </button>
                                    </h2>
                                    <div id="{{ $faqCategoryDetails[$key]['button_prefix'] }}{{ $index }}" class="accordion-collapse collapse" data-bs-parent="#{{ $faqCategoryDetails[$key]['accordion'] }}">
                                        <div class="accordion-body">
                                            {{ $faq['answer'] }}
                                        </div>
                                    </div>
                                </div>
                                @php $index++; @endphp
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </section>
@push('css')
<style>
.page-header {
        background: var(--primary-brown);
        color: white;
        padding: 80px 0;
        margin-bottom: 60px;
    }
    
    .faq-section {
        padding: 60px 0;
    }
    
    .section-title {
        color: var(--primary-brown);
        font-weight: 700;
        margin-bottom: 40px;
        text-align: center;
        position: relative;
    }
    
    .section-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background: var(--primary-brown);
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
    
    .quick-links {
        background: #f8f9fa;
        padding: 40px 0;
        margin-bottom: 40px;
        border-radius: 15px;
    }
    
    .quick-link-item {
        text-align: center;
        padding: 20px;
        background: white;
        border-radius: 10px;
        margin-bottom: 20px;
        transition: transform 0.3s ease;
        text-decoration: none;
        color: #333;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .quick-link-item:hover {
        transform: translateY(-5px);
        color: var(--primary-brown);
    }
    
    .quick-link-icon {
        font-size: 2rem;
        color: var(--primary-brown);
        margin-bottom: 15px;
    }
    
    @media (max-width: 768px) {
        .page-header {
            padding: 60px 0;
        }
        
        .faq-section {
            padding: 40px 0;
        }
    }
    </style>
@endpush

</x-web.layout>