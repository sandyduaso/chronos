@if (isset($dropzone) && $dropzone)
  <div {{ $attr ?? null }} data-dropzone="{{ isset($options) ? json_encode($options ?? []) : null }}" class="file-upload dropzone">
    <div class="fallback">
      <div class="custom-file">
        <input {{ isset($multiple) && $multiple ? 'name=file[]' : 'name=file' }} type="file" class="custom-file-input" {{ isset($multiple) && $multiple ? 'multiple' : null }} {{ isset($options['acceptedFiles']) ? 'accept='.$options['acceptedFiles'] : null }}>
        <label class="custom-file-label">{{ __('Choose files...') }}</label>
      </div>
    </div>
  </div>
@else
  <div {{ $attr ?? null }} class="file-upload">
    <div class="fallback">
      <div class="custom-file">
        <input {{ isset($multiple) && $multiple ? 'name=file[]' : 'name=file' }} type="file" class="custom-file-input" {{ isset($multiple) && $multiple ? 'multiple' : null }} {{ isset($options['acceptedFiles']) ? 'accept='.$options['acceptedFiles'] : null }}>
        <label class="custom-file-label">{{ __('Choose files...') }}</label>
      </div>
    </div>
  </div>
@endif
