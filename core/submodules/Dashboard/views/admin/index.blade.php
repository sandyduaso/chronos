@extends('Theme::layouts.admin')

@section('page-content')
  <div class="container-fluid">
    <div class="row">
      {{-- @include("Theme::widgets.glance", ['widgets' => widgets('dashboard.glance', 'location')]) --}}

      <div class="col-lg-12">
        {{-- <div class="card">
          <canvas class="card-img" width="100%" data-confetti data-options='{"max":"60","size":"1","animate":true,"props":["square","triangle"],"colors":[[165,104,246],[230,61,135],[0,199,228],[253,214,126]],"clock":"2","rotate":true,"width":"1200","height":"300"}'></canvas>
          <div class="card-img-overlay bg-transparent justify-content-center py-4 text-center">
            <img class="mx-auto rounded-circle" width="120" height="120" src="{{ user()->photo }}" alt="{{ user()->fullname }}" class="avatar avatar-fit">
            <h1 class="page-title text-primary"><strong>Happy Birthday, {{ user()->firstname }}!</strong></h1>
            <p class="card-text">Here's wishing you a very special day.</p>
          </div>
        </div> --}}
      </div>
    </div>
    <div class="row">
      @foreach (widgets('dashboard.2', 'location') as $widget)
        <div class="col-sm-4">
          @include($widget->view, compact('widget'))
        </div>
      @endforeach
    </div>
  </div>
@endsection
