@foreach($news as $item)
    <div class="col-12 news-item">
        <div class="news-card p-4">
            <div class="row align-items-center">
                <div class="col-lg-10 col-sm-12">
                    <div class="d-flex align-items-center mb-2">
                        <span class="news-category me-3">{{ optional($item->event)->title ?? 'News' }}</span>
                        <span class="news-meta">
                            <i class="bi bi-calendar3 me-1"></i>{{ \Carbon\Carbon::parse($item->created_at)->format('F d, Y') }}
                            <i class="bi bi-person ms-3 me-1"></i>{{ $item->author ?? 'Aastha Hospital' }}
                        </span>
                    </div>
                    <h3 class="fw-bold text-dark mb-2">{{ $item->title }}</h3>
                    <p class="text-muted mb-0">{{ $item->subtitle ?? Str::limit(strip_tags($item->subtitle), 120) }}</p>
                </div>
                <div class="col-lg-2 col-sm-12 text-lg-end text-start mt-3 mt-lg-0">
                    @if(!empty($item->news_url))
                        <a href="{{ $item->news_url }}" class="news-link-icon me-3" title="Read Full Article" target="_blank">
                            <i class="bi bi-newspaper"></i>
                        </a>
                    @endif
                    @if(!empty($item->file_name) && $item->file_type === 'application/pdf')
                        <a href="{{ asset('storage/'.$item->file_name) }}" class="news-link-icon me-3" title="Download PDF" target="_blank">
                            <i class="bi bi-file-earmark-pdf"></i>
                        </a>
                    @elseif(!empty($item->file_name))
                        <a href="{{ asset('storage/'.$item->file_name)  }}" class="news-link-icon me-3" title="Download File" target="_blank">
                            <i class="bi bi-images"></i>
                        </a>
                    @endif
                    
                    @if(!empty($item->video_url))
                        <a href="{{ $item->video_url }}" class="news-link-icon me-3" title="Watch Video" target="_blank">
                            <i class="bi bi-play-circle"></i>
                        </a>
                    @endif
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('web.news.show', $item->id)) }}" class="news-link-icon" title="Share" target="_blank">
                        <i class="bi bi-share"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endforeach
