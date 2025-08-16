@if($entities->isNotEmpty())
    <div class="container">
        <div class="row mt-n1-9">
            @foreach($entities as $entity)
                <div class="col-sm-6 col-lg-3 mb-4 d-flex align-items-stretch">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="position-relative overflow-hidden" style="background: #f8f9fa; width: 100%; height: 220px;">
                            <a href="{{ route('web.product.detail', ['slug'=>$entity->Slug]) }}" style="display: block; width: 100%; height: 100%;">
                                <img 
                                    src="{{ asset('Uploads/Products/'.$entity->File_Name) }}"
                                    alt="{{ $entity->Product_Name ?? 'Product Image' }}"
                                    class="card-img-top img-fluid p-3"
                                    style="width: 100%; height: 100%; object-fit: contain; background: #fff; display: block;"
                                    onerror="this.onerror=null;this.src='{{ asset('/uploads/no-image.svg') }}';"
                                />
                            </a>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title mb-2 text-truncate" title="{{ $entity->Product_Name ?? 'Product Name' }}">
                                <a href="{{ route('web.product.detail', ['slug'=>$entity->Slug]) }}" class="text-decoration-none text-dark">
                                    {{ $entity->Product_Name ?? 'Product Name' }}
                                </a>
                            </h5>
                            {{-- Optionally, add a short description or category here --}}
                            <div class="mt-auto">
                                <a href="{{ route('web.enquiry.index', ['type'=>'product','slug'=>$entity->Slug]) }}"
                                   class="btn btn-primary w-100 mb-2">
                                    <i class="bi bi-envelope me-1"></i> Enquiry
                                </a>
                                <a href="https://wa.me/919001600127?text=Hello, I am interested in {{ urlencode($entity->Product_Name ?? 'this product') }} from Unisafe Securities."
                                   target="_blank"
                                   class="btn btn-success w-100">
                                    <i class="bi bi-whatsapp me-1"></i> WhatsApp Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Custom Pagination -->
        @if ($entities->lastPage() > 1)
            <div class="row">
                <div class="col-sm-12 col-lg-12 mt-1-9 wow fadeInUp" data-wow-delay="50ms">
                    <div class="pagination radius-5 mt-1-9 d-block">
                        <ul>
                            <li class="{{ $entities->onFirstPage() ? 'disabled' : '' }}">
                                <a href="{{ $entities->previousPageUrl() ?? '#' }}">
                                    <i class="fas fa-long-arrow-alt-left me-2"></i> Prev
                                </a>
                            </li>

                            @for ($i = 1; $i <= $entities->lastPage(); $i++)
                                <li class="{{ $entities->currentPage() == $i ? 'active' : '' }}">
                                    <a href="{{ $entities->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor

                            <li class="{{ !$entities->hasMorePages() ? 'disabled' : '' }}">
                                <a href="{{ $entities->nextPageUrl() ?? '#' }}">
                                    Next <i class="fas fa-long-arrow-alt-right ms-2"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        @endif
    </div>
@else
    <div class="col-12">
        <div class="text-center">
            <h4 class="text-center">No products found</h4>
        </div>
    </div>
@endif
