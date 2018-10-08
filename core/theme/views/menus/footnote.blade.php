@if (get_menu('footer'))
  <ul class="list-inline list-inline-dots mb-0">
    @foreach (get_menu('footer') as $menu)
      <li class="list-inline-item"><a href="{{ $menu->url }}">{{ __($menu->title) }}</a></li>
    @endforeach
  </ul>
@endif
