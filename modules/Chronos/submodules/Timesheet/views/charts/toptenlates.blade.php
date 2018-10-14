<div class="card card-table mb-3">
  <div class="card-header border-0">
    <h3 class="card-title">{{ __('Top 10 Staff (That are Late)') }}</h3>
  </div>
  <div class="card-body">
    <div id="timesheet-chart-lates" data-toggle="chart" data-options='{"color":{"pattern":["#06c398","#0c5689"]},"data":{"type":"bar","types":{"Total No. of Lates":"bar"},"columns":{{ json_encode($data[0]) }} },"axis":{"x":{"type":"category","categories":{{ json_encode($data[1]) }} }}}'></div>
  </div>
  <div class="table-responsive">
    <table class="table table-sm table-striped">
      <thead>
        <tr>
          <th>{{ __('Staff') }}</th>
          <th>{{ __('Total No. Hours Lates') }}</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data[1] as $i => $employee)
          <tr>
            <td>{{ $employee }}</td>
            <td>{{ $repository->punchcard()->toTime($data[0][0][$i+1]) }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
