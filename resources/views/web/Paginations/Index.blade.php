@if ($paginator->hasPages())
    <div class="basic-pagination pt-40">
        <nav>
            <ul>
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li>
                        <span class="disabled">
                            <i class="far fa-angle-left"></i>
                        </span>
                    </li>
                @else
                    <li>
                        <a href="{{ $paginator->previousPageUrl() }}">
                            <i class="far fa-angle-left"></i>
                        </a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li>
                            <span class="disabled">{{ $element }}</span>
                        </li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li>
                                    <span class="current">{{ $page }}</span>
                                </li>
                            @elseif ($page == 1 || $page == $paginator->lastPage() || abs($page - $paginator->currentPage()) <= 2)
                                <li>
                                    <a href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @elseif ($page == $paginator->currentPage() + 3 || $page == $paginator->currentPage() - 3)
                                <li>
                                    <span class="disabled">...</span>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li>
                        <a href="{{ $paginator->nextPageUrl() }}">
                            <i class="far fa-angle-right"></i>
                        </a>
                    </li>
                @else
                    <li>
                        <span class="disabled">
                            <i class="far fa-angle-right"></i>
                        </span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
@endif
