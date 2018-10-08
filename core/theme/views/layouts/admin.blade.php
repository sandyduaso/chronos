@extends('Theme::layouts.master')

@push('before-main')
  @include('Theme::partials.sidebar')
@endpush

@section('main')
  <div id="workspace" class="workspace justify-content-start" data-workspace>

    @include('Theme::partials.utilitybar')
    @include('Theme::partials.breadcrumbs')

    <main id="main" class="main justify-content-start" role="main">
      @stack('before-content')

      @section('content')
        @section('main-title')
          <div data-sticky="#page-header"></div>
          <nav id="page-header" data-sticky-class="sticky bg-workspace shadow-sm" class="navbar">
            @section('page-title')
              <h1 class="page-title">{{ __( $application->page->title) }}</h1>
            @show
          </nav>
        @show


        @section('main-content')
          @yield('page-content')
        @show

        @yield('main-footer')
      @show

      @stack('after-content')
        {{--  @include('Theme::partials.rightsidebar')
        @include('Theme::partials.dialog') --}}
    </main>

    {{-- Snackbar Alert --}}
    @include('Theme::partials.snackbar')
    {{-- Snackbar Alert --}}
    @include('Theme::partials.endnote')

  </div>
@endsection

@section('footer', '')
