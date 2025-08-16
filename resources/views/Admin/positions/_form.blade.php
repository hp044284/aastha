{!! 
    Html::form()
        ->action(isset($position) ? route('positions.update', $position->id) : route('positions.store'))
        ->method('POST')
        ->attribute('class', 'row g-3 needs-validation')
        ->attribute('id', 'create-form')
        ->open()
!!}
    @if(isset($position))
        @method('PUT')
    @endif

    <div class="col-md-6">
        {!! 
            Html::label('Position Title', 'title')->class('form-label') 
        !!}
        {!! 
            Html::text('title', old('title', isset($position) ? $position->title : ''))
                ->id('title')
                ->class('form-control' . ($errors->has('title') ? ' is-invalid' : ''))
                ->attribute('placeholder', 'Position Title')
        !!}
        @if ($errors->has('title'))
            <div class="invalid-feedback">
                {{ $errors->first('title') }}
            </div>
        @endif
    </div>

    <div class="col-md-6">
        {!! Html::label('Status', 'status')->class('form-label') !!}
        <div class="form-check form-switch mt-2">
            {!! 
                Html::checkbox('status', 1, isset($position) ? (bool)$position->status : (bool)old('status', true))
                    ->id('status')
                    ->class('form-check-input')
            !!}
            {!! Html::label('Active', 'status')->class('form-check-label') !!}
        </div>
    </div>

    <div class="col-md-12">
        <div class="d-md-flex d-grid align-items-center gap-3">
            {!! Html::button('Submit')->type('submit')->class('btn btn-primary px-4') !!}
        </div>
    </div>
{!! Html::form()->close() !!}