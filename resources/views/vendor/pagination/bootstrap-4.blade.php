@if ($paginator->total())
    <nav>
        <div class="pagination-description">
            @php
                $from = ($paginator->perPage() * $paginator->currentPage()) - ($paginator->perPage() - 1);

                if (($paginator->perPage() * $paginator->currentPage()) > $paginator->total()) {
                    $to = $paginator->total();
                } else {
                    $to = $paginator->perPage() * $paginator->currentPage();
                }

                if ($paginator->total() > $paginator->perPage()) {
                    echo 'Exibindo do <strong>' . $from . '</strong> ao <strong>' . $to . '</strong> de <strong>' . $paginator->total() . '</strong> registros encontrados';
                } else {
                    echo $paginator->total() . ($paginator->total() > 1 ? ' registros encontrados' : ' registro encontrado');
                }
            @endphp
        </div>
        @if ($paginator->hasPages())
            <ul class="pagination m-0 justify-content-end">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <a class="page-link" href="#" aria-disabled="true">
                            &lsaquo;
                        </a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                        <a class="page-link" href="#" aria-disabled="true">&rsaquo;</a>
                    </li>
                @endif
            </ul>
        @endif
    </nav>
@endif
