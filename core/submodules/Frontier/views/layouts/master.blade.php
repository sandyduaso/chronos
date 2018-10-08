@include('Frontier::partials.head')

<div id="application-root" data-application-root>
  @stack('before-main')

  @section('main')
    <main id="main" data-main>
      @stack('before-content')

      @yield('content')

      @stack('after-content')
    </main>
  @show

  @stack('after-main')
</div>

@include('Frontier::partials.foot')
