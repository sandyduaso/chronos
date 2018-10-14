@extends('Theme::layouts.master')

@section('main')
  <main id="main" class="main mt-3" data-main>
    @yield('content')
  </main>
@endsection

@section('footer', '')
