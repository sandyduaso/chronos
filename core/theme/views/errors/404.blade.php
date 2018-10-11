@extends('Theme::layouts.blank')

@section('head:title', '404 Page Not Found')

@section('page:content')
  <div class="page">
    <div class="page-content">
      <div class="container text-center">
        <h1 class="display-1 page-title-primary text-muted">{{ __('404') }}</h1>
        <h2 class="h2 mb-3">{{ __('Oops.. page not found.') }}</h2>
        <p class="h4 text-muted font-weight-normal mb-7">{{ __('Either something went wrong or the page does not exist anymore.') }}&hellip;</p>
        <a role="button" href="{{ home() }}" class="btn btn-large btn-primary">{{ __('Home') }}</a>
      </div>
    </div>
  </div>
@endsection

