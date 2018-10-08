@extends('Theme::layouts.admin')

@section('head-title', $resource->fullname)

@section('page-title', $resource->fullname)

@section('page-content')
  <div class="container-fluid">
    <div class="row">

      <div class="col-lg-12">
        <p class="text-muted text-center">{{ __('Page not available yet.') }}</p>
      </div>

    </div>
  </div>
@endsection
