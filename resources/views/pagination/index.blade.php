<nav aria-label="...">
    <ul class="pagination">
        @if($paginator->onFirstPage())
            <li class="page-item disabled">
                <a class="page-link" href="" tabindex="-1">Previous</a>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{$paginator->previousPageUrl()}}" tabindex="-1">Previous</a>
            </li>
        @endif

        @foreach ($elements as $element)

            @if(is_array($element))
                @foreach ($element as $page => $url)

                    @if($page == $paginator->currentPage())
                        <li class="page-item active">
                            <a class="page-link">{{$page}}</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{$url}}">{{$page}}</a>
                        </li>
                    @endif

                @endforeach
            @endif

        @endforeach

        @if($paginator->onLastPage())
            <li class="page-item disabled">
                <a class="page-link" href="" tabindex="-1">Next</a>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{$paginator->nextPageUrl()}}" tabindex="-1">Next</a>
            </li>
        @endif

    </ul>
</nav>
