@extends('Frontier::layouts.master')

{{-- Override the main section from master --}}
@section('main')
  <div class="authentication-card">
    <div class="authentication-card__content">
      @yield('content')
    </div>
  </div>
@endsection
