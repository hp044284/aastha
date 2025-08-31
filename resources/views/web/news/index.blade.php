<x-web.layout>
<!-- Hero Section -->
<section id="home" class="bg-gray py-5">
        <div class="container-fluid px-4">
            <!-- Page Title and Description -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="display-4 fw-bold mb-3 fs-2 text-primary">News & Media</h1>
                    <p class="lead text-muted mb-4">Stay updated with the latest news, events, and media coverage from Aastha Hospital. Explore our press releases, awards, health campaigns, and more.</p>
                </div>
            </div>
        </div>
    </section>

    @if($news->isNotEmpty())
        <!-- News & Media Section -->
        <section class="py-5">
            <div class="container-fluid px-4">
                <div id="newsContainer" class="row g-4">
                    @include('web.news.news-items')
                </div>

                <!-- Load More Section -->
                <div class="text-center mt-5" id="loadMoreSection">
                    <button class="btn load-more-btn" id="loadMoreBtn">
                        <i class="bi bi-plus-circle me-2"></i>Load More News
                    </button>
                    <p class="text-muted mt-3 mb-0">
                        <span id="currentCount">{{ $news->count() }}</span> of <span id="totalCount">{{ $news->total() }}</span> articles shown
                    </p>
                </div>

                <!-- No More Content Message -->
                <div class="text-center mt-5 d-none" id="noMoreContent">
                    <div class="alert alert-info d-inline-block">
                        <i class="bi bi-info-circle me-2"></i>
                        You've reached the end of our news archive. Check back soon for more updates!
                    </div>
                </div>
            </div>
        </section>
    @endif
    @push('js')
        <script>
            let currentPage = {{ $news->currentPage() }};
            const lastPage = {{ $news->lastPage() }};
            let currentCount = {{ $news->count() }};
            const totalCount = {{ $news->total() }};

            document.addEventListener('DOMContentLoaded', function() {
                const loadMoreBtn = document.getElementById('loadMoreBtn');
                if (loadMoreBtn) {
                    loadMoreBtn.addEventListener('click', loadMoreNews);
                }
            });

            function loadMoreNews() {
                const loadMoreBtn = document.getElementById('loadMoreBtn');
                loadMoreBtn.disabled = true;
                loadMoreBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Loading...';

                fetch(`{{ route('web.news.index') }}?page=${currentPage + 1}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => 
                {
                    console.log(data , ' data');
                    if (data.html) 
                    {
                        // Append new items
                        document.getElementById('newsContainer').insertAdjacentHTML('beforeend', data.html);

                        // Update counts
                        currentPage++;
                        currentCount += data.count;
                        document.getElementById('currentCount').textContent = currentCount;

                        // Hide Load More if last page
                        if (currentPage >= lastPage || currentCount >= totalCount) {
                            document.getElementById('loadMoreSection').style.display = 'none';
                            document.getElementById('noMoreContent').classList.remove('d-none');
                        } else {
                            loadMoreBtn.disabled = false;
                            loadMoreBtn.innerHTML = '<i class="bi bi-plus-circle me-2"></i>Load More News';
                        }
                    } else {
                        // No more data
                        document.getElementById('loadMoreSection').style.display = 'none';
                        document.getElementById('noMoreContent').classList.remove('d-none');
                    }
                })
                .catch(() => {
                    loadMoreBtn.disabled = false;
                    loadMoreBtn.innerHTML = '<i class="bi bi-plus-circle me-2"></i>Load More News';
                });
            }
        </script>
    @endpush
</x-web.layout>