@extends('Theme::layouts.master')

@push('before:main')
  @include('Theme::partials.navigationbar')
@endpush

@section('root')
  @yield('content')
@endsection
