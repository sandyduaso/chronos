@extends('Theme::layouts.master')

@section('root')
  <div id="app" class="page gradient-primary" data-app>
    <div style="opacity:0.09;position:fixed;width:100vw;height:100vh;background-image: url({{ theme('dist/assets/img/patterns/seigaiha.png?v=2') }})"></div>
    <main class="page-main page-single mt-3" data-main>
      @yield('content')
    </main>
  </div>
@endsection

@section('footer', '')
