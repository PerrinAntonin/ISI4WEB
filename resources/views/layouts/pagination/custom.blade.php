@if ($paginator->hasPages())

<div class="row">
    <div class="col-12">
        <!-- Pagination -->
        <nav aria-label="navigation">
            <ul class="pagination justify-content-end mt-50">
                @foreach ($elements as $element)

                    @if (is_string($element))
                    <li class="disabled"><span>{{ $element }}</span></li>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="active page-item"><span class="page-link">{{ $page }}.</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}.</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </ul>
        </nav>
    </div>
</div>
@endif