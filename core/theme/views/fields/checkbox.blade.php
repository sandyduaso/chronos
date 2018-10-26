<div class="form-group">
  <div class="custom-control custom-checkbox">
    <input id="{{ $name }}" {{ $attr ?? '' }} type="{{ $type ?? 'checkbox' }}" name="{{ $name }}" class="custom-control-input {{ $errors->has($name) ? 'is-invalid' : '' }}" value="{{ $value ?? old($name) }}">
    <label role="button" for="{{ $name }}" class="custom-control-label">{{ __($label ?? ucfirst($name)) }}</label>
  </div>
  @include('Theme::errors.span', ['field' => $field ?? $name])
</div>
