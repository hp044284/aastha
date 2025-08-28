<x-web.layout>

<!-- Header -->
<section class="bg-primary py-5">
    <div class="container">
        <div class="row align-items-center">
            <!-- Left: Text Content -->
            <div class="slide-content col-md-6">
                <h1 class="slide-title fw-bold">Patient Case Studies</h1>
                <p class="slide-description mb-4">Real stories of healing and hope at Aastha Hospital.</p>
                <a href="book-an-appointment" class="view-all-btn"><i class="fas fa-calendar-alt"></i> Book An Appointment </a>
            </div>

            <!-- Right: Image -->
            <div class="col-md-6 text-center">
                <!--500x300-->
                <img src="https://suryahospitals.com/frontend/images/2023/07/use-case.jpg" height="300" width="500" alt="Hospital Illustration" class="img-fluid rounded shadow" />
            </div>
        </div>
    </div>
</section>
    
<!-- All Testimonials Grid -->
<section class="py-5">
    <div class="container-fluid">
        <div class="row">
            <div id="testimonial-container">
                @include('web.case-studies.partials._list', ['entities' => $entities])
            </div>
        </div>
    </div>
</section>
@push('css')
<style>
    
        /* Case Studies */
.case-study-card {
    display: flex;
    align-items: stretch;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    overflow: hidden;
    background: white;
}

.case-study-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
}

.case-study-content {
    flex: 1;
    padding-bottom: 30px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
}
.case-study-content a{
    padding-bottom: 10px
}
.case-study-image-container {
    flex: 1.5;
    position: relative;
    overflow: hidden;
}

.case-study-image {
    width: 100%;
    height: 100%;
    min-height: 250px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.case-study-card:hover .case-study-image {
    transform: scale(1.05);
}

.case-study-title {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 15px;
    color: #;
}

.case-study-subtitle {
    font-size: 1rem;
    color: #000;
    margin-bottom: 25px;
    line-height: 1.6;
}

.learn-more-btn {
    background: var(--primary-brown);
    border: none;
    color: white;
    margin-top: 10px;
    padding: 12px 25px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    width: fit-content;
}

.learn-more-btn:hover {
    margin-top: 10px;
    background: var(--dark-brown);
    color: white;
    transform: translateY(-2px);
}

@media (max-width: 768px) {
    .case-study-card {
        flex-direction: column;
    }
    
    .case-study-image-container {
        min-height: 200px;
    }
    
    .case-study-content {
        padding: 20px;
    }
}
        .section-title {
            color: var(--primary-brown);
            font-weight: 700;
            margin-bottom: 50px;
        }
    </style>
@endpush

@push('js')
    <script>
    $(document).on('click', '#testimonial-container .pagination a', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        if (!url) return;

        // Optionally, show loader/spinner here

        $.ajax({
            url: url,
            type: "GET",
            beforeSend: function () {
                // Optionally, show loader/spinner here
                showLoader();
            },
            success: function (data) 
            {
                console.log(data , ' data');
                $('#testimonial-container').html(data);
                // Optionally, scroll to top of blog list
                $('html, body').animate({
                    scrollTop: $('#testimonial-container').offset().top - 100
                }, 400);
            },
            error: function (xhr, status, error) {
                // Optionally, show error message
                console.error('Pagination AJAX error:', error);
            },
            complete: function () {
                hideLoader();
            }
        });
    });
    </script>
    @endpush
  
</x-web.layout>