@extends('Theme::layouts.master')

@section('main')
  <main id="main" class="main pt-4 bg-workspace" data-main>
    @yield('content')
  </main>
@endsection

@section('footer', '')
