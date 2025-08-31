<x-web.layout>
    <!-- Hero Section -->
    <section id="home" class="bg-gray py-5">
        <div class="container-fluid px-4">
            <div class="row">
                <div class="col-lg-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('web.news.index') }}">News & Media</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $news->title }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- News Detail Section -->
    <section class="py-5">
        <div class="container-fluid px-4">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="news-detail-card p-4">
                        <!-- News Header -->
                        <div class="news-header mb-4">
                            <div class="d-flex align-items-center mb-3">
                                <span class="news-category me-3">{{ optional($news->event)->title ?? 'News' }}</span>
                                <span class="news-meta">
                                    <i class="bi bi-calendar3 me-1"></i>{{ \Carbon\Carbon::parse($news->created_at)->format('F d, Y') }}
                                    <i class="bi bi-person ms-3 me-1"></i>{{ $news->author ?? 'Aastha Hospital' }}
                                </span>
                            </div>
                            <h1 class="fw-bold text-dark mb-3">{{ $news->title }}</h1>
                            @if($news->subtitle)
                                <p class="lead text-muted mb-4">{{ $news->subtitle }}</p>
                            @endif
                        </div>

                        <!-- News Content -->
                        <div class="news-content mb-4">
                            @if($news->description)
                                <div class="news-description">
                                    {!! $news->description !!}
                                </div>
                            @endif
                        </div>

                        <!-- News Actions -->
                        <div class="news-actions d-flex flex-wrap gap-3 mb-4">
                            @if(!empty($news->news_url))
                                <a href="{{ $news->news_url }}" class="btn btn-primary" target="_blank">
                                    <i class="bi bi-newspaper me-2"></i>Read Full Article
                                </a>
                            @endif
                            
                            @if(!empty($news->file_name))
                                @if($news->file_type === 'application/pdf')
                                    <a href="{{ asset('storage/'.$news->file_name) }}" class="btn btn-outline-primary" target="_blank">
                                        <i class="bi bi-file-earmark-pdf me-2"></i>Download PDF
                                    </a>
                                @else
                                    <a href="{{ asset('storage/'.$news->file_name) }}" class="btn btn-outline-primary" target="_blank">
                                        <i class="bi bi-download me-2"></i>Download File
                                    </a>
                                @endif
                            @endif
                            
                            @if(!empty($news->video_url))
                                <a href="{{ $news->video_url }}" class="btn btn-outline-success" target="_blank">
                                    <i class="bi bi-play-circle me-2"></i>Watch Video
                                </a>
                            @endif
                        </div>

                        <!-- Share Section -->
                        <div class="share-section">
                            <h6 class="fw-bold mb-3">Share this news:</h6>
                            <div class="d-flex gap-2">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                                   class="btn btn-outline-primary btn-sm" target="_blank" title="Share on Facebook">
                                    <i class="bi bi-facebook"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($news->title) }}" 
                                   class="btn btn-outline-info btn-sm" target="_blank" title="Share on Twitter">
                                    <i class="bi bi-twitter"></i>
                                </a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" 
                                   class="btn btn-outline-secondary btn-sm" target="_blank" title="Share on LinkedIn">
                                    <i class="bi bi-linkedin"></i>
                                </a>
                                <a href="mailto:?subject={{ urlencode($news->title) }}&body={{ urlencode('Check out this news: ' . request()->url()) }}" 
                                   class="btn btn-outline-danger btn-sm" title="Share via Email">
                                    <i class="bi bi-envelope"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-web.layout>
