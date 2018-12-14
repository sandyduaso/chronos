<div id="{{ $id ?? 'modal-id' }}" class="modal fade" aria-hidden="true" role="dialog">
  <form action="{{ $action ?? '' }}" method="POST" {{ ($upload ?? false) ? 'enctype=multipart/form-data' : null }}>
    {{ csrf_field() }}
    {{ method_field($method ?? 'POST') }}
    <div class="modal-dialog {{ $class ?? null }}" role="document">
      <div class="modal-content">
        <div class="modal-body {{ $alignment ?? 'text-center' }}">
          <div class="m-5"><i class="text-{{ $context ?? 'primary' }} {{ $icon ?? '' }}"></i></div>
          <p class="lead">{!! $lead !!}</p>
          @isset ($text)
            <p>{!! $text !!}</p>
          @endisset

          @if (isset($include) && ! is_array($include))
            @include($include)
          @elseif (isset($include) && is_array($include))
            @include($include[0], $include[1])
          @endif
        </div>
        <div id="bulk-{{ $id ?? 'modal-id' }}" class="bulk-data"></div>
        <div class="modal-footer border-0">
          @if (isset($button) && $button)
            <button type="submit" class="btn btn-{{ $context }}">{{ $button }}</button>
          @endif
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
        </div>
      </div>
    </div>
  </form>
</div>
