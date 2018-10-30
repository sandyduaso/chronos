<div class="card mb-3">
  <div class="row">
    <div class="col-sm">
      <div class="card-body">
        <h3 class="mb-1 display-4 text-primary">{{ \User\Models\User::count() }}</h3>
        <p class="m-0 h2 text-primary"><a href="{{ route('users.index') }}">{{ __('Users') }}</a></p>

        <div><a href="{{ route('users.trashed') }}" class="small text-muted">+{{ \User\Models\User::onlyTrashed()->count() }} {{ __('deactivated') }}</a></div>
      </div>
      <div class="card-footer border-0 text-right">
        <a href="{{ route('users.create') }}" role="button" class="btn ml-3 btn-secondary"><i class="{{ $widget->icon }}"></i>&nbsp;{{ __('Add') }}</a>
      </div>
    </div>
  </div>
</div>
