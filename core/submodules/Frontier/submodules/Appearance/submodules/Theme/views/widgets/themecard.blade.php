<div id="{{ $resource->code }}" class="card card-theme justify-content-between d-flex mb-3">
  @if ($resource->active)
    <div class="card-status bg-accent"></div>
  @endif

  @isset ($resource->preview->hintpath)
    @include($resource->preview->hintpath, ['theme' => $resource, 'item' => $resource])
  @else

    <img src="{{ $resource->thumbnail }}" class="card-theme-thumbnail">
    <div class="card-body text-light bg-overlay">
      <div class="mb-5">
        <h5 class="card-title">{{ $resource->name }}</h5>
        <p class="card-text">{{ $resource->description }}</p>
      </div>
      <div class="card-text">
        @isset ($resource->preview->url)
          <a href="{{ $resource->preview->url }}" target="_blank" class="small text-white">{{ $resource->preview->credit }}</a>
        @else
          <span class="small text-white">{{ $resource->preview->credit }}</span>
        @endisset

      </div>
    </div>

  @endisset

  <div class="card-footer {{ isset($resource->preview->hintpath) ?: 'bg-overlay' }} border-0">
    @isset ($resource->author->name)
      <div class="row">
        <div class="col">
          <div class="theme-author small text-muted mb-3">
            {{ __('Theme by') }}
            {{ $resource->author->name }}
          </div>
        </div>
      </div>
    @endisset
    <div class="row">

      <div class="col">
        <div class="card-action d-flex justify-content-start">
          <div class="mr-3">
            <a role="button" href="{{ route('themes.preview', $resource->code) }}" class="btn btn-secondary btn-sm"><i class="mdi mdi-image-search">&nbsp;</i>{{ __('Details...') }}</a>
          </div>
          @if (! $resource->active)
            <form action="{{ route('settings.store') }}" method="POST">
              @csrf
              <input type="hidden" name="active_theme" value="{{ $resource->code }}">
              <button type="submit" class="btn btn-primary btn-sm">{{ __('Activate') }}</button>
            </form>
          @endif
        </div>
      </div>

      <div class="col d-flex justify-content-end">
        <div>
          <span title="{{ __('Primary') }}" class="mx-1 colorinput-color colorinput-sm rounded-circle" style="vertical-align:middle;background-color:{{ $resource->colors->primary }}"></span>
          <span title="{{ __('Accent') }}" class="mx-1 colorinput-color colorinput-sm rounded-circle" style="vertical-align:middle;background-color:{{ $resource->colors->accent }}"></span>
          <span title="{{ __('Secondary') }}" class="mx-1 colorinput-color colorinput-sm rounded-circle" style="vertical-align:middle;background-color:{{ $resource->colors->secondary }}"></span>
        </div>
      </div>

    </div>
  </div>
</div>
