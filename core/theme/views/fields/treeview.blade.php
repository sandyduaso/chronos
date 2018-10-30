@php
  $id = $id ?? 'id';
  $key = $key ?? 'key';
  $text = $text ?? 'text';
@endphp

<div class="treeview">
  <header class="treeview-header">
    @isset ($label)
      <label class="treeview-label form-label">{{ $label ?? __('Items') }}</label>
    @endisset
    @isset ($description)
      <p class="text-muted small">{{ $description }}</p>
    @endisset
    <div class="btn-group btn-group-toggle mb-3">
      @if ((isset($actions) && $actions) || ! isset($actions))
        <button type="button" data-tree-toggle="collapse" class="btn btn-sm btn-secondary"><i class="mdi mdi-arrow-collapse-vertical">&nbsp;</i>{{ __('Collapse') }}</button>
        <button type="button" data-tree-toggle="expand" class="btn btn-sm btn-secondary"><i class="mdi mdi-arrow-expand-vertical">&nbsp;</i>{{ __('Expand') }}</button>
      @endif

      @if ((isset($readonly) && ! $readonly) || ! isset($readonly))
        <button type="button" data-tree-toggle="check" class="btn btn-sm btn-secondary"><i class="mdi mdi-check-all">&nbsp;</i>{{ __('Check') }}</button>
        <button type="button" data-tree-toggle="uncheck" class="btn btn-sm btn-secondary"><i class="mdi mdi-checkbox-blank-outline">&nbsp;</i>{{ __('Uncheck') }}</button>
      @endif
    </div>
  </header>

  <div class="treeview-body mb-3">
    <ul data-tree class="list-group list-group-transparent">
      @foreach ($items as $group => $set)
        <li data-tree-item class="list-group-item">
          <div data-tree-header>
            <div role="button" data-tree-label class="d-flex justify-content-between">
              @if (isset($readonly) && $readonly)
                <div class="m-0">
                  @isset ($icon)
                    <i class="{{ $icon }}"></i>
                  @endisset
                  <strong>{{ ucfirst($group) }}</strong>
                </div>
              @else
                <div class="custom-control custom-checkbox">
                  <input id="checkbox-{{ $group }}" type="checkbox" class="custom-control-input">
                  <label for="checkbox-{{ $group }}" role="button" class="custom-control-label">
                    <strong>{{ ucfirst($group) }}</strong>
                  </label>
                </div>
              @endif

              <i class="mdi mdi-chevron-down"></i>
            </div>
          </div>
          <ul data-tree-child class="list-group border-0 {{ ($collapsed ?? true) ? 'collapse' : null }}">
            @foreach ($set as $item)
              <li data-tree-item class="list-group-item border-0">

                @if (isset($readonly) && $readonly)
                  <div class="m-0">
                    <div><strong>{{ $item->{$key} }}</strong></div>
                    <em class="text-muted">{{ $item->{$text} }}</em>
                  </div>
                @else
                  <div class="custom-control custom-checkbox">
                    <input data-tree-checkbox {{ in_array($item->{$id}, ($value ?? old($old ?? $field ?? $name ?? 'items') ?? [])) ? 'checked=checked' : null }} id="checkbox-{{ $group }}-{{ $item->{$id} }}" type="checkbox" class="custom-control-input" name="{{ $name ?? 'items[]' }}" value="{{ $item->{$id} }}">
                    <label data-tree-label for="checkbox-{{ $group }}-{{ $item->{$id} }}" role="button" class="custom-control-label">
                      <strong>{{ $item->{$key} }}</strong>
                      <p>{{ $item->{$text} }}</p>
                    </label>
                  </div>
                @endif
              </li>
            @endforeach
          </ul>
        </li>
      @endforeach
    </ul>
  </div>
  @include('Theme::errors.span', ['field' => $field ?? $name ?? 'nodes'])
</div>
