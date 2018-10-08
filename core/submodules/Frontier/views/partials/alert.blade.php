@if (Session::has('type') && Session::get('type') == 'alert')
    <dialog class="mdl-dialog">
        <h4 class="mdl-dialog__title">Allow data collection?</h4>
        <div class="mdl-dialog__content">
            <p>
                Allowing us to collect data will let us get you the information you want faster.
            </p>
        </div>
        <div class="mdl-dialog__actions">
            <button type="button" class="mdl-button">Agree</button>
            <button type="button" class="mdl-button close">Disagree</button>
        </div>
    </dialog>
    <div role="alert" class="alert alert-">
        <div class="banner-block">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h5>{!! Session::get('icon') or '' !!}{!! Session::get('title') !!}</h5>
            {!! Session::get('message') !!}
        </div>
    </div>
@endif
