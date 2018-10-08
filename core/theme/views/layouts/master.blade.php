@include('Theme::partials.head')

<div id="app" data-app>
  @stack('before-main')

  @section('main')
    <main id="main" class="main" data-main>
      @stack('before-content')

      @yield('root')

      @stack('after-content')
    </main>
  @show

  @stack('after-main')
</div>

@include('Theme::partials.foot')
