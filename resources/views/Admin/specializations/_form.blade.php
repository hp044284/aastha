{!! 
    Html::form()
        ->action(isset($specialization) ? route('specializations.update', $specialization->id) : route('specializations.store'))
        ->method('POST')
        ->attribute('class', 'row g-3 needs-validation')
        ->attribute('id', 'create-form')
        ->open()
!!}
    @if(isset($specialization))
        @method('PUT')
    @endif

    <div class="col-md-6">
        {!! 
            Html::label('Specialization Name', 'name')->class('form-label') 
        !!}
        {!! 
            Html::text('title', old('name', isset($specialization) ? $specialization->title : ''))
                ->id('name')
                ->class('form-control' . ($errors->has('title') ? ' is-invalid' : ''))
                ->attribute('placeholder', 'Specialization Name')
        !!}
        @if ($errors->has('name'))
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
        @endif
    </div>

    <div class="col-md-6">
        {!! Html::label('Status', 'status')->class('form-label') !!}
        <div class="form-check form-switch mt-2">
            {!! 
                Html::checkbox('status', 1, isset($specialization) ? (bool)$specialization->status : (bool)old('status', true))
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