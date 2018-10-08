<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-transparent small">
    @foreach (breadcrumbs() as $crumb)
      <li class="breadcrumb-item small {{ $crumb->last ? 'active' : '' }}" {{ $crumb->last ? 'aria-current="page"' : '' }}">
        @if ($crumb->last)
          <span>{{ __($crumb->label) }}</span>
        @else
          <a href="{{ $crumb->url }}">{{ __($crumb->label) }}</a>
        @endif
      </li>
    @endforeach
  </ol>
</nav>
