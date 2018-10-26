@php
  $timesheet = \Timesheet\Models\Timesheet::get()->last();
@endphp

<div class="card mb-3 bg-primary bg-dark text-accent">
  <div class="card-header border-0">
    <h1 class="card-title text-accent"><i class="{{ $widget->icon }}">&nbsp;</i>{{ $widget->name }}</h1>
  </div>
  <div class="card-body text-right">
    @if (! is_null($timesheet))
      <p class="lead m-0">{{ __('Latest') }}</p>
      <h1 class="display-4 m-0 text-primary">
        <a href="{{ route('timesheets.show', $timesheet->id) }}">{{ $timesheet->name }}</a>
      </h1>
      <p class="m-0 subheading">{{ __("From {$timesheet->daterange}") }}</p>
    @else
      <p class="lead m-0">{{ __('Today') }}</p>
      <h1 class="display-4 m-0 text-primary">
        {{ date('F Y') }}
      </h1>
      <p class="m-0 subheading">{{ __('Upload a timesheet for this month.') }}</p>
    @endif
  </div>
  <div class="card-footer border-0 text-right">
    <a href="{{ route('timesheets.index') }}" class="mb-3 btn btn-outline-primary" role="button">{{ __("View Timesheets") }}</a>
    <a href="{{ route('timesheets.create') }}" class="mb-3 btn btn-primary" role="button">{{ __("Create New Timesheet") }}</a>
  </div>
  <div class="card-chart-bg">
    <div id="timesheet-sample-chart" class="chart" data-this-is-pektus data-toggle="chart" data-options='{"size":{"height":64,"width":"600"},"tooltip":{"show":false},"grid":false, "axis":{"x":{"show":false},"y":{"show": false}},"color":{"pattern":["#06c398","#abdfa6"]},"legend":{"show":false},"data":{"columns":[["data1", 3, 5, 0, 1],["data2", 1, 2, 4, 1]],"types": {"data1": "area","data2":"area-spline"}}}'></div>
  </div>
</div>
