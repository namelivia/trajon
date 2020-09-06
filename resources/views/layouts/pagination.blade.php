<nav aria-label="Pagination">
  <ul class="pagination">
    <li class="page-item {{ $response->offset == 0 ? 'disabled' : ''}}">
        <a class="page-link" href="?page={{($response->offset / $response->limit) - 1}}">Anterior</a>
    </li>
    @foreach (range(0, ($response->total/$response->limit)) as $page)
        @if ($loop->index > ($response->offset / $response->limit) - 10 &&
            $loop->index < ($response->offset / $response->limit) + 10)
            <li class="page-item {{ $loop->index == ($response->offset / $response->limit) ? 'active' : ''}}">
                <a class="page-link" href="?page={{$page}}">{{$page}}</a>
            </li>
        @endif
    @endforeach
    <li class="page-item {{ $response->offset + $response->limit > $response->total ? 'disabled' : ''}}">
        <a class="page-link" href="?page={{$response->offset + 1}}">
            Siguiente
        </a>
    </li>
  </ul>
</nav>
