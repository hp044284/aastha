{!! 
    Html::form()
        ->action(isset($doctor) ? route('doctors.update', $doctor->id) : route('doctors.store'))
        ->method(isset($doctor) ? 'POST' : 'POST')
        ->attribute('class', 'row g-3 needs-validation')
        ->attribute('id', 'create-form')
        ->attribute('enctype', 'multipart/form-data')
        ->open()
!!}
    @if(isset($doctor))
        @method('PUT')
    @endif

    <div class="col-md-6">
        {!! Html::label('Name', 'name')->class('form-label') !!}
        {!! 
            Html::text('name', old('name', isset($doctor) ? $doctor->name : ''))
                ->id('name')
                ->class('form-control' . ($errors->has('name') ? ' is-invalid' : ''))
                ->attribute('placeholder', 'Doctor Name')
        !!}
        @if ($errors->has('name'))
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
        @endif
    </div>

    <div class="col-md-6">
        <x-image-upload name="image" label="Profile Image" :value="isset($doctor) ? $doctor->image : null" />
    </div>

    <div class="col-md-6">
        {!! Html::label('Position', 'position_id')->class('form-label') !!}
        {!! 
            Html::select('position_id', 
                isset($positions) ? $positions->pluck('title', 'id')->toArray() : [], 
                old('position_id', isset($doctor) ? $doctor->position_id : null)
            )
            ->id('position_id')
            ->class('form-select' . ($errors->has('position_id') ? ' is-invalid' : ''))
            ->attribute('placeholder', 'Select Position')
        !!}
        @if ($errors->has('position_id'))
            <div class="invalid-feedback">
                {{ $errors->first('position_id') }}
            </div>
        @endif
    </div>

    <div class="col-md-6">
        {!! Html::label('Specializations', 'specialization_id')->class('form-label') !!}
        {!! 
            Html::select('specialization_id[]', 
                isset($specializations) ? $specializations->pluck('title', 'id')->toArray() : [], 
                old('specialization_id', isset($doctor) ? (array)$doctor->specializations->pluck('id')->toArray() : [])
            )
            ->id('specialization_id')
            ->class('form-select select2' . ($errors->has('specialization_id') ? ' is-invalid' : ''))
            ->attribute('multiple', 'multiple')
            ->attribute('placeholder', 'Select Specializations')
        !!}
        @if ($errors->has('specialization_id'))
            <div class="invalid-feedback">
                {{ $errors->first('specialization_id') }}
            </div>
        @endif
    </div>
    <script>
        
    </script>

    <div class="col-md-6">
        {!! Html::label('Affiliation', 'affiliation')->class('form-label') !!}
        {!! 
            Html::text('affiliation', old('affiliation', isset($doctor) ? $doctor->affiliation : ''))
                ->id('affiliation')
                ->class('form-control' . ($errors->has('affiliation') ? ' is-invalid' : ''))
                ->attribute('placeholder', 'Affiliation')
        !!}
        @if ($errors->has('affiliation'))
            <div class="invalid-feedback">
                {{ $errors->first('affiliation') }}
            </div>
        @endif
    </div>

    <div class="col-md-12">
        {!! Html::label('About Us', 'about_us')->class('form-label') !!}
        {!! 
            Html::textarea('about_us', old('about_us', isset($doctor) ? $doctor->about_us : ''))
                ->id('about_us')
                ->class('form-control' . ($errors->has('about_us') ? ' is-invalid' : ''))
                ->attribute('placeholder', 'About the doctor')
                ->attribute('rows', 4)
        !!}
        @if ($errors->has('about_us'))
            <div class="invalid-feedback">
                {{ $errors->first('about_us') }}
            </div>
        @endif
    </div>

    <div class="col-md-12">
        <label class="form-label fw-bold fs-5 mt-4 mb-2 d-block">
            <i class="bx bx-book"></i> Educations
        </label>
        <div id="education-wrapper"></div>
        <button type="button" id="add-education-btn" class="btn btn-primary">Add Education</button>
    </div>

    <div class="col-md-12">
        <!-- Positions Section -->
        <label class="form-label fw-bold fs-5 mt-4 mb-2 d-block">
            <i class="bx bx-briefcase"></i> Positions
        </label>
        <!-- Wrapper for positions -->
        <div id="position-wrapper"></div>
        <!-- Add button -->
        <button type="button" id="add-position-btn" class="btn btn-primary mt-3">
        Add Position
        </button>
    </div>

    <div class="col-md-12">
        <label class="form-label fw-bold fs-5 mt-4 mb-2 d-block">
            <i class="bx bx-link"></i> Affiliations
        </label>
        <div id="affiliations-wrapper"></div>
        <button type="button" id="add-affiliation-btn" class="btn btn-primary mt-3">Add Affiliation</button>
    </div>

    <div class="col-md-6">
        {!! Html::label('Status', 'status')->class('form-label') !!}
        <div class="form-check form-switch mt-2">
            {!! 
                Html::checkbox('status', 1, isset($doctor) ? (bool)$doctor->status : (bool)old('status', true))
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
    <script type="text/javascript">
        function initRepeater({wrapperSelector, addBtnSelector, rowTemplateSelector}) {
            const wrapper = document.querySelector(wrapperSelector);
            const addBtn = document.querySelector(addBtnSelector);
            const rowTemplate = document.querySelector(rowTemplateSelector).innerHTML;

            function reindexRows() {
                wrapper.querySelectorAll('.repeat-group').forEach((group, index) => {
                    group.querySelectorAll('[name]').forEach(input => {
                        input.name = input.name.replace(/\[\d+\]/, `[${index}]`);
                        input.id = input.id.replace(/_\d+_/, `_${index}_`);
                    });
                });
            }

            function updateRemoveButtons() {
                const groups = wrapper.querySelectorAll('.repeat-group');
                groups.forEach(btnGroup => {
                    const removeBtn = btnGroup.querySelector('.btn-remove-row');
                    if (removeBtn) {
                        removeBtn.style.display = (groups.length > 1) ? 'inline-flex' : 'none';
                    }
                });
            }

            function addRow() {
                const index = wrapper.querySelectorAll('.repeat-group').length;
                const newRowHtml = rowTemplate
                    .replace(/\[0\]/g, `[${index}]`)
                    .replace(/_0_/g, `_${index}_`);
                const div = document.createElement('div');
                div.innerHTML = newRowHtml;
                wrapper.appendChild(div.firstElementChild);
                updateRemoveButtons();
                $(".datepicker").flatpickr();
            }

            // If new form and no rows exist → add one default
            if (wrapper.querySelectorAll('.repeat-group').length === 0) {
                addRow();
            }

            addBtn.addEventListener('click', () => {
                addRow();
            });

            wrapper.addEventListener('click', (e) => {
                if (e.target.closest('.btn-remove-row')) {
                    const groups = wrapper.querySelectorAll('.repeat-group');
                    if (groups.length > 1) {
                        e.target.closest('.repeat-group').remove();
                        reindexRows();
                        updateRemoveButtons();
                    }
                }
            });

            updateRemoveButtons();
        }

        document.addEventListener("DOMContentLoaded", function () 
        {
            initRepeater({
                wrapperSelector: '#education-wrapper',
                addBtnSelector: '#add-education-btn',
                rowTemplateSelector: '#education-template',
                addFirst: true
            });

            initRepeater({
                wrapperSelector: '#position-wrapper',
                addBtnSelector: '#add-position-btn',
                rowTemplateSelector: '#position-template',
                addFirst: true // ensures 1 default row appears
            });

            initRepeater({
                wrapperSelector: '#affiliations-wrapper',
                addBtnSelector: '#add-affiliation-btn',
                rowTemplateSelector: '#affiliation-template',
                addFirst: true // ensures 1 default row appears
            });
        });

        $(document).ready(function() {
            $('#specialization_id').select2({
                placeholder: "Select Specializations",
                allowClear: true
            });
            $('#position_id').select2({
                placeholder: "Select Specializations",
                allowClear: true
            });

            $(".datepicker").flatpickr();
        });

        document.addEventListener("DOMContentLoaded", function () {
            new ImageUploader(".image-upload-wrapper");
        });
    </script>
    <!-- Row Template (hidden) -->
    <script type="text/template" id="education-template">
        <div class="repeat-group border rounded-4 mb-4 bg-white shadow-sm px-3 py-4">
            <div class="row g-4">
                <div class="col-md-6">
                    <input type="text" name="education[0][degree]" id="education_0_degree" placeholder="Degree" class="form-control">
                </div>
                <div class="col-md-6">
                    <input type="text" name="education[0][institution]" id="education_0_institution" placeholder="Institution" class="form-control">
                </div>
                <div class="col-md-6">
                    <input type="number" name="education[0][start_year]" id="education_0_start_year" placeholder="Start Year" class="form-control datepicker">
                </div>
                <div class="col-md-6">
                    <input type="number" name="education[0][end_year]" id="education_0_end_year" placeholder="End Year" class="form-control datepicker">
                </div>
                <div class="col-12 text-end">
                    <button type="button" class="btn btn-outline-danger btn-remove-row">Remove</button>
                </div>
            </div>
        </div>
    </script>

    <!-- Row Template (hidden) for Positions -->
    <script type="text/template" id="position-template">
        <div class="repeat-group border rounded-4 mb-4 bg-white shadow-sm px-3 py-4">
            <div class="row g-4">
                <div class="col-md-6">
                    <input type="text" name="positions[0][position_title]" id="positions_0_position_title" placeholder="Position Title" class="form-control">
                </div>
                <div class="col-md-6">
                    <input type="text" name="positions[0][organization]" id="positions_0_organization" placeholder="Organization" class="form-control">
                </div>
                <div class="col-md-6">
                    <input type="number" name="positions[0][start_year]" id="positions_0_start_year" placeholder="Start Year" class="form-control datepicker">
                </div>
                <div class="col-md-6">
                    <input type="number" name="positions[0][end_year]" id="positions_0_end_year" placeholder="End Year" class="form-control datepicker">
                </div>
                <div class="col-12 text-end">
                    <button type="button" class="btn btn-outline-danger btn-remove-row">Remove</button>
                </div>
            </div>
        </div>
    </script>

    <!-- Row Template (hidden) for Affiliations -->
    <script type="text/template" id="affiliation-template">
        <div class="repeat-group border rounded-4 mb-4 bg-white shadow-sm px-3 py-4">
            <div class="row g-4">
                <div class="col-md-4">
                    <input type="text" name="affiliations[0][organization]" id="affiliations_0_organization" placeholder="Organization" class="form-control">
                </div>
                <div class="col-md-4">
                    <input type="text" name="affiliations[0][affiliation_type]" id="affiliations_0_affiliation_type" placeholder="Affiliation Type" class="form-control">
                </div>
                <div class="col-md-4">
                    <input type="text" name="affiliations[0][role_title]" id="affiliations_0_role_title" placeholder="Role Title" class="form-control">
                </div>
                <div class="col-12 text-end">
                    <button type="button" class="btn btn-outline-danger btn-remove-row">Remove</button>
                </div>
            </div>
        </div>
    </script>

@endpush