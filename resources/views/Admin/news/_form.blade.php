{!! 
    html()->model($news ?? null)
        ->form()
        ->action(isset($news) ? route('news.update', $news->id) : route('news.store'))
        ->method(isset($news) ? 'POST' : 'POST')
        ->class('row g-3 needs-validation')
        ->id('create-form')
        ->attribute('enctype', 'multipart/form-data') // Accept image and pdf uploads
        ->open()
!!}
    @if(isset($news))
        @method('PUT')
    @endif

    <div class="col-md-6">
        {!! html()->label('News Title', 'title')->class('form-label') !!}
        {!! html()->text('title')
            ->id('title')
            ->class('form-control' . ($errors->has('title') ? ' is-invalid' : ''))
            ->placeholder('News Title') !!}
        @if ($errors->has('title'))
            <div class="invalid-feedback">{{ $errors->first('title') }}</div>
        @endif
    </div>

    <div class="col-md-6">
        {!! html()->label('Subtitle', 'subtitle')->class('form-label') !!}
        {!! html()->text('subtitle')
            ->id('subtitle')
            ->class('form-control' . ($errors->has('subtitle') ? ' is-invalid' : ''))
            ->placeholder('Subtitle') !!}
        @if ($errors->has('subtitle'))
            <div class="invalid-feedback">{{ $errors->first('subtitle') }}</div>
        @endif
    </div>

    <div class="col-md-6">
        {!! html()->label('News URL', 'news_url')->class('form-label') !!}
        {!! html()->input('url','news_url')
            ->id('news_url')
            ->class('form-control' . ($errors->has('news_url') ? ' is-invalid' : ''))
            ->placeholder('https://example.com/news') !!}
        @if ($errors->has('news_url'))
            <div class="invalid-feedback">{{ $errors->first('news_url') }}</div>
        @endif
    </div>

    <div class="col-md-6">
        {!! html()->label('Video URL', 'video_url')->class('form-label') !!}
        {!! html()->input('url', 'video_url')
            ->id('video_url')
            ->class('form-control' . ($errors->has('video_url') ? ' is-invalid' : ''))
            ->placeholder('https://youtube.com/watch?v=...') !!}
        @if ($errors->has('video_url'))
            <div class="invalid-feedback">{{ $errors->first('video_url') }}</div>
        @endif
    </div>

    <div class="col-md-6">
        {!! html()->label('File Name', 'file_name')->class('form-label') !!}
        {!! html()->file('file_name')
            ->id('file_name')
            ->class('form-control' . ($errors->has('file_name') ? ' is-invalid' : ''))
            ->accept('.pdf,image/*') !!}
        @if ($errors->has('file_name'))
            <div class="invalid-feedback">{{ $errors->first('file_name') }}</div>
        @endif
    </div>

    <div class="col-md-6">
        {!! html()->label('Event', 'event_id')->class('form-label') !!}
        {!! html()->select('event_id', $evnts)
            ->id('event_id')
            ->class('form-select' . ($errors->has('event_id') ? ' is-invalid' : ''))
            ->placeholder('Select Event') !!}
        @if ($errors->has('event_id'))
            <div class="invalid-feedback">{{ $errors->first('event_id') }}</div>
        @endif
    </div>

    <div class="col-md-6">
        {!! html()->label('Status', 'status')->class('form-label') !!}
        <div class="form-check form-switch mt-2">
            {!! html()->hidden('status', 0) !!} {{-- Ensures unchecked = 0 --}}
            {!! html()->checkbox('status', !empty($news->status) ? true : false,1)
                ->id('status')
                ->class('form-check-input') !!}
            {!! html()->label('Active', 'status')->class('form-check-label') !!}
        </div>
    </div>

    <div class="col-md-12">
        <div class="d-md-flex d-grid align-items-center gap-3">
            {!! html()->button('Submit')->type('submit')->class('btn btn-primary px-4') !!}
        </div>
    </div>

{!! html()->form()->close() !!}
