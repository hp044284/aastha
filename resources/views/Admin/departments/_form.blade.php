{!! 
    Html::form()
        ->action(isset($department) ? route('departments.update', $department->id) : route('departments.store'))
        ->method(isset($department) ? 'POST' : 'POST')
        ->attribute('class', 'row g-3 needs-validation')
        ->attribute('id', 'create-form')
        ->open()
!!}
    @if(isset($department))
        @method('PUT')
    @endif

    <div class="col-md-6">
        {!! 
            Html::label('Department Name', 'name')->class('form-label') 
        !!}
        {!! 
            Html::text('name', old('name', isset($department) ? $department->name : ''))
                ->id('name')
                ->class('form-control' . ($errors->has('name') ? ' is-invalid' : ''))
                ->attribute('placeholder', 'Department Name')
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
                Html::checkbox('status', 1, isset($department) ? (bool)$department->status : (bool)old('status', true))
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