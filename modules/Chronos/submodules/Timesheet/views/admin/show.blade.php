@extends('Theme::layouts.admin')

@section('head-title', $resource->name)

@section('page-title')
  <h1 class="page-title">{{ $resource->name }}</h1>
@endsection

@section('page-content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">

            {{-- <div class="border" data-options='{"height": 400}' data-toggle="handsontable" data-value="{{ json_encode($resource->data->toArray()) }}"></div> --}}

            @include('Timesheet::reports.html', ['data' => $resource->data->toArray()])

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
