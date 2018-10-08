@if (Session::has('type') && Session::has('message'))
    <div role="alert" class="alert alert-{{ Session::get('type') }} mt-3">
        <div class="banner-block">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            @if (Session::has('title'))
                <span>{!! Session::get('icon') or '' !!}{!! Session::get('title') !!}</span>
            @endif
            {!! Session::get('message') !!}
        </div>
    </div>
@endif
