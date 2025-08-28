{!! 
    Html::form()
        ->action(isset($testimonial) ? route('testimonials.update', $testimonial->id) : route('testimonials.store'))
        ->method('POST')
        ->attribute('class', 'row g-3 needs-validation')
        ->attribute('id', 'testimonial-form')
        ->attribute('enctype', 'multipart/form-data')
        ->open()
!!}
    @if(isset($testimonial))
        @method('PUT')
    @endif

    <div class="col-md-6">
        {!! 
            Html::label('Name', 'name')->class('form-label') 
        !!}
        {!! 
            Html::text('name', old('name', isset($testimonial) ? $testimonial->name : ''))
                ->id('name')
                ->class('form-control' . ($errors->has('name') ? ' is-invalid' : ''))
                ->attribute('placeholder', 'Name')
        !!}
        @if ($errors->has('name'))
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
        @endif
    </div>

    <div class="col-md-6">
        {!! 
            Html::label('City', 'city')->class('form-label') 
        !!}
        {!! 
            Html::text('city', old('city', isset($testimonial) ? $testimonial->city : ''))
                ->id('city')
                ->class('form-control' . ($errors->has('city') ? ' is-invalid' : ''))
                ->attribute('placeholder', 'City')
        !!}
        @if ($errors->has('city'))
            <div class="invalid-feedback">
                {{ $errors->first('city') }}
            </div>
        @endif
    </div>

    <div class="col-md-6">
        {!! 
            Html::label('Ratting', 'ratting')->class('form-label') 
        !!}
        {!! 
            Html::number('ratting', old('ratting', isset($testimonial) ? $testimonial->ratting : ''))
                ->id('ratting')
                ->class('form-control' . ($errors->has('ratting') ? ' is-invalid' : ''))
                ->attribute('placeholder', 'Ratting')
                ->attribute('min', 1)
                ->attribute('max', 5)
        !!}
        @if ($errors->has('ratting'))
            <div class="invalid-feedback">
                {{ $errors->first('ratting') }}
            </div>
        @endif
    </div>

    <div class="col-md-6">
        {!! 
            Html::label('Treatment', 'treatment')->class('form-label') 
        !!}
        {!! 
            Html::text('treatment', old('treatment', isset($testimonial) ? $testimonial->treatment : ''))
                ->id('treatment')
                ->class('form-control' . ($errors->has('treatment') ? ' is-invalid' : ''))
                ->attribute('placeholder', 'Treatment')
        !!}
        @if ($errors->has('treatment'))
            <div class="invalid-feedback">
                {{ $errors->first('treatment') }}
            </div>
        @endif
    </div>

    <div class="col-md-6">
        {!! 
            Html::label('Treatment Date', 'treatment_date')->class('form-label') 
        !!}
        {!! 
            Html::date('treatment_date', old('treatment_date', isset($testimonial) ? $testimonial->treatment_date : ''))
                ->id('treatment_date')
                ->class('form-control' . ($errors->has('treatment_date') ? ' is-invalid' : ''))
        !!}
        @if ($errors->has('treatment_date'))
            <div class="invalid-feedback">
                {{ $errors->first('treatment_date') }}
            </div>
        @endif
    </div>

    <div class="col-md-6">
        {!! Html::label('Status', 'status')->class('form-label') !!}
        <div class="form-check form-switch mt-2">
            {!! 
                Html::checkbox('status', 1, isset($testimonial) ? (bool)$testimonial->status : (bool)old('status', true))
                    ->id('status')
                    ->class('form-check-input')
            !!}
            {!! Html::label('Active', 'status')->class('form-check-label') !!}
        </div>
    </div>

    <div class="col-md-12">
        {!! 
            Html::label('Message', 'message')->class('form-label') 
        !!}
        {!! 
            Html::textarea('message', old('message', isset($testimonial) ? $testimonial->message : ''))
                ->id('message')
                ->class('form-control' . ($errors->has('message') ? ' is-invalid' : ''))
                ->attribute('placeholder', 'Message')
                ->attribute('rows', 4)
        !!}
        @if ($errors->has('message'))
            <div class="invalid-feedback">
                {{ $errors->first('message') }}
            </div>
        @endif
    </div>

    <div class="col-md-6">
        <x-image-upload 
            name="image" 
            label="Profile Image" 
            :value="isset($testimonial) ? $testimonial->image : null"  
            :is-store="true"
        />
        @if ($errors->has('image'))
            <div class="invalid-feedback">
                {{ $errors->first('image') }}
            </div>
        @endif
    </div>

    <div class="col-md-12">
        <div class="d-md-flex d-grid align-items-center gap-3">
            {!! Html::button('Submit')->type('submit')->class('btn btn-primary px-4') !!}
        </div>
    </div>
{!! Html::form()->close() !!}
@push('js')
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function () {
            new ImageUploader(".image-upload-wrapper");
        });
    </script>
@endpush