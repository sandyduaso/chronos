@if ($errors->has($field))
  <span class="small text-danger">{{ $errors->first($field) }}</span>
@endif
