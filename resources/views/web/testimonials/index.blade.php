<x-web.layout>
    
<!-- All Testimonials Grid -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold mb-3">What Our Patients Say</h2>
            <p class="lead text-muted">Read more testimonials from our satisfied patients</p>
        </div>

        <div class="row">
            <div id="testimonial-container">
                @include('web.testimonials.partials._list', ['entities' => $entities])
            </div>
        </div>
    </div>
</section>
@push('css')
<style>
    .testimonial-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
    }

    .testimonial-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .patient-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid var(--primary-color);
    }

    .rating-stars {
        color: var(--primary-brown);
    }

    .featured-testimonial {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border-radius: 20px;
        padding: 50px;
        position: relative;
        overflow: hidden;
    }

    .featured-testimonial::before {
        content: '"';
        position: absolute;
        top: -20px;
        left: 30px;
        font-size: 150px;
        color: var(--primary-color);
        opacity: 0.1;
        font-family: serif;
    }

    .btn-custom {
        background: white;
        color: var(--primary-color);
        border: 2px solid white;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-custom:hover {
        background: transparent;
        color: white;
        border-color: white;
    }

    .btn-outline-custom {
        background: transparent;
        color: white;
        border: 2px solid white;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-outline-custom:hover {
        background: white;
        color: var(--primary-color);
    }

    .treatment-badge {
        background: var(--primary-brown);
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
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