@if ($errors->has($field))
  <span class="error help-block text-danger">{{ $errors->first($field) }}</span>
@endif
