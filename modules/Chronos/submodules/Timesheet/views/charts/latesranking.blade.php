<div class="card card-table mb-3">
  <div class="card-header border-0">
    <h3 class="card-title">{{ __('Total No. of Lates with Department Ranking') }}</h3>
  </div>
  <div class="card-body">
    <div id="timesheet-chart-ranking" data-toggle="chart" data-options='{"data":{"axes":{"Ranking":"y2"},"type":"line","types":{"Total No. of Lates":"bar"},"columns":{{ $data }} },"axis":{"y2":{"inverted":true,"show":true},"x":{"type":"category","categories":{{ $departments }} }}}'></div>
  </div>
</div>
