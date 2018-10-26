@extends('Theme::layouts.admin')

@section('head:title', $resource->fullname)

@section('page:title')
  <h1 class="page-title">{{ $resource->fullname }}</h1>
@endsection

@section('page:content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 text-muted">
        no preview available
      </div>
    </div>
  </div>
@endsection
