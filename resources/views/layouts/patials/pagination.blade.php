@if ($paginator->isNotEmpty() && $paginator->hasPages())
    @php
        $paginator->appends($params ?? [])->links();
    @endphp
    <div class="row mt-5">
        <div class="col-12 text-right">
            <hr>

            <div class="btn-group btn-group-toggle">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <label class="btn btn-white"><</label>
                @else
                    <a class="btn btn-white" href="{{$paginator->previousPageUrl()}}" rel="prev"><</a>
                @endif

                {{-- Check has allow limit link --}}
                {{-- Just default --}}
                @if (!$link_limit)
                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <label class="btn btn-white">{{$element}}</label>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <label class="btn btn-primary">{{$page}}</label>
                                @else
                                    <a class="btn btn-white" href="{{$url}}">{{$page}}</a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                    {{-- Customize limit link --}}
                @else
                    @php
                        $half_total_links = floor($link_limit / 2);
                        $from = ($paginator->currentPage() - $half_total_links) < 1 ? 1 : $paginator->currentPage() - $half_total_links;
                        $to = ($paginator->currentPage() + $half_total_links) > $paginator->lastPage() ? $paginator->lastPage() : ($paginator->currentPage() + $half_total_links);
                        if ($from > $paginator->lastPage() - $link_limit):
                            $from = ($paginator->lastPage() - $link_limit) + 1;
                            $to = $paginator->lastPage();
                        endif;
                        if ($to <= $link_limit):
                            $from = 1;
                            $to = $link_limit < $paginator->lastPage() ? $link_limit : $paginator->lastPage();
                        endif;
                    @endphp
                    @for ($i = $from; $i <= $to; $i++)
                        @if ($i == $paginator->currentPage())
                            <label class="btn btn-primary">{{$i}}</label>
                        @else
                            <a class="btn btn-white" href="{{$paginator->url($i)}}">{{$i}}</a>
                        @endif
                    @endfor
                @endif

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a class="btn btn-white" href="{{$paginator->nextPageUrl()}}" rel="next">></a>
                @else
                    <label class="btn btn-white">></label>
                @endif
            </div>
        </div>
    </div>
@endif
