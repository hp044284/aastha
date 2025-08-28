{!! 
    Html::form()
        ->action(isset($service) ? route('services.update', $service->id) : route('services.store'))
        ->method('POST')
        ->attribute('class', 'row g-3 needs-validation')
        ->attribute('id', 'create-form')
        ->attribute('enctype', 'multipart/form-data')
        ->open()
!!}
    @if(isset($service))
        @method('PUT')
    @endif

    <div class="col-md-6">
        {!! Html::label('Title', 'title')->class('form-label') !!}
        {!! 
            Html::text('title', old('title', isset($service) ? $service->title : ''))
                ->id('title')
                ->class('form-control' . ($errors->has('title') ? ' is-invalid' : ''))
                ->attribute('placeholder', 'Service Title')
        !!}
        @if ($errors->has('title'))
            <div class="invalid-feedback">
                {{ $errors->first('title') }}
            </div>
        @endif
    </div>

    <div class="col-md-6">
        {!! Html::label('Icon', 'icon')->class('form-label') !!}
        {!! 
            Html::text('icon', old('icon', isset($service) ? $service->icon : ''))
                ->id('icon')
                ->class('form-control' . ($errors->has('icon') ? ' is-invalid' : ''))
                ->attribute('placeholder', 'Icon (e.g. fa fa-star)')
        !!}
        @if ($errors->has('icon'))
            <div class="invalid-feedback">
                {{ $errors->first('icon') }}
            </div>
        @endif
    </div>

    <div class="col-md-6">
        {!! Html::label('Meta Title', 'meta_title')->class('form-label') !!}
        {!! 
            Html::text('meta_title', old('meta_title', isset($service) ? $service->meta_title : ''))
                ->id('meta_title')
                ->class('form-control' . ($errors->has('meta_title') ? ' is-invalid' : ''))
                ->attribute('placeholder', 'Meta Title')
        !!}
        @if ($errors->has('meta_title'))
            <div class="invalid-feedback">
                {{ $errors->first('meta_title') }}
            </div>
        @endif
    </div>

    <div class="col-md-6">
        {!! Html::label('Category', 'category_id')->class('form-label') !!}
        {!! 
            Html::select('category_id', ['' => 'Select Category'] + ($sub_categories ?? []), old('category_id', isset($service) ? $service->category_id : ''))
                ->id('category_id')
                ->class('form-select' . ($errors->has('category_id') ? ' is-invalid' : ''))
        !!}
        @if ($errors->has('category_id'))
            <div class="invalid-feedback">
                {{ $errors->first('category_id') }}
            </div>
        @endif
    </div>

    <div class="col-md-6">
        {!! Html::label('Meta Keyword', 'meta_keyword')->class('form-label') !!}
        {!! 
            Html::text('meta_keyword', old('meta_keyword', isset($service) ? $service->meta_keyword : ''))
                ->id('meta_keyword')
                ->class('form-control' . ($errors->has('meta_keyword') ? ' is-invalid' : ''))
                ->attribute('placeholder', 'Meta Keyword')
        !!}
        @if ($errors->has('meta_keyword'))
            <div class="invalid-feedback">
                {{ $errors->first('meta_keyword') }}
            </div>
        @endif
    </div>

    <div class="col-md-6">
        {!! Html::label('Meta Description', 'meta_description')->class('form-label') !!}
        {!! 
            Html::textarea('meta_description', old('meta_description', isset($service) ? $service->meta_description : ''))
                ->id('meta_description')
                ->class('form-control' . ($errors->has('meta_description') ? ' is-invalid' : ''))
                ->attribute('placeholder', 'Meta Description')
                ->attribute('rows', 2)
        !!}
        @if ($errors->has('meta_description'))
            <div class="invalid-feedback">
                {{ $errors->first('meta_description') }}
            </div>
        @endif
    </div>

    <div class="col-md-6">
        <x-image-upload name="file_name" label="Profile Image" :value="isset($service) ? $service->file_name : null" />
    </div>

    <div class="col-md-12">
        {!! Html::label('Description', 'description')->class('form-label') !!}
        {!! 
            Html::textarea('description', old('description', isset($service) ? $service->description : ''))
                ->id('description')
                ->class('form-control ckeditor' . ($errors->has('description') ? ' is-invalid' : ''))
                ->attribute('placeholder', 'Description')
                ->attribute('rows', 5)
        !!}
        @if ($errors->has('description'))
            <div class="invalid-feedback">
                {{ $errors->first('description') }}
            </div>
        @endif
    </div>

    <div class="col-md-6">
        {!! Html::label('Status', 'status')->class('form-label') !!}
        <div class="form-check form-switch mt-2">
            {!! 
                Html::checkbox('status', 1, isset($service) ? (bool)$service->status : false)
                    ->id('status')
                    ->class('form-check-input')
            !!}
            {!! Html::label('Active', 'status')->class('form-check-label') !!}
        </div>
    </div>

    <div class="col-md-12 mb-4">
        <label class="form-label">FAQs</label>
        <div id="faqs-wrapper">
            @php
                $faqs = old('faqs', isset($service) && isset($service->faqs) ? $service->faqs : [['question' => '', 'answer' => '']]);
            @endphp
            @foreach ($faqs as $i => $faq)
                <div class="faq-item mb-3" data-index="{{ $i }}">
                    <div class="mb-2">
                        <label class="form-label" for="faqs-{{ $i }}-question">Question</label>
                        <input 
                            type="text" 
                            id="faqs-{{ $i }}-question"
                            name="faqs[{{ $i }}][question]" 
                            class="form-control" 
                            placeholder="Question" 
                            value="{{ old("faqs.$i.question", $faq['question'] ?? '') }}">
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="faqs-{{ $i }}-answer">Answer</label>
                        <textarea 
                            id="faqs-{{ $i }}-answer"
                            name="faqs[{{ $i }}][answer]" 
                            class="form-control" 
                            placeholder="Answer" 
                            rows="2">{{ old("faqs.$i.answer", $faq['answer'] ?? '') }}</textarea>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-danger remove-faq" title="Remove FAQ" @if(count($faqs) == 1) disabled @endif><i class="bx bx-trash"></i></button>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-2">
            <button type="button" class="btn btn-success add-faq" id="add-faq-btn" title="Add FAQ"><i class="fa fa-plus"></i> Add FAQ</button>
        </div>
        @if ($errors->has('faqs'))
            <div class="invalid-feedback d-block">
                {{ $errors->first('faqs') }}
            </div>
        @endif
    </div>
    @push('js')
    <script>
        
    </script>
    @endpush

    <div class="col-md-12">
        <div class="d-md-flex d-grid align-items-center gap-3">
            {!! Html::button('Submit')->type('submit')->class('btn btn-primary px-4') !!}
        </div>
    </div>
{!! Html::form()->close() !!}

@push('js')
    <script src="{{ asset('assets/js/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript">

        document.addEventListener("DOMContentLoaded", function () {
            new ImageUploader(".image-upload-wrapper");
        });

        $(function()
        {
            CKEDITOR.replace( 'description',
            {
                height : 250,
                fullPage : true,
                allowedContent : true,
            });
        });

        $(document).ready(function() {
            function updateRemoveButtons() {
                let $items = $('#faqs-wrapper .faq-item');
                $items.find('.remove-faq').prop('disabled', $items.length === 1);
            }

            function getNextIndex() {
                let max = -1;
                $('#faqs-wrapper .faq-item').each(function() {
                    let idx = parseInt($(this).attr('data-index'));
                    if (!isNaN(idx) && idx > max) max = idx;
                });
                return max + 1;
            }

            $('#add-faq-btn').on('click', function() {
                let nextIndex = getNextIndex();
                let $new = $(
                    `<div class="faq-item mb-3" data-index="${nextIndex}">
                        <div class="mb-2">
                            <label class="form-label" for="faqs-${nextIndex}-question">Question</label>
                            <input type="text" id="faqs-${nextIndex}-question" name="faqs[${nextIndex}][question]" class="form-control" placeholder="Question">
                        </div>
                        <div class="mb-2">
                            <label class="form-label" for="faqs-${nextIndex}-answer">Answer</label>
                            <textarea id="faqs-${nextIndex}-answer" name="faqs[${nextIndex}][answer]" class="form-control" placeholder="Answer" rows="2"></textarea>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-danger remove-faq" title="Remove FAQ"><i class="bx bx-trash"></i></button>
                        </div>
                    </div>`
                );
                $('#faqs-wrapper').append($new);
                updateRemoveButtons();
            });

            $('#faqs-wrapper').on('click', '.remove-faq', function() {
                $(this).closest('.faq-item').remove();
                updateRemoveButtons();
            });

            updateRemoveButtons();
        });
    </script>
@endpush