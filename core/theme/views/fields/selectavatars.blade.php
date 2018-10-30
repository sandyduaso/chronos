<select {{ $attr ?? '' }} title="{{ $title ?? __('Icon') }}" name="{{ $name ?? 'details[#][icon]' }}" class="form-control {{ $class ?? '' }}">
  <optgroup label="{{ __('Avatars') }}">
    @foreach (config('avatar.avatars') as $avatar)
      <option {{ isset($value) ? ($value === $avatar['url'] ? 'selected="selected"' : '') : '' }} value="{{ $avatar['url'] }}" data-content="<img src='{{ $avatar['url'] }}' width='25' height='25'><span class='ml-3'>{{ __($avatar['text']) }}</span>">{{ __($avatar['text']) }}</option>
    @endforeach
  </optgroup>
</select>
