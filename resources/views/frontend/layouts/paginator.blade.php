
@if ($paginator->hasPages())
    <nav class="woocommerce-pagination">
        <ul class="page-numbers">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li>
                    <span class="previous page-numbers" aria-disabled="true">
                        <i class="fas fa-angle-left"></i>
                    </span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" class="next page-numbers" aria-disabled="true" >
                        <i class="fas fa-angle-left"></i>
                    </a>
                </li>
            @endif
            
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li>
                        <span class="previous page-numbers" aria-disabled="true">
                            {{ $element }}
                        </span>
                    </li>
                @endif
            
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <span aria-current="page" class="page-numbers current">{{ $page }}</span>
                            </li>
                        @else
                            <li>
                                <a class="page-numbers" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a class="next page-numbers" href="{{ $paginator->nextPageUrl() }}">
                        <i class="fas fa-angle-right"></i>
                    </a>
                </li>
            @else
                <li>
                    <span class="next page-numbers" aria-disabled="true">
                        <i class="fas fa-angle-right"></i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif

