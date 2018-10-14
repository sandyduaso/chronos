@extends('Theme::layouts.blank')

@section('head:title', '403')

@section('page:content')
  <div class="page">
    <div class="page-content">
      <div class="container text-center">
        <div class="display-1 text-muted mb-5">{{ __('403') }}</div>
        <h2 class="h2 mb-3">{{ __('Oops.. page is restricted.') }}</h2>
        <p class="h4 text-muted font-weight-normal mb-7">{{ __('We are sorry but you do not have permission to access this page') }}&hellip;</p>
        <a role="button" href="{{ home() }}" class="btn btn-primary">{{ __('Home') }}</a>
      </div>
    </div>
  </div>
@endsection

