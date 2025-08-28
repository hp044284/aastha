{!! 
    html()->model($event ?? null)
        ->form()
        ->action(isset($event) ? route('events.update', $event->id) : route('events.store'))
        ->method(isset($event) ? 'POST' : 'POST')
        ->class('row g-3 needs-validation')
        ->id('create-form')
        ->open()
!!}
    @if(isset($event))
        @method('PUT')
    @endif


    <div class="col-md-6">
        {!! html()->label('Event Title', 'title')->class('form-label') !!}
        {!! html()->text('title')
            ->id('title')
            ->class('form-control' . ($errors->has('title') ? ' is-invalid' : ''))
            ->placeholder('Event Title') !!}
        @if ($errors->has('title'))
            <div class="invalid-feedback">{{ $errors->first('title') }}</div>
        @endif
    </div>

    <div class="col-md-6">
        {!! html()->label('Status', 'status')->class('form-label') !!}
        <div class="form-check form-switch mt-2">
            {!! html()->hidden('status', 0) !!} {{-- Ensures unchecked = 0 --}}
            {!! html()->checkbox('status', !empty($event->status) ? true : false,1)
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
