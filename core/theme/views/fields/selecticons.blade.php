<select {{ $attr ?? '' }} title="{{ __('Icon') }}" name="{{ $name ?? 'details[#][icon]' }}" class="form-control">
  <optgroup label="{{ __('Editor') }}">
    <option {{ isset($value) ? ($value === 'mdi mdi-pen' ? 'selected="selected"' : '') : '' }} value="mdi mdi-pen" data-icon="mdi mdi-pen">{{ __('Pen') }}</option>
  </optgroup>
  <optgroup label="{{ __('Files') }}">
    <option {{ isset($value) ? ($value === 'mdi mdi-file-excel' ? 'selected="selected"' : '') : '' }} value="mdi mdi-file-excel" data-icon="mdi mdi-file-excel">{{ __('MS Excel') }}</option>
    <option {{ isset($value) ? ($value === 'mdi mdi-google-spreadsheet' ? 'selected="selected"' : '') : '' }} value="mdi mdi-google-spreadsheet" data-icon="mdi mdi-google-spreadsheet">{{ __('Google Spreadsheet') }}</option>
  </optgroup>
  <optgroup label="{{ __('Misc') }}">
    <option {{ isset($value) ? ($value === 'fe fe-activity' ? 'selected="selected"' : '') : '' }} value="fe fe-activity" data-icon="fe fe-activity">{{ __('Activity') }}</option>
    <option {{ isset($value) ? ($value === 'fe fe-star' ? 'selected="selected"' : '') : '' }} value="fe fe-star" data-icon="fe fe-star">{{ __('Star') }}</option>
    <option {{ isset($value) ? ($value === 'fe fe-smartphone' ? 'selected="selected"' : '') : '' }} value="fe fe-smartphone" data-icon="fe fe-smartphone">{{ __('Mobile Phone') }}</option>
    <option {{ isset($value) ? ($value === 'fe fe-phone' ? 'selected="selected"' : '') : '' }} value="fe fe-phone" data-icon="fe fe-phone">{{ __('Phone') }}</option>
    <option {{ isset($value) ? ($value === 'fa fa-birthday-cake' ? 'selected="selected"' : '') : '' }} value="fa fa-birthday-cake" data-icon="fa fa-birthday-cake">{{ __('Birthday') }}</option>
    <option {{ isset($value) ? ($value === 'fe fe-map-pin' ? 'selected="selected"' : '') : '' }} value="fe fe-map-pin" data-icon="fe fe-map-pin">{{ __('Map Pin') }}</option>
    <option {{ isset($value) ? ($value === 'fe fe-heart' ? 'selected="selected"' : '') : '' }} value="fe fe-heart" data-icon="fe fe-heart">{{ __('Heart') }}</option>
  </optgroup>
  <optgroup label="{{ __('Social') }}">
    <option {{ isset($value) ? ($value === 'fe fe-github' ? 'selected="selected"' : '') : '' }} value="fe fe-github" data-icon="fe fe-github">{{ __('Github') }}</option>
    <option {{ isset($value) ? ($value === 'fe fe-instagram' ? 'selected="selected"' : '') : '' }} value="fe fe-instagram" data-icon="fe fe-instagram">{{ __('Instagram') }}</option>
    <option {{ isset($value) ? ($value === 'fe fe-facebook' ? 'selected="selected"' : '') : '' }} value="fe fe-facebook" data-icon="fe fe-facebook">{{ __('Facebook') }}</option>
    <option {{ isset($value) ? ($value === 'fe fe-twitter' ? 'selected="selected"' : '') : '' }} value="fe fe-twitter" data-icon="fe fe-twitter">{{ __('Twitter') }}</option>
    <option {{ isset($value) ? ($value === 'fe fe-linkedin' ? 'selected="selected"' : '') : '' }} value="fe fe-linkedin" data-icon="fe fe-linkedin">{{ __('Linkedin') }}</option>
    <option {{ isset($value) ? ($value === 'fe fe-slack' ? 'selected="selected"' : '') : '' }} value="fe fe-slack" data-icon="fe fe-slack">{{ __('Slack') }}</option>
  </optgroup>
</select>
