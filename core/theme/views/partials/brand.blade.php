@section('brand:logo')
  <div class="brand-logo mb-3 {{ $color ?? '' }}">
    {!! logo(core_path('theme/dist/logos/logo.svg')) !!}
  </div>
@show
