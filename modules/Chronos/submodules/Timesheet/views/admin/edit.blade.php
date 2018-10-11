@extends('Theme::layouts.admin')

@section('head:title', $resource->name)

@section('page:title')
  <h1 class="page-title">{{ $resource->name }}</h1>
@endsection

@section('page:content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <p class="text-muted">under construction</p>
      </div>
    </div>
  </div>
@endsection
