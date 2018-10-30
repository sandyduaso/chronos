@extends('Theme::layouts.admin')

@section('head:title', __('Themes / Appearance'))
@section('page:title', __('Themes'))

@section('page:content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card-deck">

          @foreach ($resources as $resource)
            @include('Theme::widgets.themecard', compact('resource'))
          @endforeach

        </div>
      </div>
    </div>
  </div>
@endsection
