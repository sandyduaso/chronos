<div class="alert alert-{{ $alert['type'] ?? 'info' }} {{ $alert['class'] ?? '' }}">
  @isset ($alert['title'])
    <div><i class="{{ $alert['icon'] ?? 'fe fe-info' }}"></i>&nbsp;<strong>{{ $alert['title'] }}</strong></div>
  @endisset
  @isset ($alert['text'])
    <div>{!! $alert['text'] !!}</div>
  @endisset
</div>
