
@if($blogs->isNotEmpty())
    @foreach($blogs as $blogKey => $blog)
        <div class="col-md-6 mt-2-9 wow fadeIn" data-wow-delay="{{ $blogKey % 2 == 0 ? '100ms' : '200ms'  }}">
            <article class="card card-style1 border-0 m-0 h-100">
                <div class="overflow-hidden img-card mb-2 rounded-top-md-5px">
                    <img class="rounded-top-md-5px" src="{{ getDynamicImage($blog->File_Name ,'Uploads/Blogs') }}" alt="{{ $blog->Title ?? '' }}" />
                </div>
                <div class="card-body rounded-bottom-md-5px text-start p-4">
                    <p class="text-primary font-weight-600">{{ carbonFormatDate($blog->created_at) }}</p>
                    <h3 class="h5 mb-3">
                        <a href="{{ route('blogs.detail',$blog->Slug) }}">{{ $blog->Title ?? '' }}</a>
                    </h3>
                    <a href="{{ route('blogs.detail',$blog->Slug) }}" class="font-weight-500">Read More &#10230;</a>
                </div>
            </article>
        </div>
    @endforeach
    @if($blogs->isNotEmpty())
        @include('web.Blog.pagination', ['blogs' => $blogs])
    @else
        <div class="col-12">
            <p class="text-center text-muted">No blog posts found.</p>
        </div>
    @endif
@else
    <div class="col-12">
        <p class="text-center text-muted">No blog posts found.</p>
    </div>
@endif
