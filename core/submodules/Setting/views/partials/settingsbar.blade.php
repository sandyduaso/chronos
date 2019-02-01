<div class="sidebar-static mb-3">
  <div class="sidebar-nav nav-pills">
    <div class="list">
      @foreach (sidebar()->parent()->children ?? [] as $menu)
        <a data-name="{{ @$menu->labels->title }}" href="{{ $menu->url ?? "?code={$menu->code}" }}" class="sidebar-item nav-link {{ ($menu->active || $menu->url == request()->url()) ? 'active' : null }}">
          @isset ($menu->icon)
            <i class="{{ $menu->icon }}">&nbsp;</i>
          @endisset

          @isset ($menu->labels->title)
            <span>{!! $menu->labels->title !!}</span>
          @endisset
        </a>
      @endforeach
    </div>
  </div>
</div>
