<div class="list-group list-group-transparent">
  @foreach ($menus as $menu)
    <a role="panel" href="{{ @$menu['url'] ?? '?code='.$menu['code'] }}" class="list-group-item list-group-item-action flex-column align-items-start {{ @$menu['active'] ? 'active' : null }} {{ request()->get('code') == @$menu['code'] ?? '' ? 'active' : null }}">
      <div>
        @isset ($menu['icon'])
          <i class="{{ $menu['icon'] }}"></i>
        @endisset
        <strong>{{ $menu['name'] }}</strong>
      </div>
      @isset ($menu['description'])
        <p class="small text-truncate">{{ $menu['description'] }}</p>
      @endisset
    </a>
  @endforeach
</div>
