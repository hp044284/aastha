<x-web.layout>
   
    <!-- Blog Heading -->
    <section class="bg-light rounded shadow-sm mb-4">
        <div class="container p-4 ">
            <h1 class="display-5 text-primary fw-bold mb-2">Latest Blog Posts</h1>
            <p class="lead text-muted mb-0">Stay informed with expert tips, health guides, and medical insights from Aastha Multispeciality Hospital. Explore our latest articles on wellness, disease prevention, and advanced treatments — written by our team of trusted doctors and specialists.</p>
        </div>
    </section>
    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <!-- Blog Section -->
            <main class="col-lg-8 mb-4">
                <div id="blog-container">
                    @include('web.blog.partials._list', ['blogs' => $blogs])
                </div>
            </main>

            <!-- Sidebar -->
            <aside class="col-lg-4">
                <!-- Search -->
                <div class="card mb-4">
                    <div class="card-header text-primary">Search</div>
                    <div class="card-body">
                        <div class="input-group">
                            <input type="text" class="form-control search-input" placeholder="Search..." />
                            <button class="search-btn" type="button" id="searchBtn">Go</button>
                        </div>
                    </div>
                </div>

                <!-- Latest Posts -->
                <div class="mb-5">
                    
                    @if($recent_blogs->isNotEmpty())
                        <!-- Latest Posts -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <strong class="text-primary">Latest Posts</strong>
                            </div>
                            <ul class="list-group list-group-flush">
                                @foreach($recent_blogs as $recent)
                                    <li class="list-group-item">
                                        <div class="d-flex">
                                            <img src="{{ getDynamicImage($recent->File_Name, 'Uploads/Blogs') }}" class="rounded me-3" alt="{{ $recent->Title }}" style="object-fit: cover; width: 60px; height: 60px;" />
                                            <div>
                                                <a href="{{ route('web.blogs.detail', $recent->Slug ?? $recent->id) }}" class="fw-semibold text-decoration-none post-title d-block">
                                                    {{ $recent->Title }}
                                                </a>
                                                <small class="text-muted">{{ \Carbon\Carbon::parse($recent->created_at)->format('F d, Y') }}</small>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if($blog_categories->isNotEmpty())
                        <!-- Categories -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <strong>Categories</strong>
                            </div>
                            <div class="list-group list-group-flush">
                                @foreach($blog_categories as $category)
                                    <a href="{{ route('web.blogs.detail', $category->Slug ?? $category->id) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        <span>
                                            @if(!empty($category->icon))
                                                <i class="{{ $category->icon }} me-2"></i>
                                            @else
                                                <i class="bi bi-folder me-2"></i>
                                            @endif
                                            {{ $category->Title }}
                                        </span>
                                        <span class="badge bg-primary rounded-pill">{{ $category->Total_Blog ?? ($category->Total_Blog ?? 0) }}</span>
                                    </a>
                                @endforeach
                                
                            </div>
                        </div>
                    @endif

                </div>
            </aside>
        </div>
    </div>
    @push('js')
    <script>
    // AJAX pagination for blog list using Axios

    // The reason hideLoader() may not hide the loader is likely due to the fact that Axios interceptors
    // (defined in your layout) already call hideLoader() on every response and error.
    // If you call hideLoader() again here, it may be redundant or even cause timing issues.
    // To debug, let's log when hideLoader is called and also ensure the preloader element exists.

    // $(document).on('click', '.pagination a', function(e) {
    //     e.preventDefault();
    //     var url = $(this).attr('href');
    //     if (!url) return;

    //     // Optionally, you can show a loader here, but the Axios request interceptor will do it

    //     axiosRequest({
    //         url: url,
    //         method: 'get',
    //         contentType: 'application/json'
    //     }).then(function(response) {
    //         // Laravel returns HTML for the blog list partial
    //         if (response.status === 200 && response.data) 
    //         {
    //             // No need to call hideLoader() here, Axios response interceptor will handle it
    //             $('#blog-container').html(response.data);
    //             // Scroll to top of blog list for better UX
    //             $('html, body').animate({
    //                 scrollTop: $('#blog-container').offset().top - 100
    //             }, 400);
    //         }
    //         else
    //         {
    //             handleAxiosErrorResponse(response);
    //         }
    //     }).catch((error) => handleAxiosErrorRequest(error));
    // });

    $(document).on('click', '#blog-container .pagination a', function(e) {
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
                $('#blog-container').html(data);
                // Optionally, scroll to top of blog list
                $('html, body').animate({
                    scrollTop: $('#blog-container').offset().top - 100
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
</x-layout>