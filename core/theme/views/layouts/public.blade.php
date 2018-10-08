@extends('Theme::layouts.master')

@push('before-main')
  @include('Theme::partials.navigationbar', ['fixed' => true])
@endpush

@section('root')
  @yield('content')
@endsection
