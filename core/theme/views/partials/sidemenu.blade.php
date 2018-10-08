@if (isset($sidemenus))
  <div class="list-group list-group-transparent">
    @foreach ($sidemenus as $menu)
      <a href="{{ $menu['url'] }}" class="list-group-item list-group-item-action {{ $menu['active'] ? 'active' : '' }}"><span class="icon mr-3"><i class="{{ $menu['icon'] }}"></i></span>{{ __($menu['labels']['title']) }}</a>
    @endforeach
  </div>
@endif
