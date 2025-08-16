@forelse($blogs as $blog)
    <div class="card mb-4 blog-post">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ getDynamicImage($blog->File_Name ,'Uploads/Blogs') }}" alt="{{ $blog->Title }}" class="img-fluid" style="object-fit:cover; width:100%; height:180px;" />
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5>
                        <a href="{{ route('web.blogs.detail', $blog->Slug ?? $blog->id) }}" class="post-title">
                            {{ $blog->Title }}
                        </a>
                    </h5>
                    <p class="card-text">
                        {!! Str::limit(strip_tags($blog->Description), 150) !!}
                    </p>
                    <a href="{{ route('web.blogs.detail', $blog->Slug ?? $blog->id) }}" class="btn btn-outline-primary btn-sm">Learn More</a>
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="alert alert-info">No blog posts found.</div>
@endforelse

@include('web.blog.pagination', ['blogs' => $blogs])