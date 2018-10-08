@foreach ($resource->calendar('card_id') as $key => $calendar)
  <ul>
    <li>
      {{ $key }}
      @foreach ($calendar as $date)
        <p>{{ $date['date'] }}</p>
      @endforeach
    </li>
  </ul>
@endforeach
{{-- {{ dd($resource->calendarized()) }} --}}
