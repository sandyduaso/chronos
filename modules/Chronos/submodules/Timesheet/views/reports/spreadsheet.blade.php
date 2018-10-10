@foreach ($resource->department() as $department => $employees)
  <div class="card card-table">
    <div class="table-responsive">
      <table class="table table-sm table-striped">
        <thead>
          <tr>
            <th colspan="3" class="lead">{{ $department }}</th>
            <th>{{ __('Time in') }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach (calendar($resource->start_date, $resource->end_date) as $date)
            <tr>
              <td>{{ date('D', strtotime($date->day)) }}</td>
              <td>{{ $date->dated }}</td>

              {{-- Employees --}}
              @foreach ($employees as $key => $calendar)
                <td>{{ $key }}</td>
                @foreach ($calendar as $employee)
                  @if ($employee->date === $date->date)
                    <td>{{ $employee->time_in ?? '00:00:00' }}</td>
                  @endif
                @endforeach
              @endforeach
              {{-- Employees --}}

            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endforeach

{{-- {{ dd($resource->calendarized()) }} --}}
