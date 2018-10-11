@include('Theme::partials.head')

@section('app')
  <div id="app" data-app>
    @stack('before:main')

    @section('main')
      <main id="main" data-main class="main">
        @stack('before:root')

        @yield('root')

        @stack('after:root')
      </main>
    @show

    @stack('after:main')
  </div>
@show

@include('Theme::partials.foot')
