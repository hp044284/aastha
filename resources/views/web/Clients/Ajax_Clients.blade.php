@if(!empty($entities) && $entities->isNotEmpty())
    @foreach($entities as $entity_Key => $entity)
        <div class="col-xl-2 col-lg-3 col-md-6 grid-item">
            <div class="tp-port-item mb-30">
                <div class="tp-case-img">
                    <div class="fix">
                        <img src="{{ getDynamicImage($entity->File_Name, 'Uploads/Clients') }}" alt="{{ $entity->Title ?? '' }}" class="img-fluid w-100" />
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif