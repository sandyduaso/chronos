<div class="form-group">
  <label for="{{ $name }}" class="form-label">{{ __($label ?? ucfirst($name)) }}</label>
  <textarea id="{{ $name }}" {{ $attr ?? '' }} type="{{ $type ?? 'text' }}" name="{{ $name }}" class="form-control {{ $errors->has($name) ? 'is-invalid' : '' }}">{{ old($name) }}</textarea>
  @include('Theme::errors.span', ['field' => $field ?? $name])
</div>
