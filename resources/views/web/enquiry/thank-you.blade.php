<x-web.layout>
    @push('meta')
    @php
        $metaTitle = 'Thank You for Your Enquiry | Unisafe Securities';
        $metaDescription = 'Your enquiry has been submitted successfully. We will contact you shortly.';
        $metaKeywords = 'thank you, enquiry, contact unisafe, security solutions, CCTV, biometric, EPABX, video door phone, networking';
    @endphp
    @endpush
    <title>{{ $metaTitle ?? '' }}</title>
    <meta name="title" content="{{ $metaTitle ?? '' }}">
    <meta name="keywords" content="{{ $metaKeywords ?? '' }}">
    <meta name="description" content="{{ $metaDescription ?? '' }}">
    <div class="d-flex p-10 align-items-center justify-content-center bg-gray">
        <div class="text-center p-4 bg-white shadow rounded" style="max-width: 500px; width: 100%;">
            <img src="{{ asset('assets/images/success.png') }}" alt="Success" width="80" class="mb-3" />
            <h3 class="mb-2 text-success">Thank You!</h3>
            <p class="mb-4">{{ $success ?? 'Your enquiry has been submitted successfully. We will contact you shortly.' }}</p>
            <div class="d-flex justify-content-center gap-4 mb-4">
                <div class="d-flex align-items-center gap-2">
                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <i class="bi bi-envelope-fill text-primary"></i>
                    </div>
                    <span>{{ $settings['Email'] ?? 'info@unisafesecurities.com' }}</span>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <i class="bi bi-telephone-fill text-primary"></i>
                    </div>
                    <span>{{ $settings['Sales_Mobile_Number'] ?? '0123456789' }}</span>
                </div>
            </div>
    
            <a href="{{ route('home') }}" class="btn btn-custom primary-hover text-white w-100">Back to Home</a>
        </div>
    </div>
</x-web.layout>