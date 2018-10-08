@if (session()->has('message'))
  <div
    data-snackbar-autoload
    data-style="{{ session('type') }}"
    data-timeout="{{ session('timeout', 8000) }}"
    data-content="{!! session('message') !!}"
    data-html-allowed="true"
  ></div>
@endif
