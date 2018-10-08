{{-- Per Page --}}
<div class="dropdown" title="{{ __($title ?? 'Filter shown items count') }}">
  <button id="per-page-dropdown" class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    {{ request()->get('per_page') ?? __('All') }}
  </button>
  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="per-page-dropdown">
    @foreach ([5, 15, 20, 30, 50, 100, null] as $perPage)
      <a href="{{ url()->route(request()->route()->getName(), url_filter(['page' => 1, 'per_page' => $perPage])) }}" class="dropdown-item {{ request()->get('per_page') == $perPage ? 'active' : '' }}">{{ __($perPage ?? 'All') }}</a>
    @endforeach
  </div>
</div>
{{-- Per Page --}}
