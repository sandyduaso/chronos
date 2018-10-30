@extends('Theme::layouts.blank')

@push('css')
  <link rel="stylesheet" href="{{ url('anytheme/'.$resource->code.'/dist/app.min.css') }}">
@endpush

@section('page:content')
  <div class="workspace bg-workspace">
    <div data-sticky="#page-header"></div>
    <header id="page-header" data-sticky-class="sticky bg-workspace sticky-shadow px-4 py-3" class="d-flex justify-content-between p-2 mb-5">
      <a class="btn btn-icon shadow-none mr-sm-2 py-1" href="{{ route('themes.index') }}"><i class="mdi mdi-arrow-left">&nbsp;</i>{{ __('Back to Themes') }}</a>
      <div>
        <span title="{{ __('Primary') }}" class="mx-1 colorinput-color colorinput-sm rounded-circle" style="vertical-align:middle;background-color:{{ $resource->colors->_primary }}"></span>
        <span title="{{ __('Accent') }}" class="mx-1 colorinput-color colorinput-sm rounded-circle" style="vertical-align:middle;background-color:{{ $resource->colors->_accent }}"></span>
        <span title="{{ __('Secondary') }}" class="mx-1 colorinput-color colorinput-sm rounded-circle" style="vertical-align:middle;background-color:{{ $resource->colors->_secondary }}"></span>
      </div>
    </header>

    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6">
          <h1 class="page-title mb-5"><small class="small text-muted">{{ (__('Preview')) }}/</small>{{ __($resource->name) }}</h1>

          <div class="card bg-transparent border-0 shadow-none">
            <div class="card-header border-0">
              <h3 class="card-title">{{ __('Components') }}</h3>
            </div>
            <div class="card-body border-0">
              <div class="list-group list-group-transparent">
                <a href="#" class="list-group-item">{{ __('Alerts') }}</a>
                <a href="#" class="list-group-item">{{ __('Badge') }}</a>
                <a href="#" class="list-group-item">{{ __('Breadcrumb') }}</a>
                <a href="#" class="list-group-item">{{ __('Buttons') }}</a>
                <a href="#" class="list-group-item">{{ __('Button Group') }}</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
