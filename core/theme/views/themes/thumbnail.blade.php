<div class="card border-0 m-0">
  <div class="card-body">
    <h3 class="card-title">{{ $item->name }}</h3>
    <div class="card-text">
      <blockquote class="text-muted">
        <div>{{ __('"What if there\'s a sidebar and the sidebar has no color?"') }}</div>
        <cite>{{ __('John, on coming up with the default theme') }}</cite>
      </blockquote>
      {!! $item->description !!}
    </div>
  </div>
</div>
