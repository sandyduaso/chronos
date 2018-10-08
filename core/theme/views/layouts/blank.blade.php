@extends('Theme::layouts.master')

@section('main')
  <div class="page">
    <div class="page-content">
      @yield('content')
    </div>
  </div>
@endsection

@section('footer', '')
