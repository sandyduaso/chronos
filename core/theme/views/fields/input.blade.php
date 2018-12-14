<div class="form-group">
  <label for="{{ $name }}" class="form-label">{{ __($label ?? ucfirst($name)) }}</label>
  <div class="{{ isset($icon) ? 'input-icon' : null }} {{ isset($prepend) ? 'input-group' : null }}">

    @isset ($icon)
      <span class="input-icon-addon">
        <i class="{{ $icon }}"></i>
      </span>
    @endisset

    @isset ($prepend)
      <span class="input-group-prepend">
        <span class="input-group-text">{{ $prepend }}</span>
      </span>
    @endisset

    <input id="{{ $name }}" {{ $attr ?? '' }} type="{{ $type ?? 'text' }}" name="{{ $name }}" class="form-control {{ $errors->has($name) ? 'is-invalid' : '' }}" value="{{ $value ?? old($name) }}">

  </div>
  @isset ($hint)
    @if (! $errors->has($field ?? $name))
      @include('Theme::fields.hint', ['text' => $hint])
    @endif
  @endisset
  @include('Theme::errors.span', ['field' => $field ?? $name])
</div>
