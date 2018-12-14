@if (isset($dropzone) && $dropzone)
  <div {{ $attr ?? null }} data-dropzone="{{ isset($options) ? json_encode($options ?? []) : null }}" class="file-upload dropzone">
    <div class="fallback">
      <div class="custom-file">
        <input {{ isset($multiple) && $multiple ? 'name='.($name??'file').'[]' : 'name='.($name??'file') }} type="file" class="custom-file-input" {{ isset($multiple) && $multiple ? 'multiple' : null }} {{ isset($options['acceptedFiles']) ? 'accept='.$options['acceptedFiles'] : null }}>
        <label class="custom-file-label">{{ __('Choose files...') }}</label>
      </div>
    </div>
  </div>
@else
  <div class="form-group file-upload">
    @isset ($label)
      <label class="form-label">{{ $label }}</label>
    @endisset
    <div class="custom-file">
      <input {{ $attr ?? null }} {{ isset($multiple) && $multiple ? 'name='.($name ?? 'file').'[]' : 'name='.($name ?? 'file') }} type="file" class="custom-file-input" {{ isset($multiple) && $multiple ? 'multiple' : null }} {{ isset($options['acceptedFiles']) ? 'accept='.$options['acceptedFiles'] : null }}>
      <label class="custom-file-label">{{ __('Choose files...') }}</label>
      @include('Theme::errors.span', ['field' => $field ?? $name ?? 'file'])
    </div>
  </div>
@endif
