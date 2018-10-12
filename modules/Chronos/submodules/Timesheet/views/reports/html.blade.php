@foreach ($resource->department() as $department => $employees)
  <a name="scroll-{{ str_slug($department) }}" class="d-block"></a>
  <div id="scroll-{{ str_slug($department) }}" class="card card-table card-sm small mb-4">
    <div class="card-header">
      <i class="fe fe-circle"></i>&nbsp;
      <a href="#scroll-{{ str_slug($department) }}">
        <strong class="lead">{{ $department }}</strong>
      </a>
    </div>
    <div class="table-responsive d-flex">
      @foreach ($employees as $id => $employee)
        <table id="table-{{ $id }}" class="table table-sm mb-0">
          <tbody>
            <tr>
              <td class="pt-6">
                <a name="{{ $employee['key'] }}"></a>
                <strong>{{ __('Employee') }}</strong>
              </td>
              <td class="pt-6"><strong><a href="#{{ $employee['key'] }}">{{ $employee['key'] }}</a></strong></td>
              <td class="pt-6" colspan="100%">{{
                $employee['user']
                ? $employee['user']->displayname
                : (($employee['metadata']->firstname ?? $id))
              }}</td>
            </tr>
            <tr><td colspan="100%"></td></tr>
            <tr class="text-center">
              <td class="w-100" colspan="2"></td>
              <td class="w-100">{{ __('Time In') }}</td>
              <td class="w-100">{{ __('Time Out') }}</td>
              <td>{{ __('Morning Hours') }}</td>
              <td>{{ __('Afternoon Hours') }}</td>
              <td>{{ __('Total Hours') }}</td>
              <td>{{ __('Hours Late') }}</td>
              <td>{{ __('Under Time') }}</td>
              <td>{{ __('Over Time') }}</td>
              <td>{{ __('Tardy Offset') }}</td>
            </tr>
            @foreach ($employee['calendar'] as $j => $date)
              <tr class="text-center {{ $date->weekend || $date->holiday ? 'bg-light text-muted' : '' }}">
                <td class="bg-muted">{{ $date->dayletter }}</td>
                <td class="bg-muted" style="min-width:100px;">{!! $date->dated ?? '<span class="text-muted">00:00:00</span>' !!}</td>
                <td><span data-x-contenteditable data-x-data-mask="99:99:99">{!! $date->time_in ?? '<span class="text-muted">00:00:00</span>' !!}</span></td>
                <td><span data-x-contenteditable data-x-data-mask="99:99:99">{!! $date->time_out ?? '<span class="text-muted">00:00:00</span>' !!}</span></td>
                <td><span data-x-contenteditable data-x-data-mask="99:99:99">{!! $date->total_am ?? '<span class="text-muted">00:00:00</span>' !!}</span></td>
                <td><span data-x-contenteditable data-x-data-mask="99:99:99">{!! $date->total_pm ?? '<span class="text-muted">00:00:00</span>' !!}</span></td>
                <td><span data-x-contenteditable data-x-data-mask="99:99:99">{!! $date->total_time ?? '<span class="text-muted">00:00:00</span>' !!}</span></td>
                <td><span data-x-contenteditable data-x-data-mask="99:99:99">{!! $date->tardy_time ?? '<span class="text-muted">00:00:00</span>' !!}</span></td>
                <td><span data-x-contenteditable data-x-data-mask="99:99:99">{!! $date->under_time ?? '<span class="text-muted">00:00:00</span>' !!}</span></td>
                <td><span data-x-contenteditable data-x-data-mask="99:99:99">{!! $date->over_time ?? '<span class="text-muted">00:00:00</span>' !!}</span></td>
                <td><span data-x-contenteditable data-x-data-mask="99:99:99">{!! $date->offset_hours ?? '<span class="text-muted">00:00:00</span>' !!}</span></td>
              </tr>

              @if ($employee['calendar']->last()->date === $date->date)
                <tr class="text-center">
                  <td colspan="2" class="text-right">{{ __('Number of Lates') }}</td>
                  <td>
                    <a title="{{ __('Late this number of times during this period.') }}">{{ $repository->punchcard()->totalLateCount($employee['calendar'], 'time_in') }}</a>
                  </td>
                  <td colspan="4"></td>
                  <td><strong>{{ $repository->punchcard()->totalFromKey($employee['calendar']->toArray(), 'tardy_time') }}</strong></td>
                  <td><strong>{{ $repository->punchcard()->totalFromKey($employee['calendar']->toArray(), 'under_time') }}</strong></td>
                  <td><strong>{{ $repository->punchcard()->totalFromKey($employee['calendar']->toArray(), 'over_time') }}</strong></td>
                  <td><strong>{{ $repository->punchcard()->totalFromKey($employee['calendar']->toArray(), 'offset_hours') }}</strong></td>
                </tr>
              @endif
            @endforeach
          </tbody>
        </table>
      @endforeach
    </div>
  </div>
@endforeach
{{-- {{ dd($resource->calendarized()) }} --}}
