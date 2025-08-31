<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="name" class="form-label">
                Name <span class="text-danger">*</span>
            </label>
            {!! html()->text('name')
                ->id('name')
                ->class('form-control' . ($errors->has('name') ? ' is-invalid' : ''))
                ->required() !!}
            @if($errors->has('name'))
                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {!! html()->label('Profile Photo', 'file_name')->class('form-label') !!}
            {!! html()->file('file_name')
                ->id('file_name')
                ->accept('image/*')
                ->class('form-control' . ($errors->has('file_name') ? ' is-invalid' : '')) !!}
            @if($errors->has('file_name'))
                <div class="invalid-feedback">{{ $errors->first('file_name') }}</div>
            @endif
            <small class="form-text text-muted">Accepted formats: JPG, PNG, GIF, SVG, WEBP. Max size: 2MB</small>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            {!! html()->label('Department', 'department_id')->class('form-label') !!}
            {!! html()->select('department_id', 
                    ['' => 'Select Department'] + ($departments->toArray() ?? []), 
                )
                ->id('department_id')
                ->class('form-select' . ($errors->has('department_id') ? ' is-invalid' : '')) !!}
            @if($errors->has('department_id'))
                <div class="invalid-feedback">{{ $errors->first('department_id') }}</div>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            {!! html()->label('Position', 'positions_id')->class('form-label') !!}
            {!! html()->select('positions_id', 
                    ['' => 'Select Position'] + ($positions->toArray() ?? []), 
                )
                ->id('positions_id')
                ->class('form-select' . ($errors->has('positions_id') ? ' is-invalid' : '')) !!}
            @if($errors->has('positions_id'))
                <div class="invalid-feedback">{{ $errors->first('positions_id') }}</div>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            {!! html()->label('Experience', 'experience')->class('form-label') !!}
            @php
                $experienceOptions = [];
                for ($i = 1; $i <= 50; $i++) {
                    $experienceOptions[$i] = $i . '+ years';
                }
            @endphp
            {!! html()->select('experience', ['' => 'Select Experience'] + $experienceOptions, old('experience', $team->experience ?? ''))
                ->id('experience')
                ->class('form-select' . ($errors->has('experience') ? ' is-invalid' : '')) !!}
            @if($errors->has('experience'))
                <div class="invalid-feedback">{{ $errors->first('experience') }}</div>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <div class="form-check">
                {!! html()->hidden('status', 0) !!}
                <div class="form-check form-switch mt-2">
                    {!! html()->checkbox('status', old('status', $team->status ?? false) ? true : false, 1)
                        ->id('status')
                        ->class('form-check-input') !!}
                    {!! html()->label('Status', 'status')->class('form-check-label') !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-end gap-2">
            {!! html()->button(isset($team) ? 'Update Team Member' : 'Create Team Member')
                ->type('submit')
                ->class('btn btn-primary') !!}
        </div>
    </div>
</div>