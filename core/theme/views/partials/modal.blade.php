<div id="{{ $id ?? 'modal-id' }}" class="modal fade" aria-hidden="true" role="dialog">
  <form action="{{ $action ?? '' }}" method="POST">
    {{ csrf_field() }}
    {{ method_field($method) }}
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body text-center">
          <div class="m-5"><i class="{{ $icon }} text-{{ $context }}"></i></div>
          <p class="lead">{!! $lead !!}</p>
          @isset ($text)
            <p>{!! $text !!}</p>
          @endisset

          @isset ($include)
            @include($include)
          @endisset
        </div>
        <div id="bulk-{{ $id ?? 'modal-id' }}" class="bulk-data"></div>
        <div class="modal-footer border-0">
          <button type="submit" class="btn btn-{{ $context }}">{{ $button }}</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
        </div>
      </div>
    </div>
  </form>
</div>
