@if($Blogs->isNotEmpty())
    @foreach($Blogs as $Blog_Key => $Blog)
    
        @php
            $Blog_Slug = $Blog->Slug ?? '';
            $formattedDate = carbonFormatDate($Blog->created_at);
        @endphp
        <article class="postbox__item {{ $Blog_Key % 2 == 0 ? 'format-image' : 'format-video' }} mb-50 transition-3">
            <div class="postbox__thumb {{ $Blog_Key % 2 == 0 ? 'postbox__slider' : 'postbox__slider' }} w-img">
                <a href="{{ route('home.blog_detail',$Blog_Slug) }}">
                    <img src="{{ getDynamicImage($Blog->File_Name, 'Uploads/Blogs') }}" alt="{{ $Blog->Title ?? '' }}" />
                </a>
            </div>
            <div class="postbox__content">
                <div class="postbox__meta">
                    <span><i class="far fa-calendar-check"></i>{{ $formattedDate }}</span>
                    <span>
                        <a href="javascript:void(0);">
                            <i class="far fa-user"></i>Admin
                        </a>
                    </span>
                    <span>
                        <a href="javascript:void(0);">
                            <i class="fal fa-comments"></i> 02 Comments
                        </a>
                    </span>
                </div>
                <h3 class="postbox__title">
                    <a href="{{ route('home.blog_detail',$Blog_Slug) }}">{{ $Blog->Title ?? '' }}</a>
                </h3>
                <div class="postbox__text">
                    <p>
                        {!! truncateText($Blog->Description,10) !!}
                    </p>
                </div>
                <div class="post__button">
                    <a class="tp-btn" href="{{ route('home.blog_detail',$Blog_Slug) }}"> READ MORE</a>
                </div>
            </div>
        </article>
    @endforeach
    <div class="mt-4">
        {{ $Blogs->links('Web_Site.Paginations.Index') }}
    </div>
@endif