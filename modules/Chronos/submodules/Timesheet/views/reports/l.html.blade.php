<table class="table table-sm table-bordered">
  <thead></thead>
  <tbody>
    {{-- <tr>
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
    </tr> --}}
    @foreach (collect($resource->department())->only('Barakah') as $department => $calendar)
      <tr class="text-left">
        <td colspan="100%"><strong>{{ $department }}</strong></td>
      </tr>
      @foreach ($calendar as $date => $employees)
        <tr class="text-right">
          <td>{{ date('D', strtotime($date)) }}</td>
          <td>{{ date(settings('default_date', 'd-M-y'), strtotime($date)) }}</td>
          <td></td>
          @foreach ($employees as $employee)
            {{-- @if ($date === '2018-08-20')
              {{ dd($employee) }}
            @endif --}}
            <td>{{ $employee->key . ' ' . $employee->time_in }}</td>
            <td>{{ $employee->time_out }}</td>
            <td>{{ $employee->total_am }}</td>
            <td>{{ $employee->total_pm }}</td>
            <td>{{ $employee->total_time }}</td>
            <td>{{ $employee->tardy_time }}</td>
            <td>{{ $employee->under_time }}</td>
            <td>{{ $employee->over_time }}</td>
            <td>{{ $employee->offset_hours }}</td>
            <td></td>
          @endforeach
        {{-- {{ dd($employee) }} --}}
      @endforeach
    @endforeach
  </tbody>
</table>
{{-- {{ dd($resource->calendarized()) }} --}}
