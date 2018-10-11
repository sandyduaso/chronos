@if ($errors->has($field))
  <span class="error help-block">{{ $errors->first($field) }}</span>
@endif
