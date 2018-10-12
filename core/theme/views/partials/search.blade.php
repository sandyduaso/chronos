<!-- start search form -->
<form class="form-row form-inline my-2" method="GET">
  {{ csrf_field() }}
  <div class="col">
    <div class="form-group mb-0">
      <label for="page-search" class="sr-only">{{ __('Search') }}</label>
      <input id="page-search" tabindex="0" type="text" name="search" class="form-control w-100" aria-describedby="search" placeholder="{{ __('Search') }}" value="{{ request()->get('search') }}">
    </div>
  </div>
  <div class="col-auto col-sm-auto">
    <button type="submit" class="btn btn-secondary"><i class="fe fe-search"></i></button>
    @if (request()->get('search'))
      <a role="button" href="{{ url()->route(request()->route()->getName(), url_filter(['search' => null])) }}" class="btn btn-secondary">
        @isset($close)
          {!! $close !!}
        @else
          <i class="fe fe-x"></i>
        @endisset
      </a>
    @endif
  </div>
</form>
<!-- end search form -->
