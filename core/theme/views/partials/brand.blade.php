@section('brand:logo')
  <div class="brand-logo {{ $color ?? '' }}">
    {!! logo(public_path('logo.svg')) !!}
  </div>
@show
