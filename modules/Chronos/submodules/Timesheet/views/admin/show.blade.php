@extends('Theme::layouts.admin')

@section('head-title', $resource->name)

@section('page-title')
  <div class="container-fluid p-0">
    <div class="row w-100">
      <div class="col">
        <h1 class="page-title">{{ $resource->name }}</h1>
      </div>
      <div class="col-auto">
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Departments
          </button>
          <div class="dropdown-menu">
            @foreach ($resource->department() as $department => $unused)
              <a data-smooth-scroll--disabled href="#scroll-{{ str_slug($department) }}" class="dropdown-item" href="#">{{ $department }}</a>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('workspace:head')
  <div id="workspace" class="workspace justify-content-start" data-workspace data-spy="scroll" data-target="#report-list" data-offset="50">
@endsection

@section('page-content')
  <div class="container-fluid">
    <div class="row">
      {{-- <div class="col-lg-3">
        <div data-sticky="#report-list"></div>
        <div id="report-list" data-sticky-class="sticky pt-8" class="list-group">
          @foreach ($resource->department() as $department => $unused)
            <a data-smooth-scroll--disabled href="#scroll-{{ str_slug($department) }}" class="list-group-item list-group-item-action">{{ $department }}</a>
          @endforeach
        </div>
      </div> --}}
      <div class="col-lg-12">
        @include('Timesheet::reports.html', ['data' => $resource->data->toArray()])
      </div>
    </div>
  </div>
@endsection
