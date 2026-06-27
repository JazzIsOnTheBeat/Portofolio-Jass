@if ($paginator->hasPages())
    <nav class="admin-pagination justify-center" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="opacity-30 cursor-not-allowed"><i class="fa-solid fa-chevron-left" style="font-size:10px"></i></span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev">
                <i class="fa-solid fa-chevron-left" style="font-size:10px"></i>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="opacity-50">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="active"><span>{{ $page }}</span></span>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next">
                <i class="fa-solid fa-chevron-right" style="font-size:10px"></i>
            </a>
        @else
            <span class="opacity-30 cursor-not-allowed"><i class="fa-solid fa-chevron-right" style="font-size:10px"></i></span>
        @endif
    </nav>
@endif