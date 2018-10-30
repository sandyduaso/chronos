@extends('Theme::layouts.master')

@push('before:main')
  @include('Theme::partials.sidebar')
@endpush

@section('main')
  @section('workspace')
    <div id="workspace" class="workspace justify-content-start">
      @include('Theme::partials.utilitybar')
      @include('Theme::partials.breadcrumbs')

      <main id="main" class="main justify-content-start" role="main">
        @stack('before:content')

        @section('content')
          @section('main:title')
            <div data-sticky="#page-header"></div>
            <nav id="page-header" data-sticky-class="sticky bg-workspace sticky-shadow" class="navbar px-3">
              @section('page:header')
                <h1 class="page-title">
                  @section('page:title')
                    {{ __($application->page->title) }}
                  @show
                </h1>
              @show
            </nav>
          @show

          @section('main:content')
            @yield('page:content')
          @show

          @yield('main:footer')
        @show

        @stack('after:content')
      </main>

      @include('Theme::partials.snackbar')
      @include('Theme::partials.endnote')

    </div>
  @show
@endsection

@section('footer', '')
