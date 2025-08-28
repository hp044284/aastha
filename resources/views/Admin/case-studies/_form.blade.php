{!! 
    Html::form()
        ->action(isset($caseStudy) ? route('case-studies.update', $caseStudy->id) : route('case-studies.store'))
        ->method('POST')
        ->attribute('class', 'row g-3 needs-validation')
        ->attribute('id', 'create-form')
        ->attribute('enctype', 'multipart/form-data')
        ->open()
!!}
    @if(isset($caseStudy))
        @method('PUT')
    @endif

    <div class="col-md-6">
        {!! 
            Html::label('Title', 'title')->class('form-label') 
        !!}
        {!! 
            Html::text('title', old('title', isset($caseStudy) ? $caseStudy->title : ''))
                ->id('title')
                ->class('form-control' . ($errors->has('title') ? ' is-invalid' : ''))
                ->attribute('placeholder', 'Case Study Title')
                ->required()
        !!}
        @if ($errors->has('title'))
            <div class="invalid-feedback">
                {{ $errors->first('title') }}
            </div>
        @endif
    </div>

    <div class="col-md-6">
        {!! 
            Html::label('Subtitle', 'subtitle')->class('form-label') 
        !!}
        {!! 
            Html::text('subtitle', old('subtitle', isset($caseStudy) ? $caseStudy->subtitle : ''))
                ->id('subtitle')
                ->class('form-control' . ($errors->has('subtitle') ? ' is-invalid' : ''))
                ->attribute('placeholder', 'Case Study Subtitle')
        !!}
        @if ($errors->has('subtitle'))
            <div class="invalid-feedback">
                {{ $errors->first('subtitle') }}
            </div>
        @endif
    </div>

    <div class="col-md-6">
        {!! 
            Html::label('Age', 'age')->class('form-label') 
        !!}
        {!! 
            Html::number('age', old('age', isset($caseStudy) ? $caseStudy->age : ''))
                ->id('age')
                ->class('form-control' . ($errors->has('age') ? ' is-invalid' : ''))
                ->attribute('placeholder', 'Patient Age')
                ->attribute('min', '0')
        !!}
        @if ($errors->has('age'))
            <div class="invalid-feedback">
                {{ $errors->first('age') }}
            </div>
        @endif
    </div>

    <div class="col-md-6">
        {!! Html::label('Gender', 'gender')->class('form-label') !!}
        {!! 
            Html::select('gender', [
                '' => 'Select Gender',
                'male' => 'Male',
                'female' => 'Female',
                'other' => 'Other'
            ], old('gender', isset($caseStudy) ? $caseStudy->gender : ''))
                ->id('gender')
                ->class('form-select' . ($errors->has('gender') ? ' is-invalid' : ''))
        !!}
        @if ($errors->has('gender'))
            <div class="invalid-feedback">
                {{ $errors->first('gender') }}
            </div>
        @endif
    </div>

    <div class="col-md-12">
        {!! 
            Html::label('Description', 'description')->class('form-label') 
        !!}
        {!! 
            Html::textarea('description', old('description', isset($caseStudy) ? $caseStudy->description : ''))
                ->id('description')
                ->class('form-control' . ($errors->has('description') ? ' is-invalid' : ''))
                ->attribute('placeholder', 'Case Study Description')
                ->attribute('rows', '4')
        !!}
        @if ($errors->has('description'))
            <div class="invalid-feedback">
                {{ $errors->first('description') }}
            </div>
        @endif
    </div>

    <div class="col-md-12">
        {!! 
            Html::label('Medical History', 'medical_history')->class('form-label') 
        !!}
        {!! 
            Html::textarea('medical_history', old('medical_history', isset($caseStudy) ? $caseStudy->medical_history : ''))
                ->id('medical_history')
                ->class('form-control' . ($errors->has('medical_history') ? ' is-invalid' : ''))
                ->attribute('placeholder', 'Patient Medical History')
                ->attribute('rows', '3')
        !!}
        @if ($errors->has('medical_history'))
            <div class="invalid-feedback">
                {{ $errors->first('medical_history') }}
            </div>
        @endif
    </div>

    <div class="col-md-6">
        {!! 
            Html::label('Presenting Symptoms', 'presenting_symptoms')->class('form-label') 
        !!}
        {!! 
            Html::textarea('presenting_symptoms', old('presenting_symptoms', isset($caseStudy) ? $caseStudy->presenting_symptoms : ''))
                ->id('presenting_symptoms')
                ->class('form-control' . ($errors->has('presenting_symptoms') ? ' is-invalid' : ''))
                ->attribute('placeholder', 'Presenting Symptoms')
                ->attribute('rows', '3')
        !!}
        @if ($errors->has('presenting_symptoms'))
            <div class="invalid-feedback">
                {{ $errors->first('presenting_symptoms') }}
            </div>
        @endif
    </div>

    <div class="col-md-6">
        {!! 
            Html::label('Duration of Symptoms', 'duration_of_symptoms')->class('form-label') 
        !!}
        {!! 
            Html::text('duration_of_symptoms', old('duration_of_symptoms', isset($caseStudy) ? $caseStudy->duration_of_symptoms : ''))
                ->id('duration_of_symptoms')
                ->class('form-control' . ($errors->has('duration_of_symptoms') ? ' is-invalid' : ''))
                ->attribute('placeholder', 'e.g., 2 weeks, 1 month')
        !!}
        @if ($errors->has('duration_of_symptoms'))
            <div class="invalid-feedback">
                {{ $errors->first('duration_of_symptoms') }}
            </div>
        @endif
    </div>

    <div class="col-md-12">
        {!! 
            Html::label('Risk Factor', 'risk_factor')->class('form-label') 
        !!}
        {!! 
            Html::textarea('risk_factor', old('risk_factor', isset($caseStudy) ? $caseStudy->risk_factor : ''))
                ->id('risk_factor')
                ->class('form-control' . ($errors->has('risk_factor') ? ' is-invalid' : ''))
                ->attribute('placeholder', 'Risk Factors')
                ->attribute('rows', '3')
        !!}
        @if ($errors->has('risk_factor'))
            <div class="invalid-feedback">
                {{ $errors->first('risk_factor') }}
            </div>
        @endif
    </div>

    <div class="col-md-12">
        {!! 
            Html::label('Outcome', 'outcome')->class('form-label') 
        !!}
        {!! 
            Html::textarea('outcome', old('outcome', isset($caseStudy) ? $caseStudy->outcome : ''))
                ->id('outcome')
                ->class('form-control' . ($errors->has('outcome') ? ' is-invalid' : ''))
                ->attribute('placeholder', 'Outcome')
                ->attribute('rows', '3')
        !!}
        @if ($errors->has('outcome'))
            <div class="invalid-feedback">
                {{ $errors->first('outcome') }}
            </div>
        @endif
    </div>

    <div class="col-md-12">
        {!! 
            Html::label('Image', 'image')->class('form-label') 
        !!}
        {!! 
            Html::file('image')
                ->id('image')
                ->class('form-control' . ($errors->has('image') ? ' is-invalid' : ''))
                ->attribute('accept', 'image/*')
        !!}
        @if ($errors->has('image'))
            <div class="invalid-feedback">
                {{ $errors->first('image') }}
            </div>
        @endif
        @if(isset($caseStudy) && $caseStudy->image)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $caseStudy->image) }}" alt="Current Image" class="img-thumbnail" style="max-height: 100px;">
            </div>
        @endif
    </div>

    <div class="col-md-6">
        {!! Html::label('Status', 'status')->class('form-label') !!}
        <div class="form-check form-switch mt-2">
            {!! 
                Html::checkbox('status', 1, isset($caseStudy) ? (bool)$caseStudy->status : (bool)old('status', true))
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

@push('js')
    <script src="{{ asset('assets/js/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript">

        $(function()
        {
            CKEDITOR.replace( 'description',
            {
                height : 250,
                fullPage : true,
                allowedContent : true,
            });
        });
    </script>
@endpush