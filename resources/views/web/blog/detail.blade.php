<x-web.layout>
@push('css')
<style>
    .blog-title {
        font-size: 2.5rem;
        font-weight: bold;
    }
    .blog-meta {
        color: #6c757d;
        margin-bottom: 20px;
    }
    .sidebar {
        background-color: #ffffff;
        padding: 20px;
        border: 1px solid #dee2e6;
        border-radius: 5px;
    }
    .post-image {
        width: 100%;
        height: auto;
        margin-bottom: 20px;
    }
    .comment-box {
      border: 1px solid #ddd;
      border-radius: 10px;
      padding: 20px;
      background-color: #fff;
      margin-bottom: 20px;
    }
    .comment-avatar {
      width: 45px;
      height: 45px;
      border-radius: 50%;
      object-fit: cover;
    }
    .comment-author {
      font-weight: 600;
    }
    .comment-meta {
      font-size: 0.875rem;
      color: #888;
    }
    .reply-box {
      margin-left: 3rem;
      margin-top: 1rem;
    }
    .reply-btn {
      font-size: 0.875rem;
      color: #007bff;
      cursor: pointer;
    }
</style>
@endpush
<!-- Main Container -->
<div class="container py-5">
    <div class="row">
        <!-- Blog Content -->
        <div class="col-md-8">
            <article>
                <h1 class="blog-title text-primary">{{ $blog->Title }}</h1>
                <div class="blog-meta">
                    <span>{{ $blog->Author_Name ?? 'Admin' }}</span> | 
                    <span>{{ $blog->created_at ? $blog->created_at->format('F d, Y') : '' }}</span> |
                    <span>
                        @if($blog->category)
                            {{ $blog->category->Title }}
                        @else
                            Uncategorized
                        @endif
                    </span>
                </div>
                <img src="{{ getDynamicImage($blog->File_Name, 'Uploads/Blogs') }}" alt="{{ $blog->Title }}" class="post-image" />
                <div>
                    {!! $blog->Description !!}
                </div>
            </article>
            @if(isset($previousBlog) || isset($nextBlog))
            <!-- Previous & Next Blog Navigation -->
            <div class="row mt-5 pt-4 border-top">
               @if(isset($previousBlog) && $previousBlog)
                <div class="col-md-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body d-flex align-items-center gap-3">
                                <img src="{{ getDynamicImage($previousBlog->File_Name, 'Uploads/Blogs') }}" height="60" width="80" class="rounded" alt="{{ $previousBlog->Title }}" />
                                <div>
                                    <small class="text-muted d-block">← Previous Post</small>
                                    <a href="{{ route('web.blogs.detail', $previousBlog->Slug ?? $previousBlog->id) }}" class="post-title fw-semibold text-decoration-none">
                                        {{ $previousBlog->Title }}
                                    </a>
                                </div>
                            </div>
                        </div>
                     </div>
                     @endif
                @if(isset($nextBlog) && $nextBlog)
                <div class="col-md-6 text-end">
                    
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body d-flex flex-row-reverse align-items-center gap-3">
                                <img src="{{ getDynamicImage($nextBlog->File_Name, 'Uploads/Blogs') }}" height="60" width="80" class="rounded" alt="{{ $nextBlog->Title }}" />
                                <div class="text-end">
                                    <small class="text-muted d-block">Next Post →</small>
                                    <a href="{{ route('web.blogs.detail', $nextBlog->Slug ?? $nextBlog->id) }}" class="post-title fw-semibold text-decoration-none">
                                        {{ $nextBlog->Title }}
                                    </a>
                                </div>
                            </div>
                        </div>
                     </div>
                  </div>
                  @endif
            @endif

           <!-- Comment Box -->
            <div class="mt-5 pt-5 border-top">
                <div class="bg-light p-4 rounded shadow-sm">
                    <div class="d-flex">
                        <!--45x45-->
                        <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" class="comment-avatar me-3" alt="User" />
                        <div>
                            <div class="comment-author">John Doe</div>
                            <div class="comment-meta">Posted 2 hours ago</div>
                            <p class="mt-2 mb-1">This blog is very informative. Thanks for sharing!</p>
                            <span class="reply-btn text-primary" data-bs-toggle="collapse" data-bs-target="#replyForm1">Reply</span>

                            <!-- Reply Form -->
                            <div class="collapse mt-3" id="replyForm1">
                                <form>
                                    <textarea class="form-control search-input mb-2 w-100" rows="2" placeholder="Your reply..."></textarea>
                                    <button type="submit" class="btn btn-sm btn-outline-primary">Post Reply</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Nested Reply -->
                    <div class="reply-box mt-4">
                        <div class="d-flex">
                            <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" class="comment-avatar me-3" alt="User" />
                            <div>
                                <div class="comment-author">Jane Smith</div>
                                <div class="comment-meta">Replied 1 hour ago</div>
                                <p class="mt-2">Glad you found it helpful!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Comment Section -->
            <div class="mt-5 pt-5 border-top">
                <h4 class="mb-4 fw-bold">💬 Leave a Comment</h4>
                <form class="bg-light p-4 rounded shadow-sm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Your Name *</label>
                            <input type="text" class="form-control search-input" id="name" placeholder="Enter your name" required />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Your Email *</label>
                            <input type="email" class="form-control search-input" id="email" placeholder="Enter your email" required />
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">Comment *</label>
                        <textarea class="form-control search-input" id="comment" rows="5" placeholder="Write your comment here..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary px-4">Post Comment</button>
                </form>
            </div>


        </div>

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
                                 <img 
                                    src="{{ getDynamicImage($recent->File_Name, 'Uploads/Blogs') }}" 
                                    class="rounded me-3" 
                                    alt="{{ $recent->Title }}" 
                                    style="object-fit: cover; width: 60px; height: 60px;" 
                                 />
                                 <div>
                                    <a 
                                       href="{{ route('web.blogs.detail', $recent->Slug ?? $recent->id) }}" 
                                       class="fw-semibold text-decoration-none post-title d-block"
                                    >
                                       {{ \Illuminate\Support\Str::limit($recent->Title, 60) }}
                                    </a>
                                    <small class="text-muted">
                                       {{ \Carbon\Carbon::parse($recent->created_at)->format('M d, Y') }}
                                    </small>
                                 </div>
                              </div>
                           </li>
                        @endforeach
                     </ul>
                  </div>
               @endif
                <!-- Categories -->
                  @if(isset($blog_categories) && $blog_categories->isNotEmpty())
                  <div class="card mb-4">
                    <div class="card-header">
                        <strong>Categories</strong>
                    </div>
                    <div class="list-group list-group-flush">
                        @foreach($blog_categories as $category)
                            <a 
                                href="{{ route('web.blogs.index', $category->Slug ?? $category->id) }}" 
                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                            >
                                <span>
                                    @php
                                        // Optionally, you can map icons to categories by name or id
                                        $icons = [
                                            0 => 'bi-folder', // default
                                            1 => 'bi-code-slash',
                                            2 => 'bi-palette2',
                                            3 => 'bi-phone',
                                            4 => 'bi-globe',
                                        ];
                                        $icon = $icons[$loop->index+1] ?? $icons[0];
                                    @endphp
                                    <i class="bi {{ $icon }} me-2"></i>{{ $category->Title ?? '' }}
                                </span>
                                <span class="badge bg-primary rounded-pill">
                                    {{ $category->Total_Blog ?? 0 }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                  </div>
                  @endif

            </div>
        </aside>

    </div>
</div>
</x-layout>