@if ($errors->has($field))
    {{-- mdl-textfield__error --}}
    <span class="error help-block">{{ $errors->first($field) }}</span>
@endif
