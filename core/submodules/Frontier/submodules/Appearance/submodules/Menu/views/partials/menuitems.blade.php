@foreach ($menus as $menu)
  <div {{ ($disabled ?? false) ? null : 'role=button' }} class="card mb-3">
    <div class="card-header border-0 d-flex justify-content-between">
      <div></div>
      @if (! ($disabled ?? false))
        <button type="button" class="btn btn-secondary btn-sm"><i class="fe fe-x"></i></button>
      @endif
    </div>
    <div class="card-body border-0">
      @field('input', [
        'name' => 'title',
        'label' => false,
        'value' => $menu->title,
      ])

      @field('input', [
        'name' => 'slug',
        'label' => false,
        'prepend' => '/',
        'value' => $menu->slug,
      ])
    </div>
  </div>
  @if ($menu->has_children)
    <div class="pl-6 bg-workspace">
      @include('Menu::partials.menuitems', ['menus' => $menu->children])
    </div>
  @endif
@endforeach
