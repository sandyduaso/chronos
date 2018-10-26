<div class="form-group">
  <label for="{{ $name }}" class="form-label">{{ __($label ?? ucfirst($name)) }}</label>
  <input id="{{ $name }}" {{ $attr ?? '' }} type="{{ $type ?? 'text' }}" name="{{ $name }}" class="form-control {{ $errors->has($name) ? 'is-invalid' : '' }}" value="{{ $value ?? old($name) }}">
  @include('Theme::errors.span', ['field' => $field ?? $name])
</div>
