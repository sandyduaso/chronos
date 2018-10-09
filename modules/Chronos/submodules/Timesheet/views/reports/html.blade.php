@foreach ($resource->department() as $department => $employees)
  <a name="scroll-{{ str_slug($department) }}" class="mb-8 d-block"></a>
  <div id="scroll-{{ str_slug($department) }}" class="card card-table card-sm small mb-4">
    <div class="card-header">
      <i class="fe fe-circle"></i>&nbsp;
      <a href="#scroll-{{ str_slug($department) }}">
        <strong class="lead">{{ $department }}</strong>
      </a>
    </div>
    <div class="table-responsive">
      <table class="table table-sm">
        <tbody>
          @foreach ($employees as $id => $calendar)
            <tr>
              <td><a name="{{ $id }}"></a></td>
            </tr>
            <tr>
              <td class="pt-6"><strong>{{ __('Employee') }}</strong></td>
              <td class="pt-6"><strong><a href="#{{ $id }}">{{ $id }}</a></strong></td>
              <td class="pt-6" colspan="100%">Name goes here</td>
            </tr>
            <tr><td colspan="100%"></td></tr>
            <tr class="text-center">
              <td colspan="2"></td>
              <td>{{ __('Time In') }}</td>
              <td>{{ __('Time Out') }}</td>
              <td>{{ __('Morning Hours') }}</td>
              <td>{{ __('Afternoon Hours') }}</td>
              <td>{{ __('Total Hours') }}</td>
              <td>{{ __('Hours Late') }}</td>
              <td>{{ __('Under Time') }}</td>
              <td>{{ __('Over Time') }}</td>
              <td>{{ __('Offset for Tardy') }}</td>
            </tr>
            @foreach ($calendar as $j => $date)
              <tr class="text-center {{ $date->weekend || $date->holiday ? 'bg-light text-muted' : '' }}">
                <td>{{ $date->dayletter }}</td>
                <td>{!! $date->dated ?? '<span class="text-muted">00:00:00</span>' !!}</td>
                <td>{!! $date->time_in ?? '<span class="text-muted">00:00:00</span>' !!}</td>
                <td>{!! $date->time_out ?? '<span class="text-muted">00:00:00</span>' !!}</td>
                <td>{!! $date->total_am ?? '<span class="text-muted">00:00:00</span>' !!}</td>
                <td>{!! $date->total_pm ?? '<span class="text-muted">00:00:00</span>' !!}</td>
                <td>{!! $date->total_time ?? '<span class="text-muted">00:00:00</span>' !!}</td>
                <td>{!! $date->tardy_time ?? '<span class="text-muted">00:00:00</span>' !!}</td>
                <td>{!! $date->under_time ?? '<span class="text-muted">00:00:00</span>' !!}</td>
                <td>{!! $date->over_time ?? '<span class="text-muted">00:00:00</span>' !!}</td>
                <td>{!! $date->offset_hours ?? '<span class="text-muted">00:00:00</span>' !!}</td>
              </tr>

              @if ($calendar->last()->date === $date->date)
                <tr class="text-center">
                  <td colspan="2">{{ __('Number of Lates') }}</td>
                  <td>{{ $repository->punchcard()->totalFromKey($calendar->toArray(), 'time_in') }}</td>
                  <td colspan="4"></td>
                  <td><strong>{{ $repository->punchcard()->totalFromKey($calendar->toArray(), 'tardy_time') }}</strong></td>
                  <td><strong>{{ $repository->punchcard()->totalFromKey($calendar->toArray(), 'under_time') }}</strong></td>
                  <td><strong>{{ $repository->punchcard()->totalFromKey($calendar->toArray(), 'over_time') }}</strong></td>
                  <td><strong>{{ $repository->punchcard()->totalFromKey($calendar->toArray(), 'offset_hours') }}</strong></td>
                </tr>
              @endif
            @endforeach
            {{-- Computations --}}
            {{-- Computations --}}
            <tr><td colspan="100%"></td></tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endforeach
{{-- {{ dd($resource->calendarized()) }} --}}
