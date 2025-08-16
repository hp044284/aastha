@if($entities->isNotEmpty())
    @foreach($entities as $entityKey => $entity)
        <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6">
            <div class="product__item mb-30 text-center transition-3">
                <div class="product__thumb p-relative mb-30 w-img fix">
                    <a href="{{ route('web_product.detail',$entity->Slug) }}">
                        <img src="{{ getDynamicImage($entity->File_Name , 'Uploads/Products') }}" alt="{{ $entity->Product_Name ?? '' }}">
                    </a>
                    <div class="product__icon">
                        <a href="{{ route('web_product.detail',$entity->Slug) }}"><i class="fal fa-eye"></i></a>
                    </div>
                </div>
                <div class="product__content">
                    <h4 class="product__title">
                        <a href="{{ route('web_product.detail',$entity->Slug) }}">{{ $entity->Product_Name ?? '' }}</a>
                    </h4>
                    <div class="breadcrumb__list mb-10">
                        <span><i class="fab fa-whatsapp"></i>
                            <a href="javascript:void(0);"> WhatsApp Now</a>
                        <span>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="mt-4">
        {{ $entities->links('Web_Site.Paginations.Index') }}
    </div>
@else
    <div class="col-12">
        <div class="text-center">
            <h4 class="text-center">No products found</h4>
        </div>
    </div>
@endif