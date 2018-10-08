@stack('before-empty')

@section('empty')
  <section class="text-center justify-content-center text-muted">
    <div style="filter: grayscale(0.7);">
      @include('Theme::icons.man-on-laptop', ['width' => '200px', 'height' => '200px'])
    </div>

    <div class="text-muted display-6 card-body">
      @isset($states['empty']['title'])
        {!! $states['empty']['title'] !!}
      @else
        <p><strong>{{ __('No resource found') }}</strong></p>
      @endisset
      {!! $states['empty']['text'] ?? 'This page returned empty results.' !!}
    </div>

    @if (request()->get('search'))
      <p>{{ __('Try searching for other keywords') }}</p>
      <div class="col-12 d-flex mx-auto justify-content-center">
        @include('Theme::partials.search', ['close' => __('Reload Page')])
      </div>
    @endif
  </section>
@show

@stack('after-empty')
