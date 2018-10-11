@section('brand:logo')
  <div class="brand-logo text-{{ $color ?? 'primary' }}">
    {!! logo(public_path('logo.svg')) !!}
  </div>
@show
