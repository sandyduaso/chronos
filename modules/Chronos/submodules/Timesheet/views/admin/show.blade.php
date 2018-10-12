@extends('Theme::layouts.admin')

@section('workspace:head')
  <div id="workspace" class="workspace justify-content-start" data-workspace data-spy="scroll" data-target="#report-list" data-offset="50">
@endsection

@section('page:title')
  @parent
  <button data-modal-toggle type="button" class="btn btn-secondary" data-toggle="modal" data-target="#export-single-confirmbox-{{ $resource->id }}" title="{{ __('Export this timesheet') }}">
    <i class="fe fe-download-cloud"></i>
    {{ __('Export...') }}
  </button>
  @include('Theme::partials.modal', [
    'dataset' => false,
    'id' => 'export-single-confirmbox-'.$resource->id,
    'icon' => 'fe fe-download-cloud display-1 icon-border icon-faded d-inline-block',
    'lead' => __('Select format to download.'),
    'text' => 'Export data to a specific file type.',
    'method' => 'POST',
    'action' => route('timesheets.export', $resource->id),
    'button' => __("Export"),
    'context' => 'success',
    'include' => ['Timesheet::fields.export', ['name' => $resource->name]],
  ])
@endsection

@section('page:content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            {{ dd($repository->charts($resource->department())) }}
            <div id="timesheet-chart" data-toggle="chart" data-options='{"data":{"axes":{"Ranking":"y2"},"type":"area","types":{"Total No. of Lates":"bar"},"columns":{{ json_encode($repository->charts($resource->department())) }} },"axis":{"y2":{"show":true},"x":{"type":"category","categories":{{ json_encode($resource->departments) }} }}}'></div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3 col-lg-2">
        <div data-sticky="#report-list"></div>
        <div id="report-list" data-sticky-class="sticky pt-8" class="list-group">
          {{-- @foreach ($resource->department() as $department => $unused)
            <a data-smooth-scroll-test href="#scroll-{{ str_slug($department) }}" class="list-group-item list-group-item-action">{{ $department }}</a>
          @endforeach --}}
        </div>
      </div>
      <div class="col-md-9 col-lg-10">
        {{-- @include('Timesheet::reports.html', ['data' => $resource->data->toArray()]) --}}
      </div>
    </div>
  </div>
@endsection
